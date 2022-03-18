<?php
use App\Services\Page;
if($_SESSION['user']){
    \App\Services\Router::redirect('/profile');
}
?>
<html>
<?php
Page::par('head');
?>
<body>
<?php
Page::par('navbar');
?>
<div class="container-xxl">
    <h3>Регистрация</h3>
    <hr>
    <form action="/auth/register" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email почта</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" required>
            <div id="passwordHelpBlock" class="form-text">
                Ваш пароль должен быть не меньше 8 символов.
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Подтвердите пароль</label>
            <input type="password" name="passwordConfirm" class="form-control" required>

        </div>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Фамилия</label>
            <input type="text" name="lastname" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Создать аккаунт</button>
    </form>

</div>

</body>
</html>