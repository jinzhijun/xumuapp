/**
 * 后台公共JS函数库
 *
 */

/*
 * 确认函数
 */
function confirmurl(url,message) {
  $.dialog({
    icon: 'question',
    content: message,
    ok: function () {
      $.ajax({
        url: url, // 表单提交的地址
        type: 'GET',
        dataType: 'json',
        success: function (data, textStatus) {
          // 成功提示框
          if(data.status){
            $.dialog({
              icon: 'succeed',
              content: data.info,
              lock:true,
              button:[
                {
                  name: '确定',
                  callback:function(){
                    window.location.reload();
                    return true;
                  },
                  focus: true
                }
              ]
            });
          }
          else {
            // 错误提示框
            $.dialog({
              icon: 'error',
              content: data.info,
              lock:true,
              ok:function(){
                return true;
              },
            });
          }
        },
        cache: false
      });
    },
    cancelVal: '取消',
    cancel: true
  });
}
/*
 * 确认函数
 * 确定和取消有回调函数
 * fn1:确定的回调函数
 * fn1_param:确定的回调函数参数
 * fn2:取消的回调函数
 * fn2_param:取消的回调函数参数
 */
function confirmurls(url,message,fn1,fn1_param,fn2,fn2_param) {
  $.dialog({
    icon: 'question',
    content: message,
    ok: function () {
      $.ajax({
        url: url, // 表单提交的地址
        type: 'get',
        dataType: 'json',
        data: '', // 表单提交的数据
        success: function (data) {
         if (data.re == 1) {
            art.dialog({
              icon: 'succeed',
              content: data.info,
              lock:true,
              width:180,
              height:70,
              button:[
                {
                  name: '确定',
                  callback:function(){
                    if (!fn1 || fn1 == ''){
                      return true;
                    }else{
                      fn1(fn1_param);
                    }
                  },
                  focus: true
                }
              ]
            });
          }
        },
        cache: false,
        cancel: true
      });
    },
    cancelVal: '取消',
    cancel: function(){
      if (!fn2 || fn2 == ''){
        return true;
      }else{
        fn2(fn2_param);
      }
    }
  });
}

/*
 * 跳转url
 */
function redirect(url) {
  location.href = url;
}

/*
 * 全选checkbox,注意：标识checkbox id固定为为check_box
 * @param string name 列表check名称,如 uid[]
 */
function selectall(name) {
  if ($("#check_box").attr("checked")=='checked') {
    $("input[name='"+name+"']").each(function() {
        $(this).attr("checked","checked");
      
    });
  } else {
    $("input[name='"+name+"']").each(function() {
        $(this).removeAttr("checked");
    });
  }
}
function openwinx(url,name,w,h) {
  if(!w) w=screen.width-4;
  if(!h) h=screen.height-95;
    window.open(url,name,"top=100,left=400,width=" + w + ",height=" + h + ",toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no");
}

/*
 * 表单提交时弹出确认消息,一般用户添加和编辑内容
 * 点击‘返回上一页’后，返回上一画面并刷新
 */
function submit_confirm(id,listurl,w,h){
  if(!w) w=180;
  if(!h) h=70;
  
  $.ajax({
    url: $("#"+id).attr('action'), // 表单提交的地址
    type: 'POST',
    dataType: 'json',
    data:$('#'+id).serialize(), // 表单提交的数据
    success: function (data, textStatus) {
      // 成功提示框
      if(data.status){
        art.dialog({
          icon: 'succeed',
          content: data.info,
          lock:true,
          width:w,
          height:h,
          button:[
            {
              name: '继续添加？',
              callback:function(){
                window.location.reload();
                return true;
              },
              focus: true
            },{
              name: '返回上一页',
              callback:function(){
                window.location.href=document.referrer;
                return true;
              }
            }
          ]
        });
      }
      else {
        // 错误提示框
        art.dialog({
          icon: 'error',
          content: data.info,
          lock:true,
          width:w,
          height:h,
          ok:function(){
            return true;
          },
        });
      }
    },
    cache: false
  });
}

/*
 * 弹出窗口的编辑页面保存按钮
 * 点击确定之后父窗口刷新
 */
function submit_confirm_dialog(id,listurl,w,h){
  if(!w) w=180;
  if(!h) h=70;
  
  $.ajax({
    url: $("#"+id).attr('action'), // 表单提交的地址
    type: 'POST',
    dataType: 'json',
    data:$('#'+id).serialize(), // 表单提交的数据
    success: function (data, textStatus) {
      // 成功提示框
      if(data.status){
        art.dialog({
          icon: 'succeed',
          content: data.info,
          lock:true,
          width:w,
          height:h,
          button:[
            {
              name: '确定',
              callback:function(){
                if (listurl && listurl != ''){
                  window.parent.main.location.href = listurl;
                 // parent.location.href = listurl;
                }
                return true;
              },
              focus: true
            }
          ]
        });
      }
      else {
        // 错误提示框
        art.dialog({
          icon: 'error',
          content: data.info,
          lock:true,
          width:w,
          height:h,
          ok:function(){
            return true;
          },
        });
      }
    },
    cache: false
  });
}

/*
 * 画面内容保存后提示消息,一般用户编辑内容
 */
