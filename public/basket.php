<?php

require_once __DIR__ . '/../config/config.php';

$Content = "";
if(isset($_SESSION['login'])) {
	$Content .= 'Здраствуйте, ' . $_SESSION['login'] . '<br>';
	$Content .= 'Ваш EMail: ' . $_SESSION['email'] . '<br>';
	$Content .= 'Ваш ID: ' . $_SESSION['id'] . '<br>';
}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Магазин',
	'h1' => 'Личный кабинет',
	'content' => $Content
]);
