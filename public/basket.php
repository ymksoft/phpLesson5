<?php

require_once __DIR__ . '/../config/config.php';

$content = renderBacket($_COOKIE['Basket']);

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Корзина',
	'h1' => 'Список товаров в корзине',
	'content' => $content
]);


function renderBacket($basket) {
	$content = "";

	if( empty($basket) ) {
		$content .= "Ваша корзина пока пуста!<br>";
		return $content;
	}

	$ids = array_keys($basket);
	$goods = getGoodsByIds($ids);

	$totalAmount = 0;
	$totalPrice = 0;
	foreach($goods as $good)	 {
		$amount = $basket[$good['id']];
		$price = $good['price'];
		$sum = $price * $amount;
		$content .= render(TEMPLATES_DIR . 'basketListItem.tpl', [
			'name' => $good['name'],
			'id' => $good['id'],
			'amount' => strval( $amount ),
			'price' => strval( $good['price'] ),
			'sum' => strval( $sum )
		]);
		$totalAmount += $amount;
		$totalPrice += $sum;
	}

	return render(TEMPLATES_DIR . 'basketList.tpl', [
		'amount' => strval( $totalAmount ),
		'sum' => strval ($totalPrice ),
		'content' => $content,
		'order' => empty($_SESSION['user']) 
			? '<a href="/login.php">Войти</a>'
			: '<a href="/createOrder.php">Оформить заказ</a>'
	]);;
}
