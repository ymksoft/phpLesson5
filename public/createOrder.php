<?php

require_once __DIR__ . '/../config/config.php';

$address = $_POST['address'] ?? '';
if( isset($_POST['enter']) && $address) {
	$content = createOrder([
		'address' => $address,
	]);
}
else {
	// Оформление заказа - Уточним адрес, потом способ оплаты и т.п.
	$content = renderCreateOrder([
		'address' => $address,
	]);
}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Оформление заказа',
	'h1' => 'Форма оформления заказа',
	'content' => $content
]);

function createOrder($params) {

	$content = '';

	// Если пользователь не авторизован, отправим на страницу входа
	if(empty($_SESSION['user'])) {
		header('Location: /login.php');
	}

	// получим код пользователя для запросов
	$userId = (int)$_SESSION['user']['id'];

	// проверим наличие товаров в корзине
	$basket = $_COOKIE['Basket'];
	if( empty($basket) ) {
		$content .= "Ваша корзина пока пуста!";
		return $content;
	}

	// получить список товаров и цен
	$ids = array_keys($basket);
	$goods = getGoodsByIds($ids);
	//var_dump($goods);

	// создать новый заказ
	$address = $params['address'];
	$sql = "INSERT INTO `orders` (`userId`,`address`) VALUES ('$userId','$address')";
	
	$orderId = insert($sql);
	//$orderId = 1;

	// проврить полученный ответ, если ошибка прервать дальнее выполнение
	if(!$orderId) {
		$content .= 'Что-то пошло не так при создании заказа';
		return $content;
	}

	$sqldata = [];
	foreach($goods as $good)	 {
		$productId = (int)$good['id'];
		$amount = $basket[$good['id']];
		$price = $good['price'];
		$sqldata[] = "($orderId,$productId,$amount,$price)";
	}

	$sqlvalues = implode(', ', $sqldata);
	$sql = "INSERT INTO `orderproducts` (`orderId`,`productId`,`amount`,`price`) VALUES $sqlvalues";

	if(execQuery($sql)) {
		$content .= "Заказ успешно создан, номер вашего заказ: $orderId<br>";
		foreach($basket as $id => $value) {
			setcookie("Basket[$id]", null);
		}
	}
	else {
		$content .= "Произошла ошибка при размещении заказа $orderId<br>";
	}

	return $content;
}

function renderCreateOrder($params) {
	$content = "";

	return render(TEMPLATES_DIR . 'createOrder.tpl', $params);
}
