<?php

require_once __DIR__ . '/../config/config.php';

$Content = "";
if(isset($_SESSION['user'])) {
	$Content .= 'Здраствуйте, ' . $_SESSION['user']['login'] . '<br>';
	$Content .= 'Ваш EMail: ' . $_SESSION['user']['email'] . '<br>';
	$Content .= 'Ваш ID: ' . $_SESSION['user']['id'] . '<br>';
	$Content .= '<a href="/logout.php">Выйти</a><br>';
}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Магазин',
	'h1' => 'Личный кабинет',
	'content' => $Content
]);
