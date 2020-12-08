$(function () {
    // Токен
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        cache: false
    });

// Добавление товаров в корзину со страницы продуктов
    $(document).on("click", '#btn-buy', function () {
        var product_id = $('#product_id').val();
        var count = $('#valCount').val();
        $.ajax({
            url: '/buyCart',
            method: 'POST',
            data: {
                "product_id": product_id,
                "count": count,
            },
            error: function (xhr, status, error) {
                var errors = xhr.responseJSON.errors, errorMessage = "";
                $.each(errors, function (index, value) {
                    $.each(value, function (key, message) {
                        errorMessage += message + " ";
                    })
                })
                $('#btn-buy').attr("disabled", false);
                Swal.fire({
                    icon: 'error',
                    title: errorMessage,
                    showConfirmButton: true,
                })
            },
            success: function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Товар добавлен в корзину',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
    })
});

// Добавление товаров в корзину с главной страницы
$(document).on("click", '#btn-buyHome', function () {
    var product_id = $(this).val();
    var count = 1;
    $.ajax({
        url: '/buyCartHome',
        method: 'POST',
        data: {
             "product_id": product_id,
             "count": count,
        },
        error: function (xhr, status, error) {
            var errors = xhr.responseJSON.errors, errorMessage = "";
            $.each(errors, function (index, value) {
                $.each(value, function (key, message) {
                    errorMessage += message + " ";
                })
            })
            $('#btn-buyHome').attr("disabled", false);
            Swal.fire({
                icon: 'error',
                title: errorMessage,
                showConfirmButton: true,
            })
        },
        success: function () {
            Swal.fire({
                icon: 'success',
                title: 'Товар добавлен в корзину',
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
});

// Удаление товара из корзины
$(document).on("click", '#btn-del', function () {
    var product_id = $(this).val();
    // console.log($(this).val());
    $.ajax({
        url: '/delCart', method: 'POST',
        data: {
            "product_id": product_id,
         },
        error: function (xhr, status, error) {
            var errors = xhr.responseJSON.errors, errorMessage = "";
            $.each(errors, function (index, value) {
                $.each(value, function (key, message) {
                    errorMessage += message + " ";
                })
            })
            $('#btn-del').attr("disabled", false);
            Swal.fire({
                icon: 'error',
                title: errorMessage,
                showConfirmButton: true,
            })
        },
        success: function () {
            Swal.fire({
                icon: 'success',
                title: 'Товар удален из корзины',
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
});


//counter
$(document).ready(function () {
    $('.minus .down').click(function () {
        var $input = $(this).parent().find('input');
        console.log($input);
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.up').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});

//табы
function openTabs(evt, tabsName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabsName).style.display = "block";
    evt.currentTarget.className += " active";
}


//нова пошта
$(document).ready(function () {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'https://api.novaposhta.ua/v2.0/json/',
        data: JSON.stringify({
            modelName: 'Address',
            calledMethod: 'searchSettlements',
            methodProperties: {
                CityName: 'ки',
                Limit: 555
            },
            apiKey: '3290bef07476a0a0d06726d54cec7d34'
        }),
        headers: {
            'Content-Type': 'application/json'
        },
        xhrFields: {
            withCredentials: false
        },
        success: function(texts) {
            console.log(texts);
        },
    });

});
