<?php
namespace Home\Controller;
use Think\Controller;
//use Think\Upload;
//use Think\Verify;
//use Think\Image;
//use Home\Event\UserEvent;
//use Home\Model\UserModel;
class UserController extends Controller{
	public function index(){
	    /* //$cf = array('useNoise' => false);
	    $fy = new Verify();
	    $fy->useImgBg = true;
	    $fy->useNoise = false;
	    //$fy->fontttf = '3.ttf';
	    //$fy->fontttf = 'FZLTCXHJW.TTF';
	    //$fy->useZh = true;
	    //$fy->zhSet = '你是不像我在太阳下唱歌';
	    $fy->entry(); */
	    $this->display();
	}
	
	/* public function upload(){
	    $upload = new Upload();
	    $upload->maxSize=31457280;
	    $upload->exts = array('jpg','gif','png');
	    $upload->savePath = './';
	    $info = $upload->upload();
	    if(!$info){
	        $this->error($upload->getError());
	    }else {
	        //$this->success('right');
	        //dump($info);
	        foreach ($info as $file){
	            echo $file['key'],' ',$file['savename'];
	        }
	    }
	    echo 34;
	} */

	public function test(){
	    /* $a = new UserEvent();
	    $a->test(); */
	    
	    /* $img = new Image();
	    $img->open('./Public/Images/top.jpg');
	    //echo $img->width();
	    //$img->crop(500,126,0,0,100,50)->save('./Public/1.jpg');
	    $img->thumb(100, 20)->save('./Public/1.jpg'); */
	    
	    /* $code = I('code');
	    echo $code.'<br/>';
	    dump(verifycheck($code)); */
	    
	    /* $a = D('User');
	    $data = $a->relation(true)->select();
	    dump($data); */
	    echo C('DATA_CACHE_TYPE');
	    
	}
	
	public function create(){
		/* $wish = M('user');
		//dump($wish->add($wish->create()));
		$data = $wish->create();
		$data['time'] = time();
		dump($wish->add($data)); */
		$this->assign('title','titlecreate');
		$this->display();
	}
	
	public function _empty(){
	    echo 'err',ACTION_NAME;
	}
}