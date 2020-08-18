$(document).ready(function(){
	if(location.href == "http://localhost/crudAjax/login.php"){
		$('body').css({
			'background-image' : 'url("assets/img/bg-2.jpg")',
			'background-attachment': 'fixed',
			'height': '100%',
			'background-position': 'center',
 			'background-repeat': 'no-repeat',
  			'background-size': 'cover',
		});
	}

	$('#signin').on('click', function(){
		let user = $('#user').val();
		let pass = $('#pass').val();

		if(user !== '' && pass !== ''){
			$.ajax({
				url: 'contents/loginProcess.php',
				method: 'post',
				data: 'user='+user+'&pass='+pass,
				success: function(dataLogin){
					if(dataLogin == 'Login Success'){
						Swal.fire(dataLogin);
						setTimeout(function(){
							document.location.href='index.php';
						}, 1500);
					}else if(dataLogin == 'Login Failed'){
						Swal.fire(dataLogin);
						setTimeout(function(){
							document.location.href='login.php';
						}, 1500);
					}
				}
			});
		}else{
			Swal.fire("Harap login terlebih dahulu dengan username anda")
		}
	})
});