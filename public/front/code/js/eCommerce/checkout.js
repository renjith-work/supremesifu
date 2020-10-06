$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var _token = $("input[name='_token']").val();


    $(document).on('click', '.spc-add-edit-a', function (event) {
        event.preventDefault();
        var id = $(this).attr('href');
        var input_name = '';
        if(id == 1){
            input_name = 'spc-add-inp-billing';
            loadChangeAddressModal(input_name);
        }else if(id == 2){
            input_name = 'spc-add-inp-shipping';
            loadChangeAddressModal(input_name);
        }
    });
    
    function loadChangeAddressModal(input_name)
    {
        $('#spc-add-table > tbody').html('');
        var label = '';
        $.ajax({
            url: "front/api/user/addresses",
            type: 'POST',
            data: { _token: _token },
            dataType: 'json',
            success: function (response) {
                $('#changeAddress').modal('show');
                $.each(response, function (key, value) {
                    if(key == 'billing_address'){
                        label = 'Default Billing Address';
                        loadAdddressInTable(value, label, input_name);
                    } else if (key == 'shipping_address') {
                        label = 'Default Shipping Address';
                        loadAdddressInTable(value, label, input_name);
                    } else if (key == 'others')
                    {
                        label = '';
                        loadOtherAddressInTable(value, label, input_name);
                    }
                });  
            }
        });
    }

    function loadOtherAddressInTable(response, label, input_name){
        $.each(response, function (key, value) {
            loadAdddressInTable(value, label, input_name)
        });
       
    }

    function loadAdddressInTable(address, label, input_name)
    {
        $('#spc-add-table > tbody').append('<tr class="spc-add-tab-body"><th><div class="add-tab-name">' + address.name + '</div></th><td>' + address.address + '</td><td>' + address.phone + '</td><td><span class="badge badge-light">' + label + '</span></td><td><div class="spc-add-tab-action"><input type="radio" name="address" class="' + input_name + '" value="' + address.id + '"></div></td></tr>');
    }



// Shipping Address management
    changeShippingAddress();
    function changeShippingAddress(){
        $(document).on('change', '.spc-add-inp-shipping', function (event) {
            event.preventDefault();
            var shippping_address_val = $(this).val();
            console.log(shippping_address_val);
            getShippingAddress(shippping_address_val);
        });
    }

    function getShippingAddress(id){
        $.ajax({
            url: "front/api/user/get-address",
            type: 'POST',
            data: { _token: _token, id: id},
            dataType: 'json',
            success: function (response) {
                updateShippingAddress(response);
                $('#changeAddress').modal('hide');
            }
        });
    }

    function updateShippingAddress(address)
    {
        $('#spc-shipping-address-body').html('');
        $('#spc-shipping-address-body').append('<div class="shpd-add-name">' + address.name + '</div><div class="shpd-add-add">' + address.address + '.</div>');
    }

// Billing Address management
    changeBillingAddress();
    function changeBillingAddress() {
        $(document).on('change', '.spc-add-inp-billing', function (event) {
            event.preventDefault();
            var shippping_billing_val = $(this).val();
            console.log(shippping_billing_val);
            getBillingAddress(shippping_billing_val);
        });
    }

    function getBillingAddress(id) {
        $.ajax({
            url: "front/api/user/get-address",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                updateBillingAddress(response);
                $('#changeAddress').modal('hide');
            }
        });
    }

    function updateBillingAddress(address) {
        $('#spc-billing-address-body').html('');
        $('#spc-billing-address-body').append('<div class="shpd-add-name">' + address.name + '</div><div class="shpd-add-add">' + address.address + '.</div>');
    }
});