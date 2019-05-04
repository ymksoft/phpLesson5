<?php


function render($file, $variables = [])
{
	if (!is_file($file)) {
		echo 'Template file "' . $file . '" not found';
		exit();
	}

	if (filesize($file) === 0) {
		echo 'Template file "' . $file . '" is empty';
		exit();
	}


	$templateContent = file_get_contents($file);

	foreach ($variables as $key => $value) {
		if (!is_string($value)) {
			continue;
		}

		$key = '{{' . strtoupper($key) . '}}';
		$templateContent = str_replace($key, $value, $templateContent);
	}

	return $templateContent;
}


function createGallery($imgDir) {
	$result = '';

	$images = scandir(WWW_DIR . $imgDir);


	foreach ($images as $image) {
		if(is_file(WWW_DIR . $imgDir . $image)) {
			$result .= render(TEMPLATES_DIR . 'galleryItem.tpl', [
				'src' => $imgDir . $image
			]);
		}
	}
	return $result;
}

function getGallery()
{
	$sql = "SELECT * FROM images ORDER BY `images`.`views` DESC";
	return getAssocResult($sql);
}

function updateGalleryCount($id, $newViewCount)
{
	$sqlViewCount = 'UPDATE `images` SET `views` = '.$newViewCount.' WHERE `images`.`id` = '.$id;
	execQuery($sqlViewCount);
}

function renderGallery($images, $templateFile)
{
	$imagesContent = '';
	foreach ($images as $imagesItem) {
		if (empty($imagesItem['url'])) {
			$imagesItem['url'] = 'img/no-image.jpeg';
		}
		if(!is_file($imagesItem['url'])) {
			$imagesItem['url'] = 'img/no-image.jpeg';
		}
		$imagesContent .= render(TEMPLATES_DIR . $templateFile, $imagesItem );
	}
	return $imagesContent;
}