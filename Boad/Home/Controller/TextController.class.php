<?php
namespace Home\Controller;
use Think\Controller;

class TextController extends Controller{
	public function index(){
        $um = M('user');
        $res = $um->select();
        p($res);
    }
}