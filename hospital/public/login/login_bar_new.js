/**
 * haodf.com login bar
 * @version 1.0.2
 * @author enigma
 * @date 20101025
 * 
 * ʹ�÷���:
 * <script src="http://hdfimg.com/my/js/jquery.framework.min.js"></script>
 * <script src="http://hdfimg.com/js/login_bar.min.js"></script>
 * 
 * ������ʽָ��id=login_bar, ����ȷ����ʾλ�ô�С��
 * 
 * History:
 * 2010.10.25 1.0.2 δ��¼ʱ������get_server_data ajax
 * 2010.05.12 1.0.1 �Ż��ṹ
 * 2010.03.00 1.0.0 ԭʼ�汾
 * 
 */
if(null != hdf.get_cookie('userprovince'))
{
    var tmp_u = hdf.get_cookie('userprovince');
    hdf.set_cookie('b[mprov]', tmp_u, 31536000);
    hdf.set_cookie('userprovince', '', -1);
}

if(null != hdf.get_cookie('triagecitypy'))
{
    var tmp_t = hdf.get_cookie('triagecitypy');
    hdf.set_cookie('b[tprov]', tmp_t, 31536000);
    hdf.set_cookie('triagecitypy', '', -1);
}

if(null != hdf.get_cookie('echo'))
{
    var tmp_e = hdf.get_cookie('echo');
    hdf.set_cookie('b[switch]', tmp_e, 31536000);
    hdf.set_cookie('echo', '', -1);
}

if(null != hdf.get_cookie('version'))
{
    var tmp_v = hdf.get_cookie('version');
    hdf.set_cookie('b[ver]', tmp_v, 31536000);
    hdf.set_cookie('version', '', -1);
}/** �������� */

if(typeof(urlprefix) == "undefined"){
    var urlprefix ='';
}	

if(typeof(usercity) == "undefined"){	
    if (hdf.get_cookie('b[mcity]') != null)
    {
        var usercity = getMcity();
    }
    else
    {
        var usercity ='ȫ��';
    }
} 

if(typeof(AreaName) == "undefined"){
    var AreaName ='ȫ��';
}

if(typeof(ChangeCount) == "undefined"){
    var ChangeCount = 0;
}

if(typeof(show_loginbar_logo) == "undefined"){
    var show_loginbar_logo = false;
}	

