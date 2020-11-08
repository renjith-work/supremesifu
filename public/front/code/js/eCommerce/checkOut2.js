$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var _token = $("input[name='_token']").val();


    // Address Managemenet Section

    var modal_address_type_id = '';
    //Create new Address
    $(document).on('click', '.spc-add-address', function (event) {
        event.preventDefault();
        var id = $(this).attr('href');
        console.log(id);
        loadAddAddressModal(id);
    });

    function loadAddAddressModal(address_type_id) {
        $('#addAddress').modal('show');
        modal_address_type_id = address_type_id;
        loadCountries();
    }

    function loadCountries() {
        $.ajax({
            url: "/front/api/user/addresses/countries",
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    $('#country').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    }

    $(document).on('change', '#country', function () {
        var country_id = $("#country").val();
        loadZones(country_id);
        loadMobileCodes(country_id);
    });

    function loadZones(id) {
        $('#zone').html('');
        $.ajax({
            url: "/user/country",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                $('#zone').append('<option disabled>Please select a zone..</option>')
                $.each(response, function (key, value) {
                    $('#zone').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    }

    $(document).on('click', '#submitAddress', function (event) {
        event.preventDefault();
        submitAddress();
    });

    function submitAddress() {
        var postAddress = collectAddForm();
        $('.modal-error').html("");
        $('.form-control').removeClass("is-invalid");
        $.ajax({
            url: "/front/api/user/addresses/save",
            type: 'POST',
            data: postAddress,
            dataType: 'json',
            success: function (response) {
                if (response.success == 0) {
                    if (response.errors) {
                        $.each(response.errors, function (key, value) {
                            $('#' + key).addClass("is-invalid");
                            $('#error_' + key).append(value[0]);
                        });
                    }
                } else if (response.success == 1) {
                    // console.log(response);
                    // console.log(modal_address_type_id);

                    if (modal_address_type_id == 1) {
                        $('#addAddress').modal('hide');
                        input_name = 'spc-add-inp-billing';
                        loadChangeAddressModal(input_name);
                    } else if (modal_address_type_id == 2) {
                        $('#addAddress').modal('hide');
                        input_name = 'spc-add-inp-shipping';
                        loadChangeAddressModal(input_name);
                    }
                }
            }
        });
    }

    function collectAddForm() {
        var addObj = {};
        addObj["_token"] = _token;
        addObj["first_name"] = $('#first_name').val();
        addObj["last_name"] = $('#last_name').val();
        addObj["email"] = $('#email').val();
        addObj["country"] = $('#country').val();
        addObj["phoneCode"] = $('#phoneCode').val();
        addObj["phone"] = $('#phone').val();
        addObj["zone"] = $('#zone').val();
        addObj["address"] = $('#address').val();
        addObj["city"] = $('#city').val();
        addObj["postcode"] = $('#postcode').val();
        return addObj;
    }

    function loadMobileCodes(id) {
        $('#phoneCode').html('');
        $.ajax({
            url: "/front/api/user/addresses/phone-code/find",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                $('#phoneCode').append('<option value="' + response.id + '">' + response.value + '</option>');
            }
        });
    }

    // Change Address
    $(document).on('click', '.spc-add-edit-a', function (event) {
        event.preventDefault();
        var id = $(this).attr('href');
        var input_name = '';
        if (id == 1) {
            input_name = 'spc-add-inp-billing';
            loadChangeAddressModal(input_name);
        } else if (id == 2) {
            input_name = 'spc-add-inp-shipping';
            loadChangeAddressModal(input_name);
        }
    });



    function loadChangeAddressModal(input_name) {
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
                    if (key == 'billing_address') {
                        label = 'Default Billing Address';
                        loadAdddressInTable(value, label, input_name);
                    } else if (key == 'shipping_address') {
                        label = 'Default Shipping Address';
                        loadAdddressInTable(value, label, input_name);
                    } else if (key == 'others') {
                        label = '';
                        loadOtherAddressInTable(value, label, input_name);
                    }
                });
            }
        });
    }

    function loadOtherAddressInTable(response, label, input_name) {
        $.each(response, function (key, value) {
            loadAdddressInTable(value, label, input_name)
        });

    }

    function loadAdddressInTable(address, label, input_name) {
        $('#spc-add-table > tbody').append('<tr class="spc-add-tab-body"><th><div class="add-tab-name">' + address.name + '</div></th><td>' + address.address + '</td><td>' + address.phone + '</td><td><span class="badge badge-light">' + label + '</span></td><td><div class="spc-add-tab-action"><input type="radio" name="address" class="' + input_name + '" value="' + address.id + '"></div></td></tr>');
    }



    // Shipping Address management
    changeShippingAddress();
    function changeShippingAddress() {
        $(document).on('change', '.spc-add-inp-shipping', function (event) {
            event.preventDefault();
            var shippping_address_val = $(this).val();
            console.log(shippping_address_val);
            getShippingAddress(shippping_address_val);
        });
    }

    function getShippingAddress(id) {
        $.ajax({
            url: "front/api/user/get-address",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                updateShippingAddress(response);
                $('#changeAddress').modal('hide');
            }
        });
    }

    function updateShippingAddress(address) {
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
        $('#spc-billing-address-body').append('<div class="shpd-add-name">' + address.first_name + address.last_name + '</div><div class="shpd-add-add">' + address.address + '.</div>');
    }
});