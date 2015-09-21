<?php
namespace Common\Controller;
use Think\Controller;
use Think\Auth;

class AuthController extends Controller{
    protected function _initialize(){
        $session = session('auth');
        if (!$session)$this->error('非法访问',U('Login/index'));
        if ($session['id'] == 1){
            return true;
        }
        $auth = new Auth();
         if (!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,$session['id'])){
            $this->error('没有权限',U('Login/index'));
        } 
        /* if($session['id']){
            return true;
        } */
    }
    
    
}