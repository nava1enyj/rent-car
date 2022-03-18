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
    <h3>Войти</h3>
    <hr>
    <form action="/auth/login" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name = "password" class="form-control" id="exampleInputPassword1">
        </div>

        <p><a class="mt-2" href="register">У вас еще нет аккаунта , создайте его</a></p>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

</body>
</html>