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
	<title><?php echo $title; ?></title>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#">To-Do List</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Аккаунт</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				          <!-- <a class="dropdown-item" id="changeUserBtn" href="#">Сменить пользователя</a> -->
				          <a class="dropdown-item" id="logoutBtn" href="#">Выход</a>
				        </div>
			      </li>		
				</ul>
			</div>	
		</div>
	</nav>


	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register">
	  Запустить модальное окно
	</button>

	<!-- Account Modal -->
	<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Войдите или зарегистрируйтесь</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
			    	<div class="container-fluid">
					  	<div class="nav nav-tabs" id="nav-tab-select" role="tablist">
					    	<a class="nav-item nav-link active" id="nav-login-tab" data-toggle="tab" href="#nav-login" role="tab" aria-controls="nav-login" aria-selected="true">Войти</a>
					    	<a class="nav-item nav-link" id="nav-register-tab" data-toggle="tab" href="#nav-register" role="tab" aria-controls="nav-register" aria-selected="false">Зарегистрироваться</a>
					  	</div>
						<div class="tab-content" id="nav-tabContent">
					  		<div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">
					  			<form class="sign-in">
								  <div class="form-group">
								    <label for="loginEmailInput">Email</label>
								    <input type="text" class="form-control" id="loginEmailInput" name="email" placeholder="Email">
								  </div>
								  <div class="form-group">
								    <label for="loginPasswordInput">Пароль</label>
    								<input type="password" class="form-control" id="loginPasswordInput" name="password" autocomplete="password" placeholder="Пароль">
								  </div>
								  <input class="btn btn-primary" type="submit" name="" disabled>
								</form>		
					  		</div>
					  		<div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
					  			<form class="sign-up" method="POST">
								  <div class="form-group">
								    <label for="registerNameInput">Имя</label>
								    <input type="text" class="form-control" id="registerNameInput" name="name" placeholder="Имя" data-valid>
								    <div class="feedback" id="feedback"></div>
								  </div>
								  <div class="form-group">
								    <label for="registerNameInput">Фамилия</label>
								    <input type="text" class="form-control" id="registerSurnameInput" name="surname" placeholder="Фамилия" data-valid>
								    <div class="feedback" id="feedback"></div>
								  </div>
								  <div class="form-group">
								    <label for="registerEmailInput">Email</label>
							      	<input type="email" class="form-control" id="registerEmailInput" placeholder="Email" name="email" data-valid>
							      	<div class="feedback" id="feedback"></div>
								  </div>
								  <div class="form-group">
								    <label for="registerPasswordInput">Пароль</label>
    								<input type="password" class="form-control" id="registerPasswordInput" name="password" autocomplete="password" placeholder="Пароль" data-valid>
    								<div class="feedback" id="feedback"></div>
								  </div>
								  <div class="form-group">
								    <label for="registerConfirmPasswordInput">Повторите пароль</label>
    								<input type="password" class="form-control" id="registerConfirmPasswordInput" name="confirm" autocomplete="password" placeholder="Повторите пароль" data-valid>
    								<div class="feedback" id="feedback"></div>
								  </div>
								  <div class="alert alert-danger" role="alert"></div>
								  <input class="btn btn-primary" type="submit" name="button" disabled>
								</form>
					  		</div>
						</div>				    	
				    </div>
				</div>
				<!-- <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-primary">Принять</button>
				</div> -->
			</div>
		</div>
	</div>