function submit_save(id,errorurl,keywords,w,h){
  if(!w) w=180;
  if(!h) h=70;
  
  $.ajax({
    url: $("#"+id).attr('action'), // 表单提交的地址
    type: 'POST',
    dataType: 'json',
    data:$('#'+id).serialize(), // 表单提交的数据
    success: function (data, textStatus) {
      // 成功提示框
      if(data.status){
        art.dialog({
          icon: 'succeed',
          content: data.info,
          lock:true,
          width:w,
          height:h,
          button:[
            {
              name: '确定',
              callback:function(){
                window.location.reload();
                return true;
              },
              focus: true
            }
          ]
        });
      }
      else {
        // 错误提示框
        if (errorurl != null) {
          art.dialog({
            icon: 'error',
            content: data.info,
            lock:true,
            width:w,
            height:h,
            button:[{
              name: '确定',
              callback:function(){
                location = errorurl;
                return true;
              },
              focus: true
            }]
          });
        } else {
          art.dialog({
            icon: 'error',
            content: data.info,
            lock:true,
            width:w,
            height:h,
            ok:function(){
              return true;
            },
          });
        } 
      }
    },
    cache: false
  });
}

/*
 * 画面内容保存后提示消息,一般用户编辑内容
 */
function submit_console(id,errorurl,keywords,w,h){
  if(!w) w=180;
  if(!h) h=70;

  $.ajax({
    url: $("#"+id).attr('action'), // 表单提交的地址
    type: 'POST',
    dataType: 'json',
    data:$('#'+id).serialize(), // 表单提交的数据
    success: function (data, textStatus) {
      // 成功提示框
      if(data.status){
        art.dialog({
          icon: 'succeed',
          content: data.info,
          lock:true,
          width:w,
          height:h,
          button:[
            {
              name: '确定',
              callback:function(){
                window.location.href = data.url;
                return true;
              },
              focus: true
            }
          ]
        });
      }
      else {
        // 错误提示框
        if (data.url != null) {
          art.dialog({
            icon: 'error',
            content: data.info,
            lock:true,
            width:w,
            height:h,
            button:[{
              name: '确定',
              callback:function(){
                //window.location.href = data.url;
                return true;
              },
              focus: true
            }]
          });
        } else {
          art.dialog({
            icon: 'error',
            content: data.info,
            lock:true,
            width:w,
            height:h,
            ok:function(){
              return true;
            },
          });
        }
      }
    },
    cache: false
  });
}

/**
 * 更新数据时提交
 */
function submit_update(id,successurl,errorurl,w,h){
  if(!w) w=180;
  if(!h) h=70;
  
  $.ajax({
    url: $("#"+id).attr('action'), // 表单提交的地址
    type: 'POST',
    dataType: 'json',
    data:$('#'+id).serialize(), // 表单提交的数据
    success: function (data, textStatus) {
      // 成功提示框
      if(data.status){
        art.dialog({
          icon: 'succeed',
          content: data.info,
          lock:true,
          width:w,
          height:h,
          button:[
            {
              name: '确定',
              callback:function(){
                return true;
              },
              focus: true
            },{
              name: '返回上一页',
              callback:function(){
                window.location.href=document.referrer;
                return true;
              }
            }
          ]
        });
      }
      else {
        // 错误提示框
        if (errorurl != null) {
          art.dialog({
            icon: 'error',
            content: data.info,
            lock:true,
            width:w,
            height:h,
            button:[{
              name: '确定',
              callback:function(){
                location = errorurl;
                return true;
              },
              focus: true
            }]
          });
        } else {
          art.dialog({
            icon: 'error',
            content: data.info,
            lock:true,
            width:w,
            height:h,
            ok:function(){
              return true;
            },
          });
        } 
      }
    },
    cache: false
  });
}

//权限设置
function setting_access(turl,title,w,h) {
  if(!w) w=430;
  if(!h) h=400;
  $.dialog.open(turl,{title: title, width: w, height: h});
}

/**
 * 表单提交时弹出确认消息,一般用户添加和编辑内容
 */
function wx_autobind(id,listurl,w,h){
  if(!w) w=500;
  if(!h) h=350;
  
  $.ajax({
    url: $("#"+id).attr('action'), // 表单提交的地址
    type: 'POST',
    dataType: 'json',
    data:$('#'+id).serialize(), // 表单提交的数据
    success: function (data, textStatus) {
      // 成功提示框
      if(data.status){
        art.dialog({
          icon: 'succeed',
          content: data.info,
          lock:true,
          width:w,
          height:h,
          button:[
            {
              name: '确定',
              callback:function(){
              window.location.reload();
                return true;
              },
              focus: true
            }
          ]
        });
      }
      else {
        // 错误提示框
        art.dialog({
          icon: 'error',
          content: data.info,
          lock:true,
          width:w,
          height:h,
          ok:function(){
            return true;
          },
        });
      }
    },
    cache: false
  });
}

/**
 * checkbox选中和取消确认提示函数
 */
function checkbox_confirm(obj,id,uid,w,h){
  if(!w) w=180;
  if(!h) h=70;
  
  $.ajax({
    url: $("#"+id).attr('action'), // 表单提交的地址
    type: 'POST',
    dataType: 'json',
    data:$('#'+id).serialize(), // 表单提交的数据
    success: function (data, textStatus) {
      // 成功提示框
      if(data.status){
        art.dialog({
          icon: 'succeed',
          content: data.info,
          lock:true,
          width:w,
          height:h,
          button:[
            {
              name: '确定',
              callback:function(){
                window.location.reload();
                return true;
              },
              focus: true
            }
          ]
        });
      }
      else {
        // 错误提示框
        if (errorurl != null) {
          art.dialog({
            icon: 'error',
            content: data.info,
            lock:true,
            width:w,
            height:h,
            button:[{
              name: '确定',
              callback:function(){
                location = errorurl;
                return true;
              },
              focus: true
            }]
          });
        } else {
          art.dialog({
            icon: 'error',
            content: data.info,
            lock:true,
            width:w,
            height:h,
            ok:function(){
              return true;
            },
          });
        } 
      }
    },
    cache: false
  });
}

/*
 * 取消返回上一页
 */
function cancel_back(){
  window.location.href=document.referrer;
}
