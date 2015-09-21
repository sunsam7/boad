<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<title><?php echo ($title); ?></title>
<style type="text/css">
	.table{
		border: 1px solid #ccc;border-collapse: collapse; width:100%;
	}
	.table th,.table td{
		border: 1px solid #ccc;padding: 2px;
	}
	.table th,.text_right{
		text-align: right;
	}
	.input_text{
		width:95%;
		border:none;
		border-bottom: 1px #775599 solid;
	}
	.content{
		width: 95%;
		height: 100px;
	}
	.submit{
		text-align: center;
	}
</style>
<script src="/wish/Public/js/ckeditor44/ckeditor.js"></script>
<script src="/wish/Public/js/ckfinder/ckfinder.js"></script>

</head>
<body>
<form id="btitle" name="btitle" method="post" action="/wish/Admin/Index/boadcontent_save/">
<table class="table">
	<tr>
	<td scope="row"><a href="/wish/Admin/Index/boadlist/id/<?php echo ($info["tid"]); ?>">返回内容列表</a></td>
	<?php if($act == 'update'): ?><td scope="row" class="text_right"><a href="/wish/Admin/Index/boadcontent/tid/<?php echo ($info["tid"]); ?>">新增直播内容</a></td>
	<?php else: ?>
	<td class="text_right">新增</td><?php endif; ?>
    
    </tr>
    <tr style="height:20px;">
    	
    </tr>
  
  <tr>
    <td colspan="2"><textarea class="content" name="content" id="content" ><?php echo ($info["content"]); ?></textarea></td>
  </tr>
  <tr>
    <th scope="row" width="28%">顶</th>
    <td><input name="dig" type="text" value="<?php echo ($info["dig"]); ?>" /></td>
  </tr>
  <tr>
    <th scope="row">时间</th>
    <td><input  name="uptime" type="text" value="<?php echo ($info["uptime"]); ?>" /></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" class="submit">
    	<input type="submit" name="button" id="button" value="提交" />
    	<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
    	<input type="hidden" name="tid" value="<?php echo ($info["tid"]); ?>" />
    	<input type="hidden" name="act" value="<?php echo ($act); ?>" />
    </td>
    </tr>
</table>
<script>
    var editor = CKEDITOR.replace( 'content' ,{
    	//uiColor: '#9AB8F3',
    	height:300,
    	filebrowserBrowseUrl : '/wish/Public/js/ckfinder/ckfinder.html',
    	filebrowserImageBrowseUrl : '/wish/Public/js/ckfinder/ckfinder.html?Type=Images',
    	filebrowserFlashBrowseUrl : '/wish/Public/js/ckfinder/ckfinder.html?Type=Flash',
    	filebrowserUploadUrl : '/wish/Public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    	filebrowserImageUploadUrl : '/wish/Public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    	filebrowserFlashUploadUrl : '/wish/Public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
    });
    CKFinder.setupCKEditor(editor, 'ckfinder/');
</script>
</form>
</body>
</html>