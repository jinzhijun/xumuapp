<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>管理中心</title>
 		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
 		<!-- jq库 -->
		<script src='/Public/Admin/assets/js/jquery-2.0.3.min.js'></script>
		<!-- bootstrap -->
		<link href="/Public/Admin/assets/css/bootstrap.min.css" rel="stylesheet" />
		<!-- 时间选择器  -->
		 <link href="/Public/Components/bootstrap-datetimepicker-master/sample in bootstrap v3/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
   		 <link href="/Public/Components/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
		<script type="text/javascript" src="/Public/Components/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
		<script type="text/javascript" src="/Public/Components/bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
		 <!-- jqgrid -->
		<link rel="stylesheet" href="/Public/Admin/assets/css/ui.jqgrid.css" />
		<!-- 通知层 -->
		 <link href="/Public/Components/toastr/toastr.css" rel="stylesheet" />
		 <script src='/Public/Components/toastr/toastr.js'></script>
		  <!-- awesome 字体库 -->
		<link rel="stylesheet" href="/Public/Admin/assets/css/font-awesome.min.css" />
		 <!--[if IE 7]>
			  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
 		<!-- 表单验证 -->
		<link rel="stylesheet" href="/Public/Components/jquery-validation-1.14.0/demo/css/screen.css">
		<script src="/Public/Components/jquery-validation-1.14.0/dist/jquery.validate.js"></script>
		<!-- ace styles -->
		<!-- 图片上传预览 -->
		<script type="text/javascript" src="/Public/js/uploadPreview.min.js"></script>
		<!-- 后台样式 -->
		<link rel="stylesheet" href="/Public/Admin/assets/css/ace.min.css" />
		<link rel="stylesheet" href="/Public/Admin/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="/Public/Admin/assets/css/ace-skins.min.css" />
 		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
 		<!-- ace settings handler -->
 		<script src="/Public/Admin/assets/js/ace-extra.min.js"></script>
		<script src="/Public/Admin/assets/js/chosen.jquery.min.js"></script>
		<script src="/Public/Admin/assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="/Public/Admin/assets/js/jquery.knob.min.js"></script>
		<script src="/Public/Admin/assets/js/jquery.autosize.min.js"></script>
		<script src="/Public/Admin/assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="/Public/Admin/assets/js/jquery.maskedinput.min.js"></script>
		<script src="/Public/Admin/assets/js/bootstrap-tag.min.js"></script>
		<!-- 公共js  <link rel="stylesheet" href=on.js" /> -->
		
			<!-- 自定义公共css  -->
		<link rel="stylesheet" href="/Public/css/style.css" />
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<script type="text/javascript" charset="utf-8" src="/Public/Components/ueditor1_4_3-utf8-php/ueditor.config.js"></script>
		<script type="text/javascript" charset="utf-8" src="/Public/Components/ueditor1_4_3-utf8-php/ueditor.all.min.js"> </script>
		<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
		<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
		<script type="text/javascript" charset="utf-8" src="/Public/Components/ueditor1_4_3-utf8-php/lang/zh-cn/zh-cn.js"></script>

		<!--[if lt IE 9]>
		<script src="/Public/Admin/assets/js/html5shiv.js"></script>
		<script src="/Public/Admin/assets/js/respond.min.js"></script>
		<![endif]-->
		<!-- 通知层前台js -->
		<script>
			//批量删除
			function batchDel(selector,action){
				var list = new Array();
				$("input[id='"+selector+"']:checked").each(function () {
					list.push($(this).val());
				});
				if (list == '') {
					alert('请选择您要删除的数据！');
					return false;
				}
				if(confirm('确定要删除？')){
					var data = "list=" + list.join(',');
					$.ajax({
						url: "<?php echo u(CONTROLLER_NAME . '/"+action+"');?>",
						type: "POST",
						dataType: "json",
						data: data,
						success: function (res) {
							if (res.result == 'success1') {
								alert("操作成功");
								location.reload();
							} else {
								alert("操作失败");
							}
						}
					});
				}
			}
			//单条数据删除
		 function OneDelData(action,id){
			 if(confirm('确定要删除？')){
				 $.ajax({
					 url:"<?php echo u(CONTROLLER_NAME . '/"+action+"');?>",
					 type:"POST",
					 dataType:"json",
					 data:"id="+id,
					 success:function(res){
						 if(res.result == 'success'){
							 location.reload()
						 }else{
							 alert("操作失败");
						 }
					 }
				 });
			 }
		 }
			//修改状态
			function statusSave(action,id){
					var show = document.getElementById("show_"+id).checked == true ? '1':'0';
					$.ajax({
						url:"<?php echo U(CONTROLLER_NAME . '/"+action+"');?>", // 表单提交的地址
						type: 'POST',
						dataType: 'json',
						data:'id='+id+'&status='+show, // 表单提交的数据
						success:function(res){
						}
					});
			}
		var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-top-right",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "500",
			"timeOut": "5000",
			"extendedTimeOut": "500",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
			};
		</script>
		  <style>
