<?php

function getReviews()
{
	$sql = "SELECT * FROM reviews";
	return getAssocResult($sql);
}

function showReview($id)
{
	$id = (int)$id;
	$sql = "SELECT * FROM reviews WHERE id = $id";
	$reviews = getAssocResult($sql);
	if (!$reviews) {
		return null;
	}
	return $reviews[0];
}

function renderReviews($reviews)
{
	$Content = '';
	foreach ($reviews as $review) {
		$Content .= render(TEMPLATES_DIR . 'reviews.tpl', $review);
	}
	return $Content;
}

function renderReviewsForm($review)
{
	return render(TEMPLATES_DIR . 'reviewsform.tpl', $review);
}

function createReview($author, $text)
{
	$link = createConnection();

	$author = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($author)));
	$text = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($text)));

	$sql = "INSERT INTO `reviews`(`author`, `text`) VALUES ('$author', '$text')";

	$result = mysqli_query($link, $sql);

	mysqli_close($link);
	return $result;
}

function updateReview($id, $author, $text)
{
	$link = createConnection();

	$id = (int)$id;
	$author = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($author)));
	$text = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($text)));

	$sql = "UPDATE `reviews` SET `author`='$author',`text`='$text' WHERE `id` = $id";

	$result = mysqli_query($link, $sql);

	mysqli_close($link);
	return $result;
}