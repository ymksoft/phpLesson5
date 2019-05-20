<?php

require_once __DIR__ . '/../config/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

if(!$id) {
	echo 'id не передан';
	exit();
}

$sql = "SELECT * FROM products WHERE id = $id";

$goodsItem = showForRender($sql);

if(!$goodsItem) {
	echo "404";
	die;
}

$goodsContent = renderGallery($goodsItem, "goodsItem.tpl");

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => $goodsItem[0]['name'],
	'content' => $goodsContent,
	'h1' => $goodsItem[0]['name']
]);

