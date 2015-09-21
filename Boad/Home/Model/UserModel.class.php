<?php
namespace Home\Model;
//use Think\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel{
	//protected $tablePrefix = 'tp32_';
	//protected $tableName = 'wish';
	
	/* protected $_scope = array(
			'sql1'		=> array(
					'where' => array('id'=>1),
				),
			'order'		=> array(
					'order'	=> array('id'=>'desc'),
				),
			'default'	=> array(
					'where'	=> array('id'=>3),
				),
		);
	
	protected $_validate = array(
			//array('id','number','请填写数字'),
			array('id','2015-1-1,2015-3-18','请规定日期',0,'expire'),
	); */
    
    /* protected $_link = array(
        'Card' => array(
            'mapping_type'  => self::HAS_ONE,
            'foreign_key'   => 'user_id',
            //'class_name'    =>  'Card',
            //'mapping_fields'    => 'number',
            'as_fields'     => 'number',
            
        ),
    ); */

}