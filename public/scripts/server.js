'use strict';
//*****ACCOUNT*****

//registrtation
function registerAction() {
  if (localStorage.userID) return;
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
      preloader.classList.toggle('hidden');
      signUpForm.classList.toggle('hidden');
      signInForm.classList.toggle('hidden'); 
      if (data.status === 'error') {
        document.querySelector(".sign-up .alert").classList.remove('hidden');
        document.querySelector(".sign-up .alert").textContent = data.message;
      } else {
        $('#register').modal('hide');
        $('#confirmMsg').modal('show');
      }  
     })
    .catch(error => console.log(error));
}

//auth
function loginAction() {
  if (localStorage.userID) return;
  if (!acceptValidation) return;
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
      preloader.classList.toggle('hidden');
      signUpForm.classList.toggle('hidden');
      signInForm.classList.toggle('hidden'); 
      if (data.status === 'error') {
          document.querySelector(".sign-in .alert").classList.remove('hidden');
          document.querySelector(".sign-in .alert").textContent = data.message;
      } else {
          document.location.href = "/";      	
      }
    })
    .catch(error => console.log(error));
}		

//logout
function logoutAction() {
	const request = fetch('/account/logout', {
  	method: 'GET',
  })
    .then(() => document.location.href="/");	
}
//auth-user data
function getAuthUserData() {
  const request = fetch('account/user', {
    method: 'GET',
  })
    .then((res) => {
      if (200 <= res.status && res.status < 300) {
        return res;
      }
    })
    .then((res) => res.json())
    .then(data => {
      if (data.status !== 'success') return;
      localStorage.userID = data.message.id;
      localStorage.userEmail = data.message.email;
    })
    .then(() => navbarDropdown.textContent = localStorage.userEmail)
    .then(getTasks(appState))
    .catch(error => console.log(error)); 
}
//users
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

//*****TASKS*****

//add
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
	$('#addMsgModal').modal('show');
	addTaskForm.description.value = '';
	addTaskForm.login.options[0].selected = true;			
}
//get
function getTasks(state, page = 1) {
  document.querySelector('#before-load').classList.remove('hidden');
  const request = fetch(`/task/${state}/${page}`, {
    method: 'GET',
  })
    .then((res) => {
      if (200 <= res.status && res.status < 300) {
        return res;
      }
    })
    .then((res) => res.json())
    .then(data => {
      document.querySelector('#before-load').classList.add('hidden');
      renderTasks(data.message, currentTab, state);
      return data;
    })
    .then((data) => {
      pageCount = data.pageCount;
      getPages(data.pageCount);
    })
    .then(() => setNumber(page))
    .catch(error => console.log(error));   
}
//edit
function updateTask(obj) {
  const request = fetch(`/task/edit/${obj.id}`, {
    body: JSON.stringify(obj),
    credentials: 'same-origin',
    method: 'PUT',
    headers: {'Content-Type': 'application/json'}
  })
  .then(res => {
      if (200 <= res.status && res.status < 300) {
        return res;
      }
    })
  .then(res => res.json())
  .then(data => {
    console.log(data);
    if (currentPage > data.pageCount) {
      currentPage--;
    }
    getTasks(appState, currentPage);
  })
  .catch(error => console.log(error));
}
//delete
function deleteTaskAction(id) {
  const request = fetch(`/task/delete/${id}`, {
    credentials: 'same-origin',
    method: 'DELETE'
  })
  .then(res => {
      if (200 <= res.status && res.status < 300) {
        return res;
      }
    })
  .then(res => res.json())
  .then(data => {
    console.log(data);
    if (currentPage > data.pageCount) {
      currentPage--;
    }
    getTasks(appState, currentPage);
  })
  .catch(error => console.log(error));   
}

