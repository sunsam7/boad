<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title><?php echo ($title); ?></title>
</head>
<style type="text/css">
	.table{
		border: 1px solid #ccc;border-collapse: collapse; width:100%;
	}
	.table th,.table td{
		border: 1px solid #ccc;padding: 2px;
	}
	.text_right{
		text-align: right;
	}
	.input_text{
		width:95%;
		border:none;
		border-bottom: 1px #775599 solid;
	}
	
</style>
<body>
<form id="btitle" name="btitle" method="post" action="/wish/Admin/Index/boadtitle_save">
<table class="table">
	<tr>
    	<td scope="row"><a href="/wish/Admin">返回列表</a></td>
    	<td scope="row" class="text_right"><a href="/wish/Admin/Index/boadtitle">新增直播专题</a></td>
    </tr>
  <tr>
    <th scope="row" width="28%">直播名称</th>
    <td><input class="input_text" type="text" name="title" id="title" value="<?php echo ($info["title"]); ?>" /></td>
  </tr>
  <tr>
    <th scope="row" width="28%">头图地址(640*326)</th>
    <td><input class="input_text" type="text" name="titlepic" id="titlepic" value="<?php echo ($info["titlepic"]); ?>" /></td>
  </tr>
  <tr>
    <th scope="row">主播</th>
    <td><input class="input_text" name="author" type="text" value="<?php echo ($info["author"]); ?>" /></td>
  </tr>
  <tr>
    <th scope="row">主播头像地址</th>
    <td><input class="input_text" name="authorpic" type="text" value="<?php echo ($info["authorpic"]); ?>" /></td>
  </tr>
  <tr>
    <th scope="row">描述</th>
    <td><input class="input_text" name="description" type="text" value="<?php echo ($info["description"]); ?>" /></td>
  </tr>
  <tr>
    <th scope="row">状态</th>
    <td>
      <input type="radio" name="status" id="status0" value="0" <?php if($info["status"] == 0): ?>checked="checked"<?php endif; ?> /><label for="status0">等待开始</label>
      <input type="radio" name="status" id="status1" value="1" <?php if($info["status"] == 1): ?>checked="checked"<?php endif; ?> /><label for="status1">直播中</label>
      <input type="radio" name="status" id="status2" value="2" <?php if($info["status"] == 2): ?>checked="checked"<?php endif; ?> /><label for="status2">已结束</label>
    </td>
  </tr>
  <tr>
    <td colspan="2" scope="row" class="submit">
    	<input type="submit" name="button" id="button" value="提交" />
    	<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
    	<input type="hidden" name="act" value="<?php echo ($act); ?>" />
    </td>
    </tr>
</table>

</form>
</body>
</html>