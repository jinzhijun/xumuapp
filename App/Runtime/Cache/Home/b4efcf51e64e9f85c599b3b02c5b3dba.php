<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0045)http://fc.vhot119.com/home/index/appdown.html -->
<html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <title>青岛九万文化传媒</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="九万管理系统">
        <meta name="keywords" content="财务管理系统">
        <meta name="author" content="Ghostry">
        <link href="/Public/Home/login/appdown/bootstrap.min.css" rel="stylesheet">
        <link href="/Public/Home/login/appdown/bootstrap-theme.min.css" rel="stylesheet">
        <link href="/Public/Home/login/appdown/select2.min.css" rel="stylesheet">
        <link href="/Public/Home/login/appdown/qq.css" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="http://fc.vhot119.com/Public/Theme/default/Home/Img/favicon.ico">
        <script src="/Public/Home/login/appdown/hm.js"></script><script src="/Public/Home/login/appdown/jquery-2.0.3.min.js"></script>
    <link href="/Public/Home/login/appdown/default.css" rel="stylesheet"></head>
    <body>
        <div class="container" style="width: 100%">
            <div class="row" id="body">
                
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            首页&nbsp;&gt;App下载
                        </div>
                        <div class="panel-body">        
                            <div style="height: 100px;text-align: center;">2016-03-21 更新</div>
                            <div class="row">
                                                            <div class="col-lg-6" style="text-align: center;" id="android">
                                    <a href="http://www.umnet.cn/2016for/20160321.apk" title="点击下载安卓版">
                                        <img width="100" src="/Public/Home/login/appdown/android.gif">
                                        <br><br>安卓客户端下载
                                    </a>                
                                    <div style="height: 120px;"></div>
                                </div>               
                                <div class="col-lg-6" style="text-align: center;" id="ios">
                                    <a href="itms-services://?action=download-manifest&amp;url=https://raw.githubusercontent.com/baogonemp/umlxe/master/weishijiao.aliyun" title="点击下载IOS版">
                                        <img width="100" src="/Public/Home/login/appdown/ios.png">
                                        <br><br>苹果客户端下载
                                    </a>
                                    <div style="height: 120px;"></div>            
                                </div>                            </div>
                        </div>
                    </div>        
                    <script>
                        $(document).ready(function () {                      
                                                        windowInit();
                            $(window).resize(windowInit);
                        });
                        function windowInit() {
                            var w = $(window).width();
                            if (w < 767) {
                                $(".progress").css({'height': '100px'});
                                $(".progress-bar").css({'line-height': '18px', 'padding-top': '20px'});
                            } else {
                                $(".progress").css({'height': '50px'});
                                $(".progress-bar").css({'line-height': '50px', 'padding-top': '0px'});
                            }
                        }
                    </script>
                    </div>
</div>
<div class="row">
    <footer>
        <p class="pull-left">© <a href="http://www.yishoujiameng.com/" target="_blank">一手加盟网</a> 2016</p>
        <p class="pull-right">Powered by: <a href="http://www.yishoujiameng.com/">一手加盟网</a></p>
    </footer>
</div>
</div>
<script src="/Public/Home/login/appdown/jquery.browser.min.js"></script>
<script src="/Public/Home/login/appdown/bootstrap.min.js"></script>
<script src="/Public/Home/login/appdown/jquery.cookie.js"></script>
<script src="/Public/Home/login/appdown/jquery.dataTables.min.js"></script>
<script src="/Public/Home/login/appdown/jquery.flot.min.js"></script>
<script src="/Public/Home/login/appdown/jquery.flot.pie.min.js"></script>
<script src="/Public/Home/login/appdown/jquery.flot.stack.js"></script>
<script src="/Public/Home/login/appdown/jquery.flot.resize.min.js"></script>
<script src="/Public/Home/login/appdown/select2.min.js"></script>
<script src="/Public/Home/login/appdown/zh-CN.js"></script>
<script src="/Public/Home/login/appdown/jquery.colorbox.min.js"></script>
<script src="/Public/Home/login/appdown/jquery.raty.min.js"></script>
<script src="/Public/Home/login/appdown/jquery.autogrow-textarea.js"></script>
<script src="/Public/Home/login/appdown/jquery.history.js"></script>
<script src="/Public/Home/login/appdown/js.js"></script>
<script src="/Public/Home/login/appdown/jquery.validate.min.js"></script>
<script src="/Public/Home/login/appdown/messages_zh.min.js"></script>
<link href="/Public/Home/login/appdown/css.css" rel="stylesheet">
<script src="/Public/Home/login/appdown/kindeditor-all-min.js"></script>
<script>
    $(document).ready(function () {
	$(".chosen-select").select2({
	    language: "zh-CN"
	});
	if ($('#body div:first ul li').size() < 2) {
	    // $('#body div:first').remove();
	    // $('#body div:first').addClass('col-md-12').removeClass('col-md-10');
	}
	var editor = KindEditor.create('.kindeditor', {
	    uploadJson: '/home/editer/upload.html'
	});
	$('.btn-danger').click(function () {
	    var msg = "您真的确定要这么做吗？\n\n请确认！";
	    if (confirm(msg) == true) {
		return true;
	    } else {
		return false;
	    }
	});
    });
    function alertt(data) {
	var type = arguments[1] ? arguments[1] : 1;
	var tt = new Array();
	tt[4] = new Array('success', '恭喜');
	tt[1] = new Array('info', '注意');
	tt[2] = new Array('warning', '警告');
	tt[3] = new Array('danger', '危险');
	var t = setTimeout("$('.alert').alert('close');", 5000);
	return '<div class="alert alert-' + tt[type][0] + '"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>' + tt[type][1] + '！</strong>' + data + '</div>';
    }
</script>
<div style="">
    <script>
	var _hmt = _hmt || [];
	(function () {
	    var hm = document.createElement("script");
	    hm.src = "//hm.baidu.com/hm.js?2866d184a661820df35879dc03c43cff";
	    var s = document.getElementsByTagName("script")[0];
	    s.parentNode.insertBefore(hm, s);
	})();
    </script>
</div>

<div id="cboxOverlay" style=""></div><div id="colorbox" class="cboxIE"><div id="cboxWrapper"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left;"></div><div id="cboxContent" style="float: left;"><div id="cboxLoadedContent" style="width: 0px; height: 0px; overflow: hidden; float: left;"></div><div id="cboxLoadingOverlay" style="float: left;"></div><div id="cboxLoadingGraphic" style="float: left;"></div><div id="cboxTitle" style="float: left;"></div><div id="cboxCurrent" style="float: left;"></div><div id="cboxNext" style="float: left;"></div><div id="cboxPrevious" style="float: left;"></div><div id="cboxSlideshow" style="float: left;"></div><div id="cboxClose" style="float: left;"></div></div><div id="cboxMiddleRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div></div></body></html>