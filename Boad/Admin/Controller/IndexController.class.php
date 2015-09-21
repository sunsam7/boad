<?php
namespace Admin\Controller;
 //use Think\Controller;
use Common\Controller\AuthController;
/*class IndexController extends AuthController {
    public function index(){
        $this->show('Admin');
    }
} */

//class IndexController extends Controller{
class IndexController extends AuthController {
    public function index(){
        $this->assign('title','直播专题列表');
        $m = M('boadtitle');
        $res = $m->field('id, author, status, title,datetime')->select();
        $this->assign('list',$res);
        $this->display();
    }
    
    public function boadtitle(){
        $id = I('id');
        $res = array();
        if ($id){
            $title = '直播专题修改';
            $act = 'update';
            $m = M('boadtitle');
            $res = $m->find($id);
        }else{
            $title = '直播专题新增';
            $act = 'add';
        }
        $this->assign('title',$title);
        
        $this->assign('act',$act);
        $this->assign('info',$res);
        $this->display();
    }
    public function boadtitle_save(){
        $post = I('post.');
        $m = M('boadtitle');
        $url = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:U('index','','');
        if ($post['act'] == 'add'){
            $post['datetime'] = date('Y-m-d H:i:s');
            $insert_id = $m->add($post);
            if ($insert_id) {
                echo "<script> alert('add ok'); </script>";
                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
            }else{
                echo "<script> alert('保存出错'); </script>";
                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
            }
        }else{
            $res = $m->save($post);
            if ($res) {
                echo "<script> alert('update ok'); </script>";
                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
            }else{
                echo "<script> alert('保存出错'); </script>";
                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
            }
        }
    }
    
    public function boadlist(){
        $id = I('id');
        $this->assign('tid',$id);
    
        $mbt = M('boadtitle');
        $title = $mbt->where('id=%d',$id)->getField('title');
        $this->assign('title',$title);
    
        $mbl = M('boadlist');
        $perpage = 50;
        $ct = $mbl->where('tid=%d',$id)->getField('count(*)');
        $pagecount = ceil($ct/$perpage);
        $this->assign('pagecount',$pagecount);
        $this->assign('perpage',$perpage);
    
        $this->display();
    }
    
    public function boadcontent(){
        $id = I('id');
        $tid = I('tid');
        
        $m = M('boadlist');
        if (intval($id)){
            $title = '修改直播内容';
            $act = 'update';
            $res = $m->find($id);
        }else{
            if (!intval($tid))$this->error('未知的直播主题',U('index','',''));
            $title = '新增直播内容';
            $act = 'add';
            $res = array('tid'=>$tid);
        }
        $this->assign('title',$title);
        $this->assign('act',$act);
        $this->assign('info',$res);
        
        $this->display();
    }
    
    public function boadcontent_save(){
        $post = I('post.');
        $post['content'] = I('content','','stripslashes');
        //p($post);
        $m = M('boadlist');
        $url = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:U('index','','');
        if ($post['act'] == 'add'){
            $post['uptime'] = date('Y-m-d H:i:s');
            $res = $m->field('tid,content,dig,uptime')->add($post);
            if ($res) {
                echo "<script> alert('add ok'); </script>";
                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
            }else{
                echo "<script> alert('保存出错'); </script>";
                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
            }
        }else{
            $res = $m->field('id,tid,content,dig,uptime')->save($post);
            if ($res) {
                echo "<script> alert('update ok'); </script>";
                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
            }else{
                echo "<script> alert('保存出错'); </script>";
                echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
            }
        }
    }
    
    public function ajax_act(){
        $act = I('act');
        if(!empty($act) && $act == 'get_boadlist'){
            $tid        = ( !empty($_GET['id']) )  ? intval($_GET['id']) : 1;
            $order        = ( is_numeric($_GET['order']) )  ? $_GET['order'] : 1;
            $page        = ( !empty($_GET['page']) )  ? intval($_GET['page']) : 1;
            $perpage        = ( !empty($_GET['perpage']) )  ? intval($_GET['perpage']) : 10;
            get_boadlist($tid,$order,$page,$perpage);
            
        }elseif(!empty($act) && $act == 'delete_bcontent'){
            $id = I('id',0,'intval');
            //p($id);
            if ($id){
                if (M('boadlist')->where('id=%d',$id)->delete()){
                    $mbc = M('boadcomment');
                    $ct = $mbc->field('boadtitle_id,count(*) as ct')->where('boadlist_id=%d',$id)->find();
                    $res = $mbc->where('boadlist_id=%d',$id)->delete();
                    if ($res){
                        M('boadtitle')->where('id=%d',$ct['boadtitle_id'])->setDec('comment_count',$ct['ct']);
                        $data = array('status'=>1);
                    }else{  //删除相关评论不成功
                        $data = array('status'=>2,'err'=>'boadlist deleted,comment delete error!');
                    }
                }else{  //删除此条内容不成功
                    $data = array('err'=>'error');
                }
                echo json_encode($data);
            }
        }elseif(!empty($act) && $act == 'delete_title'){
            $id = I('id',0,'intval');
            if ($id){
                if (M('boadtitle')->where('id=%d',$id)->delete()){
                    if (M('boadlist')->where('tid=%d',$id)->delete()){
                        M('boadcomment')->where('boadtitle_id=%d',$id)->delete();
                        $data = array('status'=>1);
                    }else{
                        $data = array('status'=>2,'err'=>'title deleted,list delete error!');
                    }
                }else {
                    $data = array('status'=>3,'err'=>'delete error!');
                }
                echo json_encode($data);
            }
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}