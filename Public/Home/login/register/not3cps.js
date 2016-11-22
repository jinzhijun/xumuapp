
function CloseWebPage() {  
  if (navigator.userAgent.indexOf("MSIE") > 0) {  
                if (navigator.userAgent.indexOf("MSIE 6.0") > 0) {  
                    window.opener = null; window.close();  
                }  
                else {  
                    window.open('', '_top'); window.top.close();  
                }  
            }  
            else if (navigator.userAgent.indexOf("Firefox") > 0) {  
                window.location.href = 'about:blank '; //火狐默认状态非window.open的页面window.close是无效的 
                //window.history.go(-2);  
            }  
            else {  
                window.opener = null;   
                window.open('', '_self', '');  
                window.close();  
  }  
}  


function notde(words)
{
Words=Words.replace(/\|/g,"%")
NewWords = unescape(Words);
document.write(NewWords);
}

//写cookie
function setCookie(name,value,expires){
var exp=new Date();
exp.setTime(exp.getTime()+expires*24*60*60*1000); //天
document.cookie=name+"="+escape(value)+";expires="+exp.toGMTString();//+";domain=.com;path=/";
} 

//读取cookie
function readcookie(name){
var oRegex=new RegExp(name+'=([^;]+)','i');
var oMatch=oRegex.exec(document.cookie);
if(oMatch&&oMatch.length>1)return unescape(oMatch[1]);
else return '0000';
}

//获取url中"?"符后的字串
function GetRequest() {
   var url = location.search; //获取url中"?"符后的字串
   var theRequest = new Object();
   if (url.indexOf("?") != -1) {
      var str = url.substr(1);
      strs = str.split("&");
      for(var i = 0; i < strs.length; i ++) {
         theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
      }
   }
   return theRequest;
}

function getfrom() {
var Request = new Object();
Request = GetRequest();
var u,w;
u = Request['u'];
w = Request['w'];

  if (u != null && u != "") {
     //setCookie("u",u,7)
     document.write("<input type=hidden name=userid value='"+u+"'>");
  }
  
  if (w != null && w != "") {
     //setCookie("u",u,7)
     document.write("<input type=hidden name=userwx value='"+w+"'>");
  }
  
var myDate = new Date();
myDate.getYear();       //获取当前年份(2位)
myDate.getFullYear();   //获取完整的年份(4位,1970-????)
myDate.getMonth();      //获取当前月份(0-11,0代表1月)
myDate.getDate();       //获取当前日(1-31)
myDate.getDay();        //获取当前星期X(0-6,0代表星期天)
myDate.getTime();       //获取当前时间(从1970.1.1开始的毫秒数)
myDate.getHours();      //获取当前小时数(0-23)
myDate.getMinutes();    //获取当前分钟数(0-59)
myDate.getSeconds();    //获取当前秒数(0-59)
var truedate = myDate.getMonth()+1;
var not3num=""; 
for(var i=0;i<3;i++) 
{ 
not3num+=Math.floor(Math.random()*10); 
}

document.form.orderid.value=''+myDate.getFullYear()+truedate+myDate.getDate()+myDate.getHours()+myDate.getMinutes()+myDate.getSeconds()+not3num;

}

var Request = new Object();
Request = GetRequest();
var uu,ww;
uu = Request['u'];
ww = Request['w'];

  if (uu != null && uu != "") {
     setCookie("uu",uu,7)
  }else{
  uu=readcookie("uu")
  }
  
  if (ww != null && ww != "") {
     setCookie("ww",ww,7)
  }else{
  ww=readcookie("ww")
  }