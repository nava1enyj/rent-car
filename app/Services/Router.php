<?php

namespace App\Services;



class Router
{
    private static $list = [];

//    метод регистрирует роут для обычной страницы

    public static function page($uri,$page_name){
        self::$list[] = [
            "uri" =>$uri,
            "page" => $page_name
        ];
    }

    public static function post($uri,$class,$method,$formdata = false,$files = false){
        self::$list[] = [
            'uri' => $uri,
            'class' => $class,
            'method' => $method,
            'post' => true,
            'formdata' => $formdata,
            'files' => $files
        ];
    }

    public static function get($uri,$page_name){
        self::$list[] = [
            "uri" => $uri,
            'page' => $page_name,
            'get' => true
        ];
    }

//     метод перенаправялет на роут страницы
    public static function enable(){
        $query = $_GET['q'];
        foreach (self::$list as $route) {
            if ($route['uri'] === '/' . $query) {
                if($route['post']===true && $_SERVER['REQUEST_METHOD'] === 'POST'){

                    $action = new $route['class'];
                    $method = $route['method'];
                    if($route['formdata'] && $route['files']){
                        $action->$method($_POST,$_FILES);
                    }elseif ($route['formdata'] && !$route['files']){
                        $action->$method($_POST);
                    }else{
                        $action->$method();
                    }
                    die();
                }else{
                    require_once 'views/pages/' . $route['page'] . '.php';
                    die();
                }
            }

            if($route['get']===true){
                $params = explode("/", $query);
                $nowUri = '/' . $params[0];
                $data = $params[1];
                if($route['uri'] === $nowUri){
                    $_SESSION['query'] = $data;
                    require_once 'views/pages/' . $route['page'] . '.php';
                    die();
                }
            }

        }

        self::error('404');
    }

    public static function error($error){
        require_once 'views/errors/' . $error . '.php';
        die();
    }

    public static function redirect($uri){
        header('Location: ' . $uri);
    }


}