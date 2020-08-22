$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var _token = $("input[name='_token']").val();


    $('.mobile-qty-increase').click(function (event) {
        event.preventDefault();
        var qtyInput = $(this).parent().find(".cart-qty-input-value");
        var product_id = qtyInput.attr("id");
        qtyInput.val(+qtyInput.val()+1)
        updateCart(product_id, qtyInput.val());
    });

    $('.mobile-qty-decrease').click(function (event) {
        event.preventDefault();
        var qtyInput = $(this).parent().find(".cart-qty-input-value");
        if (qtyInput.val() <= 1)
        {
            qtyInput.val(1);
        }else{
            qtyInput.val(+qtyInput.val() - 1);
            var product_id = qtyInput.attr("id");
            updateCart(product_id, qtyInput.val());
        }
    });

    function updateCart(id, qty)
    {
        $.ajax({
            url: "/cart/update",
            type: 'POST',
            data: { _token: _token, id: id, qty:qty },
            dataType: 'json',
            success: function (response) {
                updateProductPrice(id, response.price);
                updateSubTotal(response.total);
            }
        });
    }

    function updateProductPrice(id, price)
    {
        $('#cart-product-total-price-'+id).html('');
        $('#cart-product-total-price-'+id).append(price);
    }

    function updateSubTotal(price)
    {
        $('#cartSubTotal').html('');
        $('#cartSubTotal').append(price);
        cartTotal(price);
    }

    function cartTotal(price)
    {
        $('#cartTotal').html('');
        $('#cartTotal').append(price);
    }
});


