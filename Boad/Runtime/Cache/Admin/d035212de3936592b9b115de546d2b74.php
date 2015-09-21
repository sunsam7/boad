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

<table class="table">
	<tr>
    	<td colspan="3" ></td>
    	<td colspan="3" class="text_right"><a href="/wish/Admin/Index/boadtitle">新建专题</a></td>
    </tr>
  <tr>
    <th scope="col">ID</th>
    <th scope="col" width="60%">标题</th>
    <th scope="col">作者</th>
    <th scope="col">状态</th>
    <th scope="col">时间</th>
    <th scope="col">操作</th>
  </tr>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
    <td><?php echo ($vo["id"]); ?></td>
    <td><a href="/wish/<?php echo ($vo["id"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></td>
    <td><?php echo ($vo["author"]); ?></td>
    <td><?php echo ($vo["status"]); ?></td>
    <td><?php echo ($vo["time"]); ?></td>
    <td><a href="/wish/Admin/Index/boadlist/id/<?php echo ($vo["id"]); ?>">内容</a>  <a href="/wish/Admin/Index/boadtitle/id/<?php echo ($vo["id"]); ?>">修改</a>  <a href="javascript:void(0);" onclick="delete_data(this,<?php echo ($vo["id"]); ?>);">删除</a></td>
  </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
</table>
<script type="text/javascript" src="/wish/Public/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
function delete_data(obj,id){
	var obj_tr = jQuery(obj).parent().parent();
	if(confirm("确定要删除这个专题吗？专题的内容将会同步删除。")){
		jQuery.post("boadcontent_save.php", {
	        act:"delete_title",id:id
	    }, function(data) {
	        if (data.status==1 || data.status==2) { 
	            obj_tr.remove();
	            if (data.status==2) {alert(data.err);};
	        }else{
	            alert(data.err);
	        }
	    }, "json");
	}
}
</script>
</body>
</html>