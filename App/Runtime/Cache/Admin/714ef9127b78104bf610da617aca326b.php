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

 <style>
 .btn {
    background-image: none !important;
    border: medium none;
    border-radius: 0;
    box-shadow: none !important;
    color: #fff !important;
    cursor: pointer;
    display: inline-block;
    margin: 0;
    position: relative;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25) !important;
    transition: all 0.15s ease 0s;
    vertical-align: middle;
}
 </style>
 
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
                   
                    <li class="active"><a href="">设置权限</a></li>
                    <li><a href="<?php echo U(CONTROLLER_NAME.'/addadmin');?>">添加</a> </li>
                  </ul>
                </div>
              </div>
            </div>
           <form role="form" id="form1"	method="post" enctype="multipart/form-data"   action="/index.php/Setting/save_data">
          <input type="hidden" value="<?php echo ($uid); ?>" name="uid" />
            <div class="main-container" id="main-container"> 
              
        
			  <div class="col_main">
			 
			
			<div class="module_list">
		<div style="text-align:left;margin:10px 0 7px 0;">
		<label><input type="checkbox"  class="chkall">全选</label></div>
				<?php if(is_array($system_module1)): $i = 0; $__LIST__ = $system_module1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if($menu["parent"] == 0): ?><div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
					 
					<input class="boxallv box menu_level_1"  name="checkbox[]"  type="checkbox" id="<?php echo ($menu["id"]); ?>" value=<?php echo ($menu["id"]); ?> <?php if(in_array($menu['id'],$power) == 'true'): ?>checked<?php endif; ?>
					 
					 ><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree_<?php echo ($menu["id"]); ?>" aria-expanded="false" aria-controls="collapseThree">
					 <?php echo ($menu["name"]); ?>
					</a>
					 
					</h4>		
					</div>
					<div id="collapseThree_<?php echo ($menu["id"]); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
					<div class=" " style="padding:0 15px 15px 15px;">
					<p style="font-weight :bold;border-bottom:1px solid #ccc;padding:0 0 10px 0;"><?php echo ($menu["name"]); ?>下的二级菜单</p>
					
					<?php if(is_array($system_module1)): $i = 0; $__LIST__ = $system_module1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menusub): $mod = ($i % 2 );++$i; if(($menusub["parent"]) == $menu["id"]): ?><div class="">
							<div style="margin:0 0 0 20px;">
							<label><input  name="checkbox[]"  class="box menu_level_2" type="checkbox" id=<?php echo ($menu["id"]); ?>_<?php echo ($menusub["id"]); ?> value=<?php echo ($menusub["id"]); ?>
							  <?php if(in_array($menusub['id'],$power) == 'true'): ?>checked<?php endif; ?>
							 ><?php echo ($menusub["name"]); ?>
							 
							 </label>
							</div>
							<?php if(($menusub3["parent"]) == $menusub["id"]): ?><div style="margin:5px 0 5px 40px;border-bottom:1px solid #ccc;">
								 <?php echo ($menusub["name"]); ?>下的二级菜单</div><?php endif; ?>
							<?php if(is_array($system_module1)): $i = 0; $__LIST__ = $system_module1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menusub3): $mod = ($i % 2 );++$i; if(($menusub3["parent"]) == $menusub["id"]): ?><div style="margin:0 0 0 40px;">
								<div class="menu_level_3">
									<div>
									
									<label><input type="checkbox" name="checkbox[]" class=" box" id=<?php echo ($menu["id"]); ?>_<?php echo ($menusub["id"]); ?>_<?php echo ($menusub3["id"]); ?> value=<?php echo ($menusub3["id"]); ?>
								   <?php if(in_array($menusub3['id'],$power) == 'true'): ?>checked<?php endif; ?>
								  ><?php echo ($menusub3["name"]); ?>
									 
								  </label>
									</div>
									<?php if(is_array($system_module)): foreach($system_module as $key=>$sub): if(($sub["parent"]) == $menusub3["id"]): ?><div><?php echo ($sub["name"]); ?>
									 <input type="checkbox"  name="checkbox[]"  id=<?php echo ($menu["id"]); ?>_<?php echo ($menusub["id"]); ?>_<?php echo ($menusub3["id"]); ?>_<?php echo ($sub["id"]); ?> value=<?php echo ($sub["id"]); ?>
									   <?php if(in_array($sub['id'],$power) == 'true'): ?>checked<?php endif; ?>
									 />
									</div><?php endif; endforeach; endif; ?>
								</div>
							</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</div><?php endif; endforeach; endif; else: echo "" ;endif; ?></div></div>
				</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</div>
			
	<div class="tool_area">
				<div class="tool_bar border">

				<a class="sub_f btn btn-info" href="javascript:$('form').submit()" name="on"><i class="icon-ok bigger-110" ></i>提交</a>
				</div>

			</div>
		</div>
									 
		</form>	 
			 
			
			
			
			 
			<div class="page-loading-overlay">
				<div class="loader-2"> </div>
			 

		 
      </div>
              <!-- /.main-container-inner --> 
              
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
   
  <script>
 $(".chkall").click(function () { 
 	var checked = $(this).prop("checked");
 	$('.box').prop("checked",checked);
 });
 $(".menu_level_1").click(function(){
	    var checked = $(this).prop("checked");
	    var id = $(this).attr("id");
		$("input[id^='"+id+"_']").prop("checked",checked);
	 
	})
	$(".menu_level_2").click(function(){
	    var checked = $(this).prop("checked");
	    var id = $(this).attr("id");
		$("input[id^='"+id+"_']").prop("checked",checked);
	 
	})
 </script>
  <!-- /.main-container-inner --> 
 
   
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