.main-content {
  margin-left: 0;
    margin-right: 0;
    margin-top: 0;
    min-height: 100%;
    padding: 0;
}
</style> 
	</head>
<body>
 

<div class="main-container" id="main-container">
  <div class="main-container-inner"> <a class="menu-toggler" id="menu-toggler" href="#"> <span
				class="menu-text"></span> </a> 
    <div class="main-content">
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div class="widget-box transparent" id="recent-box">
              <div class="widget-header">
                <div class="widget-toolbar no-border">
                  <ul class="nav nav-tabs" id="recent-tab">
                   
                    <li><a href="<?php echo U(CONTROLLER_NAME.'/index');?>">管理员列表</a></li>
                    <li class="active"><a href="<?php echo U(CONTROLLER_NAME.'/edit');?>">编辑</a> </li>
                  </ul>
                </div>
              </div>
            </div>
            <br>
            <div class="main-container" id="main-container"> 
              <script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
       <script type="text/javascript">
		 $(document).ready(function(){
			 
			 $("#js_submit_role").click(function(){
				 if($("#real_name").val() ==  "")
				 {
					 alert("姓名不能为空");
					 $("#real_name").focus();
					 return false;
				 }
				 
				 if($("#account1").val() ==  "")
				 {
					 alert("账号不能为空");
					 $("#account1").focus();
					 return false;
				 }
				  
				 var data ="real_name="+$("#real_name").val()+"&account1="+$("#account1").val()+"&status="+$("#status").val()+"&id="+$("#id").val()+"&action=update";
				  
				 $.ajax({
					 url:"<?php echo u(CONTROLLER_NAME . '/edit');?>",
					 type:"POST",
					 dataType:"json",
					 data:data,
					 success:function(res){
						  if(res.result == 'success'){
							 alert("保存成功");
							 location.href="<?php echo u(CONTROLLER_NAME . '/index');?>";
						 }else{
							 alert("保存失败");
						 }
						 
					 }
				 });
				 
				 return false;
			 });
		 });
		 
		 </script>
		  <div style="width:400px;margin:0 0;">
				<form role="form" id="form1" method="post" enctype="multipart/form-data" action="">
			<div class="form-horizontal">
<input type="hidden" name="action" value="update" />
				<div class="margin100 control-group">
					<input type="hidden" class="" value="<?php echo ($admin["id"]); ?>" name="id" id="id">
					<label class="control-label">姓名</label>
					<div class="controls">
						<input type="text" class="fl dpb form-control width250 " id="real_name" name="real_name"
							placeholder="姓名" maxlength="20" value="<?php echo ($admin["real_name"]); ?>"> 
							<span class="colorf00 dpb fl lh30 margin010">*必填 </span>  
							 <div class="clb"></div>
					</div>
				</div>
				<div class="margin100 control-group">
					<label class="control-label">账号</label>
					<div class="controls">
						<input type="text" class="fl dpb form-control width250 " id="account1" name="account1"
							placeholder="登录账号" maxlength="20" value="<?php echo ($admin["account"]); ?>">
							 <span class="colorf00 dpb fl lh30 margin010">*必填 </span>
							 <div class="clb"></div>  
					</div>
				</div><div class="margin100 control-group">
<div class="controls">
 
  <label style="text-align:left" class="col-sm-12 control-label " for="form-field-1" style="text-align:right">头像</label>
 
													 <div class="col-sm-9">
<div class="" style="width:300px;">
				
	 <div id="upload_zizhi" style="padding: 0; cursor: pointer;"
								class="upload"></div>
							<div id="imgdiv_zizhi" style=" padding: 0"
								class="upload">

								 
									<img id="imgShow_zizhi" src="<?php echo ($admin["head"]); ?>" width="100" height="100">
								 

 <div id="cancel_zizhi"
									style="width: 50px; cursor: pointer">

								</div>
								<input type="hidden" id="ifuploadback_zizhi"
									name="ifuploadback_zizhi" value="0" />

							</div>
						 
