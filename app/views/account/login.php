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
                        <!-- preloader -->
                        <div class="hidden" id="before-load">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                        <!-- login tab -->
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
                                <div class="alert alert-danger hidden" role="alert"></div>
                                <input class="btn btn-primary" type="submit" name="" disabled>
                            </form>
                        </div>
                       <!--  register tab -->
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
                                <div class="alert alert-danger hidden" role="alert"></div>
                                <input class="btn btn-primary" type="submit" name="button" disabled>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Succes Message-->
<!-- Modal -->
<div class="modal fade" id="confirmMsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Подвердите ваш аккаунт</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-20">
                <p>Для подтверждения вашей учётной записи, перейдите по ссылке, которую мы выслали на ваш Email</p>
                <hr>
            </div>
        </div>
    </div>
</div>

<script src="/public/scripts/forms.js"></script>
