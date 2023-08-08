@extends('frontend.layouts.secondary')
@section('title')
    Contact Us
@endsection
@section('icon')
https://w7.pngwing.com/pngs/598/408/png-transparent-computer-icons-mobile-phones-phone-miscellaneous-telephone-call-logo-thumbnail.png
@endsection
@section('main-section')
    @php
        $store = DB::table('store')->first();
    @endphp
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Contact For Any Queries</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15689138.553657398!2d-100.34082346698526!3d34.54673008868858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1690612643617!5m2!1sen!2s"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    {{-- <div id="success"></div>
                <form method="POST" action="{{ route('frontend.contact.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form> --}}
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                <p>{{ $store->name }}.</p>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{ $store->address }}</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ $store->email }}</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ $store->contact }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
