
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
                <a href="#"> <img src="{{url('images/food-picky-logo.png')}}" alt="Footer logo"> </a> <span>Order Delivery &amp; Take-Out </span> </div>
            <div class="col-xs-12 col-sm-2 about color-gray"><ul>
                    <li> <a href="#" style="color: white;"> imprint</a> </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                <ul>
                    <li> <a href="#" style="color: white;"> contact</a> </li>  </ul>
            </div>
            <div class="col-xs-12 col-sm-2 pages color-gray">
                <ul>
                    <li> <a href="{{route('dataprotection')}}"style="color: white;"> data protection</a> </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-3 popular-locations color-gray"><ul >
                    <li> <a href="#" style="color: white;"> city List</a> </li></ul>
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
                            <a href="#"> <img src="{{url('images/paypal.png')}}" alt="Paypal"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="{{url('images/mastercard.png')}}" alt="Mastercard"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="{{url('images/maestro.png')}}" alt="Maestro"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="{{url('images/stripe.png')}}" alt="Stripe"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="{{url('images/bitcoin.png')}}" alt="Bitcoin"> </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 address color-gray">
                    <h5>Address</h5>
                    <p>Concept design of oline food order and deliveye,planned as restaurant directory</p>
                    <h5>Phone: <a href="tel:+080000012222">080 000012 222</a></h5> </div>
                <div class="col-xs-12 col-sm-5 additional-info color-gray">
                    <h5>Addition informations</h5>
                    <p>Join the thousands of other restaurants who benefit from having their menus on TakeOff</p>
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