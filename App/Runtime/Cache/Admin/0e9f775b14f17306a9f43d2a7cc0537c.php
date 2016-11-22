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
.btn-purple, .btn-purple:focus {
    background: none;
    border-color: none;
}
.btn, .btn-default, .btn:focus, .btn-default:focus {
    background: none;
    border-color:none;
}.btn {
    display: inline-block;
    color: #FFF!important;
    text-shadow: 0 -1px 0 rgba(0,0,0,0.25)!important;
    background-image: none!important;
    border:none;
    border-radius: 0;
    box-shadow: none!important;
    -webkit-transition: all ease .15s;
    transition: all ease .15s;
    cursor: pointer;
    vertical-align: middle;
    margin: 0;
    position: relative;
}
.sort_1{
	float:left;
	margin:0 10px 0 0px;
	width:60px; 
	text-align:center;
}
.sort_6{
	float:left;
	margin:0 10px 0 0px;
	width:200px; 
	text-align:center;
}
.sort_2{
	
	float:left;
	margin:0 10px 0 0px;
	width:200px;
}
.sort_3{
	float:left;
	margin:0 10px 0 0px;
	width:150px;
}
.sort_4{
	float:left;
	margin:0 10px 0 0px;
	width:150px;
}
.sort_5{
	width:70px;
	float:left;
	margin:0 10px 0 0px;
}
.sort_7{
	 float:left;margin:0 10px 0 0px;width:150px; text-align:center; 
}
.sort_8{
	float:left;margin:0 10px 0 0px;width:70px; text-align:center;
}
 .append_div1{
	width:200px;
	height:100px;
 }
 .append_div{ 
 	position:absolute;
	right:10000px; 
	
 }
.sort_10{
	float:left;margin:0 10px 0 0px;text-align:center;
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
                   
                    <li class="active"><a href="<?php echo U(CONTROLLER_NAME.'/index');?>">类型列表</a></li>
                    <li><a href="<?php echo U(CONTROLLER_NAME.'/add');?>">添加</a> </li>
                  </ul>
                </div>
              </div>
            </div>
          
            <div class="main-container" id="main-container"> 
              <script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
              
              <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  
</div>
              <div class="main-container-inner"> <a class="menu-toggler" id="menu-toggler" href="#"> <span
										class="menu-text"></span> </a>
                
                <div class="row">
                  <div class="col-xs-12"> 
                    <!-- PAGE CONTENT BEGINS -->
        <div style=" border-bottom:1px solid #ccc;margin:0 0 15px 0;">
        <p  style=" width:60px;  " class="sort_10">等级</p>
        <p  style=" width:60px;  " class="sort_10">排序</p>
        <p  style="width:200px;" class="sort_10">icon图标</p>
       <p class="sort_7">菜单名称</p>
        <p class="sort_7">路径</p>
        <p  style="width:80px;" class="sort_10">是否启用</p>
         <p  class="sort_9	" >操作</p>
        
        <p style="clear:both;"></p>
      </div>

      <?php if(is_array($system_menu1)): $i = 0; $__LIST__ = $system_menu1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if($menu["parent"] == 0): ?><div style="height:40px;">
            <p style=" float:left;margin:0 0 0 0px;width:70px; text-align:center; line-height:30px;font-size:1.3em;">一级菜单</p>
            <input type="hidden" id="id" name="id" value="<?php echo ($menu["id"]); ?>" />
  <input type="text" value="<?php echo ($menu["sort"]); ?>" data-id="<?php echo ($menu["id"]); ?>" class="sort_1 form-control" name="sort"  id="sort_<?php echo ($menu["id"]); ?>" />
              <input data-id="<?php echo ($menu["id"]); ?>" type="text" class="sort_2 form-control" value="<?php echo ($menu["icon"]); ?>" name="icon"  id="icon_<?php echo ($menu["id"]); ?>" />
              <input data-id="<?php echo ($menu["id"]); ?>" type="text" class="sort_3 form-control" value="<?php echo ($menu["name"]); ?>" name="name"  id="name_<?php echo ($menu["id"]); ?>"  />
                <input data-id="<?php echo ($menu["id"]); ?>" type="text" class="sort_4 form-control" value="<?php echo ($menu["path"]); ?>" name="path"  id="path_<?php echo ($menu["id"]); ?>"  />
               <select data-id="<?php echo ($menu["id"]); ?>" type="text" class="sort_5 form-control" name="status" id="status_<?php echo ($menu["id"]); ?>">
                <option value="1" <?php if($menu["status"] == 1): ?>selected = selected"<?php endif; ?> >是</option>
                <option value="0" <?php if($menu["status"] == 0): ?>selected = selected"<?php endif; ?> >否</option>
             </select>
         <!-- href="javascript:void(0);" onclick="save(<?php echo ($menu["id"]); ?>)" -->
              <?php if($menu['path'] == '' && $menu['path'] == null ): ?><div>
               <a data-id="<?php echo ($menu["id"]); ?>" class="save_sub btn btn-success">修改</a>
               <a href="" onclick="alert('包含二级菜单不能删除');" disabled  class="btn btn-grey id="del_<?php echo ($menu["id"]); ?>">删除</a>
               <!--p style="float:right; line-height:30px;margin:0 10px 0 0;"><span style="color:#F00;">*</span>包含二级菜单不能删除</p-->
              </div>
              <?php else: ?> 
              <!--  <a href="javascript:void(0);" onclick="save(<?php echo ($menu["id"]); ?>)" class="btn btn-success">修改</a>   -->
              <a data-id="<?php echo ($menu["id"]); ?>" class="save_sub btn btn-success">修改</a>
               <a href="javascript:void(0);" onclick="del(<?php echo ($menu["id"]); ?>)" class="btn btn-pink save_del">删除</a><?php endif; ?> 
             </div>
            <?php if(is_array($system_menu1)): $i = 0; $__LIST__ = $system_menu1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menusub): $mod = ($i % 2 );++$i; if(($menusub["parent"]) == $menu["id"]): ?><div style="height:40px;">
