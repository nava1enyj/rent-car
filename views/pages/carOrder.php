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
<div class="container-xxl">
    <h3>Подтвердите взятие автомобиля</h3>
    <hr>
    <?php
    $car = \R::findOne('cars' , '`id` = ?' , [$_SESSION['query']]);
    ?>
    <h5>Название машины: <?= $car->model_car ?></h5>
    <img class="img-confirm img-thumbnail" src="/<?= $car->path ?> " alt="">
    <p class="mt-3 fs-5">Цена на день: <?= $car->price ?></p>
    <hr>
    <form method="post">
        <div class="mb-3">
            <p>Введите число до которого будет аренда автомобиля</p>
            <input type="date" class="form-control" name="date" aria-describedby="passwordHelpBlock" value="1">
        </div>
        <button class="btn btn-primary" name="btn-inset">Забрать</button>
    </form>
</div>

<?php

if(isset($_POST['btn-inset'])){
    $date = $_POST['date'];

        $price = \R::findOne('price' , 'id_user = ?' , [$_SESSION['user']['id']]);
    if(!$price){
        die('у вас не хватает денег1');
    }

    if($price->price<$car->price){
        die('у вас не хватает денег2');
    }
    else{
        $orders = \R::dispense('orders');
        $orders->id_user = $_SESSION['user']['id'];
        $orders->id_car = $car->id;
        $orders->date =  $date;
        R::store($orders);

        $prices = \R::load('price', $_SESSION['userPrice']['id']);
        $priceAll = $prices->price-$car->price;
        $prices->id_user = $_SESSION['userPrice']['id'];
        $prices->price = $priceAll;
        $prices->nambercard = $_SESSION['userPrice']['nambercard'];
        $prices->numberdate = $_SESSION['userPrice']['numberdate'];
        $prices->cvv = $_SESSION['userPrice']['cvv'];;
        \R::store($prices);


        $_SESSION['userPrice']=[
            'id' => $prices->id,
            'nambercard' => $prices->nambercard,
            'numberdate' => $prices->numberdate,
            'cvv' => $prices->cvv,
            'price' => $prices->price
        ];
        \App\Services\Router::redirect('/successpackageapplication');
    }

}