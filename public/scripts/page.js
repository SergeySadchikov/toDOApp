'use strict';

// const header  = document.getElementsByTagName('header')[0];
// const navHeader = document.querySelector('.nav-header');
// const navBar = document.querySelector('.navbar');
// const sideBar = document.querySelector('#sidebar');

// document.addEventListener('scroll', event => {
// 	if (window.pageYOffset > header.clientHeight) {
// 		navHeader.style.position = 'fixed';
// 		navHeader.style.top = `${navBar.clientHeight}px`;
// 		navHeader.style.left = '0px';
// 		navHeader.style.right = '0px';
// 	}
// 	if (window.pageYOffset < header.clientHeight) {
// 		navHeader.style.position = 'relative';
// 		navHeader.style.top = '0px';
// 		navHeader.style.left = '0px';
// 	} 
// });

// sideBar.addEventListener('click', event => {
// 	console.log(event.target);
// 	if (event.target.parentNode.id === 'sidebar-switch') {
// 		event.currentTarget.style.left = `0px`;
// 	}
// 	if (event.target.classList.contains('list-group-item')) {
// 		event.currentTarget.style.left = `-${event.currentTarget.clientWidth}px`;
// 		Array.from(event.currentTarget.children).forEach(item => item.classList.remove('active'));
// 		event.target.classList.add('active');
// 	}
// })


window.addEventListener('resize', () => {
	if (document.documentElement.clientWidth <= 1000) {
		console.log('aasdasd')
		document.querySelector('.pagination').classList.add('pagination-sm');
	} else {
		document.querySelector('.pagination').classList.remove('pagination-sm');
	}
});