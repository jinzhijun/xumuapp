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

<script src="/Public/b-fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="/Public/b-fileinput/js/fileinput.min.js"></script>
<link  href="/Public/b-fileinput/css/fileinput.css" rel="stylesheet">
<script  src="/Public/b-fileinput/js/fileinput.js" ></script>
<script src="/Public/b-fileinput/js/fileinput_locale_zh.js"></script>



<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>



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
                                            <a  href="<?php echo U(CONTROLLER_NAME . '/index');?>">列表</a>
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
                        <?php if($list["id"] != '' ): ?><form role="form" id="form1" method="post" enctype="multipart/form-data" action="<?php echo U(CONTROLLER_NAME . '/edit_pro');?>">
                                <?php else: ?>
                                <form role="form" id="form1" method="post" enctype="multipart/form-data" action=""><?php endif; ?>
                        <input type="hidden" name="id" id="id" value="<?php echo ($list["id"]); ?>" />
                        <?php if($statu == 3): ?><div class="form-group">
                            <label class="tar col-sm-3 control-label no-padding-right" for="form-field-1">产品名称</label>

                            <div class="col-sm-9">
                                <input value="<?php echo ($list["name"]); ?>" type="text" id="name" placeholder="" name="name" class="col-xs-10 col-sm-5" />
                            </div>
                            <div style="clear:both;"></div>
                        </div>

                        <div class="form-group">
                            <label class="tar col-sm-3 control-label no-padding-right" for="form-field-1">商品总价</label>

                            <div class="col-sm-9">
                                <input value="<?php echo ($list["goods_total"]); ?>" type="text" id="goods_total" placeholder="" name="goods_total" class="col-xs-10 col-sm-5" />
                            </div>
                            <div style="clear:both;"></div>
                        </div>

                        <div class="form-group">
                            <label class="tar col-sm-3 control-label no-padding-right" for="form-field-1">本店售价</label>

                            <div class="col-sm-9">
                                <input value="<?php echo ($list["shop_price"]); ?>" type="text" id="shop_price" placeholder="" name="shop_price" class="col-xs-10 col-sm-5" />
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                            <!--<div class="form-group">-->
                                <!--<input type="hidden" value="1" name="change" id="change" />-->
                                <!--<label style="text-align:right" class="col-sm-3 control-label no-padding-right" for="form-field-1">此级别查看</label>-->
                                <!--<input type="hidden" name="id" id="id" value="<?php echo ($list["id"]); ?>" />-->
                                <!--<div class="col-sm-9">-->
                                    <!--<select name="UserGrade">-->
                                        <!--<?php if(is_array($UserGrade)): $i = 0; $__LIST__ = $UserGrade;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n_v): $mod = ($i % 2 );++$i;?>-->
                                            <!--<option <?php if($n_v['id'] == $list['grade_id']): ?>selected = selected<?php endif; ?> value="<?php echo ($n_v["id"]); ?>"><?php echo ($n_v["name"]); ?></option>-->
                                        <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->

                                    <!--</select>-->
                                <!--</div>  <div style="clear: both;"></div>-->
                            <!--</div>-->
                        <div class="form-group">
                            <label class="tar col-sm-3 control-label no-padding-right" for="form-field-1">产品简介</label>

                            <div class="col-sm-9">
                                <textarea style="padding:5px;" class="col-xs-10 col-sm-5" id="intro"  name="intro" rows="3"> <?php echo ($list["intro"]); ?></textarea>

                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style=" text-align: right;">产品分类</label>

                            <div class="col-sm-9">
                                <select name="news_class">
                                    <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n_v): $mod = ($i % 2 );++$i;?><option <?php if($n_v['id'] == $list['class']): ?>selected = selected<?php endif; ?> value="<?php echo ($n_v["id"]); ?>"><?php echo ($n_v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                                </select>
                            </div>  <div style="clear: both;"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style=" text-align: right;">产品封面</label>
                            <div class="col-sm-7" >
                                <div style="float: left;width:200px;margin:0 10px 10px 0;">
                                    <img src="<?php echo ($list["main_img"]); ?>" id="img01"   width="200" height="150"><br>
                                    <input type="hidden" name="file011" id="file011" <?php if($list["main_img"] != '' ): ?>value="0"<?php else: ?>value="1"<?php endif; ?> />
                                    <input type="file" name="file01" id="file01" multiple="multiple" style="border:none"/>
                                </div>
                                <script>
                                    $("#file01").change(function(){
                                        var objUrl = getObjectURL(this.files[0]) ;
                                        console.log("objUrl = "+objUrl) ;
                                        if (objUrl) {
                                            $("#file011").attr('value','2');
                                            $("#img01").attr("src", objUrl) ;
                                        }
                                    }) ;
                                    //建立一個可存取到該file的url
                                    function getObjectURL(file) {
                                        var url = null ;
                                        if (window.createObjectURL!=undefined) { // basic
                                            url = window.createObjectURL(file) ;
                                        } else if (window.URL!=undefined) { // mozilla(firefox)
                                            url = window.URL.createObjectURL(file) ;
                                        } else if (window.webkitURL!=undefined) { // webkit or chrome
                                            url = window.webkitURL.createObjectURL(file) ;
                                        }
                                        return url ;
                                    }
                                </script>
                                <!--<input class="input-5" name="input0" value="" type="file" multiple class="file-loading">
                                <p style="color:red;">最多可上传1张图片，文件格式为"jpg", "png", "gif"</p>
                                <script>

                                    $(document).on('ready', function() {
                                        $(".input-5").fileinput({
                                            initialPreview: [
                                                "<img src='<?php echo ($list["main_img"]); ?>' class='file-preview-image' />",

                                            ],
                                            language: "zh",
                                            showCaption: false,
                                            showUpload: false
                                        });
                                    });

                                </script>-->
                            </div>


                        </div><?php endif; ?>
                        <?php if($list["id"] != ''): ?><div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style=" text-align: right;">产品图片</label>
                            <div class="col-sm-7" >
                                <input id="input-dim-1" name="file" type="file" multiple class="file-loading" accept="image/*">
                                <p style="color:red;">可上传多张图片，文件格式为"jpg", "png", "gif"</p>
                                <script>
                                    var id = $("#id").val();

                                    $("#input-dim-1").fileinput({

                                        uploadUrl: "imgUpload?pid="+id,
                                        maxFileCount: false,
                                        language: "zh",
                                        showRemove: false,
                                        validateInitialCount: true,
                                        overwriteInitial: false,
                                        initialPreview: [
                                        <?php if(is_array($pic)): $i = 0; $__LIST__ = $pic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic_v): $mod = ($i % 2 );++$i;?>"<img class='a' data-img='<?php echo ($pic_v["id"]); ?>' style='height:160px' src='<?php echo ($pic_v["url"]); ?>'>",<?php endforeach; endif; else: echo "" ;endif; ?>

                                        ],
                                        initialPreviewConfig: [
                                        <?php if(is_array($pic)): $i = 0; $__LIST__ = $pic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic_v): $mod = ($i % 2 );++$i;?>{caption: "", width: "", url: "imgDel?pid=<?php echo ($pic_v["id"]); ?>", id: <?php echo ($pic_v["id"]); ?>},<?php endforeach; endif; else: echo "" ;endif; ?>

                                        ],
                                        allowedFileExtensions: ["jpg", "png", "gif"]
                                    });
                                </script>
                                <!--

                                        initialPreview: [
                                            "<?php if(is_array($pic)): $i = 0; $__LIST__ = $pic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic_v): $mod = ($i % 2 );++$i;?><img src='<?php echo ($pic_v["url"]); ?>' class='file-preview-image' /><?php endforeach; endif; else: echo "" ;endif; ?>",

                                        ],
                                -->
                               <style>
    .file-drop-zone {
        border: 1px dashed #aaa;
        border-radius: 4px;
     height:inherit;
        text-align: center;
        vertical-align: middle;
        margin: 12px 15px 12px 12px;
        padding: 5px;
    }
