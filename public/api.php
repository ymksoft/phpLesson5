<?php

require_once __DIR__ . '/../config/config.php';

// Функция для вывода сообщения об ошибке
function error($error_text) 
{

    // JSON Вариант
    /*
    header('Content-type: application/json');
    echo  json_encode([
        'error' => true,
        'error_text' => $error_text,
        'data' => null,
    ]);
    exit();
    */

    // Тесктовый вариант
    echo "Ошибка: $error_text";
    exit();
}

// Функция вывода успешного ответа
function success($data = true)
{
    // JSON Вариат
    /*
    header('Content-type: application/json');
    echo  json_encode([
        'error' => false,
        'error_text' => null,
        'data' => $data,
    ]);
    exit();
    */

    // Тесктовый вариант
    echo "OK";
    exit(); 
}

// Проверка входых данных
$apiMethod = $_POST['apiMethod'];

if( empty($apiMethod) ) {
    error('Не передан метод обработки apiMethod');
}

// Обработка метода авторизации login
if( $apiMethod === 'login' )
{
    // входные параметры
    $login = $_POST['postData']['login'] ?? '';
    $pass = $_POST['postData']['pass'] ?? '';

    // проверка входных параметров
    if( !$login || !$pass ) {
        error('Вы не каказали логин или пароль');
    }

    $result = checkUser($login, $pass);
	if ($result) { 
        $_SESSION['user'] = $result;
        success();
    }
    
    error('Пользователя с таким логином или паролем нет');
    exit();
}

// Обработка метода добавления в корзину
if( $apiMethod === 'addToBasket' )
{
    // входные параметры
    $id = (int)$_POST['postData']['id'] ?? 0;

    // проверка входных параметров
    if( $id === 0 ) {
        error('Не указан код товара для добавления в корзину');
    }
    
    // читаем корзину из куки
    $Basket = $_COOKIE['Basket'] ?? [];

    // получаем число данного товара в корзине
    $count = $Basket[$id] ?? 0;

    // добавляем товар в корзину
    $count++;

    // сохранем корзину используя куки
    setcookie("Basket[$id]", $count);
    success();
}

// Обработка метода удаления из корзины
if( $apiMethod === 'removeFromBasket' )
{
    // входные параметры
    $id = (int)$_POST['postData']['id'] ?? 0;

    // проверка входных параметров
    if( $id === 0 ) {
        error('Не указан код товара для удаления из корзины');
    }

    // удаляем данные из корзины используя куки
    setcookie("Basket[$id]", null);
    success();
}

// Обработка метода удаления из корзины
if( $apiMethod === 'deleteFromBasket' )
{
    // входные параметры
    $id = (int)$_POST['postData']['id'] ?? 0;

    // проверка входных параметров
    if( $id === 0 ) {
        error('Не указан код товара для удаления из корзины');
    }

    // читаем корзину из куки
    $Basket = $_COOKIE['Basket'] ?? [];

    // получаем число данного товара в корзине
    $count = $Basket[$id] ?? 0;

    // уменьшаем товар в корзине, если он больше 1
    if( $count > 1 ) {
        $count--;
        setcookie("Basket[$id]", $count);
    }
    // удаляем данные из корзины, если результат уменьшения 0
    else {
        setcookie("Basket[$id]", null);
    }
    success();
}

error("Для переданного метода $apiMethod нет обработчика.");

