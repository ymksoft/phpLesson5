<?php

require_once __DIR__ . '/../config/config.php';

$messages = 'Вход в магазин: ';

if(isset($_SESSION['user'])) {
	// Если авторизация через AJAX onclick->login
	// редирект заработает с опцией output_buffering = on см phpinfo()
	header('Location: /lk.php');
	exit();
}

if( isset($_POST['enter']) ) {

	$login = isset($_POST['login']) ? $_POST['login'] : '';
	$pass = isset($_POST['pass']) ? $_POST['pass'] : '';

	if ($login && $pass) {
		$result = checkUser($login, $pass);
		if ($result) { 
			
			$_SESSION['user'] = $result;

			// редирект заработает с опцией output_buffering = on см phpinfo()
			header('Location: /lk.php');
			exit();

		} else {
			$messages .= "Что-то пошло не так";
		}
	} else if(isset($_POST['login']) || isset($_POST['pass'])) {
		$messages .= "Введите логин и пароль<br>";
	}
	if(!$content) {
		$content = renderLoginForm( array(
			'LOGIN' => $login, 
			'PASS' => $pass
			) );
	}

}
else {
	$content = renderLoginForm( array('LOGIN' => "", 'PASS' => "" ) );
}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Вход в магазин',
	'h1' => $messages,
	'content' => $content
]);
