<?php

function getGoods()
{
	$sql = "SELECT * FROM products WHERE `products`.`isActive` = 1 ORDER BY `products`.`id`";
	return getAssocResult($sql);
}

function getGoodsAdmin()
{
	$sql = "SELECT * FROM products ORDER BY `products`.`id`";
	return getAssocResult($sql);
}

function getGoodsByIds($ids) 
{
	$sql = "SELECT * FROM `products` WHERE `id` IN (" . implode(', ', $ids) . ")";
	return getAssocResult($sql);
}

function updateGoods($id, $name, $description, $price, $isactive) 
{
	$link = createConnection();

	$id = (int)$id;
	$name = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($name)));
	$description = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($description)));
	$price = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($price)));
	$isactive = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($isactive)));
	
	$sql = "UPDATE `products` SET `name` = '$name', `description` = '$description', `price` = '$price', `isActive` = '$isactive', `dateChange` = NOW() WHERE `products`.`id` = $id";

	$result = mysqli_query($link, $sql);

	mysqli_close($link);
	return $result;
}

function renderGoods($goods, $templateFile)
{
	$goodsContent = '';
	foreach ($goods as $good) {
		if (empty(WWW_DIR . $good['image'])) {
			$good['image'] = WWW_DIR . 'img/no-image.jpeg';
		}
		if(!is_file(WWW_DIR . $good['image'])) {
			$good['image'] = WWW_DIR . 'img/no-image.jpeg';
		}
		$goodsContent .= render(TEMPLATES_DIR . $templateFile, $good );
	}
	return $goodsContent;
}

