<?php
session_start();

include('./db_connect.php');

// Redirect if already logged in
if(isset($_SESSION['login_id'])){
	header("location:index.php?page=home");
	exit;
}

// Fetch system settings
$settings = $conn->query("SELECT * FROM system_settings LIMIT 1");

if($settings->num_rows > 0){
	$row = $settings->fetch_assoc();

	foreach($row as $key => $value){
		$_SESSION['setting_'.$key] = $value;
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0, viewport-fit=cover" name="viewport">

	<title>Admin Login | Online Food Ordering System</title>

	<?php include('./header.php'); ?>

	<!-- Font Awesome -->
	<link rel="stylesheet"
		  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap"
		  rel="stylesheet">

<style>

/* ================= PREMIUM LOGIN DESIGN ================= */

:root{
	--primary:#ff6b35;
	--primary-dark:#e85d2c;
	--primary-light:#ff8a5c;
	--primary-glow:rgba(255,107,53,.35);

	--text-dark:#1a1a2e;
	--text-muted:#64748b;

	--shadow-xl:0 25px 50px rgba(0,0,0,.2);

	--transition:all .35s ease;
}

*{
	margin:0;
	padding:0;
	box-sizing:border-box;
}

body{
	width:100%;
	height:100vh;
	overflow:hidden;
	font-family:'Inter',sans-serif;
	background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
}

/* Animated background */
body::before{
	content:'';
	position:fixed;
	inset:0;
	background:
		radial-gradient(circle at 20% 80%, rgba(255,255,255,.08), transparent 40%),
		radial-gradient(circle at 80% 20%, rgba(255,255,255,.08), transparent 40%);
	z-index:0;
}

main#main{
	width:100%;
	height:100vh;
	display:flex;
	position:relative;
	z-index:1;
}

/* LEFT SIDE */
#login-left{
	flex:1.2;
	position:relative;
	background:url('./../assets/img/<?php echo $_SESSION['setting_cover_img']; ?>') center center/cover no-repeat;
	display:flex;
	align-items:center;
	justify-content:center;
	overflow:hidden;
}

#login-left::before{
	content:'';
	position:absolute;
	inset:0;
	background:linear-gradient(135deg,rgba(0,0,0,.8),rgba(0,0,0,.5));
	backdrop-filter:blur(2px);
}

.brand-container{
	position:relative;
	z-index:2;
	text-align:center;
	padding:2rem;
	max-width:85%;
	animation:fadeUp 1s ease;
}

.logo-wrapper{
	width:120px;
	height:120px;
	border-radius:50%;
	margin:auto;
	margin-bottom:1.5rem;

	display:flex;
	align-items:center;
	justify-content:center;

	background:rgba(255,255,255,.15);
	backdrop-filter:blur(15px);

	border:1px solid rgba(255,255,255,.2);

	box-shadow:0 0 30px rgba(255,255,255,.15);
}

.logo-wrapper i{
	font-size:3rem;
	color:#ffb347;
}

#login-left h1{
	font-family:'Playfair Display',serif;
	font-size:4rem;
	font-weight:800;
	color:#fff;
	margin-bottom:1rem;
	text-shadow:0 8px 25px rgba(0,0,0,.4);
}

.tagline{
	display:inline-flex;
	align-items:center;
	gap:10px;

	padding:12px 22px;

	border-radius:50px;

	background:rgba(255,255,255,.12);

	color:#fff;

	font-size:.95rem;
	font-weight:600;

	backdrop-filter:blur(12px);
}

/* RIGHT SIDE */
#login-right{
	flex:.9;

	display:flex;
	align-items:center;
	justify-content:center;

	background:linear-gradient(135deg,#ffffff 0%,#fff7f2 100%);
}

.login-card{
	width:90%;
	max-width:430px;
}

.card-body{
	padding:2.5rem;
	border-radius:38px;

	background:#fff;

	box-shadow:var(--shadow-xl);

	transition:var(--transition);
}

.card-body:hover{
	transform:translateY(-4px);
}

/* HEADER */
.login-header{
	text-align:center;
	margin-bottom:2rem;
}

