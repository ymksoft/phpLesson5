<?php

require_once __DIR__ . '/../config/config.php';

$Content = "";
if(isset($_SESSION['login'])) {
	$Content = 'Всего доброго, ' . $_SESSION['login'] . '<hr>';
	unset($_SESSION['login']);
}
if(isset($_SESSION['id'])) {
	unset($_SESSION['id']);
}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Магазин',
	'h1' => 'Вы завершили сессию',
	'content' => $Content
]);
