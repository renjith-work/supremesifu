    <div class="modal fade" id="saveMsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-compare-fabric-header">
            <div class="modal-compare-fabric-title" id="exampleModalLongTitle">SAVE MEASUREMENT PROFILE</div>
          </div>
          <div class="modal-body">
            <div class="modal-body-content-cover">
                <div class="modal-body-content-instruction">
                    <b>Congratulations!!!</b> You have followed our tutorial to measure youself for your perfect fitting garments. You may name and save this measurement for future refference.
                </div>
                <div class="modal-body-content-main">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" value="{{$product->id}}" id="ms-profile-product" name="product">
                            <div class="form-group">
                                <label for="measurement_profile_name">Please provide a name for your measurement profile</label>
                                <input type="text" name="measurement_profile_name" id="measurement_profile_name" class="form-control">
                                <div id="measurement_profile_name_error"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="ms-profile-values-cover">
                        <div class="row">
                            @foreach($product->measurements as $measurement)
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="ms-profile-attr-name">{{$measurement->measurementAttribute->name}}</div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="ms-profile-attr-value">{{$measurement->value}}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="ms-profile-info"> **All Measurements are in inches </div>
                </div>
            </div>
          </div>
          <div class="modal-measurement-footer">
              <div class="row">
                  <div class="col-md-6 offset-md-6">
                      <input type="submit" id="submitMsProfile" class="btn pull-right modal-action-button" value="Save & Continue">
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>