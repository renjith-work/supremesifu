    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-compare-fabric-header">
            <div class="modal-compare-fabric-title" id="exampleModalLongTitle">LOG IN</div>
          </div>
          <div class="modal-body">
            <div class="modal-body-content-cover">

                <div class="modal-body-content-main">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="login-register-form">
                                    <form method="POST" action="#">
                                        @csrf
                                        <div class="login-input-box">
                                            <input type="text" id="modal-email" class="" name="email" placeholder="Email Address" >
                                            <div id="modal-email-error" class="ssifu-login-feedback modal-input-error" role="alert"></div>
                                            <input type="password" id="password" class="" name="password" placeholder="Password" >
                                            <div id="modal-password-error" class="ssifu-login-feedback modal-input-error" role="alert"></div>
                                        </div>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <div class="row register-addons">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineCheckbox1"> Remember Me</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <a href="/user/password/reset/email" class="login-subtext">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('message')
                                            <div class="alert alert-danger ssifu-alert">
                                              Sorry, we couldn't find an account the matches the credentials you provided. You can try and log in with another account or try to retrieve your password by <a href="/user/forgot-password">clicking this link</a>.
                                            </div>
                                            @enderror
                                            <div class="button-box">
                                                <button id="modal-login-btn" class="login-btn btn btn-f-social" type="submit"><span>Login</span></button>
                                            </div>
                                            <div class="modal-social-login row">
                                              <div class="col-md-6">
                                                <a href="/login/google">
                                                  <button type="button" class="btn btn-social-login">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-sm-3">
                                                          <div class="login-icon">
                                                            <img src="/front/assets/images/icon/google.png" alt="">
                                                          </div>
                                                        </div>
                                                        <div class="col-lg-8 col-sm-9">
                                                            <div class="login-social-text">Use Google Account </div>
                                                        </div>
                                                    </div>
                                                  </button>
                                                </a>
                                              </div>
                                              <div class="col-md-6">
                                                <a href="/login/facebook">
                                                  <button type="button" class="btn btn-social-login">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-sm-3">
                                                          <div class="login-icon">
                                                            <img src="/front/assets/images/icon/fb.png" alt="">
                                                          </div>
                                                        </div>
                                                        <div class="col-lg-8 col-sm-9">
                                                            <div class="login-social-text">Use Facebook Account </div>
                                                        </div>
                                                    </div>
                                                  </button>
                                                </a>
                                              </div>
                                            </div>
                                            <div class="modal-register-cover">
                                              Not a member yet? <a href="#">Register Now</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-measurement-footer">
              <div class="modal-footer-content-instruction">
                  In case you are using a public/shared computer we recommend that you logoutto prevent any un-authorized access to your account.
              </div>
          </div>
        </div>
      </div>
    </div>