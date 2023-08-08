@php
    $store = DB::table('store')->first();
@endphp
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-6 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">Kestrel</span>Brother Supply</h1>
            </a>
            <p>{{$store->name}}</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$store->address}}</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$store->email}}</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$store->contact}}</p>
        </div>
        <div class="col-lg-6 col-md-12 mb-5 pr-3 pr-xl-5">
            <div class="row">
                <a href="{{ route('frontend.index') }}" class="nav-item nav-link active">Home</a>
                <a href="{{route('frontend.products')}}" class="nav-item nav-link active">Products</a>
                <a href="{{route('frontend.contact')}}" class="nav-item nav-link active">Contact Us</a>
            </div>
        </div>
        {{-- <div class="col-lg-6 col-md-12">
            <div class="row">
                <div class="col-md-8 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                required="required" />
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row border-top border-light mx-xl-5 py-4">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-dark">
                &copy; <a class="text-dark font-weight-semi-bold" href="#">{{config('app.name')}}</a>. All Rights Reserved
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="img/payments.png" alt="">
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('frontend/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>

<!-- Contact Javascript File -->
<script src="{{asset('frontend/mail/jqBootstrapValidation.min.js')}}"></script>
<script src="{{asset('frontend/mail/contact.js')}}"></script>

<!-- Template Javascript -->
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
@yield('after-scripts')
</body>

</html>