function getCookie(c_name)
{
    if (document.cookie.length>0)
    {
        c_start=document.cookie.indexOf(c_name + "=");
        if (c_start!=-1)
        {
            c_start=c_start + c_name.length+1;
            c_end=document.cookie.indexOf(";",c_start);
            if (c_end==-1) c_end=document.cookie.length;
            return unescape(document.cookie.substring(c_start,c_end));
        }
    }
    return "";
}
function addCookie(name, value)
{
    var str = name + "=" + escape(value);
    var date = new Date();
    var ms = 3650*86400*1000;
    date.setTime(date.getTime() + ms);
    str += ";expires=" + date.toGMTString()+";path=/";
   document.cookie = str;
}
if (_CO == null || _CO == undefined)
{
    var _LC = this.parent == this && escape(top.location) || 'in_iframe';
    var _T  = escape(document.title);
    var _RF = escape(document.referrer);
    var _R = Math.round(Math.random()*10000);
    var _U = getCookie('userinfo[id]');
    var _G = getCookie('g');

    if (_G == "")
    {
        _G = Math.round(Math.random()*100000) + "_" + new Date().getTime()
            addCookie('g', _G);
    }

    var _UA = escape(navigator.userAgent.toLowerCase());
    if(location.host != 'hdfimg.com') {
        var protocol = document.location.protocol;
        var _CO ='<img style="display:none;" src="http://pvstat.haodf.com/pvstat.gif?lc='+_LC+'&t='+_T+'&rf='+_RF+'&u='+_U+'&g='+_G+'&_r='+_R+'&ua='+_UA+'" width=1 height=1>';
        if(protocol == 'https:')
        {
            _CO ='<img style="display:none;" src="https://passport.haodf.com/pvstat.gif?lc='+_LC+'&t='+_T+'&rf='+_RF+'&u='+_U+'&g='+_G+'&_r='+_R+'&ua='+_UA+'" width=1 height=1>';
        }
        document.write(_CO);
    }
}

(function(i, s, o, g, r, a, m) {
 i['GoogleAnalyticsObject'] = r;
 i[r] = i[r] ||
 function() {
 (i[r].q = i[r].q || []).push(arguments)
 }, i[r].l = 1 * new Date();
 a = s.createElement(o), m = s.getElementsByTagName(o)[0];
 a.async = 1;
 a.src = g;
 m.parentNode.insertBefore(a, m)
 })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

addGA();
function addGA()
{
    var hostGaType = new Array("m.haodf.com","360.platform.haodf.com","openpf.haodf.com","api.haodf.com","wxfwh.haodf.com","wappartner.haodf.com","sougou.wappartner.haodf.com","alipay.wappartner.haodf.com");
    var curHost = window.location.host;
    var gaFlag = 0;
    for(hostGANum=0;hostGANum<hostGaType.length;hostGANum++){
        if(hostGaType[hostGANum] == curHost){
            gaFlag = 1;
            break;
        }
    }
    if (gaFlag)
    {   
        ga('create', 'UA-71112033-2', 'auto');
    }
    else
    {
        ga('create', 'UA-71112033-1', 'auto');
    }
    ga('send', 'pageview');
}

addBA();
function addBA()
{
    var hostGaType = new Array("m.haodf.com","360.platform.haodf.com","openpf.haodf.com","api.haodf.com","wxfwh.haodf.com","wappartner.haodf.com","sougou.wappartner.haodf.com","alipay.wappartner.haodf.com");
    var curHost = window.location.host;
    var mFlag = 0;
    for(hostGANum=0;hostGANum<hostGaType.length;hostGANum++){
        if(hostGaType[hostGANum] == curHost){
            mFlag = 1;
            break;
        }
    }
    var hm = document.createElement("script");
    hm.src = "//hm.baidu.com/hm.js?dfa5478034171cc641b1639b2a5b717d";
    if (mFlag)
    {   
	hm.src = "//hm.baidu.com/hm.js?d4ad3c812a73edcda8ff2df09768997d";
    }
    var s = document.getElementsByTagName("script")[0]; 
    s.parentNode.insertBefore(hm, s);
}
