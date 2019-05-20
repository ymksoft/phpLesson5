<?php

require_once __DIR__ . '/../config/config.php';

$author = isset($_POST['author']) ? $_POST['author'] : '';
$text = isset($_POST['text']) ? $_POST['text'] : '';
$messages = 'Комментарии пользователей: ';

if ($author && $text) {
	if (createReview($author, $text)) {
		$messages .= "Комментарий добавлен!";
		$author = '';
		$text = '';
	} else {
		$messages .= "Что-то пошло не так!";
	}
} else {
	if (!$author) {
		$messages .= "Введите имя!";
	}
	if (!$text) {
		$messages .= "Добавьте Комментарий!";
	}
}

$reviews = getReviews();
$reviewsContent = renderReviews($reviews);

$reviewsContent .= renderReviewsForm( array('author' => "", 'text' => ""));

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Комментарии',
	'h1' => $messages,
	'content' => $reviewsContent
]);

?>


