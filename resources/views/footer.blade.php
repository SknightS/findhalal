
<section class="app-section">
    <div class="app-wrap">
        <div class="container">
            <div class="row text-img-block text-xs-left">
                <div class="container">
                    <div class="col-xs-12 col-sm-5 right-image text-center">
                        <figure> <img src="{{url('images/app.png')}}" alt="Right Image" class="img-fluid"> </figure>
                    </div>
                    <div class="col-xs-12 col-sm-7 left-text">
                        <h3>The Best Food Delivery App</h3>
                        <p>Now you can make food happen pretty much wherever you are thanks to the free easy-to-use Food Delivery &amp; Takeout App.</p>
                        <div class="social-btns">
                            <a href="#" class="app-btn apple-button clearfix">
                                <div class="pull-left"><i class="fa fa-apple"></i> </div>
                                <div class="pull-right"> <span class="text">Available on the</span> <span class="text-2">App Store</span> </div>
                            </a>
                            <a href="#" class="app-btn android-button clearfix">
                                <div class="pull-left"><i class="fa fa-android"></i> </div>
                                <div class="pull-right"> <span class="text">Available on the</span> <span class="text-2">Play store</span> </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <!-- top footer statrs -->
        <div class="row top-footer">
            <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                <a href="#"> <img src="{{url('images/findhalal.png')}}" width="110px" height="35px" alt="Footer logo"> </a> <span >Order Delivery &amp; Take-Out </span> </div>
            <div class="col-xs-12 col-sm-2 about color-gray"><ul>
                    <li> <a href="{{route('impressum')}}" style="color: white;"> imprint</a> </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                <ul>
                    <li> <a href="{{route('contact')}}" style="color: white;"> contact</a> </li>  </ul>
            </div>
            <div class="col-xs-12 col-sm-2 pages color-gray">
                <ul>
                    <li> <a href="{{route('dataprotection')}}"style="color: white;"> data protection</a> </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-3 popular-locations color-gray"><ul >
                    <li> <a href="{{route('citylist')}}" style="color: white;"> city List</a> </li></ul>
            </div>

        </div>
        <!-- top footer ends -->
        <!-- bottom footer statrs -->
        <div class="bottom-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-3 payment-options color-gray">
                    <h5>Payment Options</h5>
                    <ul>
                        <li>
                            <a href="#"> <img src="{{url('images/master.png')}}"  width="45px" height="30px" alt="Master Card"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="{{url('images/visa.png')}}" width="45px" height="30px" alt="VisaCard"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="{{url('images/maestro.png')}}"  width="45px" height="30px" alt="Maestro"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="{{url('images/stripe.png')}}"  width="45px" height="30px"alt="Stripe"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="{{url('images/bitcoin.png')}}"  width="45px" height="30px"alt="Bitcoin"> </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 address color-gray">
                    <h5>Address</h5>
                    <p>Mainzer Landstraße 41 (A-113), 60439 Frankfurt am Main, Germany </p>
                    </div>
                <div class="col-xs-12 col-sm-5 address color-gray">
                    <h5>Phone: </h5>
                    <h5><a href="tel:+4917686097107">491 7686 0971 07</a></h5>
                </div>
            </div>
        </div>
        <!-- bottom footer ends -->
    </div>
</footer>
<!-- end:Footer -->
</div>
<!--/end:Site wrapper -->
<!-- Bootstrap core JavaScript
================================================== -->
<script src="{{url('js/jquery.min.js')}}"></script>
<script src="{{url('js/tether.min.js')}}"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="{{url('js/animsition.min.js')}}"></script>
<script src="{{url('js/bootstrap-slider.min.js')}}"></script>
<script src="{{url('js/jquery.isotope.min.js')}}"></script>
<script src="{{url('js/headroom.js')}}"></script>
<script src="{{url('js/foodpicky.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>



@yield('foot-js')

</body>

</html>