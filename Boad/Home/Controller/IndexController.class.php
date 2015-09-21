<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $id = I('id',0,'intval');
        $m_b = M('boadtitle');
        $res = $m_b->field('id, author, status,description, title, titlepic, authorpic, comment_count, datetime')->where('id=%d',$id)->find();
        $this->assign('title_info',$res);
        $this->assign('title',$res['title']);
        
        $m_bl = M('boadlist');
        $list_count = $m_bl->where('tid=%d',$id)->getField('count(*)');
        $this->assign('list_count',$list_count);
        
        $this->display();
    }
    
    public function abc($id){
        //echo 'good morning!';
        if (!isset($id))$id = 0;
        $this->assign('abc',$id);
        $this->display();
    }
    
    public function ajax_act(){
        if(isset($_POST['act']) && $_POST['act'] == "get_boadlist"){
            $tid        = ( !empty($_POST['id']) )  ? intval($_POST['id']) : 1;
            $order        = ( is_numeric($_POST['order']) )  ? $_POST['order'] : 1;
            $page        = ( !empty($_POST['page']) )  ? intval($_POST['page']) : 1;
            $perpage        = ( !empty($_POST['perpage']) )  ? intval($_POST['perpage']) : 10;
            get_boadlist($tid,$order,$page,$perpage);
        }elseif(isset($_GET['act']) && $_GET['act'] == "dig_boad"){
            $type = is_numeric($_GET['type'])?$_GET['type']:1;
            $id = !empty($_GET['id'])?intval($_GET['id']):1;
            $orgnum = !empty($_GET['org'])?intval($_GET['org']):0;
            dig_boad($type,$id,$orgnum);
        }elseif(isset($_POST['act']) && $_POST['act'] == "commit_comment_boad"){
            $title_id        = ( !empty($_POST['title_id']) )  ? intval($_POST['title_id']) : 1;
            $list_id        = ( is_numeric($_POST['list_id']) )  ? $_POST['list_id'] : 0;
            $parent        = ( is_numeric($_POST['parent']) )  ? $_POST['parent'] : 0;
            $username    = ( isset($_POST['username']) )  ? trim(strip_tags($_POST['username'])) : '';
            $content    = ( isset($_POST['content']) )  ? trim(strip_tags($_POST['content'])) : '';
            commit_comment_boad($title_id,$list_id,$parent,$username,$content);
        }elseif(isset($_GET['act']) && $_GET['act'] == "get_boadlist_comment"){
            $title_id = is_numeric($_GET['title_id'])?intval($_GET['title_id']):1;
            $boadlist_id = is_numeric($_GET['list_id'])?$_GET['list_id']:1;
            $page        = ( !empty($_GET['page']) )  ? intval($_GET['page']) : 1;
            $perpage        = ( is_numeric($_GET['perpage']) )  ? $_GET['perpage'] : 10;
            get_boadlist_comment($title_id,$boadlist_id,$page,$perpage);
        }elseif(isset($_GET['act']) && $_GET['act'] == "get_boadlist_comment_all"){
            $title_id = is_numeric($_GET['title_id'])?intval($_GET['title_id']):1;
            $page        = ( !empty($_GET['page']) )  ? intval($_GET['page']) : 1;
            $perpage        = ( is_numeric($_GET['perpage']) )  ? $_GET['perpage'] : 10;
            get_boadlist_comment_all($title_id,$page,$perpage);
        }elseif(isset($_GET['act']) && $_GET['act'] == "get_listcount"){
            $title_id = is_numeric($_GET['title_id'])?intval($_GET['title_id']):1;
            get_listcount($title_id);
        }
    }
    
}