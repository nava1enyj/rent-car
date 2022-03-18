<?php

namespace App\Controllers;

use App\Services\Router;

class Car
{
public function addCar($data, $files){
  $model = $data['model'];
  $power = $data['power'];
  $color = $data['color'];
  $capacity = $data['capacity'];
  $price = $data['price'];

  $car_pic = $files['car'];

    if($car_pic['name']){
        $fileName = time() . '_' . $car_pic['name'];
        $path ='uploads/' . $fileName;
        move_uploaded_file($car_pic['tmp_name'],$path);
    }
    else{
        die('Ошибка загрузки фотографии');
    }



    $user = \R::dispense('cars');
    $user->modelCar = $model;
    $user->power = $power;
    $user->color = $color;
    $user->capacity = $capacity;
    $user->path = $path;
    $user->price = $price;
    \R::store($user);

    $bygalOne = \R::dispense('bygalone');
    $procent = $price * (10/100);
    $bygalOne->id_car = $user->id;
    $bygalOne->procents = $procent;
    \R::store($bygalOne);
    Router::redirect('/successpackageapplication');
}
}