</style>
  </div>  <div style="clear: both;"></div>
  </div>
                            <?php else: ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style=" text-align: right;">产品图片</label>
                                <div class="col-sm-7" >
                                    产品添加完成后，请去产品相册管理
                                </div> <div style="clear: both;"></div>
                            </div><?php endif; ?>
                        <?php if($statu == 3): ?><div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style=" text-align: right;">内容</label>
                            <div class="col-sm-9"> <script type="text/javascript">
                                var editor = UE.getEditor('editor_notice',{
                                    initialFrameWidth : 760,
                                    initialFrameHeight : 460
                                });
                            </script>

						 <textarea id="editor_notice" name="editor_notice">
						 <?php echo ($list["text"]); ?>
						 </textarea>
                            </div>   <div style="clear: both;"></div> </div>
                        <div class="form-group">
                            <label class="tar col-sm-3 control-label no-padding-right" for="form-field-1">排序</label>

                            <div class="col-sm-9">
                                <input  value="<?php echo ($list["sort"]); ?>" type="text" id="sort" placeholder="" name="sort" class="col-xs-10 col-sm-5" />
                                <p class="col-xs-10 col-sm-12" style="padding:0;color:#999;"><span style="color:#f00;">*</span>数字越小越靠前</p>
                            </div><div style="clear:both;"></div>
                        </div>



                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">

                                <?php if($list["id"] == '' ): ?><a class="sub_f btn btn-info" href="javascript:$('form').submit()" name="on"><i class="icon-ok bigger-110" ></i>提交</a>
                                    <?php else: ?>
                                    <a class="sub_f btn btn-info" href="javascript:$('form').submit()" name="on"><i class="icon-ok bigger-110" ></i>修改</a><?php endif; ?>


                                <?php if($list["id"] == '' ): ?>&nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="icon-undo bigger-110"></i>
                                        重置
                                    </button><?php endif; ?>
                            </div><div style="clear:both;"></div>
                        </div><?php endif; ?>
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



<!-- <![endif]-->

<!--[if IE]>

</body>
</html>