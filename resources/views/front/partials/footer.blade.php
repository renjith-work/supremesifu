   <!-- Footer Aare Start -->
    <footer class="footer-area">
       <!-- footer-top start -->
       <div class="footer-top pt--20 pb--60">
           <div class="container">
               <div class="row">
                   <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <!-- footer-info-area start -->
                                <div class="footer-info-area">
                                    <div class="footer-title">
                                        <h3>Supreme Sifu</h3>
                                    </div>
                                    <div class="desc_footer">
                                        <ul>   
                                            <li><a href="/about-us">About Us</a></li>  
                                            <li><a href="/about-us/our-history">Our History</a></li>  
                                            <li><a href="/about-us/perfect-fit-guarantee">Perfect Fit Guarantee</a></li>  
                                            <li><a href="/about-us/how-it-works">How It Works</a></li>  
                                            {{-- <li><a href="gallery">Gallery</a></li>   --}}
                                            {{-- <li><a href="#">Testimonials</a></li>   --}}
                                            <li><a href="#">Blog</a></li>  
                                        </ul>
                                    </div>
                                </div>
                                <!-- footer-info-area end -->
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <!-- footer-info-area start -->
                                <div class="footer-info-area">
                                    <div class="footer-title">
                                        <h3>Products</h3>
                                    </div>
                                    <div class="desc_footer">
                                        <ul>
                                            {{-- <li><a href="#">Shirts</a></li>
                                            <li><a href="#">Suits</a></li>
                                            <li><a href="#">Trousers</a></li>
                                            <li><a href="#">Accessories</a></li> --}}
                                            <li><a href="/guides/take-care-of-dress-shirt">Shirt Care</a></li>
                                            {{-- <li><a href="#">Style Guide</a></li> --}}
                                            <li><a href="contact-us">Large Orders</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- footer-info-area end -->
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <!-- footer-info-area start -->
                                <div class="footer-info-area">
                                    <div class="footer-title">
                                        <h3>Help</h3>
                                    </div>
                                    <div class="desc_footer">
                                        <ul>
                                            <li><a href="/user/login">Track Order</a></li>
                                            <li><a href="/delivery-returns">Delivery & Returns</a></li>
                                            <li><a href="/about-us/frequently-asked-questions-faq">F.A.Q</a></li>
                                            <li><a href="/about-us/privacy-policy">Privacy Policy</a></li>
                                            <li><a href="/about-us/terms-and-conditions">Terms & Conditions</a></li>
                                            <li><a href="/contact-us">Contact Us</a></li>  
                                        </ul>
                                    </div>
                                </div>
                                <!-- footer-info-area end -->
                            </div>

                        </div>
                   </div>
                   <div class="col-lg-4 col-md-12">
                        <!-- footer-info-area start -->
                        <div class="footer-info-area">
                            <div class="footer-title">
                                <h3>Join Our Newsletter Now </h3>
                            </div>
                            <div class="desc_footer">
                                <div class="input-newsletter">
                                   <input name="email" class="input_text" value="" placeholder="Your email address" type="text">
                                   <button class="btn-newsletter"><i class="fa fa-paper-plane-o"></i></button>
                                </div>
                                <p>Get E-mail updates about our latest products and special offers.</p>
                                <div class="link-follow-footer pt--20">
                                    <ul class="footer-social-share">
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- footer-info-area end -->
                   </div>
               </div>
           </div>
        </div>
        <!-- footer-top end -->
        <!-- footer-buttom start -->
        <div class="footer-buttom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="copy-right">
                            <p>Copyright 2018 <a href="#">Supreme Sifu</a>. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-buttom start -->
    </footer>
    <!-- Footer Aare End -->

    @include('front.modals.login-modal')    
</div>
<!-- Main Wrapper End -->

<!-- JS
============================================ -->

<!-- jQuery JS -->
<script src="/front/assets/js/vendor/jquery-1.12.4.min.js"></script>
<!-- Popper JS -->
<script src="/front/assets/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="/front/assets/js/bootstrap.min.js"></script>
<!-- Plugins JS -->
<script src="/front/assets/js/plugins.js"></script>
<!-- Ajax Mail -->
<script src="/front/assets/js/ajax-mail.js"></script>
<!-- Main JS -->
<script src="/front/assets/js/main.js"></script>
<script src="/front/assets/js/tabbed.js"></script>
<script src="/front/assets/js/auth/login.js"></script>
@yield('script')
@yield('footer')
</body>
</html>