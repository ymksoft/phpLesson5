<?php

require_once __DIR__ . '/../config/config.php';

$messages = 'Регистрация пользователя: ';

if( isset($_POST['register']) ) {

	$login = isset($_POST['login']) ? $_POST['login'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$pass = isset($_POST['pass']) ? $_POST['pass'] : '';

	if ($login && $email && $pass) {
		if (insertUser($login, $email, $pass)) { 
			$messages .= "Пользователь добавлен!";
			$login = "";
			$email = "";	
			$pass = "";
			$content = '<br><a href="/login.php">Войти в магазин</a><br>';
		} else {
			$messages .= "Что-то пошло не так";
		}
	} else if(isset($_POST['login']) || isset($_POST['email']) || isset($_POST['pass']) ) {
		if (!$login) {
			$messages .= "Введите логин<br>";
		}
		if (!$email) {
			$messages .= "Введите email<br>";
		}
		if (!$pass) {
			$messages .= "Введите пароль<br>";
		}
	}
	if(!$content) {
		$content = renderRegisterForm( array(
			'LOGIN' => $login, 
			'EMAIL' => $email, 
			'PASS' => $pass
			) );
	}

}
else {
	$content = renderRegisterForm( array('LOGIN' => "", 'EMAIL' => "", 'PASS' => "" ) );
}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Регистрация в магазине',
	'h1' => $messages,
	'content' => $content
]);
