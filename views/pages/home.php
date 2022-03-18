<?php
use App\Services\Page;
?>
<html>
<?php
Page::par('head');
?>
<body>
<?php
Page::par('navbar');
?>
<?php

$cars = \R::findAll('cars');



?>

<div class="container-xxl ">
    <h3>Главная</h3>
    <hr>
    <div class="row align-items-start">
        <?php
        foreach ($cars as $car) {
        ?>
        <div class="col mt-4  text-center">
    <div class="card" style="width: 18rem;">
        <img src="<?=$car->path ?>" class="img card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?=$car->model_car ?></h5>
            <p class="card-text">Мощность: <?=$car->power ?></p>
            <p class="card-text">Цвет: <?=$car->color ?></p>
            <p class="card-text">Вместимость: <?=$car->capacity ?></p>
            <p class="card-text">Стоимость за 1 день аренды: <?=$car->price ?>₽</p>
            <a href="/carOrder/<?=$car->id?>" class="btn btn-primary">Арендовать</a>
        </div>
    </div>
        </div>
        <?php
        }
        ?>
    </div>

</div>

</body>
</html>