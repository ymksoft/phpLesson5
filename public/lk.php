<?php

require_once __DIR__ . '/../config/config.php';

$Content = "";
if(isset($_SESSION['user'])) {
	$Content .= 'Здраствуйте, ' . $_SESSION['user']['login'] . '<br>';
	$Content .= 'Ваш EMail: ' . $_SESSION['user']['email'] . '<br>';
	$Content .= 'Ваш ID: ' . $_SESSION['user']['id'] . '<br>';
	$Content .= '<a href="/logout.php">Выйти</a><br>';

	$orders = getOrder($_SESSION['user']['id']);
	$Content .= renderOrders($orders);
}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Магазин',
	'h1' => 'Личный кабинет',
	'content' => $Content
]);

function getOrder($id)
{
	$id = (int)$id;
	$sql = "SELECT * FROM orders WHERE `userId` = '$id' ORDER BY `orders`.`id` DESC";
	return getAssocResult($sql);
}

function renderOrders($orders)
{
	$content = '';
	foreach ($orders as $orderItem) {
		$content .= render(TEMPLATES_DIR . 'orderItem.tpl', $orderItem);
	}
	return $content;
}
