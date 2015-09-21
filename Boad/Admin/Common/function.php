<?php 
function get_boadlist($tid,$order,$page,$perpage){
    $page = $page<=0?1:$page;
    $begin = ($page-1)*$perpage;
    $order = $order == 1?'DESC':'ASC';
    
    $m = M('boadlist');
    $res = $m->field('id,content,dig,comment_count,uptime')->where('tid = %d',$tid)->order('id '.$order)->limit($begin,$perpage)->select();
    
    $preg = "/<img(.*?)style=\".*?\"(.*?)\/?>/i";
    $replaced = '<img \\1 \\2 />';
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
