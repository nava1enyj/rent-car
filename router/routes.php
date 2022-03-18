<?php

use App\Services\Router;
use App\Controllers\Auth;
use App\Controllers\Package;
use App\Controllers\Car;
use App\Controllers\User;

Router::page('/login' , 'login');
Router::page('/register' , 'register');
Router::page('/' , 'home');
Router::page('/profile' , 'profile');
Router::page('/pay' , 'pay');
Router::page('/successpackageapplication' , 'successpackageapplication');

Router::post('/auth/register' , Auth::class , 'register' , true);
Router::post('/auth/login' , Auth::class , 'login' , true);
Router::post('/auth/logout' , Auth::class , 'logout');

Router::post('/add/car' , Car::class , 'addCar', true,true);

//user pay
Router::post('/user/pay' , User::class , 'pay' , true);

Router::get('/carOrder','carOrder');


Router::enable();