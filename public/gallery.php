<?php

require_once __DIR__ . '/../config/config.php';

$gallery = getGallery();
$galleryContent = renderGallery($gallery, "galleryList.tpl");

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Галерея',
	'h1' => 'Лучшие картиночки',
	'content' => $galleryContent
]);

