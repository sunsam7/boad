<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {
    public function index(){
        if (IS_POST){
            $login = array();
            switch (I('name',null,false)){
                case 'admin':
                    $login['name'] = 'admin';
                    $login['id'] = 1;
                    break;
                case 'sunsam7':
                    $login['name'] = 'sunsam7';
                    $login['id'] = 2;
                    break;
                case 'ppkyq':
                    $login['name'] = 'ppkyq';
                    $login['id'] = 3;
                    break;
                default:
                    $this->error('无此用户');
            }
            if (!empty($login)){
                session('auth',$login);
                $this->success('登录成功',U('Index/index'));
            }
        }else{
            $this->display();
        }
        
    }
    
    public function logout(){
        //session('[destroy]');
        unset($_SESSION['auth']);
        $this->success('退出成功',U('Login/index'));
    }
}