<p style=" float:left;margin:0 0 0 0px;width:70px; text-align:center; line-height:30px;">二级菜单</p>
<input type="text" value="<?php echo ($menusub["sort"]); ?>"  name="sort"  id="sort_<?php echo ($menusub["id"]); ?>"  data-id="<?php echo ($menusub["id"]); ?>" class="sort_1 form-control" />
 <input data-id="<?php echo ($menusub["id"]); ?>" type="text" class="sort_2 form-control" value="<?php echo ($menusub["icon"]); ?>"  name="icon"  id="icon_<?php echo ($menusub["id"]); ?>" />
<input class="form-control sort_3" type="text" data-id="<?php echo ($menusub["id"]); ?>" value="<?php echo ($menusub["name"]); ?>" name="name"  id="name_<?php echo ($menusub["id"]); ?>" />
<input data-id="<?php echo ($menusub["id"]); ?>" type="text" class="sort_4 form-control" value="<?php echo ($menusub["path"]); ?>" name="path"  id="path_<?php echo ($menusub["id"]); ?>" />
<select data-id="<?php echo ($menusub["id"]); ?>" class="form-control sort_5"  name="status" id="status_<?php echo ($menusub["id"]); ?>">
   <option value="1" <?php if($menusub["status"] == 1): ?>selected = selected"<?php endif; ?> >是</option>
   <option value="0" <?php if($menusub["status"] == 0): ?>selected = selected"<?php endif; ?> >否</option>
