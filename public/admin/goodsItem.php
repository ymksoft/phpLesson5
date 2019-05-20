<?php

require_once __DIR__ . '/../../config/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : false;

if(!$id) {
	echo 'id не передан';
	exit();
}

$messages = "";

if(isset($_POST['update'])) {
	
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$description = isset($_POST['description']) ? $_POST['description'] : '';
	$price = isset($_POST['price']) ? $_POST['price'] : 0;
	$isactive = isset($_POST['isactive']) ? $_POST['isactive'] : 1;

	$messages = 'Редактирование товара: ';

	if ($name && $description) {
		if (updateGoods($id, $name, $description, $price, $isactive)) { 
			$messages .= "товар изменен";
		} else {
			$messages .= "Что-то пошло не так";
		}
	} else if(isset($_POST['name']) || isset($_POST['description'])) {
		if (!$name) {
			$messages .= "Введите название товара<br>";
			$name = $review['name'];
		}
		if (!$description) {
			$messages .= "Введите описание товара<br>";
			$description = $review['description'];
		}
	}
	$messages .= "<br>";
}

$sql = "SELECT * FROM products WHERE id = $id";

$goodsItem = showForRender($sql);

if(!$goodsItem) {
	echo "404";
	die;
}

$goodsContent = renderGallery($goodsItem, "admin_goodsItem.tpl");

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => $goodsItem[0]['name'],
	'content' => $messages . $goodsContent,
	'h1' => $goodsItem[0]['name']
]);

