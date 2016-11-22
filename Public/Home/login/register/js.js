<!DOCTYPE html >
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>:( 系统发生错误！</title>
	<style type="text/css">
	    *{ padding: 0; margin: 0; }
	    body{ font-family: '微软雅黑'; color: #333; font-size: 12px; }
	    .system-message{width: 400px;height: 150px;background: #CCC;position: absolute;top: 30%;left: 35%;padding: 5px;border-radius: 4px;}
	    .system-message h1{ margin:0; padding:0;color: #fff;height: 30px;line-height: 30px;text-align: center;background: #900;opacity: 0.7;font-weight: bold;font-size: 12px;border-top-left-radius: 4px;border-top-right-radius: 4px;}
	    .system-message .success,.system-message .error{background: #fff; height:120px;}
	    .system-message .detail{border-bottom: 1px solid #CCF;color: #555;text-align: center;height:89px; line-height:16px;}
	    .system-message .jump a{ color: #333;}
	    .system-message .jump{ padding: 0px 0px; text-align:center;height: 30px;line-height: 30px;}
	</style>
    </head>
    <body>
	<div class="system-message">
	    <h1>:( 系统发生错误！</h1>
	    <div class="error">
		<div class="detail">
		    无法加载模块:Public		    		    <p>FILE: /var/www/default/t/Library/Think/Dispatcher.class.php &#12288;LINE: 171</p>
		    		    		    <p>TRACE：#0 /var/www/default/t/Library/Think/Dispatcher.class.php(171): E('???????????????...')<br />
#1 /var/www/default/t/Library/Think/App.class.php(26): Think\Dispatcher::dispatch()<br />
#2 /var/www/default/t/Library/Think/App.class.php(172): Think\App::init()<br />
#3 /var/www/default/t/Library/Think/Think.class.php(117): Think\App::run()<br />
#4 /var/www/default/t/ThinkPHP.php(136): Think\Think::start()<br />
#5 /var/www/default/index.php(76): require('/var/www/defaul...')<br />
#6 {main}</p>
		    		</div>
		<p class="jump">
		    页面自动 <a id="href" href="http://fc.vhot119.com/home/agent/reg.html">跳转</a> 等待时间： <b id="wait">10</b>
		</p>
	    </div>
	</div>
	<script type="text/javascript">
	    (function() {
		var wait = document.getElementById('wait'), href = document.getElementById('href').href;
		var interval = setInterval(function() {
		    var time = --wait.innerHTML;
		    if (time == 0) {
			location.href = href;
			clearInterval(interval);
		    }
		    ;
		}, 1000);
	    })();
	</script>
    </body>
</html>