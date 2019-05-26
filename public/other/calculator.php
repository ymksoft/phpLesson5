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

    $a = isset($_GET['a']) ? htmlspecialchars($_GET['a']) : 0;
    $b = isset($_GET['b']) ? htmlspecialchars($_GET['b']) : 0;
    $operation = isset($_GET['operation']) ? htmlspecialchars($_GET['operation']) : 'plus';
    $result = isset($_GET['result']) ? htmlspecialchars($_GET['result']) : 0;

    switch($operation) {
        case 'plus':
            $result = $a + $b;
            break;
        case 'minus':
            $result = $a - $b;
            break;
        case 'mult':
            $result = $a * $b;
            break;
        case 'div':
            $result = $b <> 0 ? $a / $b : 'division by zero';
            break;
        default:
            $result = null;
            break;
    }
?>

<h1>Калькулятор</h1>
<p>Используем GET и выбор через select</p>

<form method="GET">
	<input name="a" type="number" style="width: 60px" value="<?=$a?>">
	<select name="operation" style="width: 60px">
		<option <? if($operation=='plus') echo "selected" ?> value="plus">+</option>
        <option <? if($operation=='minus') echo "selected" ?> value="minus">-</option>
        <option <? if($operation=='mult') echo "selected" ?> value="mult">*</option>
        <option <? if($operation=='div') echo "selected" ?> value="div">/</option>
	</select>
	<input name="b" type="number" style="width: 60px" value="<?=$b?>">
	<input type="submit" value="=" name="calc">
	<b><?=$result?></b>
</form>

<br><br><a href="/index.php">на главную</a>

</body>
</html>