</select>
                <a href="# " class="save_sub btn btn-purple" data-id="<?php echo ($menusub["id"]); ?>">修改</a>
                 <a href="#" class="btn btn-pink" onclick="del(<?php echo ($menusub["id"]); ?>)" data-id="<?php echo ($menusub["id"]); ?>" id="del_<?php echo ($menu["id"]); ?>">删除</a>
                  <p style="clear:both;"></p>
                </div>

                <!--volist name="system_menu" id="menusub1">
                  <?php if(($menusub1["parent"]) == $menusub["id"]): ?><div style="height:40px;">
                   <p style=" float:left;margin:0 0 0 0px;width:140px; text-align:center; line-height:30px;">
                   -&nbsp;-&nbsp;-&nbsp;-&nbsp;三级菜单&nbsp;-&nbsp;-&nbsp;-&nbsp;-</p>
                  <input data-id="<?php echo ($menusub1["id"]); ?>" type="text" class="sort_1 form-control" value="<?php echo ($menusub1["sort"]); ?>" name="sort" id="sort_<?php echo ($menusub1["id"]); ?>" />
                  <input data-id="<?php echo ($menusub1["id"]); ?>" type="text" class="sort_2 form-control" value="<?php echo ($menusub1["icon"]); ?>" name="icon" id="icon_<?php echo ($menusub1["id"]); ?>"  />
                    <input data-value="<?php echo ($menusub1["id"]); ?>" type="text" class="sort_3 form-control" value="<?php echo ($menusub1["name"]); ?>" name="name" id="name_<?php echo ($menusub1["id"]); ?>" />
                     <input data-id="<?php echo ($menusub1["id"]); ?>" type="text" class="sort_2 form-control" value="<?php echo ($menusub1["path"]); ?>"  name="path" id="path_<?php echo ($menusub1["id"]); ?>" />
                     <select data-id="<?php echo ($menusub1["id"]); ?>" class="sort_5 form-control" name="status" id="status_<?php echo ($menusub1["id"]); ?>" >
                <option value="1" <?php if($menusub1["status"] == 1): ?>selected = selected"<?php endif; ?> >是</option>
                <option value="0" <?php if($menusub1["status"] == 0): ?>selected = selected"<?php endif; ?> >否</option>
             </select>
             <div class="append_div">
             <div class="append_div1"><br><br>
      	<a style="margin:0 0 0 20px;" href="#" class="save_del btn btn-pink"  data-id="<?php echo ($menusub1["id"]); ?>">删除</a>
      	<a class="btn btn-white">取消</a>
      </div></div>
              <a href="# " class="save_sub btn btn-turquoise"  data-id="<?php echo ($menusub1["id"]); ?>">修改</a>
				<a href="#" class="open_layer btn btn-pink"  data-id="<?php echo ($menusub1["id"]); ?>">删除</a>
                     <p style="clear:both;"></p>
                    </div><?php endif; ?>
                </volist--><?php endif; endforeach; endif; else: echo "" ;endif; ?><hr/><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      
      <div style="width:500px;margin:0 auto;"> </div>
      <script>
		  function del(id){
			  var data = 'id='+id;
			  if(confirm('确定要删除吗？')){
				  $.ajax({
					  url:"<?php echo u(CONTROLLER_NAME . '/del');?>",
					  type:"POST",
					  dataType:"json",
					  data:data,
					  success:function(res){
						  if(res.result == 'success1'){
							  alert("操作成功");
							  window.location.reload();
						  }else{
							  alert("操作失败");
						  }
					  }

				  });

			  }

		  }
     $('.append_div').hide();
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
      $('.save_sub').click(function(){
    	  var id = $(this).attr('data-id');
   		// show_loading_bar(100);
   		  if($("#name").val() ==  "")
   		 {
   			 toastr.error("<i class=fa-info></i>请输入名称内容", opts);
   			 $("#name").focus();
   			 return false;
   		 }
   		
   		 if($("#icon").val() ==  "")
   		 {
   			 toastr.error("<i class=fa-info></i>请输入图片class", opts);
   			 $("#icon").focus();
   			 return false;
   		 }  
   		var data = "id="+id+"&name="+$("#name_"+id).val()+"&path="+$("#path_"+id).val()+"&status="+$("#status_"+id).val()+"&icon="+$("#icon_"+id).val()+"&sort="+$("#sort_"+id).val();
   	 $.ajax({
   		url:"<?php echo u(CONTROLLER_NAME . '/updata');?>",
   		type:"POST",
   		dataType:"json",
   		data:data,
   		success:function(res){
   			if(res.result == 'success'){
   			 alert("操作成功");
   				 window.location.reload();
   			}else{
   				alert("操作失败");
   			 window.location.reload();
   			}
   		}
   	 
   	 });
      }); 
     
     
      $('.save_del').click(function(){
    	  var id = $(this).attr('data-id');
    	  //alert(id);
   	//	 show_loading_bar(100);
   		  var data = "id="+id+"&name="+$("#name_"+id).val()+"&path="+$("#path_"+id).val()+"&status="+$("#status_"+id).val()+"&icon="+$("#icon_"+id).val()+"&sort="+$("#sort_"+id).val();
   	 $.ajax({
   		url:"<?php echo u('/admin/menu/del');?>",
   		type:"POST", 
   		dataType:"json",
   		data:data,
   		success:function(res){
   			if(res.result == 'success1'){
   				 alert("删除成功");
   				 window.location.reload();
   			}else{
   			 alert("删除失败");
   			}
   		}
   	 
   	 });  		    
      });  

  
