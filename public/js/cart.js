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
        let product_id = $('#product_id').val();
        let count = $('#count_products').val();
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
            let errors = xhr.responseJSON.errors, errorMessage = "";
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
        success: function (data) {
            // console.log(data.countAll)
            $('.table-container').html(data.html)
            $('.checkout-container').html(data.html_for_checkout)
            $('.countAll-container').html(data.countAll)
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
$(document).on("click", '.btn-del', function () {
    var product_id = $(this).val();
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
        success: function (data) {
            $('.table-container').html(data.html)
            $('.checkout-container').html(data.html_for_checkout)
            $('.countAll-container').html(data.countAll)
            Swal.fire({
                icon: 'success',
                title: 'Товар удален из корзины',
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
});

// Изменение количества товаров "Плюс" и "Минус"
$(document).ready(function() {
    // $('body').on('click', '.plusik', function() {
    $(".plusik").click(function() {
        let cart_id = $(this).attr('id');
        let count = parseInt ($("#valCount_" + cart_id).val()) + 1;

        $.ajax({
            url: '/plus_count',
            method: 'POST',
            data: {
                "product_id": cart_id,
                "count": count,
            },
            error: function () {

            },
            success: function (data) {
                $('.countAll-container').html(data.countAll)
                $('.sumAll-container').html(data.sumAll)
                $('.sumAll-delivery-container').html(data.sumAll + 40)
                let price = ($(".price_" + cart_id).val());
                let new_price = ($(".new_price_" + cart_id).val());
                if (new_price) {
                    $('.old_cost_with_sale_' + cart_id ).html(count * price);
                    $('.price_' + cart_id ).html(count * new_price);
                } else {
                    $('.price_' + cart_id ).html(count * price);
                }
            }
        })
    });

    $(".minusik").click(function() {
        let cart_id = $(this).attr('id');
        let count = parseInt ($("#valCount_" + cart_id).val());
        if (count >= 2) {
            count = count - 1;
        }

        $.ajax({
            url: '/minus_count',
            method: 'POST',
            data: {
                "product_id": cart_id,
                "count": count,
            },
            error: function () {

            },
            success: function (data) {
                $('.countAll-container').html(data.countAll)
                $('.sumAll-container').html(data.sumAll)
                $('.sumAll-delivery-container').html(data.sumAll + 40)
                let price = ($(".price_" + cart_id).val());
                let new_price = ($(".new_price_" + cart_id).val());
                if (new_price) {
                    $('.old_cost_with_sale_' + cart_id ).html(count * price);
                    $('.price_' + cart_id ).html(count * new_price);
                } else {
                    $('.price_' + cart_id ).html(count * price);
                }
            }
        })
    });
});

// Изменение количества товаров "Плюс" и "Минус" со страницы SetCheck
$(document).ready(function() {
    // $('body').on('click', '.plusik', function() {
    $(".plus_prod").click(function() {
        let cart_id = $(this).attr('id');
        let count = parseInt ($("#valCount" + cart_id).val()) + 1;

        $.ajax({
            url: '/plus_count',
            method: 'POST',
            data: {
                "product_id": cart_id,
                "count": count,
            },
            error: function () {

            },
            success: function (data) {
                $('.countAll-container').html(data.countAll)
                $('.sumAll-container').html(data.sumAll)
                $('.sumAllSale-container').html(data.sumAllSale)
                let price = ($(".price_" + cart_id).val());
                let new_price = ($(".new_price_" + cart_id).val());
                if (new_price) {
                    $('.old_cost_with_sale_' + cart_id ).html(count * price);
                    $('.price_' + cart_id ).html(count * new_price);
                } else {
                    $('.price_' + cart_id ).html(count * price);
                }
            }
        })
    });

    $(".minus_prod").click(function() {
        let cart_id = $(this).attr('id');
        let count = parseInt ($("#valCount" + cart_id).val());
        if (count >= 2) {
            count = count - 1;
        }

        $.ajax({
            url: '/minus_count',
            method: 'POST',
            data: {
                "product_id": cart_id,
                "count": count,
            },
            error: function () {

            },
            success: function (data) {
                $('.countAll-container').html(data.countAll)
                $('.sumAll-container').html(data.sumAll)
                $('.sumAllSale-container').html(data.sumAllSale)
                let price = ($(".price_" + cart_id).val());
                let new_price = ($(".new_price_" + cart_id).val());
                if (new_price) {
                    $('.old_cost_with_sale_' + cart_id ).html(count * price);
                    $('.price_' + cart_id ).html(count * new_price);
                } else {
                    $('.price_' + cart_id ).html(count * price);
                }
            }
        })
    });
});

// Оформление товаров со страницы setCheck
$(document).on("click", '#check', function () {
    let phone = $('#phone').val();
    let name = $('#name').val();
    let LastName = $('#LastName').val();
    let region = $('#region').val();
    let cities = $('#cities').val();
    let department = $('#department').val();
    let not_call = $('#not_call_0').is(':checked');
    $.ajax({
        url: '/check',
        method: 'POST',
        data: {
            "phone": phone,
            "name": name,
            "LastName": LastName,
            "region": region,
            "cities": cities,
            "department": department,
            "order_type": 2,
            "not_call": not_call,
        },
        error: function (xhr, status, error) {
            var errors = xhr.responseJSON.errors, errorMessage = "";
            $.each(errors, function (index, value) {
                $.each(value, function (key, message) {
                    errorMessage += message + " ";
                })
            })
            $('#check').attr("disabled", false);
            Swal.fire({
                icon: 'error',
                title: errorMessage,
                showConfirmButton: true,
            })
        },
        success: function () {
            Swal.fire({
                icon: 'success',
                title: 'Товар оформлен, спасибо за покупку!',
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
});

// Оформление товаров со страницы setCheck с модалки "Оформить в 1 клик"
$(document).on("click", '#checkModalOneClick', function () {
    let phone = $('#phoneModal').val();
    let name = $('#nameModal').val();

    $.ajax({
        url: '/checkModalOneClick',
        method: 'POST',
        data: {
            "phone": phone,
            "name": name,
            "order_type": 1,
        },
        error: function (xhr, status, error) {
            var errors = xhr.responseJSON.errors, errorMessage = "";
            $.each(errors, function (index, value) {
                $.each(value, function (key, message) {
                    errorMessage += message + " ";
                })
            })
            $('#checkModalOneClick').attr("disabled", false);
            Swal.fire({
                icon: 'error',
                title: errorMessage,
                showConfirmButton: true,
            })
        },
        success: function () {
            Swal.fire({
                icon: 'success',
                title: 'Спасибо за покупку, с Вами свяжется наш оператор!',
                showConfirmButton: true,
                timer: 1500
            });
            $('#modalOneClick').modal('hide')

            $.ajax({
                url:'/session_destroy',
                type: "POST",
                success:function() {
                    window.location.replace("/");
                }
            })
        }
    })
});

//counter
$(document).ready(function () {
    $('.down').click(function () {
        var $input = $(this).parent().find('input');
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

$(document).ready(function () {
    $('#cities').keyup(function () {
        let cities = $('#cities').val();
        let region = $('#region').val();
        $.ajax({
            url: '/checkout', method: 'POST',
            data: {
                "cities": cities,
                "region": region,
            },
            error: function (xhr, status, error) {

            },
            success: function (response) {
                console.log(response)
                if( response.data.data.length != null) {
                    $("#department").empty();
                    response.data.data.forEach((item) => {
                        $("#department").prepend('<option>'  + item.ShortAddressRu + ' '  + '</option>');
                    })
                }
            }
        })
    })
});
