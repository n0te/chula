//client side validation messages
var v_email_require = "กรุณาระบุ Email";
var v_email_format = "Email ไม่ถูกต้อง";
var v_password_require = "กรุณาระบุรหัสผ่าน";
var v_password_format = "รหัสผ่านต้องมีความยาวยาวน้อย 6 ตัวอักษร";
var v_password_confirm = "กรุณายืนยันรหัสผ่านให้ถูกต้อง"; 
var v_password_new_require = "กรุณาระบุรหัสผ่านใหม่";
var v_rejectmsg_require = "กรุณาระบุเหตุผลที่ไม่อนุญาติ";
//end client side validation messages

//clint side text
var profile_filedeleteconfirm = "ไฟล์นี้จะถูกลบอย่างถาวรเมื่อคุณกดตกลง";
var module_actionbtntext = "แก้ไข";
var module_againbtntext = "ขอใช้งานอีกครั้ง";
var module_requestbtntext = "ขอใช้งาน";
var module_adminapprovebtntext = "อนุญาต";
var module_adminrejectbtntext = "ไม่อนุญาต";
var memberlist_reviewbtntext = "<i class='fa fa-search'></i>";
//end client side text

//global ajax 
$(document).ajaxSend(function(event,jqxhr,settings){
	if(settings.type == 'POST' || settings.type == 'GET' && (settings.url.indexOf('/profile') != -1 || 
		settings.url.indexOf('/login') != -1 ||
		settings.url.indexOf('/register') != -1 ||
		settings.url.indexOf('/password/email') != -1 ||
		settings.url.indexOf('/changepassword') != -1 ||
		settings.url.indexOf('/reject') != -1 ||
		settings.url.indexOf('/approve') != -1 ||
		settings.url.indexOf('/getreviewmembers') != -1
		)){
		var form = $('form[action="'+settings.url+'"]');
		form.attr("sendingrequest",''); 
		var btn = form.find('button[type="submit"]');
		btn.data('content', btn.html());
		btn.html('');
		btn.html('<img src="/assets/global/img/ajax-loader-progress.gif"/>');
		btn.prop("disabled",true);
	}
}).ajaxComplete(function(){
	var form = $('form[sendingrequest]');
	var btn = form.find('button[type="submit"]');
	btn.html(btn.data('content'));
	form.removeAttr('sendingrequest');
	btn.prop("disabled",false);
});
//end global ajax

//global commom function
function WindowScrollTopAnimation(target, speed){
    $('body').animate({scrollTop:$(target).position().top+10}, speed);
}
//end global common function