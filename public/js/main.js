
// обработчик onclick="addToBasket({{ID}})"
function addToBasket(id) {
    const $cnt = $('.message');
    $.post({
        url: '/api.php',
        data: {
            apiMethod: 'addToBasket',
            postData: {
                id: id,
            },
        },
        success: function (data) {
            if( data === 'OK' ) {
                $cnt.text("Товар добавлен в корзину!");
                setTimeout( function() {
                    $cnt.html("&nbsp");
                },2000);
            }
            else {
                alert(data);
            }
        }
    })
}

// обработчик onclick="deleteFromBasket({{ID}})"
function deleteFromBasket(id) {
    $.post({
        url: '/api.php',
        data: {
            apiMethod: 'deleteFromBasket',
            postData: {
                id: id,
            },
        },
        success: function (data) {
            if( data === 'OK' ) {
                // что-то правим в DOM
                alert('уменьшено кол-во товара в корзине');
            }
            else {
                alert(data);
            }
        }
    })
}

// обработчик onclick="removeFromBasket({{ID}})"
function removeFromBasket(id) {
    $.post({
        url: '/api.php',
        data: {
            apiMethod: 'removeFromBasket',
            postData: {
                id: id,
            },
        },
        success: function (data) {
            if( data === 'OK' ) {

                $('[data-amount="0"]').text(
                    Math.floor($('[data-amount="0"]').text()) -
                    Math.floor($('[data-amount="' + id + '"]').text())
                );

                $('[data-sum="0"]').text(
                    Math.floor($('[data-sum="0"]').text()) -
                    Math.floor($('[data-sum="' + id + '"]').text())
                );

                $('[data-id="' + id + '"]').remove();
                //alert('Товар удален из корзине');
            }
            else {
                alert(data);
            }
        }
    })
}

// обработчик авторизации onclick="login({{ID}})"
function login() {
    
    // ссылка на объекты
    const $login_input = $('[name="logindiv"]');
    const $password_input = $('[name="password"]');

    // получаем значения
    const login    = $login_input.val();
    const pass     = $password_input.val();

    // обмен сообщениями с пользователем через div class message
    const $messageRef = $('.message');

    $.post({
        url: '/api.php',
        data: {
            apiMethod: 'login',
            postData: {
                login: login,
                pass: pass,
            },
        },
        success: function (data) {
            if( data === 'OK' ) {
                //$messageRef.text("Вы успешно вошли в магазин!");
                location.reload();
            }
            else {
                $messageRef.text(data);
            }
        }
    })
}
