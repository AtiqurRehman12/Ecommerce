@extends('backend.layouts.app')

@section('title')
    {{ 'Show Order Details' }} {{ 'Order Details' }}
@endsection
@push('after-styles')
    <style>
        /*******************************
    * TABLE NO MORE - RESIZE TO MOBILE SIZE
    * Format a normal table to look great on mobile.
    *******************************/
        .table {
            overflow: hidden;
            border-radius: 3px;
            -webkit-box-shadow: 0 1px 6px 0 rgba(0, 0, 0, .12), 0 1px 6px 0 rgba(0, 0, 0, .12);
            -moz-box-shadow: 0 1px 6px 0 rgba(0, 0, 0, .12), 0 1px 6px 0 rgba(0, 0, 0, .12);
            box-shadow: 0 1px 6px 0 rgba(0, 0, 0, .12), 0 1px 6px 0 rgba(0, 0, 0, .12);
        }

        .table>thead>tr>th {
            border-bottom-color: #EEEEEE;
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            padding: 15px;
            background-color: #fff;
            border-top-color: #EEEEEE;
        }

        .table>tbody>tr:hover>td {
            background-color: #FAFAFA;
        }

        @media (max-width: 767px) {

            .table-no-more,
            .table-no-more>thead,
            .table-no-more>thead>tr,
            .table-no-more>thead>tr>th,
            .table-no-more>tbody,
            .table-no-more>tbody>tr,
            .table-no-more>tbody>tr>td {
                display: block;
            }

            .table-no-more>thead {
                position: absolute;
                top: -9999px;
                left: -9999px;
                opacity: 0;
            }

            .table-no-more>tbody>tr>td {
                position: relative;
                padding-left: 45%;
            }

            .table-no-more>tbody>tr:nth-child(even)>td {
                background-color: #ffffff;
            }

            .table-no-more>tbody>tr:nth-child(odd)>td {
                background-color: #FAFAFA;
            }

            .table-no-more>tbody>tr>td:before {
                position: absolute;
                top: 15px;
                left: 5%;
                width: 40%;
                white-space: nowrap;
                font-weight: bold;
            }

            .table-no-more>tbody>tr>td:after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 40%;
                height: 100%;
                border-right: 1px solid #EEEEEE;
            }

            .table-no-more>tbody>tr>td:nth-of-type(1):before {
                content: "#";
            }

            .table-no-more>tbody>tr>td:nth-of-type(2):before {
                content: "First Name";
            }

            .table-no-more>tbody>tr>td:nth-of-type(3):before {
                content: "Last Name";
            }
        }

        /* ----- v CAN BE DELETED v ----- */
        body {
            background-color: #9575CD;
        }

        .demo {
            padding-top: 60px;
            padding-bottom: 110px;
        }

        .demo-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 15px;
            background-color: #212121;
            text-align: center;
        }

        .demo-footer>a {
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">

            <x-backend.section-header>
                <i class="{{ 'fas fa-truck' }}"></i> {{ 'Order Details' }} <small
                    class="text-muted">{{ 'Show Order Detail' }}</small>

                <x-slot name="subtitle">
                    View Products Details
                </x-slot>
                <x-slot name="toolbar">

                </x-slot>
            </x-backend.section-header>

            <div class="row mt-4">
                <div class="col">

                    <div class="container demo">


                        <table class="table table-no-more">
                            <thead>
                                <tr>
                                    <th>Order#</th>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @forelse ($orderedProducts as $orderedProduct)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$orderedProduct->name}}</td>
                                    <td>{{$orderedProduct->product_name}}</td>
                                    <td>{{$orderedProduct->quantity}}</td>
                                    <td>{{$orderedProduct->unit_price}}</td>
                                    <td>{{$orderedProduct->total_price}}</td>
                                </tr>
                                @php
                                    $count++;
                                @endphp
                                    
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
