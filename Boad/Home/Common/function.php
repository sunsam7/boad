<?php
// use Think\Model;
function verifycheck($code,$id=''){
    $verify = new Think\Verify();
    return $verify->check($code,$id);
}

function get_boadlist($tid,$order,$page,$perpage){
    $page = $page<=0?1:$page;
    $begin = ($page-1)*$perpage;
    $order = $order == 1?'DESC':'ASC';
    
    $m_bl = M('boadlist');
    $res = $m_bl->field('id,content,dig,comment_count,uptime')->where('tid=%d',$tid)->order('id '.$order)->limit($begin,$perpage)->select();

    $host = APP_DEBUG?'':'http://cdn.aitecar.com';
    //$host = 'http://cdn.aitecar.com';
    $preg = '/(<a.*?>)?<img(.*?)src=\"(http.*?aitecar\.com)?(.*?)\".*?(style=\".*?\")?(.*?)\/?>(<\/a>)?/i';
    $replaced = '<a href="'.$host.'\\4"><img \\2 src="'.$host.'\\4?imageView2/2/w/600/q/80" \\5/></a>';
    foreach ($res as $key => $value) {
        $res[$key]['content'] = preg_replace($preg, $replaced, $res[$key]['content']);
    }

    if (!empty($res)) {
        $date['status'] = 1;
        $date['data'] = $res;
    }else{
        $date['status'] = 2;
    }

    $out = json_encode($date);
    echo  $out;
}

function dig_boad($type,$id,$orgnum){
    if(0 && isset($_COOKIE["dig_boad_".$type.$id]) && $_COOKIE["dig_boad_".$type.$id] == 1){
        echo json_encode("你已经投过票了！\n每人每天只能投一次，谢谢！");
    }elseif(1 || setcookie("dig_boad_".$type.$id,1,time()+3600*24)){
        $table = $type==1?'wp_aite_boadcomment':'wp_aite_boadlist';
        $m = M();
        $r = $m->table($table)->where('id=%d',$id)->setInc('dig');
        if ($r) {
            $date['status'] = 1;
            $date['newnum'] = $orgnum+1;
        }else{
            $date = 'sorry!请重试.';
        }
        $out = json_encode($date);
        echo  $out;
    }else{
        echo json_encode("Aitecar:sorry,please try again later!!");
    }
}

function commit_comment_boad($title_id,$list_id,$parent,$username,$content){
    if (empty($username) || empty($content)) {
        echo json_encode('not be empty');
        die;
    }
    $m = M();
    $datetime   = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $row = $m->table('wp_aite_boadcomment')->where('boadtitle_id = %d',$title_id)->getField('MAX(`floor`)');

    $floor = empty($row)?1:$row+1;
    
    $data['parent'] = $parent;
    $data['boadtitle_id'] = $title_id;
    $data['boadlist_id'] = $list_id;
    $data['username'] = $username;
    $data['content'] = $content;
    $data['dig'] = 0;
    $data['floor'] = $floor;
    $data['ip'] = $ip;
    $data['time'] = $datetime;
    $res = $m->table('wp_aite_boadcomment')->add($data);
    if ($res) {
        $last_inserted_id = $res;
        if ($list_id) {
             $sql = 'UPDATE wp_aite_boadlist bl,wp_aite_boadtitle bt SET bl.comment_count= bl.comment_count+1, bt.comment_count = bt.comment_count+1 WHERE bl.tid = bt.id AND bl.id = '."'%d'";
            $r = $m->execute($sql,$list_id);
        }else{
            $r = $m->table('wp_aite_boadtitle')->where('id = %d',$title_id)->setInc('comment_count');
        }

        /*重新设置评论列表的session*/
        unset($_SESSION['boad_commentlist_'.$title_id]);
        set_bcl_session($title_id);


        if ($r) {
            $date['status'] = 1; //成功
            $date['data'] = array('floor'=>$floor,'username'=>$username,'content'=>$content,'time'=>$datetime,'id'=>$last_inserted_id);
        }else{
            $date['status'] = 2; //评论成功，comment_count不成功
            $date['data'] = array('floor'=>$floor,'username'=>$username,'content'=>$content,'time'=>$datetime,'id'=>$last_inserted_id);
        }
    }else{
        $date['status'] = 0; //不成功
    }
    setcookie('liveboad_username',$username,time()+259200,'/');
    $out = json_encode($date);
    echo $out;
}


function get_boadlist_comment($title_id,$boadlist_id,$page,$perpage){
    //$perpage = 100;
    $page = $page<=0?1:$page;
    $begin = ($page-1)*$perpage;
    $limit = $perpage==0?'':"$begin,$perpage";
    
    $m = M('boadcomment');
    if ($boadlist_id){
        $where = 'boadlist_id = %d AND boadtitle_id = %d';
        $res = $m->field('id,parent,username,content,dig,floor,time')->where($where,$boadlist_id,$title_id)->order('id desc')->limit($limit)->select();
    }else{
        $where = 'boadtitle_id = %d';
        $res = $m->field('id,parent,username,content,dig,floor,time')->where($where,$title_id)->order('id desc')->limit($limit)->select();
    }

    if(!isset($_SESSION)){
        session_start();
    }
    if (empty($_SESSION['boad_commentlist_'.$title_id])) {
        $newresall = set_bcl_session($title_id);
        $a = 1;
    }else{
        $newresall = $_SESSION['boad_commentlist_'.$title_id];
        $a = 2;
    }

    $news = array();
    foreach ($res as $k => $v) {
        $news[$v['id']] = $v;
    }

    $res = array_intersect_key($newresall,$news);
    $res = array_values($res);

    if (!empty($res)) {
        $date['status'] = 1;
        $date['data'] = $res;
        $date['a'] = $a;
    }else{
        $date['status'] = 2;
    }

    $out = json_encode($date);
    echo  $out;
}


function get_boadlist_comment_all($title_id,$page,$perpage){
    //$perpage = 100;
    $page = $page<=0?1:$page;
    $begin = ($page-1)*$perpage;
    if(!isset($_SESSION)){
        session_start();
    }
    if (empty($_SESSION['boad_commentlist_'.$title_id])) {
        $res = set_bcl_session($title_id);
        $a = 11;
    }else{
        $res = $_SESSION['boad_commentlist_'.$title_id];
        $a = 12;
    }

    $res = array_slice($res, $begin,$perpage);

    if (!empty($res)) {
        $date['status'] = 1;
        $date['data'] = $res;
        $date['a'] = $a;
    }else{
        $date['status'] = 2;
    }

    $out = json_encode($date);
    echo  $out;
}

function set_bcl_session($title_id){
    $m = M('boadcomment');
    $where = 'boadtitle_id = %d';
    $resall = $m->field('id,parent,username,content,dig,floor,time')->where($where,$title_id)->order('id desc')->select();
    
    $newresall = array();
    foreach ($resall as $k => $v) {
        $newresall[$v['id']] = $v;
    }
    foreach ($newresall as $kk => $vv) {
        if ($vv['parent']>0) {
            $newresall[$kk]['parentnode'] = $newresall[$vv['parent']];
        }
    }

    //$_SESSION['boad_commentlist_'.$title_id] = $newresall;
    return $newresall;
}

function get_listcount($title_id){
    $m = M('boadlist');
    $list_count = $m->where('tid=%d',$title_id)->getField('count(*)');
    if ($list_count) {
        $date['status'] = 1;
        $date['list_count'] = $list_count;
        $out = json_encode($date);
        echo  $out;
    }
}