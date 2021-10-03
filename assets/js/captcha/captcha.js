
$(function() {

	$('#refresh-captcha').on('click', function(e) {
		$('img#captcha').attr("src", "/prenotazione/ctrl/captcha/newCaptcha.php?rnd=" + Math.random());
		$('#captcha_input').val('');
	});

});
