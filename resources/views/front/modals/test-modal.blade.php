<div class="modal fade" id="addAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-compare-fabric-header"><div class="modal-compare-fabric-title" id="modalTitle">Add Address</div></div>
            <div class="modal-body" id="modalBody">
                <div class="modal-body-form-cover">
                    <div class="address-modal-form-cover">
                        <form action="{{route('front.user.address.store')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name *</label><span class="modal-error" id="error_first_name"></span>
                                        <input type="text" class="form-control fc-modal" id="first_name" name="first_name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zone">Select Zone</label><span class="modal-error" id="error_zone"></span>
                                        <select class="form-control fc-modal" id="zone" name="zone">
                                            <option disabled selected>Please select a country for the zones..</option>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name *</label> <span class="modal-error" id="error_last_name"></span>
                                        <input type="text" class="form-control fc-modal" id="last_name" name="last_name" /> 
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label> <span class="modal-error" id="error_address"></span>
                                        <textarea name="address" id="address" rows="2" class="form-control fc-modal" rows="5"></textarea> 
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address *</label> <span class="modal-error" id="error_email"></span>
                                        <input type="email" class="form-control fc-modal" id="email" name="email" /> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City *</label> <span class="modal-error" id="error_city"></span>
                                        <input type="text" class="form-control fc-modal" id="city" name="city" />
                                                                            </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Select Country</label><span class="modal-error" id="error_country"></span>
                                        <select class="form-control fc-modal" id="country" name="country">
                                            <option disabled selected>Select Country</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="postcode">Post Code *</label> <span class="modal-error" id="error_postcode"></span>
                                        <input type="text" class="form-control fc-modal" id="postcode" name="postcode" /> 
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number *</label> <span class="modal-error" id="error_phone"></span>
                                        <div class="row">
                                            <div class="col-md-4 col-5">
                                                <select class="form-control fc-modal" id="phoneCode" name="phoneCode"></select>
                                            </div>
                                            <div class="col-md-8 col-7"><input type="text" class="form-control fc-modal" id="phone" name="phone" /></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="adb-label-cover">
                                <div class="adb-label-head">Address Label</div>
                                <div class="adb-label-instruction">
                                    You can set an address as default billing and shipping address. At a time you can have only one default billing address and one default shipping address. You may save the same address as default billing
                                    and shipping address.
                                </div>
                                <div class="adb-label-body-cover">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check adb-radio-cover">
                                                <input class="form-check-input adb-radio-input" type="checkbox" name="billing_address" id="billing_address" value="1" />
                                                <label class="form-check-label adb-radio-label" for="billing_address">Default Billing Address</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check adb-radio-cover">
                                                <input class="form-check-input adb-radio-input" type="checkbox" name="shipping_address" id="shipping_address" value="1" />
                                                <label class="form-check-label adb-radio-label" for="shipping_address">Default Shipping Address</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="adb-label-instruction">
                                    *if you have previouly set another address as default billing or shipping address, the default status of that address will be removed and the current address will be set as default.
                                </div>
                            </div>
                            <div class="px-customer-dashboard-submit-cover"><input type="Submit" id="submitAddress" value="Save Address" class="btn px-black-btn pull-right" /></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
