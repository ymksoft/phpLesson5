<?php

require_once __DIR__ . '/../../config/config.php';

$goods = getGoodsAdmin();
$goodsContent = renderGoods($goods, "admin_goodsList.tpl");

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Магазин',
	'h1' => 'Админка / Товары',
	'content' => $goodsContent
]);