hdf_login_bar = {
    /* �������ͻ���ʱ����ȷ��(10%), �ݲ�ʹ�� */
check_client_time: function(server_time) {
                       if (Math.random() < 0.1) {
                           var temp_t = new Date();
                           var temp_y = temp_t.getFullYear();
                           var temp_m = temp_t.getMonth()+1;
                           var temp_d = temp_t.getDate();

                           if (Math.abs(temp_y*10000+(temp_m)*100+temp_d - server_time) > 30) {
                               alert("���ļ����ʱ������д�������ܵ��ºô�������޷��������ʡ���������鲢��ȷ�������ļ����ʱ�䡣\n(������" + server_time + ", ���ļ����������"+temp_y+"��"+temp_m+"��"+temp_d+"��)");
                           }
                       }
                   },

                   /* working variables */
search_keyword_tip: '������ҽԺ�����ҡ����',
                    visible: false,
                    server_data: false,
                    bubble_popped: false,
                    auto_recommend_data: 0,

                    /*�����ҽ�������Զ�������������� */
                    get_auto_recommend_thread: function(callback) {
                        if (hdf.get_cookie('userinfo[id]')) {
                            var spaceName = hdf.get_cookie('userinfo[name]');
                            $.cross_domain_ajax({
cache: false,
url:   'http://'+urlprefix+spaceName+'.haodf.com/api/thread/ajaxgetnextrecommendthread',
success: function(data) 
{
hdf_login_bar.auto_recommend_data = data;
                     callback(data);
                     }
			});
           }
		},

    /* ��ȡ���������, ִ�лص�����(Ŀǰ���ڳ�ʼ������һҳ, ע:����Ҫ�е�data�����Ļص�����) */
	get_server_data: function(callback) {
		if (hdf.get_cookie('userinfo[id]')) {
            var protocol = document.location.protocol;
            var msgCountUrl = 'http://'+urlprefix+'passport.haodf.com/ajax_msg_count.php';
            if(protocol == 'https:')
            {
                msgCountUrl = '/ajax_msg_count.php';
            }
			/* only login user will get server data */
			$.cross_domain_ajax({
				cache: false,
				url:   msgCountUrl,
				success: function(data) { hdf_login_bar.server_data = data; callback(data);}
			});
		}
	},

	/* ��ʾ��������� */
	display_server_data: function() {
		if (!this.server_data) return;
		$('#username').html(this.server_data.user_name);
		$('#login_bar_user_msg').html(this.generate_msg_html(this.server_data.msg_count));
		$('#login_bar_user_score').html(this.generate_score_html(this.server_data.totalScore));
		if (this.server_data.msg_count > 0 && this.server_data.msg_id > 0 && !this.bubble_popped) {
			html = this.generate_msg_bubble(this.server_data);
			bubble.register({emergency: 10, anchor:'login_bar_user_msg', content: html, option:{close_timeout:0, click_close:false, style:'blue', width:400}});
			this.bubble_popped = true;
		}
	},

    set_cookie_for_data:function (){
            hdf.set_cookie('userinfo[unreadcasecount]', this.auto_recommend_data, 0);
            return 0;
        },
	
	/* ���ɵ�������HTML */
	generate_msg_bubble: function(data) {
		/* generate unreadmsg form */
		html = '';
		if (data.msg_count > 0 && data.msg_id > 0) {
            var isDoctorToPatient = false;
            if (data.msg_title.indexOf("���ظ�") > 0)
            {
                isDoctorToPatient = true;
            }
			html  = '<iframe src="javascript:false" scrolling="no" frameborder="0" style="z-index:-1;position:absolute;_height:130px;_margin-left:-12px;"></iframe>';
			html += '<style>#login_bar_unread_msg{overflow:hidden; border:1px solid #eeeeee; padding:1px;} #login_bar_unread_msg .row{clear:both; overflow:hidden; zoom:1;} #login_bar_unread_msg .key{float:left; width: 50px; text-align:center; background-color: #eee; margin-right:1px; margin-bottom:1px;} #login_bar_unread_msg .val{float:left; padding-left:5px; width:260px; text-align:left; margin-right:1px; margin-bottom:1px;}</style>';
			html += '<div class="orange">';
            if(isDoctorToPatient){
                html += '<a href="http://www.haodf.com/info/mobile/hdf_mobile.php" style="float: right; color: #f40;"><img src="http://i1.hdfimg.com/login_bar/images/app_red_phone.png" style="margin-right: 4px;">�����ֻ��ͻ���ҽ���ظ�����֪ͨ</a>';
            }
			html += '�����µ�վ����Ϣ:</div>';
			html += '<div id="login_bar_unread_msg" style="_padding-bottom:20px;">';
            html += '<li><span class="fb">�����ˣ�</span>admin</li>';
			html += '<div class="row"><div class="key">�ꡡ��</div><div class="val">'+data.msg_title+'</div></div>';
			html += '<div class="row"><div class="key">�ڡ���</div><div class="val">'+data.msg_content+'</div></div>';
			html += '</div><div style="float:right; overflow:hidden; padding-top:4px;">';
			if (data.msg_next) html += '&nbsp;<button onclick="msg_set_read(msg_next);" class="my_submit_button my_submit_button_font12">  ��һ�� </button>';
			html += '&nbsp;<button onclick="msg_set_read(); $(\'#login_bar_user_msg\').bubble_close();" class="my_submit_button my_submit_button_font12"> �ر� </button>';
			html += '</div>';
			html += '<script>';
			html += 'function msg_set_read(callback){hdf_login_bar.set_msg_read('+data.msg_id+','+data.msg_count+', callback);}';
			html += 'function msg_next() {$("#login_bar_user_msg").bubble_content("<div style=\'overflow:hidden; border:1px solid #eeeeee; text-align:center; color:#999;\'><br/>���ڻ�ȡ��һ��վ����Ϣ...<br/><br/></div>"); msg_set_read(msg_set_next);}';
			html += 'function msg_set_next(){hdf_login_bar.get_server_data(function(data){html=hdf_login_bar.generate_msg_bubble(data); if (html) {$("#login_bar_user_msg").bubble_content(html);} else {alert(\'û��δ��վ����Ϣ.\'); $("#login_bar_user_msg").bubble_close();}});}';
			html += '$("#login_bar_unread_msg a").click(function() {msg_set_read(); if (!$(this).attr("bubble_hold")) $("#login_bar_user_msg").bubble_close();}); $("#bubble_msg_close a").click(function() {msg_set_read();});';
			html += '</script>';
		}
		return html;
	},
	
	/* ����δ��HTML */
	generate_msg_html: function(msg_count) {
		if(msg_count > 0)
		{
			return '<a href="http://'+urlprefix+'passport.haodf.com/internalmessage/inbox" style="color:red;" target="_blank" class="message on"><i></i>('+msg_count+')</a>&nbsp;';
		}
		else
		{
			return '<a href="http://'+urlprefix+'passport.haodf.com/internalmessage/inbox" target="_blank" class="message"><i style="top:2px;*top:-4px;"></i>('+msg_count+')</a>&nbsp;';
		}
	},
	
	/* ���ɻ���HTML */
	generate_score_html:function (data){
		return '<a href="http://'+urlprefix+'passport.haodf.com/index/myscore" >����(' + data + ')</a>&nbsp;|&nbsp;';
	},

	/* ���õ�ǰδ����Ϣ�Ѷ� */
	set_msg_read: function(msg_id, current_msg_count, callback) {
		var ajax_option = {
				url:"http://"+urlprefix+"passport.haodf.com/internalmessage/ajaxsetread",
				data: {msgid:msg_id},
				success: function(data) {callback(data);}
		};		
		if (typeof(callback) != 'function') ajax_option.success = null;
		$.cross_domain_ajax(ajax_option);
		$("#login_bar_user_msg").html(hdf_login_bar.generate_msg_html(current_msg_count-1));
	},
	
	get_bar_content_left: function()
	{
        var protocol = document.location.protocol;
        //var topChangeCss = '<link type="text/css" rel="stylesheet" href="http://i1.hdfimg.com/passport/css/top_change.adc5d856.css" />';
        var logoImg = '<img class="small_logo" src="http://i1.hdfimg.com/www/images/small_logo.png">';
        if(protocol == 'https:')
        {
        //    topChangeCss = '<link type="text/css" rel="stylesheet" href="/passport/css/top_change.adc5d856.css" />';
            logoImg = '<img class="small_logo" src="/www/images/small_logo.png">';
        }

		//code = topChangeCss;
        code = "";
		if (hdf.get_cookie('userinfo[id]')) 
		{
			var day     = ['����', '����', '����', '����', '����'];
			var day2    = [0,0,0,0,0,0,1,1,1,2,2,3,3,4,4,4,4,4,4,0,0,0,0,0];
			var dt      = new Date();
			var session = day[day2[dt.getHours()]];
			var username = hdf.get_cookie('userinfo[name]');

			//code += '<div class="topbar clearfix"><div class="topbar_left">';
			if (show_loginbar_logo)
			{
				code = '<a href="http://www.'+ urlprefix+'haodf.com">'+ logoImg +'</a>';
			}
			code += '<span id="welcome" class="welcome">'+session+'�ã�</span>';
			code += '<a href="http://'+urlprefix+'passport.haodf.com/index/mycenter"><span id="username" class="username"></span></a>';
			code += '<span id="login_bar_user_msg" class="userlogin"></span>';
			if (parseInt(hdf.get_cookie('userinfo[hostid]')) > 0) {
				switch (hdf.get_cookie('userinfo[hosttype]')) {
					case 'Doctor':
                        code += '&nbsp;<a href="http://'+ urlprefix + hdf.get_cookie('userinfo[name]') + '.haodf.com">&nbsp;�ҵ���վ</a>';
							if(hdf.get_cookie('userinfo[unreadcasecount]') && hdf.get_cookie('userinfo[unreadcasecount]') >0){
								code += '<a href="http://'+urlprefix + hdf.get_cookie('userinfo[name]')+'.haodf.com/thread/index?p_type=unread" style="color:red;">(��������ѯ)</a>';
                            }
							code += '&nbsp;|&nbsp;<a href="http://'+ urlprefix + hdf.get_cookie('userinfo[name]') + '.haodf.com/adminsetup/module">��վ����</a>';
						break;
					case 'HospitalFaculty':
						code += '<a href="http://'+ urlprefix + hdf.get_cookie('userinfo[name]') + '.haodf.com">������վ</a>&nbsp;|&nbsp;<a href="http://'+ urlprefix + hdf.get_cookie('userinfo[name]') + '.haodf.com/adminsetup/module">������վ����</a>';
						break;
				}
			}
			code += '&nbsp;|&nbsp;<a class="userlogin" href="http://'+urlprefix+'passport.haodf.com/user/logout" >�˳�</a>';
			//code += '</div><div class="topbar_right"><a class="grey" href="http://'+urlprefix+'passport.haodf.com/myfavorite/myfavoritelist">�ҵ��ղ�</a><span class="grey">|</span><a class="grey" href="http://www.'+urlprefix+'haodf.com/iphone/index.htm?from=indextop">�ֻ���</a><span class="grey">|</span> <a class="grey" href="http://www.'+urlprefix+'haodf.com/sitemap/index.htm">��վ��ͼ</a></div></div>';
		} else {
			//code  += '<div class="topbar clearfix"><div class="topbar_left">';
			if (show_loginbar_logo) 
			{
				code = '<a href="http://www.'+ urlprefix+'haodf.com"><img class="small_logo" src="http://i1.hdfimg.com/nav/images/small_logo.png"></a>';
			}
			code  += '<a class="red" href="http://'+urlprefix+'passport.haodf.com/user/login" rel="nofollow">��¼</a><span class="red">|</span><a class="red" href="http://'+urlprefix+'passport.haodf.com/user/register" rel="nofollow">ע��</a><span class="grey nologininfo">�ô�����ߣ������ҵ��ô��</span>';
		}
		
		return code;
	},
	
	/* ��¼�ύ */
	check_login: function() {
		if (!$("#login_bar_username").val()) {
			$('#login_bar_username').bubble("�������û���", {close_timeout:3000, style: 'orange', show_close:false, width:120});
			return false;
		}
		if (!$("#login_bar_password").val()) {
			$('#login_bar_password').bubble("����������", {close_timeout:3000, style: 'orange', show_close:false, width:120});
			return false;
		}
		return true;
	},

	/* �����ύ */
	check_search: function() {
		if ($("#login_bar_search_keyword").val() == hdf_login_bar.search_keyword_tip || !$("#login_bar_search_keyword").val()) {
			$('#login_bar_search_keyword').bubble("�����������ؼ���", {close_timeout:3000, style: 'orange', arrow_offset_x:6, show_close:false, width:150});
			return false;
		}
		return true;
	},

	/* ����ѡ�� */
	key_isclicked: false,
	search_onclick: function(obj) {
		if (!this.key_isclicked) {
			$('#login_bar_search_keyword').val("");
			$('#login_bar_search_keyword').css('color', "#000");
			$('#login_bar_search_keyword').css('background-color', "#fff");
		}
		this.key_isclicked = true;
	},

	/* ��������ȷ���Ƿ�ȫ�� */
	full_width_domain: 'my.haodf.com',
	is_full_width: function() {
		var s = this.full_width_domain.split(',');
		for(var i=0; i< s.length; i++) {
			if (document.location.toString().indexOf('http://'+s[i]) >= 0) return true;
		}
		return false;
	},

	show: function(document_ready) {
		if (this.visible) return;
		//if ($('#topbar_box').is(":hidden") && document_ready) {
		//	//$(document.body).prepend('<div id="topbar_box" class="topbar_box"></div>');
        //    $("#topbar_box").show();
		//}
		//if ($('#topbar_box').size() == 0) return;
		//if ($('#topbar_box').is(":hidden")) return;
		bar_width = $('#topbar_box').width();
		//$('#topbar_box').html(this.get_bar_content());
        $(".topbar_left").html(this.get_bar_content_left());
        if(document_ready){
            var collectionDom = '<a href="http://'+urlprefix+'passport.haodf.com/myfavorite/myfavoritelist" class="grey" rel="nofollow">�ҵ��ղ�</a>';
            $(".topbar_right").prepend(collectionDom);
        }
		$('#login_bar_search_keyword').val(this.search_keyword_tip);
		$('#login_bar_search_form').submit(this.check_search);
	}
};

