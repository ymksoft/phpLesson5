<div class="goods-item">
    <img src="/../{{IMAGE}}" alt="{{NAME}}" style="max-width: 100px; max-height: 100px"/>
	<div>{{NAME}}</div>
    <div>{{DESCRIPTION}}</div>
    <div>Цена: {{PRICE}}</div>
</div>
<hr>
<form method="POST">
	Наименование:<br>
	<input type="text" name="name" value="{{NAME}}"><br>
    Описание:<br>
    <input type="text" name="description" value="{{DESCRIPTION}}"><br>
    Цена:<br>
    <input type="text" name="price" value="{{PRICE}}"><br>
    Отображение:<br>
    <input type="text" name="isactive" value="{{ISACTIVE}}"><br>
	<br>
	<input type="submit" name="update">
</form>
