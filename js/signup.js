const onClickSignup = function () {
	const name = $('#name').val();
	const email = $('#email').val();
	const password = $('#password').val();
	const confirmation = $('#confirmation').val();

	//validation

	if(password !== confirmation) {
		alert('password and confirm password do not match');
	}

	else {
		$.post('registeruser.php', { name, email, password }, function () {
			//registration successful
			window.location = 'home.php';
		})
		.fail(function (error) {
			alert(error.responseJSON.errorMessage);
		});
	}
}

$("#signupButton").click(onClickSignup);
