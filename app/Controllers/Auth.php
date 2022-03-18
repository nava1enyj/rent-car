<?php

namespace App\Controllers;

use App\Services\Router;
use App\Services\ValidationCheck;

class Auth
{
    public function register($data){

        $password = ValidationCheck::protectionAgainstXss($data['password']);
        $passwordConfirm= ValidationCheck::protectionAgainstXss($data['passwordConfirm']);
        $email = ValidationCheck::protectionAgainstXss($data['email']);
        $lastname = ValidationCheck::protectionAgainstXss($data['lastname']);
        $name= ValidationCheck::protectionAgainstXss($data['name']);

        $errorFields = [];




        if($password === '' || strlen($password) < 8 || strlen($password) > 24  ||  preg_match('/[А-Яа-яЁё_ -]/iu', $password)){
            $errorFields[] =  'password';
        }

        if($email === '' || strlen($email) < 3 || strlen($email) > 42 || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errorFields[] = 'email';
        }

        if($name === '' || strlen($name) < 3 || strlen($name) > 32){
            $errorFields[] =  'name';
        }

        if($lastname === '' || strlen($lastname) < 3 || strlen($lastname) > 32){
            $errorFields[] =  'lastname';
        }

        if(!empty($errorFields)){
            die('ошибки валидации полей');
        }

       if($password !== $passwordConfirm){
           //error
           die('пароли не совпадают');
       }

        $user = \R::findOne('users' , 'email = ?', [$email]);

        if($user){
            die('такая почта уже зарегана');
        }

        $user = \R::dispense('users');
        $user->email = $email;
        $user->password = password_hash($password,PASSWORD_DEFAULT);
        $user->lastname = $lastname;
        $user->name = $name;
        $user->group = '1'; // 1-пользователь , 2 - админ
        \R::store($user);

        session_start();
        $_SESSION['user']=[
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'lastname' => $user->lastname,
            'group' => $user->group
        ];

        Router::redirect('/');

    }

    public function login($data){
        $email =  ValidationCheck::protectionAgainstXss($data['email']);
        $password = ValidationCheck::protectionAgainstXss($data['password']);

        $user = \R::findOne('users' , 'email = ?' , [$email]);

        if(!$user){
            die('пользователь не найден');
        }



        if(password_verify($password, $user->password)){

            $prices = \R::load('price', $user->id);
            $priceFind = \R::findOne('price' , 'id_user = ?' , [$user->id]);
            session_start();
            if(!$priceFind){
                $_SESSION['userPrice']=[
                    'price' => 0
                ];
            }
            else{
                $_SESSION['userPrice']=[
                    'id' => $priceFind->id,
                    'nambercard' => $priceFind->nambercard,
                    'numberdate' => $priceFind->numberdate,
                    'cvv' => $priceFind->cvv,
                    'price' => $priceFind->price
                ];
            }

            $_SESSION['user']=[
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'group' => $user->group
            ];
            Router::redirect('/profile');
        }else{
            die('неверный логин или пароль');
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        if(isset($_SESSION['userPrice'])){
            unset($_SESSION['userPrice']);
        }
        Router::redirect('/login');
    }
}