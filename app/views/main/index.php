
<!-- MAIN -->
<main>
    <div class="nav-header">
        <div class="nav nav-tabs" id="nav-tab-main" role="tablist">
            <a class="nav-item nav-link active" id="nav-userTasks-tab" data-toggle="tab" href="#nav-userTasks" role="tab" aria-controls="nav-userTasks" aria-selected="true">Все задания</a>
            <a class="nav-item nav-link" id="nav-myTasks-tab" data-toggle="tab" href="#nav-myTasks" role="tab" aria-controls="nav-myTasks" aria-selected="false">Полученные</a>
            <a class="nav-item nav-link" id="nav-addedTask-tab" data-toggle="tab" href="#nav-addedTasks" role="tab" aria-controls="nav-addedTask" aria-selected="false">Добавленные</a>
            <a class="nav-item nav-link" id="nav-addTask-tab" data-toggle="tab" href="#nav-addTask" role="tab" aria-controls="nav-addTask" aria-selected="false">Новое</a>
        </div>
        <!-- <div class="list-group" id="sidebar">
            <button type="button" class="list-group-item list-group-item-action">Все</button>
            <button type="button" class="list-group-item list-group-item-action">Ождающие</button>
            <button type="button" class="list-group-item list-group-item-action">В процессе</button>
            <button type="button" class="list-group-item list-group-item-action">Выполненные</button>
            <div id="sidebar-switch"><i class="fas fa-caret-right"></i></div>
        </div>  --> 
    </div>
    <div class="container">
        <div class="tab-content" id="nav-tabContent">
          <!--  preloader -->
           <div class="hidden" id="before-load">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
            <div class="tab-pane fade show active" id="nav-userTasks" role="tabpanel" aria-labelledby="nav-userTasks-tab"></div>
            <div class="tab-pane fade" id="nav-myTasks" role="tabpanel" aria-labelledby="nav-myTasks-tab"></div>
            <div class="tab-pane fade" id="nav-addedTasks" role="tabpanel" aria-labelledby="nav-addedTask-tab"></div>
            <div class="tab-pane fade" id="nav-addTask" role="tabpanel" aria-labelledby="nav-addTask-tab">
                <h2 class="mt-4 mb-4">Создайте новое задание</h2>
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
        <!--  pagination all -->
            <ul class="pagination justify-content-center hidden" id="">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">&laquo;</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">&raquo;</a>
                </li>
            </ul>
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
    <!-- Add-task-MSG modal -->
    <div class="modal fade" id="addMsgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body pt-20">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading mb-3">Задание успешно добавлено!</h4>
                <p>Для редактирования войдите в раздел "Добавленные"</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">OK</button>
            </div>
        </div>
    </div>
</div>
</main>


<script src="/public/scripts/main.js"></script>
<script src="/public/scripts/templates.js"></script>
<!-- <script src="/public/scripts/page.js"></script> -->
