'use strict';

//*****ИНИЦИАЛИЗАЦИЯ*****
//Состояния приложения
let appState = 'all';
//nav
const navbarDropdown = document.querySelector('#navbarDropdownMenuLink');
const dropdownMenu = document.querySelector('.dropdown-menu');

document.addEventListener('DOMContentLoaded', () => {
	document.querySelector('#start').classList.add('hidden');
	document.querySelector('.jumbotron').style.height = 'auto';
	document.querySelector('#loginBtn').classList.add('hidden');
	if (localStorage.userID) {
		navbarDropdown.textContent = localStorage.userEmail;
		getTasks(appState); 	
	} else {
		getAuthUserData();
		//getTasks(appState); 	
	}
});

//*****ТАБЫ*****
const tabs = document.querySelector('#nav-tab-main');
const allTasksTab = document.querySelector('#nav-userTasks');
const myTasksTab = document.querySelector('#nav-myTasks');
const addedTasksTab = document.querySelector('#nav-addedTasks');
let currentTab = allTasksTab;
//Пагинация
const pagination = document.querySelector(`.pagination`);
//Обработчики выбора вкладок
tabs.addEventListener('click', (event) => {
	switch(event.target.id) {
  		case "nav-userTasks-tab": 
        	appState = 'all';
        	currentTab = allTasksTab;
        	getTasks(appState);
  			break;
		case "nav-myTasks-tab":
         	appState = 'my';
         	currentTab = myTasksTab;
         	getTasks(appState);
  			break;
    	case "nav-addedTask-tab":
        	appState = 'added';
        	currentTab = addedTasksTab;
        	getTasks(appState);
        	break; 
		case "nav-addTask-tab":
			pagination.classList.add('hidden');
  			getUsers(usersSelect);
  			break;	
	}
});
//*****ВЫВОД USERS*****
function renderUsers(users, parentNode) {
	if (parentNode.options.length > 1) return;
	users.forEach(user => {
		const option = document.createElement('option');
		option.textContent = `${user.login} ${user.surname}`;
		option.setAttribute('data-id', user.id);
		if (parentNode.dataset.assignedUserId === option.dataset.id) {
			option.setAttribute('selected', true);
		}
		parentNode.appendChild(option);
	});
}

//*****ЗАДАНИЯ*****

//add new task
const usersSelect = document.querySelector('#usersSelect'); 
const addTaskForm = document.querySelector('.add-task-form');

addTaskForm.addEventListener('submit', addTask);

addTaskForm.addEventListener('change', (event) => {
	if (event.target.id === 'defaultCheck1') {
		if (event.target.checked) {
			addTaskForm.login.disabled = true;
			addTaskForm.login.options[0].selected = true;
			addTaskForm.userId.value = "";
		} else {
			addTaskForm.login.disabled = false;
		}
	}
});

