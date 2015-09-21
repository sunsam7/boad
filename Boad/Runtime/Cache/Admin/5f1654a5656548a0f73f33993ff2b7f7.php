<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title><?php echo ($title); ?></title>
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
	.text_center{
		text-align: center;
	}
	.input_text{
		width:95%;
		border:none;
		border-bottom: 1px #775599 solid;
	}
	img{
		max-width: 200px;
	}
	
</style>
</head>
<body>
<table class="table">
	<tr>
    	<td colspan="3" ><a href="/wish/Admin">返回专题列表</a></td>
    	<td colspan="3" class="text_right"><a href="/wish/Admin/Index/boadcontent/tid/<?php echo ($tid); ?>">发表内容</a></td>
    </tr>
  <tr>
    <th scope="col">ID</th>
    <th scope="col" width="60%">内容</th>
    <th scope="col">顶</th>
    <th scope="col">评论数</th>
    <th scope="col">时间</th>
    <th scope="col">操作</th>
  </tr>
<tbody id="c_body"></tbody>
  <tr>
  	<td colspan="6" class="text_center">
  	<select name="s_page" onchange="javascript:get_boadlist(boad_id,order,this.value,perpage);">
  	<?php $__FOR_START_10780__=1;$__FOR_END_10780__=$pagecount+1;for($i=$__FOR_START_10780__;$i < $__FOR_END_10780__;$i+=1){ ?><option value="<?php echo ($i); ?>"><?php echo ($i); ?></option><?php } ?>
  	</select>
  	</td>
  </tr>
</table>
<script type="text/javascript" src="/wish/Public/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
var dig_post_file = '/wish/Admin/Index/ajax_act/';
function delete_data(obj,id){
	var obj_tr = jQuery(obj).parent().parent();
	if(confirm("确定要删除这条数据吗？")){
		jQuery.post(dig_post_file, {
	        act:"delete_bcontent",id:id
	    }, function(data) {
	        if (data.status==1) { 
	            obj_tr.remove();
	        }else{
	            alert('错误请重试');
	        }
	    }, "json");
	}
}

var perpage = <?php echo ($perpage); ?>;
var page = 1;
var boad_id=<?php echo ($tid); ?>;
var order =1;
      
jQuery(document).ready(function(){
    get_boadlist(boad_id,order,page,perpage);
});

function get_boadlist(boad_id,order,page,perpage){
	jQuery("#c_body").html('<tr><td colspan="6" class="text_center">loading...</td></tr>');
	var results_str = '';
	jQuery.get(dig_post_file, {
            act:"get_boadlist",id:boad_id,order:order,page:page,perpage:perpage
        }, function(data) {
            if (data.status == 1) {
                for (var i = 0; i < data.data.length; i++) {
                	results_str = results_str + '<tr><td>'+data.data[i]['id']+'</td><td>'+data.data[i]['content']+'</td><td>'+data.data[i]['dig']+'</td><td>'+data.data[i]['comment_count']+'</td><td>'+data.data[i]['uptime']+'</td><td><a href="/wish/Admin/Index/boadcontent/id/'+data.data[i]['id']+'">修改</a> | <a href="javascript:void(0);" onclick="delete_data(this,'+data.data[i]['id']+');">删除</a></td></tr>';
                }
                jQuery("#c_body").html(results_str);
            }
                }, "json");

}
</script>
</body>
</html>