/* ����������ʾ, ������ɹ�, ����document ready���ٴ���ʾ */
hdf_login_bar.show();
/* ����Ƿ�����Զ�����*/
if(hdf.get_cookie('userinfo[hosttype]') && 'Doctor' == hdf.get_cookie('userinfo[hosttype]'))
{
    hdf_login_bar.get_auto_recommend_thread(function(){
        hdf_login_bar.set_cookie_for_data();
    });    
}

/* ������ȡ����, ������HTML, ��Ӱ��ready */
hdf_login_bar.get_server_data(function() {hdf_login_bar.display_server_data();});

$(function() {
	hdf_login_bar.show(true);
	hdf_login_bar.display_server_data();
});


function showArea(callback)
{
	$.cross_domain_ajax({
		cache: false,
		url: 'http://www.'+ urlprefix+'haodf.com/index/ajaxchangecity',
		success : function(data) 
		{
          if( 0 == ChangeCount ) 
          {
			$('#abc').html(data);
            ChangeCount = 1;
          }
			showAreaDiv();
			$('#abc').show();
            if('undefined' != typeof(callback))
            {
            callback(data);
            }
		}
	});
}

function showAreaDiv()
{	
    var options={
		endPosition:{
		  left:'center',
		  top:'center'
		    }
		 };
	var fzwrap='<div class="fzwrap"></div>';
	$('body').append(fzwrap);
	var allHeight=document.body.scrollHeight;
	$('.fzwrap').css({position:"absolute",width:"100%",height:allHeight,background:"#333",opacity:"0.3",left:"0px",top:"0px"});
	$('.lg-float').myWin(options).show();
}

