<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
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
			

			<div class="main-container-inner">
				 

				<div class="main-content">
					 
<style>
.widget-toolbar {
    display: inline-block;
    padding: 0 10px;
    line-height: 37px;
    float: none;
    position: relative;
}
					</style>
					<div class="page-content">
						 <div class="row">
						 
				<div class="col-xs-12">
							 
										<div class="widget-box transparent" id="recent-box">
											<div class="widget-header">
												 

												<div class="widget-toolbar no-border">
													<ul class="nav nav-tabs" id="recent-tab">
																											
														<li>
															<a  href="<?php echo U(CONTROLLER_NAME . '/index');?>">会员列表</a>
														</li>
														<?php if($list["id"] == '' ): ?><li class="active">
															<a href="<?php echo U(CONTROLLER_NAME . '/add');?>">添加</a>
														</li>
														<?php else: ?>
														<li class="active">
															<a href="#">修改</a>
														</li><?php endif; ?>

														 
													</ul>
												</div>
											</div>
											
											</div>
											<br>
										<?php if($list["id"] != '' ): ?><form role="form" id="form1"	method="post" enctype="multipart/form-data"   action="/index.php/User/save_data">
										<?php else: ?>
										<form role="form" id="form1" method="post" enctype="multipart/form-data" action=""><?php endif; ?>	
											<?php if($list["id"] != '' ): ?><div class="form-group">
											 
													
														
														 <div class="col-sm-9">
													</div>	<div style="clear:both;"></div>
												</div><?php endif; ?>
					<div class="form-group">
						<input type="hidden" value="1" name="change" id="change" />
						<label style="text-align:right" class="col-sm-3 control-label no-padding-right" for="form-field-1">会员级别</label>
						<input type="hidden" name="id" id="id" value="<?php echo ($list["id"]); ?>" />
						<div class="col-sm-9">
							<select name="news_class">
								<?php if(is_array($UserGrade)): $i = 0; $__LIST__ = $UserGrade;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n_v): $mod = ($i % 2 );++$i;?><option <?php if($n_v['id'] == $list['grade_id']): ?>selected = selected<?php endif; ?> value="<?php echo ($n_v["id"]); ?>"><?php echo ($n_v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

							</select>
						</div>  <div style="clear: both;"></div>
					</div>
									<div class="form-group">
										<label style="text-align:right" class="col-sm-3 control-label no-padding-right" for="form-field-1">用户名</label>
										<input type="hidden" name="id" id="id" value="<?php echo ($list["id"]); ?>" />
										<div class="col-sm-9">
										<?php if($list["id"] != '' ): ?><input disabled value="<?php echo ($list["name"]); ?>" type="text" id="name" placeholder="请用手机号注册" name="name" class="col-xs-10 col-sm-5" />
										<?php else: ?>
										<input value="" type="text" id="name" placeholder="请用手机号注册" name="name" class="col-xs-10 col-sm-5" /><?php endif; ?>	
										</div><div style="clear:both;"></div>
									</div>
									
									<div class="form-group">
										<label style="text-align:right" class="col-sm-3 control-label no-padding-right" for="form-field-1">手机号码</label>

										<div class="col-sm-9">
											<input  value="<?php echo ($list["mobile"]); ?>" type="text" id="mobile" placeholder="" name="mobile" class="col-xs-10 col-sm-5" />
										 
										</div>	<div style="clear:both;"></div>
									</div>
									<!--<div class="form-group">
										<label style="text-align:right" class="col-sm-3 control-label no-padding-right" for="form-field-1">真实姓名</label>

										<div class="col-sm-9">
											<input  value="<?php echo ($list["truename"]); ?>" type="text" id="truename" placeholder="请填写真实姓名" name="truename" class="col-xs-10 col-sm-5" />
										 
										</div>	<div style="clear:both;"></div>
									</div>-->
									<?php if($list["id"] != '' ): ?><div class="form-group">
										<label style="text-align:right" class="col-sm-3 control-label no-padding-right" for="form-field-1">生日</label>

										<div class="col-sm-9">
											 
																<div style="padding:0;" class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text"  name="birthday"  <?php if($list["birthday"] != '' ): ?>value="<?php echo (date("Y-m-d",$list["birthday"])); ?>"<?php endif; ?> >
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
															 
										 
										</div>	<div style="clear:both;"></div>
									</div><?php endif; ?>
								
								  
									<!--div class="form-group">
										<label style="text-align:right" class="col-sm-3 control-label no-padding-right" for="form-field-1">排序</label>

										<div class="col-sm-9">

											<input  value="<?php echo ($list["sort"]); ?>" type="text" id="sort" placeholder="" name="sort" class="col-xs-10 col-sm-5" />
										<p class="col-xs-10 col-sm-12" style="padding:0;color:#999;"><span style="color:#f00;">*</span>数字越小越靠前</p>
										</div>	<div style="clear:both;"></div>
									</div-->
									 
									<?php if($list["id"] != '' ): ?><div class="form-group">
										<label style="text-align:right" class="col-sm-3 control-label no-padding-right" for="form-field-1">性别</label>

										<div class="col-sm-9">
											<label style="margin:5px 0 0 0;"><input type="radio" name="sex" value="0" <?php if($list["sex"] == 0): ?>checked="checked"<?php endif; ?> />未知
													</label>
							<label style="margin:5px 0 0 0;">	
                										
											   <input type="radio" name="sex" value="1" <?php if($list["sex"] == 1): ?>checked="checked"<?php endif; ?>  />男
                							</label>
													<label style="margin:5px 0 0 0;">	
                							<input type="radio" name="sex" value="2" <?php if($list["sex"] == 2): ?>checked="checked"<?php endif; ?> />女
													</label>
										</div>	<div style="clear:both;"></div>
									</div><?php endif; ?>
									<div>
 
  <label style="text-align:right" class="col-sm-3 control-label no-padding-right" for="form-field-1" style="text-align:right">头像</label>
  <input type="hidden" name="id" id="id" value="<?php echo ($list["id"]); ?>" /> 

													 <div class="col-sm-9">
<div class="" style="width:300px;">
				
	 <div id="upload_zizhi" style="padding: 0; cursor: pointer;"
								class="upload"></div>
							<div id="imgdiv_zizhi" style=" padding: 0"
								class="upload">

								 
									<img id="imgShow_zizhi" src="<?php echo ($list["head"]); ?>" width="100" height="100">
								 

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
			
				  </div> 

									<!--div class="form-group">
										<label style="text-align:right" class="col-sm-3 control-label no-padding-right" for="form-field-1">是否显示</label>

										<div class="col-sm-9">
											<label style="margin:5px 0 0 0;">
											
											   <input type="radio" name="status" value="1" <?php if($list["status"] == 1): ?>checked="checked"<?php endif; ?> />显示
                							<label style="">	
                							<input type="radio" name="status" value="0" <?php if($list["status"] == 0): ?>checked="checked"<?php endif; ?> />不显示
													</label>
										</div>	<div style="clear:both;"></div>
									</div-->
									 
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
										
										 
												 <a class="sub_f btn btn-info" href="javascript:$('form').submit()" name="on"><i class="icon-ok bigger-110" ></i>提交</a>	 
													 
										
											

											&nbsp; &nbsp; &nbsp;
											<?php if($list["id"] == '' ): ?><button class="btn" type="reset">
												<i class="icon-undo bigger-110"></i>
												重置
											</button><?php endif; ?>
										</div>
									</div>
									</form>
											</div>
									 
							 
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->

				  
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div> 

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

		<!-- <script>
		var status = 1;
		$('.add_').click(function(){
			 
			var name = $('#name').val();
			var mobile = $('#mobile').val();
			var truename = $('#truename').val();
			if(name == ""){
				toastr.error("请输入客户名称！", opts);
        		 $('#name').focus();
        		return false;
        	}
			if(mobile==""){
        		toastr.error("请输入手机号码！", opts);
        		$('#mobile').focus();
        		return false;
        	}
			if(truename==""){
        		toastr.error("请输入真实姓名！", opts);
        		$('#truename').focus();
        		return false;
        	}
			
			 $.ajax({
			     url:"<?php echo u(CONTROLLER_NAME . '/add_user');?>",
			     type:"POST",
			     dataType:"json",
			     data:$(".form-horizontal").serialize()+"&status="+status,
			     success:function(res){
			    if(res.result == 'success'){
			           alert("操作成功");
			   		   location.href="<?php echo u(CONTROLLER_NAME . '/index');?>"
			         }else{
			        	 toastr.error("操作失败！", opts);
			        
			      }
			     
			     }
			    });
		})
		$('.submit_save').click(function(){
			var name = $('#name').val();
			var certificate = $('#certificate').val();
        	if(name == ""){
        		alert('请输入名称！');
        		$('#name').focus();
        		return false;
        	}
        	var data = $("form").serialize()+"&status="+status+"&certificate="+certificate;
			//alert(data);	
        	$.ajax({
				     url:"<?php echo u(CONTROLLER_NAME . '/save_data');?>",
				     type:"POST",
				     dataType:"json",
				     data:data,
				     success:function(res){
				    if(res.result == 'success'){
				           alert("操作成功");
				           location.href="<?php echo u(CONTROLLER_NAME . '/index');?>"
				         }else{
				        alert("操作失败");
				      }
				     
				     }
				    });
			})
		
		</script> -->

		<!-- <![endif]-->

		<!--[if IE]>

<![endif]-->
 
	 

		 
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