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
                   
                    <li class="active"><a href="<?php echo U(CONTROLLER_NAME.'/index');?>">管理员列表</a></li>
                    <li><a href="<?php echo U(CONTROLLER_NAME.'/add');?>">添加</a> </li>
                  </ul>
                </div>
              </div>
            </div>
            <br>
            <div class="main-container" id="main-container"> 
              
        
			 <table cellspacing="0" width="100%" class="table table-small-font table-bordered table-striped">
									<thead>
										<tr>
											<th>编号</th>
											<th data-priority="1">用户名</th>
											 <th data-priority="3">用户头像</th>
											<th data-priority="3">姓名</th>
										
											<th data-priority="3">状态</th>
											<th data-priority="3">操作</th>
										 
										</tr>
									</thead>
									<tbody>
										 <?php if(is_array($admins)): $i = 0; $__LIST__ = $admins;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin): $mod = ($i % 2 );++$i;?><tr>
			 		<td><?php echo ($admin["id"]); ?></td>
			 		<td><?php echo ($admin["account"]); ?></td>
			 		 			 		<td><img src="<?php echo ($admin["head"]); ?>" width="50" /></td>
			 		<td><?php echo ($admin["real_name"]); ?></td>

			 		<td>
			 		
				 		 <?php if($admin["status"] == '1'): ?>正常
				 		<?php elseif($admin["status"] == '2'): ?>
				 		冻结
				 		<?php else: ?>
				 		删除<?php endif; ?>
				 		
			 		</td>
			 		<td>					
			 		<a class="btn btn-secondary" href="<?php echo u(CONTROLLER_NAME . '/edit');?>?id=<?php echo ($admin["id"]); ?>" >编辑</a>
			 		<?php if($admin["account"] == 'admin'): ?><a class="btn btn-pink"  href="<?php echo u(CONTROLLER_NAME . '/setAdminPassword');?>?id=<?php echo ($admin["id"]); ?>">设置密码</a>
						<a class="btn btn-pink" disabled="disabled" href="<?php echo u(CONTROLLER_NAME . '/setpower');?>?id=<?php echo ($admin["id"]); ?>">设置权限</a>
				 	<?php else: ?>
				 		<a class="btn btn-pink"  href="<?php echo u(CONTROLLER_NAME . '/setAdminPassword');?>?id=<?php echo ($admin["id"]); ?>">设置密码</a>
				 		<a class="btn btn-pink"  href="<?php echo u(CONTROLLER_NAME . '/setpower');?>?id=<?php echo ($admin["id"]); ?>">设置权限</a>
				 		<?php if($hoster == 'admin'): ?><a class="btn btn-pink"  href="javascript:deladmin(<?php echo ($admin["id"]); ?>)">删除</a><?php endif; endif; ?></td>
			 	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
										</table>
									 
			 
			 
			
			
			
			 
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
  <!-- /.main-container-inner --> 
   <script>
	function deladmin(power_id){
   		if(confirm('确定删除吗 ？')){
   			$.ajax({
				url:"<?php echo u(CONTROLLER_NAME . '/deladmin');?>",
				type:"POST",
				dataType:"json",
				data:{power_id:power_id},
				success:function(res){
					if(res.result == '1'){
						alert('操作成功');
						 window.location.reload();
					}else{
						alert('操作失败');
						 window.location.reload();
					}
				}
			 });
   		}else{
   			return false;
   		}
   }
   
   
$(document).ready(function(){
    var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-top-full-width",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};
	$('#submit').click(function(){
		 
		//show_loading_bar(100);
		 if($("#name").val() ==  "")
		 {
			// toastr.error("<i class=fa-info></i>请输入名称内容", opts);
			 $("#name").focus();
			 return false;
		 }
		 if($("#path").val() ==  "")
		 {
			// toastr.error("<i class=fa-info></i>请输入路径内容", opts);
			 $("#path").focus();
			 return false;
		 }
		 if($("#icon").val() ==  "")
		 {
			// toastr.error("<i class=fa-info></i>请输入图片class", opts);
			 $("#icon").focus();
			 return false;
		 }
		  
		 var data = "name="+$("#name").val()+
		 	 "&path="+$("#path").val()+
		 	 "&is_menu="+$('#is_menu').val()+
		 	"&status="+$('#status').val()+
			"&icon="+$('#icon').val()+
			"&sex="+$('#sex').val()+
			"&parent="+$('#parent').val()+
			"&sort="+$('#sort').val();
		 $.ajax({
			url:"<?php echo u(CONTROLLER_NAME . '/add');?>",
			type:"POST",
			dataType:"json",
			data:data,
			success:function(res){
				if(res.result == 'success'){
					alert('操作成功');
					 window.location.reload();
				}else{
					alert('操作失败');
					 window.location.reload();
				}
			}
		 
		 });
		 
	});
	
});
</script> 
  <!--a href="#" id="btn-scroll-up"
			class="btn-scroll-up btn btn-sm btn-inverse"> <i
			class="icon-double-angle-up icon-only bigger-110"></i> </a--> </div>
 
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