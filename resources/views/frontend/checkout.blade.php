@extends('frontend.layouts.secondary')
@section('title')
    Check Out
@endsection
@section('main-section')
    <div class="panel panel-default">
        <div class="panel-body">
            <h1
                class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-12 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">
                Make A Payment</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @php
                $totalPrice = 0;
                $shipping = DB::table('store')
                    ->pluck('shipping')
                    ->first();
            @endphp
            <form action="{{ route('stripe.store') }}" id="card-form" method="post">
                @csrf
                <div class="container-fluid pt-5">
                    <div class="row px-xl-5">
                        <div class="col-lg-8">
                            <div class="mb-4">
                                <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>First Name</label>
                                        <input class="form-control" name="first_name" type="text" placeholder="John">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" name="last_name" type="text" placeholder="Doe">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>E-mail</label>
                                        <input class="form-control" name="email" type="text"
                                            placeholder="example@email.com">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Mobile No</label>
                                        <input class="form-control" name="number" type="text"
                                            placeholder="+123 456 789">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Address Line 1</label>
                                        <input class="form-control" name="address_one" type="text"
                                            placeholder="123 Street">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Address Line 2</label>
                                        <input class="form-control" name="address_two" type="text"
                                            placeholder="123 Street">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>City</label>
                                        <input class="form-control" name="city" type="text" placeholder="New York">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>State</label>
                                        <input class="form-control" name="state" type="text" placeholder="New York">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>ZIP Code</label>
                                        <input class="form-control" name="zip" type="text" placeholder="123">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card border-secondary mb-5">
                                <div class="card-header bg-secondary border-0">
                                    <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                                </div>
                                <div class="card-body">
                                    <h5 class="font-weight-medium mb-3">Products</h5>
                                    @forelse ($products as $product)
                                        @php
                                            if (auth()->check()) {
                                                $count = $product->quantity;
                                            } else {
                                                $count = $productIdCounts[$product->id] ?? 0;
                                            }
                                            $price = $product->price * $count;
                                            $totalPrice += $price;
                                            
                                        @endphp
                                        <div class="d-flex justify-content-between">
                                            <p>{{ $product->name }} &nbsp;&nbsp;&nbsp; x{{ $count }}</p>
                                            <p class="prices">{{ $price }}</p>
                                        </div>

                                    @empty
                                    @endforelse
                                    <hr class="mt-0">
                                    <div class="d-flex justify-content-between mb-3 pt-1">
                                        <h6 class="font-weight-medium">Subtotal</h6>
                                        <h6 class="font-weight-medium">${{ $totalPrice }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="font-weight-medium">Shipping</h6>
                                        <h6 class="font-weight-medium">${{ $shipping }}</h6>
                                    </div>
                                </div>
                                <div class="card-footer border-secondary bg-transparent">
                                    <div class="d-flex justify-content-between mt-2">
                                        <h5 class="font-weight-bold">Total</h5>
                                        <h5 class="font-weight-bold">${{ $shipping + $totalPrice }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-secondary mb-5">
                                <div class="card-header bg-secondary border-0">
                                    <h4 class="font-weight-semi-bold m-0">Payment</h4>
                                </div>
                                <div>
                                    <div class="my-3">

                                        <input type="text" placeholder="Your Name" name="name" id="card-name"
                                            class="border-2 border-gray-200 form-control h-11 px-4 rounded-xl w-full">
                                    </div>

                                    <div class="mb-3">
                                        <label for="card"
                                            class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Card
                                            details</label>

                                        <div class="bg-gray-100 p-6 rounded-xl">
                                            <div id="card"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-secondary bg-transparent">
                                    <input type="hidden" name="total_price" value="{{ $shipping + $totalPrice }}"
                                        id="">
                                    <button type="submit"
                                        class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place
                                        Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('after-scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let stripe = Stripe('{{ env('STRIPE_KEY') }}')
        const elements = stripe.elements()
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px'
                }
            }
        })
        const cardForm = document.getElementById('card-form')
        const cardName = document.getElementById('card-name')
        cardElement.mount('#card')
        cardForm.addEventListener('submit', async (e) => {
            e.preventDefault()
            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
                billing_details: {
                    name: cardName.value
                }
            })
            if (error) {
                console.log(error)
            } else {
                let input = document.createElement('input')
                input.setAttribute('type', 'hidden')
                input.setAttribute('name', 'payment_method')
                input.setAttribute('value', paymentMethod.id)
                cardForm.appendChild(input)
                cardForm.submit()
            }
        })
    </script>

    <script>
    $(document).ready(function () {
        $("#card-form").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 2,
                },
                last_name: {
                    required: true,
                    minlength: 2,
                },
                email: {
                    required: true,
                    email: true,
                },
                number: {
                    required: true,
                    digits: true,
                },
                address_one: {
                    required: true,
                },
                city: {
                    required: true,
                },
                state: {
                    required: true,
                },
                zip: {
                    required: true,
                    digits: true,
                },
                name: {
                    required: true,
                },
                card: {
                    required: true,
                },
            },
            messages: {
                first_name: {
                    required: "Please enter your first name.",
                    minlength: "Your first name must be at least 2 characters long.",
                },
                last_name: {
                    required: "Please enter your last name.",
                    minlength: "Your last name must be at least 2 characters long.",
                },
                email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address.",
                },
                number: {
                    required: "Please enter your mobile number.",
                    digits: "Please enter only digits.",
                },
                address_one: {
                    required: "Please enter your address.",
                },
                city: {
                    required: "Please enter your city.",
                },
                state: {
                    required: "Please enter your state.",
                },
                zip: {
                    required: "Please enter your ZIP code.",
                    digits: "Please enter only digits.",
                },
                name: {
                    required: "Please enter the cardholder's name.",
                },
                card: {
                    required: "Please enter your card details.",
                },
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            },
        });
    });
</script>
@endsection
