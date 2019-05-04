<?php

require_once __DIR__ . '/../config/config.php';


//$news = getNews();
//$newsContent = renderNews($news);

$newsContent = "test";

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Новости',
	'h1' => 'Горячие новости',
	'content' => $newsContent
]);