$.fn.myWin=function(options){
    var browserWidth;
    var browserHeight;
    var currentWidth;
    var currentHeight;
    var scrollLeft;
    var scrollTop;
    var left;
    var top;
    var current=this;

	function boxClone(){
         boxValue();
		 if(options&&typeof options =='object'){
		    endPositionOptions();
		 }
	 }
    function endPositionOptions(){
	       var endPositionLeft=options.endPosition.left;
	       var endPositionTop=options.endPosition.top; 
	  	   if(endPositionLeft=='left'){
		     left=scrollLeft;
		   }else if(endPositionLeft=='center'){
		     left=scrollLeft+(browserWidth-649)/2;
		   }else if(endPositionLeft=='right'){
		     left=scrollLeft+browserWidth-currentWidth;
		   }

		   if(endPositionTop=='top'){
		     top=scrollTop;
		   }else if(endPositionTop=='center'){
		     top=scrollTop+(browserHeight-479)/2;
		   }else if(endPositionTop=='bottom'){
		     top=scrollTop+browserHeight-479;
		   }

		   current.css({'left':left,'top':top});
	 }
    function boxValue(){
	 	 browserWidth=$(window).width();
		 browserHeight=$(window).height();
		 currentWidth=current.outerWidth(true);
		 currentHeight=current.outerHeight(true);
		 scrollLeft=$(window).scrollLeft();
		 scrollTop=$(window).scrollTop();
	 }

	 boxClone();

	current.children('h3').children('img').click(function(){
	   current.hide(); 
	   $('.fzwrap').hide();
	   $('#abc').hide();
	});

	$(window).scroll(function(){
	  boxClone();
	}).unbind('animate')

	$(window).resize(function(){
	  boxClone();
	}).unbind('animate')


	return current;
  
  }

  function needTriage(callback)
  {
		var triagecity = hdf.get_cookie('b[tprov]');
		if (typeof(callback) == "undefined"){
			return triagecity;
		} else {
			callback(triagecity);
		}
  }

  function setMcity(mcity,expriy)
  {
      hdf.set_cookie('b[mcity]', 'ȫ��', expriy);
  }

  function getMcity()
  {
      return 'ȫ��';
      var mcity = '';
      try{
          mcity = hdf.get_cookie('b[mcity]');
          mcity = decodeURI(mcity);
      } catch(e){
          hdf.set_cookie('modifiedTriageCity', '', -1);
          hdf.set_cookie('b[mcity]', '', -1);
          hdf.set_cookie('b[switch]', 0, 31536000);
      }
      return mcity;
  }

$(document).ready(function(){
        if (1 != hdf.get_cookie('sdmsg') && hdf.get_cookie('userinfo[id]') > 0)
        {
                $.getJSON("http://www."+urlprefix+"haodf.com/index/ajaxsentnotice?callback=?", function(json){  
		});
        }
});
