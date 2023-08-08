@php
    $products = DB::table('products')->count();
    $categories = DB::table('category')->count();
    $orders = DB::table('orders')->count();
    $ordersCompleted = DB::table('orders')
        ->where('status', 'completed')
        ->count();
    $ordersPending = DB::table('orders')
        ->where('status', 'pending')
        ->count();
    $ordersRejected = DB::table('orders')
        ->where('status', 'rejected')
        ->count();
@endphp
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
            <div class="card-body">
                <div class="fa fa-barcode"></div>
                <div>Total Products</div>
                <div>{{ $products }}</div>
                <small class="text-medium-emphasis-inverse">Available</small>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
            <div class="card-body">
                <div class="fa fa-gear" ></div>
                <div>Categories</div>
                <div>
                    {{$categories}}
                </div>
                <small class="text-medium-emphasis-inverse">Available</small>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
            <div class="card-body">
                <div class="fas fa-shopping-cart"></div>
                <div>Total Orders</div>
                <div>{{$orders}}</div>
                <small class="text-medium-emphasis-inverse">Ordereds Received</small>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body">
                <div class="fa fa-clock"></div>
                <div>Pending Orders</div>
                <div>
                    {{$ordersPending}}
                </div>
                <small class="text-medium-emphasis-inverse">Orders Pending</small>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body">
                <div class="fa fa-check"></div>
                <div>Completed Orders</div>
                <div>
                    {{$ordersCompleted}}
                </div>
                <small class="text-medium-emphasis-inverse">Orders Completed</small>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body">
                <div class="fa fa-times"></div>
                <div>Rejected Orders</div>
                <div>
                    {{$ordersRejected}}
                </div>
                <small class="text-medium-emphasis-inverse">Orders Rejected</small>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