</script> 
 
                   
                    <!-- /.table-responsive --> 
                    
                    <script type="text/javascript">
                    //搜索表单判断
                    /*$('.search').click(function () { 
                    	var name = $('#name').val();
                    	if(name == ""){
                    		alert('请输入您要搜索的数据！');
                    		$('#name').focus();
                    		return false;
                    	}
                     });*/
                    //checkbox全选
                    $(".chkall").click(function () { 
                    	var checked = $(this).prop("checked");
                    	$('.box').prop("checked",checked);
                    });
                  //全部删除按钮为空判断
                    $(".all_val").click(function () { 
                    	var list = new Array();
                    	$("input[id='style_val']:checked").each(
								function() {
									list.push($(this).val());
								 }); 
                    	if(list == ''){
                    		alert('请选择您要删除的数据！');
                    		return false;
                    	}
                    });
                    //执行全部删除方法
                    $(".all_val1").click(function () { 
                    	var list = new Array();
                    	$("input[id='style_val']:checked").each(
								function() {
									list.push($(this).val());
								 }); 
                    	 var data = "list="+list.join(',');
                    	  $.ajax({
            			     url:"<?php echo u(CONTROLLER_NAME . '/previous_delete');?>",
            			     type:"POST",
            			     dataType:"json",
            			     data:data,
            			     success:function(res){
            			    if(res.result == 'success1'){
            			        //  alert("操作成功");
            			            location.reload() 
            			         // location.href="<?php echo u('/home/index/cc');?>"
            			         }else{
            			        alert("操作失败");
            			      }
            			     
            			     }
            			   });
                    	 
                    });
       //获取删除id
	  $('.del').click(function(){
		  var id = $(this).attr('data-id');
		  $('.del_id').attr('data-cid',id);
	  });
	  //执行单条数据删除方法
	  $('.del_id').click(function(){
		  var id = $(this).attr('data-cid');
		  $.ajax({
			     url:"<?php echo u(CONTROLLER_NAME . '/previous_delete');?>",
			     type:"POST",
			     dataType:"json",
			     data:$(".form-horizontal").serialize()+"&id="+id,
			     success:function(res){
			    if(res.result == 'success'){
			           location.reload() 
			         }else{
			        alert("操作失败");
			      }
			     
			     }
			    });
		 // $('.del_id').attr('data-cid',id);
	  });
	  //状态开关
	  function show_change(id){
		  var show = document.getElementById("show_"+id).checked == true ? '1':'0';
		   $.ajax({
		    url:"<?php echo U(CONTROLLER_NAME . '/show_change');?>", // 表单提交的地址
		    type: 'POST',
		    dataType: 'json',
		    data:'id='+id+'&status='+show, // 表单提交的数据
		    success:function(res){
			 }
		  });
		}
		 </script> 
                    
                    <!-- PAGE CONTENT ENDS --> 
                  </div>
                  <!-- /.col --> 
                </div>
                <!-- /.row --> 
                
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