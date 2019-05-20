<?php

require_once __DIR__ . '/../config/config.php';

$messages = 'Вход в магазин: ';

if( isset($_POST['enter']) ) {

	$login = isset($_POST['login']) ? $_POST['login'] : '';
	$pass = isset($_POST['pass']) ? $_POST['pass'] : '';

	if ($login && $pass) {
		$result = checkUser($login, $pass);
		if ($result) { 
			$messages .= "Добро пожаловать! " . $login;
			//var_dump();
			$_SESSION['login'] = $result['login'];
			$_SESSION['id'] = $result['id'];
			$_SESSION['email'] = $result['email'];
			$content .= '<br><a href="/basket.php">Перейти в кабинет</a><br>';
			$content .= '<br><a href="/index.php">Перейти к покупкам</a><br>';
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
