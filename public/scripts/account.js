'use strict';

//Выход из аккаунта
document.querySelector('#logoutBtn').addEventListener('click', event => {
	localStorage.clear();
	logoutAction();		
})
//Вход
document.querySelector('#start').addEventListener('click', (event) => {
	event.preventDefault();
	$('#register').modal('show');
});
document.querySelector('#loginBtn').addEventListener('click', (event) => {
	event.preventDefault();
	$('#register').modal('show');
});