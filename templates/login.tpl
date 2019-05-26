<form method="POST">
	Логин:<br>
	<input type="text" name="login" value="{{LOGIN}}"><br>
	Пароль:<br>
	<input type="password" name="pass" value="{{PASS}}"><br>
	<br>
	<input type="submit" name="enter">
</form>

<hr>
<div class="message"></div>
<div>
<p>Логин: <input type="text" name="logindiv"/></p>
<p>Пароль: <input type="password" name="password"/></p>
<button onclick="login()">Войти</button>
</div>

<hr>