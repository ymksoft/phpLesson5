<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Калькулятор</title>
</head>
<body>

<?php

    if(isset($_POST['calc'])) {
        $a = isset($_POST['a']) ? htmlspecialchars($_POST['a']) : 0;
        $b = isset($_POST['b']) ? htmlspecialchars($_POST['b']) : 0;
        $operation = htmlspecialchars($_POST['calc']);
        $result = isset($_POST['result']) ? htmlspecialchars($_POST['result']) : 0;

        switch($operation) {
            case '+':
                $result = $a + $b;
                break;
            case '-':
                $result = $a - $b;
                break;
            case '*':
                $result = $a * $b;
                break;
            case '/':
                $result = $b <> 0 ? $a / $b : 'division by zero';
                break;
            default:
                $result = null;
                break;
        }
    }
?>

<h1>Калькулятор</h1>
<p>Используем POST и выбор операции кнопочками</p>

<form method="POST" action="">
	<input name="a" type="number" style="width: 60px" value="<?=$a?>">
	<input type="submit" value="+" name="calc">
    <input type="submit" value="-" name="calc">
    <input type="submit" value="*" name="calc">
    <input type="submit" value="/" name="calc">
	<input name="b" type="number" style="width: 60px" value="<?=$b?>">
	<b><?=$result?></b>
</form>

<br><br><a href="/index.php">на главную</a>

</body>
</html>

