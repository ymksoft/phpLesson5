<?php

require_once __DIR__ . '/../config/config.php';

$goodsContent = "";
if(isset($_SESSION['login'])) {
	$goodsContent = 'Привет, ' . $_SESSION['login'] . '<hr>';
}

$goods = getGoods();
$goodsContent .= renderGoods($goods, "goodsList.tpl");

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Магазин',
	'h1' => 'Товары',
	'content' => $goodsContent
]);
