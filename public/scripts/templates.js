'use strict';

//TEMPLATES
function taskTemplate(task) {
	return {
		tag: 'div',
		className: 'task',
    attr: {'data-id': task.task_id},
		content: [
		{
			tag: 'div',
			className: ['row', 'task-header'],
			content: [{
                tag: 'div',
                className: 'col-md-auto',
                content: [{
                          tag: 'div',
                          className: 'assigned-user',
                          content: [{tag: 'span', className: 'task-marker', content: 'кому:'},
                                    {tag: 'span', className: 'task-name', content: task.assigned_user_name},
                                    {tag: 'span', className: 'task-surname', content: task.assigned_user_surname}]
                          },
                          {
                            tag: 'select',
                            className: 'custom-select',
                            attr: {id: 'task-edit-assigned', 'data-assigned-user-id': task.assigned_user_id},
                            content: {tag: 'option', className: '', attr: {disabled: true}, content: 'ответственный'}
                          }]
                },
                {
                  tag: 'div',
                  className: 'col-md-auto',
                  content:[{tag: 'span', className: 'task-marker', content: 'от:'},
                           {tag: 'span', className: 'task-name', content: task.author_name},
                           {tag: 'span', className: 'task-surname', content: task.author_surname}]
                 },
                 {
                  tag: 'div',
                  className: 'col-md-auto',
                  attr: {'data-status': `${task.is_done}`, id: 'task-state'},
                  content: [{tag: 'span', className: 'task-marker', content: 'статус:'},
                            {tag: 'span', className: ['text-info', 'wait'], content: task.is_done},
                            {tag: 'span', className: ['text-secondary', 'start'], content: task.is_done},
                            {tag: 'span', className: ['text-success', 'done'], content: task.is_done},
                            {tag: 'span', className: 'task-status', content: [{tag: 'i', className: ['far', 'fa-clock', 'wait']},
                                                                              {tag: 'i', className: ['fas', 'fa-hammer', 'start']},
                                                                              {tag: 'i', className: ['fas', 'fa-check-square', 'done']}]
                            }]
                 },
                 {
                  tag: 'div',
                  className: 'delete',
                  content: {
                            tag: 'button',
                            className: 'close',
                            attr: {'aria-label': "Close", type: 'button', id: 'deleteBtn'},
                            content: ""
                          }
                 }]
	  },
    {
      tag: 'div',
      className: ['row', 'task-content'],
      content: {
                  tag: 'div',
                  className: 'col-md-12',
                  content: {
                            tag: 'div',
                            className: 'description',
                            content: [{tag: 'span', className: 'task-marker', content: 'описание:'},
                                      {tag: 'p', className: 'task-description', content: `${task.description}`},
                                      {tag: 'textarea', className: 'form-control', attr: {id:'task-edit-description'}}]
                            }
                }
    },
    {
    tag: 'div',
    className: ['row', 'task-footer'],
    content: [{
               tag: 'div',
               className: ['col-md-auto', 'edit'],
               content:[{
                          tag: 'span',
                          className: 'task-marker',
                          content: 'редактировать:'
                        },
                        {
                          tag: 'div',
                          className: 'task-status',
                          content: [{
                                    tag:'i',
                                    className: ['fas', 'fa-edit'],
                                    attr: {id: 'editBtn', 'data-toggle':'tooltip', 'data-placement': 'bottom', title:'Изменить задание'}
                                   },
                                   {
                                    tag:'i',
                                    className: ['fas', 'fa-save'],
                                    attr: {id: 'saveBtn', 'data-toggle':'tooltip', 'data-placement': 'bottom', title:'Сохранить'}   
                                   }]
                        }]
               },
               {
                tag: 'div',
                className: ['col-md-auto','change-status'],
                content:[{
                          tag: 'span',
                          className: 'task-marker',
                          content: 'сменить статус:'
                        },
                        {
                          tag: 'div',
                          className: 'task-status',
                          content: {
                                    tag:'i',
                                    className: ['fas', 'fa-bell'],
                                    attr: {id: 'changeStatusBtn','data-toggle':"tooltip", 'data-placement':"bottom", title:"Изменить статус"}
                                    }
                        }]
               },
               {
                tag: 'div',
                className: ['col-md-auto', 'hidden', 'status-btns'],
                content: {
                            tag: 'div',
                            className: ['btn-group','btn-group-sm'],
                            attr: { role:"group", 'aria-label': "Basic example"},
                            content:[{
                                      tag: 'button',
                                      className: ['btn', 'btn-info'],
                                      attr: {type: 'button', 'data-status': 'Ожидает'},
                                      content: 'Отложить' 
                                    },
                                    {
                                      tag: 'button',
                                      className: ['btn', 'btn-secondary'],
                                      attr: {type: 'button', 'data-status': 'В процессе'},
                                      content: 'Приступить' 
                                    },
                                    {
                                      tag: 'button',
                                      className: ['btn', 'btn-success'],
                                      attr: {type: 'button','data-status': 'Завершено'},
                                      content: 'Завершить' 
                                    }]
                          }
               },
               {
                tag: 'div',
                className: ['col', 'text-right'],
                content: [{tag: 'span', className: 'task-marker', content: 'опубликовано:'},
                          {tag: 'span', className: 'task-time', content: `${task.date_added}`}]
               }]
          }]
    }  
}
//pagination `<li class="page-item"><a class="page-link" id="${i}" href="">${i}</a></li>`;

function pageNumberTemplate(number) {
  return {
    tag: 'li',
    className: ['page-item', 'number'],
    attr: {id: number},
    content:[{
              tag: 'a',
              className: 'page-link',
              content: number 
            }]
  }
}

function browserJSEngine(block) {
        if (block === undefined || block === null || block === false) {
            return document.createTextNode('');
        }
        if (typeof block === 'string' || typeof block === 'number' || block === true) {
            return document.createTextNode(block);
        }
        if (Array.isArray(block)) {
            return block.reduce((f, el) => {
                f.appendChild(browserJSEngine(el));
 
                return f;
            }, document.createDocumentFragment())
        }
        const element = document.createElement(block.tag);
 
        element.classList.add(...[].concat(block.className || []));
 
        if (block.attr) {
            Object.keys(block.attr).forEach(key => {
                element.setAttribute(key, block.attr[key]);
            });
        }
 
        element.appendChild(browserJSEngine(block.content));
 
        return element;
    }