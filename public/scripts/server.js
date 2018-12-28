'use strict';

//*****РЕГИСТРАЦИЯ*****
function registerAction(event) {
  event.preventDefault();
  if (!acceptValidation) return;
  const sendData = {};
  const dataForm = new FormData(signUpForm);
  for (const [key, value] of dataForm) {
    sendData[key] = value;
  }
  const request = fetch('/account/register', {
  body: JSON.stringify(sendData),
  credentials: 'same-origin',
  method: 'POST',
  headers: {'Content-Type': 'application/json'}
  })
    .then((res) => {
      if (200 <= res.status && res.status < 300) {
        return res;
      }
      throw new Error(res.statusText);
    })
    .then((res) => res.json())
    .then((data) => { 
      if (data.error) {
        event.target.getElementsByClassName('error-message')[0].textContent = data.message;  
      } else {
        // event.target.getElementsByClassName('error-message')[0].textContent = event.target.classList.contains('sign-in-htm') ?
        //   `Пользователь ${data.name} успешно авторизован` : `Пользователь ${data.name} успешно зарегистрирован`;
        console.log(data);
        localStorage.userID = data.message.id;
    	  localStorage.userEmail = data.message.email;
		    document.location.href="/";
      }
      
     })
    .catch((error) => {  
      event.target.getElementsByClassName('alert-danger')[0].textContent = `Ошибка ${error}`;     
    });
}
signUpForm.addEventListener('submit', registerAction);

//*****АУТЕНТИФИКАЦИЯ*****
function checkFields(event) {
	const reg = /^[\s]+$/;
	//event.target.value = event.target.value.replace(reg, '');
	if (Array.from(signInForm.querySelectorAll('input.form-control')).some(input => input.value === '')) {
		submitAuthBtn.disabled = true;				
	} else {
		submitAuthBtn.disabled = false;	
	}
}
signInForm.addEventListener('input', checkFields);

function loginAction(event) {
	event.preventDefault();
 	const sendData = {};
 	const dataForm = new FormData(signInForm);
  	for (const [key, value] of dataForm) {
    	sendData[key] = value;
  	}
  	const request = fetch('/account/login', {
 		body: JSON.stringify(sendData),
  		credentials: 'same-origin',
  		method: 'POST',
 		headers: {'Content-Type': 'application/json'}
  	})
    .then((res) => {
      if (200 <= res.status && res.status < 300) {
        return res;
      }
      throw new Error(res.statusText);
    })
    .then((res) => res.json())
    .then((data) => { 
    if (data.error) {
        event.target.getElementsByClassName('error-message')[0].textContent = data.message;  
      } else {
        // event.target.getElementsByClassName('error-message')[0].textContent = event.target.classList.contains('sign-in-htm') ?
        //   `Пользователь ${data.name} успешно авторизован` : `Пользователь ${data.name} успешно зарегистрирован`;
        console.log(data);
        if (data.status === 'success') {
          localStorage.userID = data.message.id;
          localStorage.userEmail = data.message.email;
			    document.location.href="/";       	
        }
      }
      
     })
    .catch((error) => {
    	console.log(error);  
      //event.target.getElementsByClassName('alert-danger')[0].textContent = `Ошибка ${error}`;     
    });
}		
signInForm.addEventListener('submit', loginAction);

//*****LOGOUT*****
function logoutAction() {
	const request = fetch('/account/logout', {
  	method: 'GET',
  })
    .then(() => document.location.href="/");	
}

//*****USERS*****
function getUsers(parentNode) {
	const request = fetch('/account/users', {
  	method: 'GET',
  })
    .then((res) => {
      if (200 <= res.status && res.status < 300) {
        return res;
      }
    })
    .then((res) => res.json())
    .then(data => renderUsers(data.message, parentNode));
}
//*****ADD TASK*****
function addTask(event) {
  event.preventDefault();
	if (!selectUser(event)) return;
	if (!(/[^\s]/.test(addTaskForm.description.value))) return;
		const sendData = {};
	 	const dataForm = new FormData(addTaskForm);
	  	for (const [key, value] of dataForm) {
	    	sendData[key] = value;
	  	}	
	  	const request = fetch('/task/add', {
	 		body: JSON.stringify(sendData),
	  		credentials: 'same-origin',
	  		method: 'POST',
	 		headers: {'Content-Type': 'application/json'}
	  	})
	    .catch(error => console.log(error));		
	
	addTaskForm.description.value = '';
	addTaskForm.login.options[0].selected = true;			
}
addTaskForm.addEventListener('submit', addTask);

//*****ALL TASKS*****
function getAllTasks() {
  const request = fetch('/task/all', {
    method: 'GET',
  })
    .then((res) => {
      if (200 <= res.status && res.status < 300) {
        return res;
      }
    })
    .then((res) => res.json())
    .then(data => renderTasks(data.message, allTasksTab, 'all'))
    .catch(error => console.log(error));  
}

//*****OWN TASKS*****
function getMyTasks() {
  const request = fetch('/task/my', {
    method: 'GET',
  })
    .then((res) => {
      if (200 <= res.status && res.status < 300) {
        return res;
      }
    })
    .then((res) => res.json())
    //.then(data => console.log(data))
    .then(data => renderTasks(data.message, myTasksTab, 'received'))
    .catch(error => console.log(error));  
}

//*****ADDED TASKS*****
function getAddedTasks() {
  const request = fetch('/task/added', {
    method: 'GET',
  })
    .then((res) => {
      if (200 <= res.status && res.status < 300) {
        return res;
      }
    })
    .then((res) => res.json())
    .then(data => renderTasks(data.message, addedTasksTab, 'added'))
    .catch(error => console.log(error));  
}
//*****EDIT TASK*****
function updateTask(obj) {
  const request = fetch(`/task/edit/${obj.id}`, {
    body: JSON.stringify(obj),
    credentials: 'same-origin',
    method: 'PUT',
    headers: {'Content-Type': 'application/json'}
  })
  .then((res) => {
      if (200 <= res.status && res.status < 300) {
        if (appState === 'added') {
          getAddedTasks();     
        } else if (appState === 'my') {
          getMyTasks();  
        }
      }
    })
    //.then((res) => res.json())
    //.then(data => console.log(data))
    .catch(error => console.log(error));
}
//*****DELETE TASK*****
function deleteTaskAction(id) {
  const request = fetch(`/task/delete/${id}`, {
    credentials: 'same-origin',
    method: 'DELETE'
  })
  .then(res => {
      if (200 <= res.status && res.status < 300) {
        getAddedTasks();
      }
    })
  .catch(error => console.log(error));   
}
//*****CONFIRM ACCOUNT*****
