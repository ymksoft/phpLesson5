<?php

require_once __DIR__ . '/../config/config.php';

$newsContent = "TODO";

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Магазин',
	'h1' => 'Товары',
	'content' => $newsContent
]);
