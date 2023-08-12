$(document).ready(function(){
	$(".form-darius .rgstr-btn button").click(function(){
		$('.form-darius .wrapper').addClass('move');
		// $('.form-d').css('background','#e0b722');
		$(".form-darius .login-btn button").removeClass('active');
		$(this).addClass('active');

	});
	$(".form-darius .login-btn button").click(function(){
		$('.form-darius .wrapper').removeClass('move');
		// $('.body').css('background','#ff4931');
		$(".form-darius .rgstr-btn button").removeClass('active');
		$(this).addClass('active');
	});
});