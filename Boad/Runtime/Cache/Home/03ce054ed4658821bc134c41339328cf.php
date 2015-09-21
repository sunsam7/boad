<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($title); ?></title>
<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
<link href="/boad/Public/css/style.css" rel="stylesheet" type="text/css"> 
</head>

<body>
<script type="text/javascript">
 var wbcontent = "<?php echo ($title_info['title']); ?>";
 var wbpic = encodeURI('<?php echo ($title_info['titlepic']); ?>');
</script>
  <div class="body" id="J-main">
      <div class="g-hd">
          <a href="#" class="header-home" title=""></a>
          <div class="header-title"><?php echo ($title_info['title']); ?></div>
          <div id="j-bdShare" class="header-share">
              <div class="shareBox">
                  <p class="pTit">分享到</p>
                  <div id="bdshare_warp" sharetype="tools">
                  <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
                    <a href="javascript:window.open('http://service.weibo.com/share/share.php?appkey=810519544&title='+encodeURIComponent(wbcontent)+'&url='+encodeURIComponent(location.href)+'&pic='+wbpic+'&searchPic=false','_blank','width=450,height=400');void(0)" class="bds_tsina" title="分享至新浪微博"><img src="Public/header.html/images/weibo-yuan.svg" width="25" height="25" class="weibo-yuan-svg" /></a>
                    <a href="javascript:window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+ encodeURIComponent(location.href)+ '&title='+encodeURIComponent(wbcontent),'_blank');" class="bds_qzone" title="分享至QQ空间"><img src="Public/header.html/images/q-zindex.svg" width="25" height="25" class="kongjian-svg" /></a>
                    </div>
                  </div>
              </div>
          </div>
      </div>
      
      <div class="poster">
      	<img src="<?php echo ($title_info['titlepic']); ?>" />
        <div class="userheader"><a><img alt="" src="<?php echo ($title_info['authorpic']); ?>" /></a></div>
      </div>
      
      <div class="poster-topic">
      	<h2>本期主播编辑：<?php echo ($title_info['author']); ?></h2>
        <p><?php echo ($title_info['description']); ?></p>
      </div>

      <div class="m-tab">
          <a id="subti2_1" class="subti2_on" onclick="subqh(1,2,'subti2_','subch2_')">直播现场<em>(<?php if($title_info['status'] == 0): ?>未开始<?php elseif($title_info['status'] == 1): ?>正在直播<?php else: ?>已结束<?php endif; ?>)</em></a>
          <a id="subti2_2" class="subti2_off" onclick="subqh(2,2,'subti2_','subch2_');init_cla();">网友评论<em>(<i id="all_count"><?php echo ($title_info['comment_count']); ?></i>)</em></a>
      </div>
      
      <div id="subch2_1">
      <div class="refrash">
          <span class="refrash-new"> 
             <a id="subti_1" class="subti_on" onclick="set_sort(1)">新</a>
              <a id="subti_2" class="subti_off" onclick="set_sort(0)">旧</a>
          </span>   
      </div>
      <a class="newmess" style="display: none;" onclick="clear_list();get_boadlist(boad_id,order,1,perpage);">有新内容，点击查看</a>
      <!-- <a class="newmess" style="display: none;"><img src="images/loading.gif" width="20">正在自动加载最新内容</a> -->
	  
      <div  id="subch_1">
      <ul class="picTxt" id="Jcomment">
      </ul>
      
      
      <div id="loadingMore" style="display:none;text-align: center;" class="btn-more">
        正在加载...
      </div>

      <!-- 加载完毕后显示 -->
      <a class="btn-more" id="no_more" style="display: none;">亲&gt;_&lt;暂时就这么多了哦~</a> 
      <a class="cmtmess" href="javascript:void(0);" onclick="subqh(2,2,'subti2_','subch2_');init_cla();">网友评论<em>(<i id="all_count1"><?php echo ($title_info['comment_count']); ?></i>)</em> &gt;&gt; </a>
      </div>
      

      <script type="text/javascript">
      function subqh(num,count,menu,cont){
    		for(var id = 1;id<=count;id++)
    		{
    			if(id==num)
    			{
    				document.getElementById(cont+id).style.display="block";
    				document.getElementById(menu+id).className=menu+"on";
    			}
    			else
    			{
    				document.getElementById(cont+id).style.display="none";
    				document.getElementById(menu+id).className=menu+"off";
    			}
    		}
	    }
      </script>

      <script type="text/javascript">

                /*展开*/
                var clickFn = {
                    show:function(ele1,ele2,className,html){
                        if(!ele1 || !ele2 || !className) return;
                        var objA = document.querySelectorAll('.'+ele1),
                        objB = document.querySelectorAll('.'+ele2),
                        objA_len = objA.length,
                        html = html ||"",
                        oHtml ='';

                        for (var i = 0; i < objA_len; i++) {
                            (function(j){
                                objA[j].addEventListener('click', function(evt){
                                    evt = evt || window.event;
                                    evt.stopPropagation?evt.stopPropagation():evt.cancelBubble=true;
                                    if(objB[j].className == ele2){
                                        objB[j].className = ele2 +' '+ className;
                                        if(html ==''){return;}
                                        this.innerHTML = html;
                                    }else{
                                        objB[j].className = ele2;
                                        if(html !=''){
                                            oHtml = objA[j].innerHTML;
                                            this.innerHTML = oHtml;
                                        }                    
                                    }                
                                }, false);
                                document.addEventListener('click',function(){
                                    objB[j].className = ele2;
                                },false);
                            })(i);
                        };
                    }
                };
               
                clickFn.show('header-share','header-share','header-shareopen');

            </script>

   <div class="toTop-btn" title="回顶部" onclick="window.scrollTo(0, 0);" style="display: none;"></div>
   	  <script type="text/javascript">
	  var footFn = {
	  getId: function(id) {
	  return document.getElementById(id);
	  },
	  getElem: function(selectors) {
	  return document.querySelector(selectors);
	  },
	  getElems: function(selectors) {
	  return document.querySelectorAll(selectors);
	  },
	  show: function(obj) {
	  obj.style.display = "block";
	  },
	  hide: function(obj) {
	  obj.style.display = "none";
	  },
	  };
	  (function() {
	  window.addEventListener("scroll", function() {
	  if (document.documentElement.scrollTop + document.body.scrollTop > 800) {
	  footFn.show(footFn.getElem(".toTop-btn"));
	  } else {
	  footFn.hide(footFn.getElem(".toTop-btn"));
	  }
	  }, false);
	  })();
	  </script><!--返回顶部-->

      <script type="text/javascript" src="/boad/Public/js/jquery-1.11.0.min.js"></script>
      <script type="text/javascript" src="/boad/Public/js/a_function.js"></script>
      <script type="text/javascript">
      var dig_post_file = '/boad/Home/Index/ajax_act/';
      var perpage = 5;
      var page = 1;
      var boad_id=<?php echo ($title_info['id']); ?>;
      var order =1;
      var perpage_cl = 20;
      var list_count = <?php echo ($list_count); ?>;

      jQuery(document).ready(function(){
        get_boadlist(boad_id,order,page,perpage);
      });

      

      //滑动到底部加载更多

      //获取滚动条当前的位置 
      function getScrollTop() { 
        var scrollTop = 0; 
        if (document.documentElement && document.documentElement.scrollTop) { 
          scrollTop = document.documentElement.scrollTop; 
        } 
        else if (document.body) { 
          scrollTop = document.body.scrollTop; 
        } 

        return scrollTop; 
      } 

      //获取当前可是范围的高度 
      function getClientHeight() { 
        var clientHeight = 0; 
        if (document.body.clientHeight && document.documentElement.clientHeight) { 
          clientHeight = Math.min(document.body.clientHeight, document.documentElement.clientHeight); 
        } 
        else { 
          clientHeight = Math.max(document.body.clientHeight, document.documentElement.clientHeight); 
        } 

        return clientHeight; 
      } 

      //获取文档完整的高度 
      function getScrollHeight() { 
        return Math.max(document.body.scrollHeight, document.documentElement.scrollHeight); 
      }

      //var page;
      // var pageCount = 10;
      var loadStatus = false;

      window.onscroll = function() {
        if (getScrollTop() + getClientHeight() == getScrollHeight()) {
          if (!loadStatus) {
            loadStatus = true;
            page++;
            get_boadlist(boad_id,order,page,perpage);
            loadStatus = false;
          }
        }
      }

      var sii = setInterval('check_new()',30000);
      function check_new(){
        // alert(boad_id);
        jQuery.get(dig_post_file, {
              act:"get_listcount",title_id:boad_id
            }, function(data) {
              if (data.status == 1) {
                if (data.list_count>list_count) {
                  list_count = data.list_count;
                  page = 1;
                  jQuery('.newmess').show();
                }
              }
            }, "json");
      }

      </script> <!--翻页滚动-->
     </div>
     
     
     <div id="subch2_2" style="display:none;">
     <div class="comment-con" id="comment_cla">
            <!-- 评论模块 -->
            <div class="comment" id="comment_pop" style="display: block;" title_id="<?php echo ($title_info['id']); ?>" list_id="0">
          <!-- 评论输入 -->
          <div class="c-input">
              <div class="c-top">
                  <span class="c-user">
                      <input type="text" name="username" id="username" value="<?php echo $username;?>" placeholder="用户名" />
                  </span>
              </div>
              <div class="c-area">
                  <textarea id="content" name="content" rows="" cols="" placeholder="内容"></textarea>
              </div>
              
              <div class="c-btn" onclick="add_comment(this);">
                  <span class="c-submit" id="cmtSubmit_pop">发表</span>
              </div>
          </div>
      </div>
            
            
            
            <!-- 分类标题 -->
            <div class="section"><span class="mark">所有评论</span></div>
            <!-- 评论列表 -->
            <div id="commentlist_0" class="c-list comment_l_flag" style="display: block;"></div>
            
            <div class="btn-more" id="J-more"></div>
            
        </div>
     </div>

 </div>

<!-- 提示框 -->
      <div class="popbg" id="popbg" style="position: fixed; z-index: 9999; width: 100%; height: 100%; top: 0; left: 0; background: rgba(0, 0, 0, 0.3);display:none;">
        <div class="popcontain" style="position: fixed; z-index: 10000; min-width: 140px; max-width: 280px; margin: auto; left: 0; top: 0; right: 0; bottom: 0; min-height: 100px; max-height: 150px; background: #fff; border-radius: 2px; overflow: hidden; text-align: center;">
        <div class="popmessage" style="margin-top: 4%; font-size: 20px; padding: 10px; "></div>
        <a href="javascript:void(0)" class="popbtn" style="position: absolute; bottom: 0; left: 0; width: 100%; height:40px;line-height:40px;text-align:center; background:#ebecee; color:#666; " onclick="javascript: document.getElementById('popbg').style.display = 'none';">确定</a>
        </div>
      </div>