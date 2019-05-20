<?php

function renderRegisterForm($param)
{
	return render(TEMPLATES_DIR . 'register.tpl', $param);
}

function renderLoginForm($param)
{
	return render(TEMPLATES_DIR . 'login.tpl', $param);
}

function insertUser($login, $email, $pass) 
{
	$link = createConnection();

	$login = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($login)));
	$email = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($email)));
	$pass = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($pass)));

	$pass = md5( $pass . $secure_key );

	$sql = "INSERT INTO `users`(`login`, `email`, `pass`) VALUES ('$login', '$email', '$pass')";

	$result = mysqli_query($link, $sql);
	
	mysqli_close($link);
	return $result;
}

function checkUser($login, $pass) 
{
	$link = createConnection();

	$login = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($login)));
	$pass = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($pass)));

	$pass = md5( $pass . $secure_key );

	$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'";

	$result = mysqli_query($link, $sql);
	$array_result = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$array_result[] = $row;
	}

	mysqli_close($link);
	return $array_result[0];
}