<div class=""> <p>支持JPG、PNG、BMP、GIF格式</p> </div>
					 
					<div style="background:url(/Public/img/xuanze.png) no-repeat; width: 200px; margin: 0;">
						<input type="file" id="certificate" name="certificate"
							style="height: 44px; width: 113px; filter: alpha(opacity : 0); opacity: 0; cursor: pointer;"
							onblur="checknewpaaa()" />

					</div>
				</div>	</div>
				
				<div style="clear:both;"></div>
			
				  </div>  </div> 
				 
				 
				<div class="margin100 control-group">
					<label class="control-label">状态</label>
					<div class="controls">
						<select name="status" id="status" class="fl form-control width250">
							<option value="1" <?php if(($admin["status"]) == "1"): ?>selected<?php endif; ?>>正常</option>
							<option value="2" <?php if(($admin["status"]) == "2"): ?>selected<?php endif; ?>>冻结</option>
							<option value="3" <?php if(($admin["status"]) == "3"): ?>selected<?php endif; ?>>删除</option>
						</select> 	 <span class="colorf00 dpb fl lh30 margin010">*必填 </span>
						 <div class="clb"></div>  
					</div>
				</div>
			</div> 
			<br>
			<div class="tool_area">
				<div class="tool_bar  ">
					
					 <a class="sub_f btn btn-info" href="javascript:$('form').submit()" name="on"><i class="icon-ok bigger-110" ></i>提交</a>	 
						 <a href="javascript:history.go(-1)" class="btn btn-pink">取消</a>
					 
				</div>
			</div>
			</form>
		 </div>
	  </div>
            <!-- /.main-container --> 
          </div>
        </div>
        <!-- /.row --> 
      </div>
      <!-- /.page-content --> 
    </div>
    <!-- /.main-content --> 
    
  </div>
  <!-- /.main-container-inner --> 
    <script type="text/javascript">

		$(function() {

			new uploadPreview({
				UpBtn : "certificate",
				DivShow : "imgdiv_zizhi",
				ImgShow : "imgShow_zizhi"
			});

			$("#certificate").change(function() {
				$("#imgdiv_zizhi").show();
				$("#upload_zizhi").hide();
				$("#ifuploadback_zizhi").val("1");
			});

			$("#cancel_zizhi").click(function() {
				$("#imgdiv_zizhi").hide();
				$("#upload_zizhi").show();
				$("#ifuploadback_zizhi").val("0");
			});

			 
		   	  $(".bottom2").next().hide();
			  $(".user_left>ul>li").eq(0).removeClass("a");
			  $(".user_left>ul>li").eq(5).addClass("a");

		});
	</script>
  <a href="#" id="btn-scroll-up"
			class="btn-scroll-up btn btn-sm btn-inverse"> <i
			class="icon-double-angle-up icon-only bigger-110"></i> </a> </div>
 
		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script src="/Public/Admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/Public/Admin/assets/js/jquery.dataTables.bootstrap.js"></script>
		<script src="/Public/Admin/assets/js/bootstrap.min.js"></script>
		<script src="/Public/Admin/assets/js/typeahead-bs2.min.js"></script>

		<!-- dataTables -->

		<script src="/Public/Admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/Public/Admin/assets/js/jquery.dataTables.bootstrap.js"></script>

		<!-- ace scripts -->

		<script src="/Public/Admin/assets/js/ace-elements.min.js"></script>
		<script src="/Public/Admin/assets/js/ace.min.js"></script>
		 <!-- bootstrap -->
		<script src="/Public/Admin/assets/js/bootstrap.min.js"></script>
		<script src="/Public/Admin/assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="/Public/Admin/assets/js/excanvas.min.js"></script>
		<![endif]-->

	
		<script src="/Public/Admin/assets/js/bootstrap.min.js"></script>
		<script src="/Public/Admin/assets/js/typeahead-bs2.min.js"></script>

		<!-- jqGrid -->
	<script src="/Public/Admin/assets/js/jqGrid/jquery.jqGrid.min.js"></script>
		<script src="/Public/Admin/assets/js/jqGrid/i18n/grid.locale-en.js"></script>

		<!-- ace scripts -->

		 
	 
		<script src="/Public/Admin/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="/Public/Admin/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="/Public/Admin/assets/js/jquery.slimscroll.min.js"></script>
		<script src="/Public/Admin/assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="/Public/Admin/assets/js/jquery.sparkline.min.js"></script>
		<script src="/Public/Admin/assets/js/flot/jquery.flot.min.js"></script>
		<script src="/Public/Admin/assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="/Public/Admin/assets/js/flot/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->

		<script src="/Public/Admin/assets/js/ace-elements.min.js"></script>
		
<script>

$('.form_date').datetimepicker({
    language:  'zh-CN',
    weekStart: 1,
    todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	startView: 2,
	minView: 2,
	forceParse: 0
});
</script>
 
	</body>
</html>