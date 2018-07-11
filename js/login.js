const onClickLogin = function () {
	const email = $('#email').val();
	const password = $('#password').val();

	if(!email || !password) {
		alert('Email or password can not be empty');
	}
	else {
		$.post('loginService.php', { email, password }, function (data, status) {
			window.location = 'home.php';
		})
		.fail(function (error) {
			alert(error.responseJSON.errorMessage);
		});
	}
}

$('#loginButton').click(onClickLogin);
