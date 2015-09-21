function set_sort(sort){
        if (loadStatus) {
          if (order!=sort) {
            order=sort;
            var li_obj=  jQuery('.licontent');
            jQuery('#Jcomment').html('');
            for(var i=li_obj.length; i>=0;i--){
              jQuery('#Jcomment').append(li_obj[i]);
            }
            change_subti_class(sort);
          }

        }else{
          if (order!=sort) {
            document.getElementById('no_more').style.display = 'none';
            loadStatus = false;
            jQuery('#Jcomment').html('');
            page = 1;
            order =sort;
            get_boadlist(boad_id,order,page,perpage);
            change_subti_class(sort);
          }
        }
        
      }

      function change_subti_class(sort){
        if (sort==0) {
              jQuery('#subti_1').attr('class','subti_off');
              jQuery('#subti_2').attr('class','subti_on');
        }else{
              jQuery('#subti_1').attr('class','subti_on');
              jQuery('#subti_2').attr('class','subti_off');
            }
      }

      function get_boadlist(boad_id,order,page,perpage){
        document.getElementById('loadingMore').style.display = 'block';
        jQuery.post(dig_post_file, {
            act:"get_boadlist",id:boad_id,order:order,page:page,perpage:perpage
        }, function(data) {
            if (data.status == 1) {
              // var ulList = document.getElementById('Jcomment');
              for (var i = 0; i < data.data.length; i++) {
                // var ulLength = ulList.childNodes.length;
                var li = document.createElement('li');
                li.setAttribute('class','licontent');
                li.setAttribute('id','licon_'+data.data[i]['id']);
                li.innerHTML = '<div class="bg-time"><span class="m-time">'+data.data[i]['uptime']+'</span></div><div class="textDing">'+data.data[i]['content']+'</div><div class="c-wrap"><div class="c-ctrl"><span class="btn"><a class="repost_pop" onclick="movecommentform(this,boad_id,'+data.data[i]['id']+')">'+data.data[i]['comment_count']+'</a></span><span class="btn" cid="digcontentlist_'+data.data[i]['id']+'"><a onclick="do_dig(this)"><em>'+data.data[i]['dig']+'</em></a></span></div></div>';
                // ulList.insertBefore(li, ulList.lastChild);
                jQuery('#Jcomment').append(jQuery(li));

              }
              document.getElementById('loadingMore').style.display = 'none';
            }else if (data.status == 2) {
              document.getElementById('loadingMore').style.display = 'none';
              document.getElementById('no_more').style.display = 'block';
              loadStatus = true;
            }
        }, "json");
        
      }

      function movecommentform(obj,title_id,list_id){
        var cf = jQuery('#comment_pop'),page = 1;
        var perpage = typeof(arguments[3])!="undefined" ? arguments[3] : 3;
        if(perpage==3){
          cf.insertAfter(obj.parentNode.parentNode);
          cf.attr('title_id',title_id);
          cf.attr('list_id',list_id);
          cf.attr('org_count',jQuery(obj).html());

          jQuery('.comment_l_flag').css('display','none');  //hide all commentlist
          jQuery(".repost").html('回复');
          jQuery('#comment_pop').attr('parent',0);
        }
          

        //get or show commentlist for thisobj
        if (jQuery('#commentlist_'+list_id).length>0 && perpage==3) {
          jQuery('#commentlist_'+list_id).css('display','block');
        }else{
          jQuery('#commentlist_'+list_id).remove();
          var div = document.createElement('div');
              div.setAttribute('id','commentlist_'+list_id);
              div.setAttribute('class','c-list comment_l_flag');
              div.style.display= 'block';
              div.innerHTML = '';
          jQuery.get(dig_post_file, {
              act:"get_boadlist_comment",title_id:title_id,list_id:list_id,page:page,perpage:perpage
            }, function(data) {
              if (data.status == 1) {
                for (var i = 0; i < data.data.length; i++) {
                  div.innerHTML = div.innerHTML + '<div class="c-wrap"><div class="c-th"><span class="user "><a href="#">'+data.data[i]['username']+'</a></span><span class="count">'+data.data[i]['floor']+'楼</span></div>'+getc(data.data[i]['parentnode'])+'<div class="c-tb"><div class="c-body">'+data.data[i]['content']+'</div></div><div class="c-ctrl"><span class="date">'+data.data[i]['time']+'</span><span class="btn" cid="commentid_'+data.data[i]['id']+'"><a href="javascript:void(0)" onclick="do_dig(this)">(<em>'+data.data[i]['dig']+'</em>)</a><a href="javascript:void(0);" onclick="movemovecommentform_reply(this);" class="repost">回复</a></span></div></div>';
                }
                
                if(perpage==3){
                  div.innerHTML = div.innerHTML + '<div class="btn-more" onclick="movecommentform(this,boad_id,'+list_id+',0)">加载全部</div>';
                }else{
                  jQuery(obj).remove();
                }
              }
            }, "json");
          // jQuery(obj).parent().parent().parent().append(jQuery(div));
          jQuery('#licon_'+list_id).children('.c-wrap').append(jQuery(div));
          /*if(perpage==3){
            jQuery('#licon_'+list_id).children('.c-wrap').append(jQuery('<div class="btn-more" onclick="movecommentform(this,boad_id,'+list_id+',0)">加载全部</div>'));
          }else{
            jQuery(obj).remove();
          }*/
          
        }
        // jQuery("#username").focus();
      }
      function movemovecommentform_reply(obj){
        var this_obj = jQuery(obj);
        //get_c_id = this_obj.parent().parent().parent().children().last().attr('id');
        get_c_id = this_obj.parent().parent().next().attr('id');
        if (get_c_id == 'comment_pop') { //取消动作
          jQuery(obj).html('回复');
          jQuery('#comment_pop').insertBefore(this_obj.parent().parent().parent().parent());
          jQuery('#comment_pop').attr('parent',0);
          jQuery("#content").focus();
        }else{
          jQuery(".repost").html('回复');
          jQuery(obj).html('取消');
          jQuery('#comment_pop').insertAfter(obj.parentNode.parentNode);
          var parent_idname = this_obj.parent().attr('cid');
          var idname_split = parent_idname.split('_');
          jQuery('#comment_pop').attr('parent',idname_split[1]);
          jQuery("#content").focus();

        }        
      }

      //var load_flag=true;
      function movecommentform_cla(title_id,page,perpage){
        var newpage = page+1;

        if (1) {
          jQuery.get(dig_post_file, {
              act:"get_boadlist_comment_all",title_id:title_id,page:page,perpage:perpage
            }, function(data) {
              if (data.status == 1) {
                for (var i = 0; i < data.data.length; i++) {
                  var div = document.createElement('div');
                  div.setAttribute('class','c-wrap');
                  div.innerHTML = '<div class="c-th"><span class="user "><a href="#">'+data.data[i]['username']+'</a></span><span class="count">'+data.data[i]['floor']+'楼</span></div>'+getc(data.data[i]['parentnode'])+'<div class="c-tb"><div class="c-body">'+data.data[i]['content']+'</div></div><div class="c-ctrl"><span class="date">'+data.data[i]['time']+'</span><span class="btn" cid="commentid_'+data.data[i]['id']+'"><a href="javascript:void(0)" onclick="do_dig(this)">(<em>'+data.data[i]['dig']+'</em>)</a><a href="javascript:void(0);" onclick="movemovecommentform_reply(this);" class="repost">回复</a></span></div>';
                  jQuery('#commentlist_0').append(jQuery(div));
                }
                jQuery('#J-more').html('点击查看更多');
                jQuery('#J-more').attr('onclick','movecommentform_cla(boad_id,'+newpage+','+perpage+');');
              }else{
                //load_flag = false;
                jQuery('#J-more').html('已加载全部');
                jQuery('#J-more').removeAttr('onclick');
                // jQuery('#J-more').attr('newcount',jQuery('#commentlist_0').children().length);
              }
            }, "json");
          
        }
      }
      function getc(datarr){
        if(datarr){
          return '<div style="background-color:#FFFCF0; padding:3px; border:1px #dbdbdb solid;">'+getc(datarr['parentnode'])+'<div class="c-th"><span class="user "><a href="#">'+datarr['username']+'</a></span><span class="count">'+datarr['floor']+'楼</span></div><div class="c-tb"><div class="c-body">'+datarr['content']+'</div></div></div>';
        }else{
          return '';
        }
        
      }

      function init_cla(){
        jQuery('#comment_cla').prepend(jQuery('#comment_pop'));
        jQuery('.comment_l_flag').css('display','none');
        jQuery(".repost").html('回复');
        jQuery('#comment_pop').attr('list_id',0);
        jQuery('#comment_pop').attr('parent',0);
        jQuery('#comment_pop').attr('org_count',0);
        jQuery('#commentlist_0').css('display','block');

        if(!jQuery('#commentlist_0').children().length){
          movecommentform_cla(boad_id,1,perpage_cl);
        }
        // jQuery("#username").focus();
      }

      function add_comment(obj){
        var this_obj = jQuery(obj);
        var the_form_obj = this_obj.parent().parent();
        var title_id = the_form_obj.attr('title_id');
        var list_id = the_form_obj.attr('list_id');
        var parent = the_form_obj.attr('parent');
        var username = jQuery('#username');
        var content = jQuery('#content');
        var org_count = the_form_obj.attr('org_count');
        var all_count = jQuery("#all_count").html();
        jQuery.post(dig_post_file, {
            act:"commit_comment_boad",title_id:title_id,list_id:list_id,parent:parent,username:username.val(),content:content.val()
        }, function(data) {
            if (data.status == 1) {
                jQuery(".popmessage").html('发表成功');
                jQuery(".popbg").css('display','block');
              content.val('');
              //var nclist = document.getElementById('commentlist_'+list_id);
                // var ulLength = nclist.childNodes.length;
                var div = document.createElement('div');
                div.setAttribute('class','c-wrap');
                div.innerHTML = '<div class="c-th"><span class="user "><a href="#">'+data.data['username']+'</a></span><span class="count">'+data.data['floor']+'楼</span></div><div class="c-tb"><div class="c-body">'+data.data['content']+'</div></div><div class="c-ctrl"><span class="date">'+data.data['time']+'</span><span class="btn" cid="commentid_'+data.data['id']+'"><a href="javascript:void(0)" onclick="do_dig(this)">(<em>0</em>)</a><a href="javascript:void(0);" onclick="movemovecommentform_reply(this);" class="repost">回复</a></span></div>';
                if(parent>0){
                  jQuery(div).insertBefore(the_form_obj);
                }else{
                  //nclist.insertBefore(div, nclist.lastChild);
                  // nclist.appendChild(div, nclist);
                  jQuery('#commentlist_'+list_id).prepend(jQuery(div));
                }

                var newnum = parseInt(all_count)+1;
                jQuery("#all_count").html(newnum);
                jQuery("#all_count1").html(newnum);
                if (list_id>0) {
                  newnum = parseInt(org_count)+1;
                  the_form_obj.prev().children().children('.repost_pop').html(newnum);

                  //重新设置评论列表可加载
                  jQuery('#commentlist_0').html('');

                }

            }else{
              jQuery(".popmessage").html('错误，请重试或与我们联系。');
                jQuery(".popbg").css('display','block');
            }
        }, "json");

      }

      function do_dig(obj){
        var type, this_obj = jQuery(obj);
        var em_obj = this_obj.children('em');
        var idname = this_obj.parent().attr('cid');
        var idsplit = idname.split('_');
        if (idsplit[0] == 'digcontentlist') {
          type = 0;
        }else{
          type = 1;
        }

        jQuery.get(dig_post_file, {
            act:"dig_boad",type:type,id:idsplit[1],org:em_obj.html()
            }, function(data) {
              if (data.status == 1) {
                  // jQuery(".popmessage").html('OK!');
                  // jQuery(".popbg").css('display','block');
                  em_obj.html(data.newnum);
              }else{
                  jQuery(".popmessage").html(data);
                  jQuery(".popbg").css('display','block');
              }
            }, "json");
      }

      function clear_list(){
        jQuery('.newmess').hide();
        jQuery('#loadingMore').show();
        jQuery('#Jcomment').html('');
        // clearInterval(sii);
      }