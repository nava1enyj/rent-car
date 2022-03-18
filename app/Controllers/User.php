<?php

namespace App\Controllers;
use App\Services\Router;


class User
{

    public function pay($data)
    {
        session_start();

        $price = $data['price'];
        $nambercard= $data['nambercard'];
        $date= $data['date'];
        $cvv= $data['cvv'];

        if(isset($_SESSION['userPrice']))
        {
            if($_SESSION['userPrice']['id']===0){
                $userPrice = \R::dispense('price');
                $userPrice->id_user = $_SESSION['user']['id'];
                $userPrice->price = $price;
                $userPrice->nambercard = $nambercard;
                $userPrice->numberdate = $date;
                $userPrice->cvv = $cvv;
                \R::store($userPrice);

                $pribil = \R::findOne('pribil', 'id = ?', [1]);
                    $pribilchanhe = \R::load('pribil', 1);
                    $pribAll=$pribil->pribil+$price;
                    $pribilchanhe->pribil = $pribAll;
                    \R::store($pribilchanhe);

                $_SESSION['userPrice']=[
                    'id' => $userPrice->id,
                    'nambercard' => $userPrice->nambercard,
                    'numberdate' => $userPrice->numberdate,
                    'cvv' => $userPrice->cvv,
                    'price' => $userPrice->price
                ];

                Router::redirect('/successpackageapplication');
           }
          else{
                $prices = \R::load('price', $_SESSION['userPrice']['id']);

                $priceAll = $prices->price+$price;
              $prices->id_user = $_SESSION['user']['id'];
                $prices->price = $priceAll;
                $prices->nambercard = $nambercard;
                $prices->numberdate = $date;
                $prices->cvv = $cvv;
                \R::store($prices);


              $pribil = \R::findOne('pribil', 'id = ?', [1]);
              $pribilchanhe = \R::load('pribil', 1);
              $pribAll=$pribil->pribil+$price;
              $pribilchanhe->pribil = $pribAll;
              \R::store($pribilchanhe);

                $_SESSION['userPrice']=[
                    'id' => $prices->id,
                    'nambercard' => $prices->nambercard,
                    'numberdate' => $prices->numberdate,
                    'cvv' => $prices->cvv,
                    'price' => $prices->price
                ];
                Router::redirect('/successpackageapplication');
           }


        }
        else{
            $userPrice = \R::dispense('price');
            $userPrice->id_user = $_SESSION['user']['id'];
            $userPrice->price = $price;
            $userPrice->nambercard = $nambercard;
            $userPrice->numberdate = $date;
            $userPrice->cvv = $cvv;
            \R::store($userPrice);

            $pribil = \R::findOne('pribil', 'id = ?', [1]);
            if($pribil){
                $pribilchanhe = \R::load('pribil', 1);
                $pribAll=$pribil->pribil+$price;
                $pribilchanhe->pribil = $pribAll;
                \R::store($pribilchanhe);
            }
            else{
                $pribil = \R::dispense('pribil');
                $pribil->pribil = $price;
                \R::store($pribil);
            }


            $_SESSION['userPrice']=[
                'id' => $userPrice->id,
                'nambercard' => $userPrice->nambercard,
                'numberdate' => $userPrice->numberdate,
                'cvv' => $userPrice->cvv,
                'price' => $userPrice->price
            ];

            Router::redirect('/successpackageapplication');
        }



    }

}