.brand-icon{
	width:80px;
	height:80px;
	margin:auto;
	margin-bottom:1rem;

	border-radius:50%;

	display:flex;
	align-items:center;
	justify-content:center;

	background:linear-gradient(135deg,#ff6b35,#f5576c);

	box-shadow:0 10px 25px rgba(255,107,53,.35);
}

.brand-icon i{
	color:#fff;
	font-size:2rem;
}

.login-header h3{
	font-size:2rem;
	font-weight:800;
	color:var(--text-dark);
	margin-bottom:.4rem;
}

.login-header p{
	color:var(--text-muted);
	font-size:.95rem;
}

/* FORM */
.form-group{
	margin-bottom:1.4rem;
	position:relative;
}

.form-group i{
	position:absolute;
	left:18px;
	top:50%;
	transform:translateY(-50%);
	color:#94a3b8;
	font-size:1rem;
}

.form-control{
	width:100%;
	padding:15px 18px 15px 50px;

	border:2px solid #e2e8f0;
	border-radius:28px;

	font-size:.95rem;
	font-weight:500;

	transition:var(--transition);
}

.form-control:focus{
	border-color:var(--primary);
	box-shadow:0 0 0 4px var(--primary-glow);
	outline:none;
}

/* BUTTON */
.btn-login{
	width:100%;

	border:none;
	border-radius:40px;

	padding:14px 22px;

	font-size:1rem;
	font-weight:700;

	color:#fff;

	background:linear-gradient(135deg,#ff6b35,#f5576c);

	box-shadow:0 10px 25px rgba(255,107,53,.35);

	transition:var(--transition);

	cursor:pointer;
}

.btn-login:hover{
	transform:translateY(-2px);
	box-shadow:0 15px 30px rgba(255,107,53,.45);
}

/* BACK LINK */
.back-link{
	text-align:center;
	margin-top:1.5rem;
}

.back-link a{
	text-decoration:none;
	color:var(--primary);
	font-weight:600;
	font-size:.92rem;
}

/* ALERT */
.alert-custom{
	background:#ffe5e5;
	border-left:5px solid #ff4d4f;
	color:#b42318;

	padding:14px 18px;

	border-radius:18px;

	font-size:.9rem;
	font-weight:600;

	margin-bottom:1rem;
}

/* ANIMATION */
@keyframes fadeUp{
	from{
		opacity:0;
		transform:translateY(30px);
	}
	to{
		opacity:1;
		transform:translateY(0);
	}
}

/* MOBILE */
@media(max-width:768px){

	main#main{
		flex-direction:column;
	}

	#login-left{
		min-height:35vh;
	}

	#login-left h1{
		font-size:2rem;
	}

	.card-body{
		padding:2rem;
		border-radius:28px;
	}
}

</style>

</head>

<body>

<main id="main">

	<!-- LEFT -->
	<div id="login-left">

		<div class="brand-container">

			<div class="logo-wrapper">
				<i class="fas fa-pizza-slice"></i>
			</div>

			<h1>
				<?php echo $_SESSION['setting_name']; ?>
			</h1>

			<div class="tagline">
				<i class="fas fa-shield-alt"></i>
				Admin Dashboard
			</div>

		</div>

	</div>

	<!-- RIGHT -->
	<div id="login-right">

		<div class="login-card">

			<div class="card-body">

				<div class="login-header">

					<div class="brand-icon">
						<i class="fas fa-user-shield"></i>
					</div>

					<h3>Secure Access</h3>

					<p>Enter your credentials to continue</p>

				</div>

				<form id="login-form">

					<div id="alert-placeholder"></div>

					<div class="form-group">
						<i class="fas fa-user"></i>

						<input type="text"
							   class="form-control"
							   name="username"
							   placeholder="Username"
							   required>
					</div>

					<div class="form-group">
						<i class="fas fa-lock"></i>

						<input type="password"
							   class="form-control"
							   name="password"
							   placeholder="Password"
							   required>
					</div>

					<button type="submit" class="btn-login" id="loginBtn">
						<i class="fas fa-arrow-right-to-bracket"></i>
						Sign In
					</button>

					<div class="back-link">
						<a href="./../">
							<i class="fas fa-arrow-left"></i>
							Return to Website
						</a>
					</div>

				</form>

			</div>

		</div>

	</div>

</main>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$('#login-form').submit(function(e){

	e.preventDefault();

	let btn = $('#loginBtn');

	let original = btn.html();

	btn.prop('disabled',true);
	btn.html('<i class="fas fa-spinner fa-spin"></i> Authenticating...');

	$('#alert-placeholder').html('');

	$.ajax({

		url:'ajax.php?action=login',
		method:'POST',
		data:$(this).serialize(),

		error:function(err){

			console.log(err);

			$('#alert-placeholder').html(`
				<div class="alert-custom">
					Connection error. Please try again.
				</div>
			`);

			btn.prop('disabled',false);
			btn.html(original);
		},

		success:function(resp){

			if(resp == 1){

				btn.html('<i class="fas fa-check-circle"></i> Success');

				setTimeout(function(){

					location.href='index.php?page=home';

				},700);

			}else{

				$('#alert-placeholder').html(`
					<div class="alert-custom">
						Invalid username or password.
					</div>
				`);

				btn.prop('disabled',false);
				btn.html(original);
			}
		}
	});
});

</script>

</body>
</html>