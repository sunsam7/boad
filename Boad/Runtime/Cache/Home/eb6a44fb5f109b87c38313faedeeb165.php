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
asdfasdf<br/>

<form action="/wish/Home/User/upload" method="post" enctype="multipart/form-data" >
<!-- <input type="text" name="name" /> -->
<input name="file[]" type="file" />
<input name="file[]" type="file" />
<input name="file[]" type="file" />
<input type="submit" value="提交"/>
</form>



</div>
</body>
</html>