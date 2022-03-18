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
    <h3>Пополнение баланса</h3>
    <hr>
    <form action="/user/pay" method="post">
        <div class="mb-3">
            <label for="" class="form-label">Введите сумму</label>
            <input type="number" name="price" class="form-control w-25" aria-describedby="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Номер карты</label>
            <input type="text" name="nambercard" class="form-control" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Дата</label>
            <input type="text" name="date" class="form-control w-25" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">CVV</label>
            <input type="text" name="cvv" class="form-control w-25" id="">
        </div>
        <button type="submit" class="btn btn-primary">Пополнить</button>
    </form>
</div>
</body>
</html>


