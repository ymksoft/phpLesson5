<?php

require_once __DIR__ . '/../config/config.php';

$id = isset($_GET['id']) ? $_GET['id'] : false;

if (!$id) {
	echo '404';
	exit();
}

$author = isset($_POST['author']) ? $_POST['author'] : '';
$text = isset($_POST['text']) ? $_POST['text'] : '';
$messages = 'Редактирование комментария: ';

if ($author && $text) {
	if (updateReview($id, $author, $text)) { 
		$messages .= "Комментарий изменен";
	} else {
		$messages .= "Что-то пошло не так";
	}
} else {
	if (!$author) {
		$messages .= "Введите имя<br>";
		$author = $review['author'];
	}
	if (!$text) {
		$messages .= "Добавьте Комментарий<br>";
		$text = $review['text'];
	}
}

$review = showReview($id);

if (!$review) {
	echo '404';
	exit();
}

$reviewsContent = renderReviewsForm( $review );

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Комментарии',
	'h1' => $messages,
	'content' => $reviewsContent
]);
