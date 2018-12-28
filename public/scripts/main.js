'use strict';
//Формы
//Состояния приложения
let appState;
const signUpForm = document.querySelector('form.sign-up');
const signInForm = document.querySelector('form.sign-in');
const submitBtn = signUpForm.querySelector('.btn');
const submitAuthBtn = signInForm.querySelector('.btn');
//Выпадающее меню
const navbarDropdown = document.querySelector('#navbarDropdownMenuLink');
const dropdownMenu = document.querySelector('.dropdown-menu');

//*****ТАБЫ*****
const tabs = document.querySelector('#nav-tab-main');
const allTasksTab = document.querySelector('#nav-userTasks');
const myTasksTab = document.querySelector('#nav-myTasks');
const addedTasksTab = document.querySelector('#nav-addedTasks');
//Модальное окно удаления
const deleteModal = document.querySelector('#deleteModal');
//Обработчики выбора вкладок
tabs.addEventListener('click', (event) => {
	switch(event.target.id) {
  		case "nav-userTasks-tab": 
        getAllTasks();
        appState = 'all';
  			break;
		case "nav-myTasks-tab": 
         getMyTasks();
         appState = 'my';
  			break;
    case "nav-addedTask-tab":
        getAddedTasks();
        appState = 'added';
        	break; 
		case "nav-addTask-tab": 
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
//*****НОВОЕ ЗАДАНИЕ*****
const usersSelect = document.querySelector('#usersSelect'); 
const addTaskForm = document.querySelector('.add-task-form');


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
//*****ВСЕ ЗАДАНИЯ*****
//выводим все задания (state: all || received || added)
function renderTasks(tasks, parent, state) {
  clearTasks();
  tasks.forEach(task => {
  	const taskNode = browserJSEngine(taskTemplate(task));
  	taskNode.classList.add(state);
  	taskNode.addEventListener('click', changeMode);
  	taskNode.addEventListener('change', selectAssigned);
  	parent.insertBefore(taskNode, parent.firstChild);	
  });
}
//Удалить все задания
function clearTasks() {
  document.querySelectorAll('.task').forEach(task => task.parentNode.removeChild(task));
}
//Обработка Click
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
//Функция удаления задания
deleteModal.addEventListener('click', deleteTask);

function deleteTask(event) {
	if (event.target.id !== 'deleteAction') return;
	const removingTaskId = event.currentTarget.dataset.taskId;
	deleteTaskAction(removingTaskId);
}