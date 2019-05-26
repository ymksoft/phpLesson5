<?php

require_once __DIR__ . '/../config/config.php';

$content = "";
if(isset($_SESSION['user'])) {
	$content = 'Всего доброго, ' . $_SESSION['user']['login'] . '<hr>';
	unset($_SESSION['user']);
}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Магазин',
	'h1' => 'Вы завершили сессию',
	'content' => $content
]);
