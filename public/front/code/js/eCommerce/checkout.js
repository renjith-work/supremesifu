$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var _token = $("input[name='_token']").val();

    // Address Add and Edit buttons Links Check

    checkAddressStatus();
    function checkAddressStatus()
    {
        $.ajax({
            url: "/front/api/user/addresses/check",
            type: 'POST',
            data: { _token: _token },
            dataType: 'json',
            success: function (response) {
                shpAddsLinks(response);
                bllngAddsLinks(response);
            }
        });
    }

    function shpAddsLinks(id)
    {
        $('#chk-shp-edit-add-ads-cover').html('')
        if(id == 1)
        {
            $('#chk-shp-edit-add-ads-cover').append('<div class="spc-add-address-cover"><div class="spc-shpd-edit-link"><a href="2" class="spc-add-address">Add Shipping Address</a></div></div>');
        }else if(id == 2)
        {
            $('#chk-shp-edit-add-ads-cover').append('<div class="spc-shpd-edit-link"><a href="2" class="spc-add-edit-a">Select Shipping Address</a> </div>');
        }
    }

    function bllngAddsLinks(id) {
        $('#chk-bllng-edit-add-ads-cover').html('')
        if (id == 1) {
            $('#chk-bllng-edit-add-ads-cover').append('<div class="spc-add-address-cover"><div class="spc-shpd-edit-link"><a href="1" class="spc-add-address">Add Billing Address</a></div></div>');
        } else if (id == 2) {
            $('#chk-bllng-edit-add-ads-cover').append('<div class="spc-shpd-edit-link"><a href="1" class="spc-add-edit-a">Select Billing Address</a></div>');
        }
    }

    // Checking if Default Addresses Exists
    function checkAddresses()
    {
        console.log('billling address -' + billing_address);
        console.log('shipping address -' + shipping_address);
    }

    function setBillingAddress(value)
    {
        $('#form_billing_address').val(value);
    }

    function setShippingAddress(value) {
        $('#form_shipping_address').val(value);
    }

    // Address Edit Button Click
    $(document).on('click', '.spc-add-edit-a', function (event) 
    {
        event.preventDefault();
        var id = $(this).attr('href');
        loadListAddressModal(id);
        checkAddresses();
    });

    function loadListAddressModal(id)
    {
        $('#changeAddress').modal('show');
        $('#chk-chng-add-adrs').attr("href", id);
        listAllAddress(id);
    }

    function listAllAddress(id)
    {   
        var input_name;
        var select_address;
        $.ajax({
            url: "/front/api/user/addresses/list",
            type: 'POST',
            data: { _token: _token },
            dataType: 'json',
            success: function (response) {
                if(id == 1)
                {
                    input_name = 'spc-add-inp-billing';
                    select_address = billing_address;
                    loadListAddress(response, input_name, select_address);
                } else if (id == 2) {
                    input_name = 'spc-add-inp-shipping';
                    select_address = shipping_address;
                    loadListAddress(response, input_name, select_address);
                }
            }
        });
    }

    function loadListAddress(addresses, input_name, select_address)
    {
        $('#spc-add-table > tbody').html('');
        var label_count = 1;
        $.each(addresses, function (key, value){
            if(value.id == select_address)
            {
                $('#spc-add-table > tbody').append('<tr class="spc-add-tab-body"><th><div class="add-tab-name">' + value.name + '</div></th><td>' + value.address + '</td><td>' + value.phone + '</td><td><div class="add-tab-labels-' + label_count + '"></div></td><td><div class="spc-add-tab-action"><input type="radio" name="address" class="' + input_name + '" value="' + value.id + '" checked></div></td></tr>');
                $.each(value.label, function (key1, value1) {
                    $('.add-tab-labels-' + label_count).append('<span class="badge badge-light badge-checkout-label">' + value1.name + '</span>');
                });
            }else{
                $('#spc-add-table > tbody').append('<tr class="spc-add-tab-body"><th><div class="add-tab-name">' + value.name + '</div></th><td>' + value.address + '</td><td>' + value.phone + '</td><td><div class="add-tab-labels-' + label_count + '"></div></td><td><div class="spc-add-tab-action"><input type="radio" name="address" class="' + input_name + '" value="' + value.id + '"></div></td></tr>');
                $.each(value.label, function (key1, value1) {
                    $('.add-tab-labels-' + label_count).append('<span class="badge badge-light badge-checkout-label">' + value1.name + '</span>');
                });
            }
            label_count++;
        });
    }

    // Address Changing 

    var address_cover;

    // Shipping Address management
    changeShippingAddress();
    function changeShippingAddress() {
        $(document).on('change', '.spc-add-inp-shipping', function (event) {
            event.preventDefault();
            shipping_address = $(this).val(); //Selected address id.
            setShippingAddress(shipping_address);
            address_cover = 'spc-shipping-address-body'; //Div id for selected address type.
            updateDisplayAddress(shipping_address, address_cover);
        });
    }

    // Billing Address management
    changeBillingAddress();
    function changeBillingAddress() {
        $(document).on('change', '.spc-add-inp-billing', function (event) {
            event.preventDefault();
            billing_address = $(this).val(); //Selected address id.
            setBillingAddress(billing_address);
            address_cover = 'spc-billing-address-body'; //Div id for selected address type.
            updateDisplayAddress(billing_address, address_cover);
        });
    }

    function updateDisplayAddress(id, div_id)
    {
        $.ajax({
            url: "/front/api/user/addresses/get-address",
            type: 'POST',
            data: { _token: _token, id: id },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('#' + div_id).html('');
                $('#' + div_id).append('<div class="shpd-add-name">' + response.name + '</div><div class="shpd-add-add">' + response.address + '.</div>');
                $('#changeAddress').modal('hide');
            }
        });
    }

    //Create new Address
    $(document).on('click', '.spc-add-address', function (event) {
        event.preventDefault();
        var id = $(this).attr('href');
        currrent_address_type = id;
        loadAddAddressModal();
    });
    
    var currrent_address_type;

    $(document).on('click', '#chk-chng-add-adrs', function (event) {
        event.preventDefault();
        var id = $(this).attr('href');
        $('#changeAddress').modal('hide');
        currrent_address_type = id;
        loadAddAddressModal();
    });

    

    function loadAddAddressModal() {
        $('#addAddress').modal('show');
        loadAddressForm();
        setTimeout(function () {
            loadCountries();
        }, 300); 
    }

    function loadAddressForm()
    {   
        $('#chk-address-form-cover').html('');
        $('#chk-address-form-cover').append('<div class="col-md-6"> <div class="form-group"> <label for="first_name">First Name *</label><span class="modal-error" id="error_first_name"></span> <input type="text" class="form-control fc-modal" id="first_name" name="first_name"/> </div><div class="form-group"> <label for="last_name">Last Name *</label> <span class="modal-error" id="error_last_name"></span> <input type="text" class="form-control fc-modal" id="last_name" name="last_name"/> </div><div class="form-group"> <label for="email">Email address *</label> <span class="modal-error" id="error_email"></span> <input type="email" class="form-control fc-modal" id="email" name="email"/> </div><div class="form-group"> <label for="country">Select Country</label><span class="modal-error" id="error_country"></span> <select class="form-control fc-modal" id="country" name="country"> <option disabled selected>Select Country</option> </select> </div><div class="form-group"> <label for="phone">Phone Number *</label> <span class="modal-error" id="error_phone"></span> <div class="row"> <div class="col-md-4 col-5"> <select class="form-control fc-modal" id="phoneCode" name="phoneCode"></select> </div><div class="col-md-8 col-7"><input type="text" class="form-control fc-modal" id="phone" name="phone"/></div></div></div></div><div class="col-md-6"> <div class="form-group"> <label for="zone">Select Zone</label><span class="modal-error" id="error_zone"></span> <select class="form-control fc-modal" id="zone" name="zone"> <option disabled selected>Please select a country for the zones..</option> </select> </div><div class="form-group"> <label for="address">Address</label> <span class="modal-error" id="error_address"></span> <textarea name="address" id="address" rows="1" class="form-control fc-modal"></textarea> </div><div class="form-group"> <label for="city">City *</label> <span class="modal-error" id="error_city"></span> <input type="text" class="form-control fc-modal" id="city" name="city"/> </div><div class="form-group"> <label for="postcode">Post Code *</label> <span class="modal-error" id="error_postcode"></span> <input type="text" class="form-control fc-modal" id="postcode" name="postcode"/> </div></div>');
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
                    SetAddresses(response.address);
                    // Setting links display property.
                    shpAddsLinks(2);
                    bllngAddsLinks(2);
                }
            }
        });
    }

    function SetAddresses(address, address_type)
    {
        $('#addAddress').modal('hide');
        if (currrent_address_type == 1)
        {
            billing_address = address.id;
            setBillingAddress(billing_address);
            address_cover = 'spc-billing-address-body';
            updateSetDisplayAddress(address, address_cover);
        } else if (currrent_address_type == 2)
        {
            shipping_address = address.id;
            setShippingAddress(shipping_address);
            address_cover = 'spc-shipping-address-body';
            updateSetDisplayAddress(address, address_cover);
        }
    }

    function updateSetDisplayAddress(address, div_id)
    {
        // console.log(address);
        // console.log(div_id);
        checkAddresses();
        $('#' + div_id).html('');
        $('#' + div_id).append('<div class="shpd-add-name">' + address.name + '</div><div class="shpd-add-add">' + address.address + '.</div>');
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
                     
});