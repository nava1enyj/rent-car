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
    <h3>Личный кабинет</h3>
    <hr>
    <p class="fs-5 mb-5 mt-5">Привет <?= $_SESSION['user']['name'] ?></p>

    <div class="row align-items-start">
        <div class="col">


    <?php
    if($_SESSION['user']['group'] === '1'){
        ?>
        <h4>Ваши взятые автомобили</h4>
          <a href="/pay" class="btn btn-primary">Пополнить баланс</a>
        <hr>
        <h3>Ваши заказы</h3>
        <?php
        $orders = \R::findAll('orders' , 'id_user = ?' , [$_SESSION['user']['id']]);
        foreach ($orders as $order) {
            $cars = \R::findAll('cars' , 'id = ?' , [$order->id_car]);
            foreach ($cars as $car) {


            ?>

            <p class="mb-3">Машина: <?= $car->model_car ?></p>
                <img class="img-confirm img-thumbnail mb-5" src="/<?= $car->path ?> " alt="">
                <hr>
            <?php
            }
        }
    }

   if($_SESSION['user']['group'] === '2'){
       $procents = \R::findAll('bygalone');
       $sum = 0;
       foreach ($procents as $procent){

             $sum +=$procent->procents;
       }

       ?>
       <hr>
       <p>Сумма которую надо оплатить за страховой взнос: <?= $sum?> рублей</p>
       <hr>
       <?php  $pribil = \R::findOne('pribil', 'id = ?', [1]); ?>
       <p>Прибыль: <?= $pribil->pribil ?> рублей</p>
       <hr>



       <?php

   }
            if($_SESSION['user']['group'] === '3'){
                ?>
                <form action="/add/car" method="post" enctype="multipart/form-data">
                <label for="exampleInputEmail1" class="form-label">Фото автомобиля</label>
                <input type="file" name="car" class="form-control" id="car">

                <label class="form-label">Модель</label>
                <input type="text" name="model" class="form-control" required>

                <label class="form-label">Мощность</label>
                <input type="text" name="power" class="form-control" required>

                <label class="form-label">Цвет</label>
                <input type="text" name="color" class="form-control" required>

                <label class="form-label">Вместимость</label>
                <input type="text" name="capacity" class="form-control" required>

                    <label class="form-label">Стоимость за 1 день</label>
                    <input type="text" name="price" class="form-control" required>
                <button class="btn btn-primary mt-4">Добавить</button>
                </form>
                <?php
}

   ?>

</div>

</body>
</html>