<!doctype html>
<html lang="ru">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/public/css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Bowlby+One+SC|Chelsea+Market" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Hind" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
	<script src="/public/scripts/server.js"></script>
	<title><?php echo $title; ?></title>
</head>

<body>
<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="/">To-Do List</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Аккаунт</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				          <a class="dropdown-item" id="loginBtn" href="#">Войти</a>
				          <a class="dropdown-item" id="logoutBtn" href="#">Выйти</a>
				        </div>
			      </li>		
				</ul>
			</div>	
		</div>
    </nav>
	<div class="jumbotron">
	  <h1 class="display-4">To-Do List</h1>
	  <p class="lead">Приложение <span>To-Do List </span>всегда готово помочь вам</p>
	  <hr class="my-4">
	  <p class="lead">
	    <a class="btn btn-primary btn-lg" href="#" role="button" id="start">Приступить!</a>
	  </p>
	</div>	
</header>
    <?php echo $content; ?>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
 crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
 crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
 crossorigin="anonymous">
</script>
<script>$(document.body).tooltip({ selector: "[title]" });</script>
<!-- Optional JavaScript -->
<script src="/public/scripts/account.js"></script>
<!-- <script>
	document.addEventListener('DOMContentLoaded', function() {
	if (!localStorage.userID) {
		$('#register').modal('show');	
	}
});
</script> -->
</body>
</html>	