<!-- Delete Modal -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Удалить задание</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Вы действительно хотите удалить задание?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Отмена</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteAction">Удалить</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- MAIN -->
	<main>
		<div class="container">
			<div>
			  <div class="nav nav-tabs" id="nav-tab-main" role="tablist">
			    <a class="nav-item nav-link active" id="nav-userTasks-tab" data-toggle="tab" href="#nav-userTasks" role="tab" aria-controls="nav-userTasks" aria-selected="true">Все задания</a>
			    <a class="nav-item nav-link" id="nav-myTasks-tab" data-toggle="tab" href="#nav-myTasks" role="tab" aria-controls="nav-myTasks" aria-selected="false">Полученные</a>
			    <a class="nav-item nav-link" id="nav-addedTask-tab" data-toggle="tab" href="#nav-addedTasks" role="tab" aria-controls="nav-addedTask" aria-selected="false">Добавленные</a>
			    <a class="nav-item nav-link" id="nav-addTask-tab" data-toggle="tab" href="#nav-addTask" role="tab" aria-controls="nav-addTask" aria-selected="false">Новое</a>
			  </div>
			</div>
			<div class="tab-content" id="nav-tabContent">
			  <div class="tab-pane fade show active" id="nav-userTasks" role="tabpanel" aria-labelledby="nav-userTasks-tab">
			  	
			  	<div class="task hidden">
			  		<div class="row task-header">
			  			<div class="col-md-auto">
			  				<div class="assigned-user">
			  					<span class="task-marker">кому:</span>
			  					<span class="task-name">Онотоле</span>
			  					<span class="task-surname">Кончаловских</span>	
			  				</div>
							<select class="custom-select" id="task-edit-assigned">
								<option selected disabled>ответственный</option>   
							</select>
		  				</div>
			  			<div class="col-md-auto">
			  				<span class="task-marker">от:</span>
			  				<span class="task-name">Фёдора</span>
			  				<span class="task-surname">Достаевского</span>	
			  			</div>
			  			<div class="col-md-auto">
			  				<span class="task-marker">статус:</span>
				  			<span class="text-info">Ожидает</span>
				  			<div class="task-status"><i class="far fa-clock"></i></div>
				  			<!-- <div class="task-status hide"><i class="fas fa-hammer"></i></div>
				  			<div class="task-status hide"><i class="fas fa-check-square"></i></div>	 -->
			  			</div>
			  			<div class="delete">
			  				<button type="button" class="close" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
			  			</div>
			  		</div>
			  		<div class="row task-content">
			  			<div class="col-md-12">
				  			<div class="description">
				  				<span class="task-marker">описание:</span>
				  				<p class="task-description">
				  					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				  					tempor incididunt ut labore et dolore magna aliquLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				  					tempor incididunt ut labore et dolore magna aliquLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				  				</p>
				  				<textarea class="form-control" id="task-edit-description"></textarea>
				  			</div>
			  			</div>		  	
			  		</div>
			  		<div class="row task-footer">
			  			<div class="col-md-auto edit">
			  				<span class="task-marker">редактировать:</span>
							<div class="task-status" id="editBtn"><i class="fas fa-edit" data-toggle="tooltip" data-placement="bottom" title="Изменить задание"></i></div>  
			  			</div>
			  			<div class="col-md-auto change-status">
			  				<span class="task-marker">сменить статуc:</span>
							<div class="task-status"><i class="fas fa-bell" data-toggle="tooltip" data-placement="bottom" title="Изменить статуc"></i></div>  

			  			</div>
			  			<div class="col-md-auto">	
			  				<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
								<button type="button" class="btn btn-info">Отложить</button>
								<button type="button" class="btn btn-secondary">Приступить</button>
								<button type="button" class="btn btn-success">Завешить</button>
							</div>	
			  			</div>
			  			<div class="col text-right">
				  			<span class="task-marker">опубликовано: </span>
				  			<span class="task-time">13:43 15-12-2018</span>
			  			</div>			  	
			  		</div>	
			  	</div>
			  </div>
			  <div class="tab-pane fade" id="nav-myTasks" role="tabpanel" aria-labelledby="nav-myTasks-tab">Полученные</div>
			  <div class="tab-pane fade" id="nav-addedTasks" role="tabpanel" aria-labelledby="nav-addedTask-tab">Добавленные</div>		  
			  <div class="tab-pane fade" id="nav-addTask" role="tabpanel" aria-labelledby="nav-addTask-tab">
			  <h2>Создайте новое задание</h2>
			  <form class="add-task-form">
				  <div class="form-group">
				    <label for="usersSelect">Назначить ответственного</label>
				    <select class="form-control" id="usersSelect" name="login">
				    	<option disabled selected data-id="">Выберите пользователя</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Описание задания</label>
				    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
				  </div>
				  <div class="form-check">
				  	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
				  	<label class="form-check-label" for="defaultCheck1">Оставить задание за мной</label>	
				  </div>
				  <input class="btn btn-primary" type="submit" name="button">
				  <input type="hidden" name="userId">		
				</form>
			</div>
			</div>			
		</div>			
	</main>
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
<script src="/public/scripts/main.js"></script>
<script src="/public/scripts/server.js"></script>
<script src="/public/scripts/account.js"></script>
<script src="/public/scripts/templates.js"></script>
</body>
</html>	