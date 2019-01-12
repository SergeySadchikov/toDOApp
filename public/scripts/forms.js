'use strict';
const signUpForm = document.querySelector('form.sign-up');
const signInForm = document.querySelector('form.sign-in');
const submitBtn = signUpForm.querySelector('.btn');
const submitAuthBtn = signInForm.querySelector('.btn');
const preloader = document.querySelector('.tab-content #before-load');

//События
signUpForm.addEventListener('input', (event) => {
	document.querySelector(".sign-up .alert").classList.add('hidden');
	validateForm(event);
});
signInForm.addEventListener('input', () =>{
	document.querySelector(".sign-in .alert").classList.add('hidden');
	checkFields();
});
signUpForm.addEventListener('submit', (event) => {
	event.preventDefault();
	preloader.classList.toggle('hidden');
	signUpForm.classList.toggle('hidden');
	signInForm.classList.toggle('hidden')
	registerAction();
});
signInForm.addEventListener('submit', (event) => {
	event.preventDefault();
	preloader.classList.toggle('hidden');
	signUpForm.classList.toggle('hidden');
	signInForm.classList.toggle('hidden');
	loginAction();
});

//Валидация формы регистрации
function validate(event) {
	event.preventDefault();
	const nameValue = event.currentTarget.name.value;
	const surnameValue = event.currentTarget.surname.value;
	const emailValue = event.currentTarget.email.value;
	const passwordValue = event.currentTarget.password.value;
	const confirmValue = event.currentTarget.confirm.value;
	if (event.target.name === 'name') {
		validInputs.name = validateName(event.target, nameValue) ? true : false;	
	}
	if (event.target.name === 'surname') {
		validInputs.surname = validateName(event.target, surnameValue) ? true : false;	
	}
	if (event.target.name === 'email') {
		validInputs.email = validateEmail(event.target, emailValue) ? true : false;				
	}
	if (event.target.name === 'password') {
		validInputs.password = validatePassword(event.target, passwordValue) ? true : false;	
		if (confirmValue !== '') {
			validInputs.confirm = validateConfirmPassword(event.currentTarget.confirm, passwordValue, confirmValue) ? true : false;	
		}
	}							
	if (event.target.name === 'confirm') {
		validInputs.confirm = validateConfirmPassword(event.target, passwordValue, confirmValue) ? true : false;					
	}
}
//Костыль для проверки валидности всех полей
const validInputs = {
	name: false,
	surname: false,
	email: false,
	password: false,
	confirm: false
};
//сообщение 
function validateMessage(element, message, done = true) {
	const feedback = element.nextElementSibling;
	feedback.textContent = message;
	if (!done) {
		feedback.classList.remove('resolve');
		feedback.classList.add('reject');
	} else {
		feedback.classList.remove('reject');
		feedback.classList.add('resolve');	
	} 	
}

function validateName(element, value) {
	const nameRegExp = /^[a-zA-Zа-яА-ЯёЁ']+$/ui;
	if (!nameRegExp.test(value)) {
		validateMessage(element, 'Только символы алфавита', false)
		return false;
	} else {
		validateMessage(element, 'Успешно');
		return true;	
	}	
}
function validateEmail(element, value) {
	const emailRegExp = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if (!emailRegExp.test(value)) {
		validateMessage(element, 'Невалидный email', false);
		return false;	
	} else {
		validateMessage(element, 'Успешно');
		return true;	
	}
}
function validatePassword(element, value) {
	const passwordRegExp =  /(?=.*[0-9])(?=.*[a-zA-Zа-яА-Я])[0-9a-zA-Zа-яА-Я!@#$%^&*]{6,}/g;
	if (!passwordRegExp.test(value)) {
		validateMessage(element, 'Пароль должен содержать минимум 6 символов с использованием цифр и букв', false);
		return false;	
	} else {
		validateMessage(element, 'Успешно');
		return true;	
	}
}
function validateConfirmPassword(element, passwordValue, confirmPaswordValue) {
	if (passwordValue === confirmPaswordValue) {
		validateMessage(element, 'Успешно');
		return true;	
	} else {
		validateMessage(element, 'Пароли не совпадают', false);
		return false;	
	}
}
//переменная для защиты от изменения аттрибута disbled у submitBtn в HTML разметке
let acceptValidation = false;

function validateForm(event) {
	validate(event);
	for (let key in validInputs) {
		if (!validInputs[key]) {
			submitBtn.setAttribute('disabled', '');
			return;	
		}
	}
	acceptValidation = true;
    submitBtn.removeAttribute('disabled');
}
	
//Проверка формы аутенификации
function checkFields(event) {
	if (Array.from(signInForm.querySelectorAll('input.form-control')).some(input => input.value === '')) {
		acceptValidation = false;
		submitAuthBtn.disabled = true;				
	} else {
		acceptValidation = true;
		submitAuthBtn.disabled = false;	
	}
}