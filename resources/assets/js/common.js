/*メッセージ*/
var msg_cancel = "Do you Want To Cancel ?";
var msg_register = "Do you Want To Register ?";
var msg_update = "Do you Want To Update ?";

/* メッセージを確認する */
function verifyMsg(page) {
    var msg = '';

    if (page == "Register") {
    	msg = msg_register;
    } else if(page == "Update") {
    	msg = msg_update;
    } else if(page == "Cancel") {
    	msg = msg_cancel;
    }

    return msg;
}

/* フォーム提出 */
function formSubmit(page){
	var alertmsg = verifyMsg(page);
	if(confirm(alertmsg)){
		$('form').submit();
	}
}

/* data-hrefで指定したページに戻る */
$(document).on('click',".page-return",function () {
// $(".page-return").click(function () {
	var alertmsg = verifyMsg($(this).data('act'));
	if(confirm(alertmsg)){
	  window.location.href = $(this).data('href');
	}
});