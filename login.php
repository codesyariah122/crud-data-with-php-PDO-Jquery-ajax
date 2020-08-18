<?php require_once 'functions.php'; $dir='templates'; ?>


<?php layout($dir, 'header', '.php') ?>
	<div class="bg-image">
		<div class="container login-page">
			<div class="row justify-content-center">		
				<div class="col-8 col-md-4 mt-5" id="login">
	<!-- 				<h3 class="text-primary mt-2 mb-5 text-center">Login System</h3> -->

					<div class="row justify-content-center mt-2 mb-2">
						<img src="assets/img/stylistic2.png" class="img-rounded img-responsive" widht="200" height="150"/>
					</div>
					
						<input type="text" class="form-control mb-3 rounded-pill" id="user" name="user" placeholder="youremail@mail.com">
						
						<input type="password" class="form-control mb-5 rounded-pill" id="pass" name="pass" placeholder="your password">
						
						<button type="submit" id="signin" class="btn btn-primary btn-block rounded-pill">Submit</button>

						<small class="text-danger blockquote-footer">Belum punya akun silahkan daftar</small>
						<button id="signup" class="btn btn-success btn-block rounded-pill">Signup</button>
				</div>
			</div>
		</div>
	</div>

<?php layout($dir, 'footer', '.php') ?>