function selectUser() {
	const index = addTaskForm.login.selectedIndex;
	const checkBox = addTaskForm.querySelector('#defaultCheck1');  
	if (index === 0 && !checkBox.checked) return false;
	const user = addTaskForm.login.options[index];
	addTaskForm.userId.value = user.dataset.id;
	return true;
}
//выводим все задания (state: all || my || added)
function renderTasks(tasks, parent, state) {
	clearTasks();
	if (!tasks.length) {
		parent.innerHTML = '<h3 class="mb-4 mt-4">Заданий нет</h3>';
		return;
	}
	parent.innerHTML = '';
 	tasks.forEach(task => {
	  	const taskNode = browserJSEngine(taskTemplate(task));
	  	taskNode.classList.add(state);
	  	taskNode.addEventListener('click', changeMode);
	  	taskNode.addEventListener('change', selectAssigned);
	  	parent.appendChild(taskNode);	
	  });
}
//Удалить все задания
function clearTasks() {
  document.querySelectorAll('.task').forEach(task => task.parentNode.removeChild(task));
}
//Обработка Click на карточке задания
function changeMode(event) {
	const task = event.currentTarget;
	const userList = task.querySelector('#task-edit-assigned');
	const description = task.querySelector('.task-description');
	const textEditor = event.currentTarget.querySelector('#task-edit-description');
	const statuses = task.querySelector('.status-btns');
	const statusBtns = statuses.querySelector('.btn-group');
	const status = task.querySelector('#task-state').dataset.status;
	switch (event.target.id) {
		case 'editBtn':
			task.className = '';
			task.classList.add('task','edit');
			task.querySelector('.task-footer .edit .task-marker').textContent = 'сохранить:';
			getUsers(userList);
			textEditor.value = description.innerText;
			break;	
		case 'saveBtn': 
			task.className = '';
			task.classList.add('task','added');
			task.querySelector('.task-footer .edit .task-marker').textContent = 'редактировать:';
			const changingTask = new updatedTask(task.dataset.id, status, userList.dataset.assignedUserId, textEditor.value);
			changingTask.sendUpdated();
			break;
		case 'changeStatusBtn':
			statuses.classList.toggle('hidden');
			break;
		case 'deleteBtn':
			deleteModal.setAttribute('data-task-id', task.dataset.id);

			$('#deleteModal').modal('show');
			break;
	}
	if (event.target.classList.contains('btn')) {
		changeStatus(event.target, task);
		statuses.classList.toggle('hidden');
	}
}
//Выбор пользователя для отправки
function selectAssigned(event) {
	console.log(event.target.tagName)
	if (event.target.tagName !== 'SELECT') return;
	const select = event.target;
	const user = select.options[select.selectedIndex];
	select.dataset.assignedUserId = user.dataset.id;
}
//Функция смены статуса
function changeStatus(button, task) {
	const changingTask = new updatedTask(task.dataset.id, button.dataset.status);
	changingTask.sendUpdated();
}
//Немного ООП (класс для отправки редактируемого задания)
class updatedTask {
	constructor(id, status, assigned_user_id = null, description = null) {
		this.id = id;
		this.assigned_user_id = assigned_user_id;
		this.description = description;
		this.status = status;
	}
	sendUpdated() {
		updateTask(this);
	}
}
//Модальное окно удаления
const deleteModal = document.querySelector('#deleteModal');
deleteModal.addEventListener('click', deleteTask);
//Функция удаления задания
function deleteTask(event) {
	if (event.target.id !== 'deleteAction') return;
	const removingTaskId = event.currentTarget.dataset.taskId;
	deleteTaskAction(removingTaskId);
}
//*****PAGINATION*****
let currentPage = 1;
let pageCount;

function getPages(pageCount = 1) {
	clearPages();
	pagination.addEventListener('click', selectPage);
	pagination.lastElementChild.addEventListener('click', nextPage);
	pagination.firstElementChild.addEventListener('click', previousPage);
	for (let i = 1; i <= pageCount; i++) {
		const pageNumber = browserJSEngine(pageNumberTemplate(i))
		pagination.insertBefore(pageNumber, pagination.lastElementChild);
	}
}
function clearPages() {
	const pages = document.querySelectorAll(`.pagination .number`);
	pages.forEach(page => page.parentNode.removeChild(page));
}

function selectPage(event) {
	event.preventDefault();
	if (!event.target.parentNode.classList.contains('number')) return;
	currentPage = event.target.parentNode.id;
	getTasks(appState, currentPage);
}
//Next
function nextPage(event) {
	event.preventDefault();
	if (currentPage < pageCount) {
		currentPage++;
		event.target.parentNode.classList.remove('disabled');
		getTasks(appState, currentPage);
	}
	if (currentPage === pageCount) {
		event.target.parentNode.classList.add('disabled');
	}
}
//Previous
function previousPage(event) {
	event.preventDefault();
	if (currentPage > 1) {
		currentPage--;
		event.target.parentNode.classList.remove('disabled');
		getTasks(appState, currentPage);
	}
	if (currentPage === 1) {
		event.target.parentNode.classList.add('disabled');	
	}
}
function setNumber(page) {
	document.querySelector(`.pagination li[id="${page}"]`).classList.add('active');
	if (pageCount == 1) {
		pagination.firstElementChild.classList.add('disabled');
		pagination.lastElementChild.classList.add('disabled');
		pagination.classList.remove('hidden');
		return;
	}
	if (page == 1) {
		pagination.firstElementChild.classList.add('disabled');
		pagination.lastElementChild.classList.remove('disabled');  
	} else if (page == pageCount) {
		pagination.lastElementChild.classList.add('disabled');
		pagination.firstElementChild.classList.remove('disabled'); 
	} else {
		pagination.firstElementChild.classList.remove('disabled');
		pagination.lastElementChild.classList.remove('disabled');   
	}
	pagination.classList.remove('hidden');

}
