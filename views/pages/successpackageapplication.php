<?php
use App\Services\Page;

if(!$_SESSION['user']){
    \App\Services\Router::redirect('/login');
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
    <h3>Успешно</h3>
</div>

</body>
</html>