<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($title); ?></title>
<style>
*{
	margin:0;
	padding:0;	
}
body{
	position:relative;	
}
#guess{
	position:absolute;
	width:300px;
	height:300px;
	font-size:20px;
	top:50%;
	left:50%;
	margin:150px 0 0 -150px;
	text-align:center;
	color:#333;
	font-family:Arial, Helvetica, sans-serif;	
}
img{
	border:0;	
}

</style>
</head>

<body>
<!-- <div id="guess">
	Coming Soon...
</div> -->
<div>
<!-- <?php if(isset($word)): ?>word已经存在<?php else: ?>word不存在<?php endif; ?><br/>
<?php if(isset($_GET['user'])): ?>$_Get['user']已经存在<?php else: ?>user不存在<?php endif; ?><br/> -->
<!-- <?php if(empty($word)): ?>word为空<?php else: ?>word不为空:<?php echo ($word); endif; ?> -->

<!-- <ul>
	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arr): $mod = ($i % 2 );++$i;?><li><?php echo ($i); ?>.<?php echo ($arr['username']); ?> 说 ：<?php echo ($arr['content']); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul> -->

<!-- <?php $good_id = '1412'; ?>
<?php echo ($good_id); ?> -->




<div style="color:#9922cc;border:1px solid #9922cc" >你好吗？我很好</div>
</div>
</body>
</html>