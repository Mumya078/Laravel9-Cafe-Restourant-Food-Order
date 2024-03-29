@extends('layouts.main')


<!-- favicon -->
<link rel="shortcut icon" type="image/png" href="public/assets/tempassets/img/favicon.png">
<!-- google font -->

<link rel="stylesheet" href="/assets/tempassets/css/all.min.css">
<!-- bootstrap -->
<link rel="stylesheet" href="/assets/tempassets/bootstrap/css/bootstrap.min.css">
<!-- owl carousel -->
<link rel="stylesheet" href="/assets/tempassets/css/owl.carousel.css">
<!-- magnific popup -->
<link rel="stylesheet" href="/assets/tempassets/css/magnific-popup.css">
<!-- animate css -->
<link rel="stylesheet" href="/assets/tempassets/css/animate.css">
<!-- mean menu css -->
<link rel="stylesheet" href="/assets/tempassets/css/meanmenu.min.css">
<!-- main style -->
<link rel="stylesheet" href="/assets/tempassets/css/main.css">
<!-- responsive -->
<link rel="stylesheet" href="/assets/tempassets/css/responsive.css">


<style>



</style>
@section('title','User Shopcart')


@section('content')



    <section id="shopcart" class="pattern-style-4 has-overlay">
        <div class="container raise-2">
            <h3 class="section-title mb-6 pb-3 text-center">Orders</h3>
            <h4 class="text-center">{{\App\Http\Controllers\ShopCartController::countshopcart()}} Items in shopcart</h4>
            @include('home.messages')
            <div class="cart-section mt-150 mb-150">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="cart-table-wrap">
                                <table class="cart-table">
                                    <thead class="cart-table-head">
                                    <tr class="table-head-row">
                                        <th class="product-remove"></th>
                                        <th class="product-image">Product Image</th>
                                        <th class="product-name">Name</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($total=0)
                                    @foreach($data as $rs)
                                    <tr class="table-body-row">
                                        <td class="product-remove"><a href="/shopcart/destroy/{{$rs->id}}"><i class="far fa-window-close"></i></a></td>
                                        <td class="product-image"><img src="{{Storage::url($rs->product->image)}}" alt=""></td>
                                        <td class="product-name">{{$rs->product->title}}</td>
                                        <td class="product-price">${{$rs->product->price}}</td>
                                        <td class="product-quantity">
                                            <form action="/shopcart/update/{{$rs->id}}" method="post">
                                                @csrf
                                                <input name="quantity" type="number" value="{{$rs->quantity}}" min="1" onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="product-total">${{$rs->product->price * $rs->quantity}}</td>
                                    </tr>
                                        @php($total += $rs->product->price * $rs->quantity)
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="total-section">
                                <table class="total-table">
                                    <thead class="total-table-head">
                                    <tr class="table-total-row">
                                        <th>Total</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="total-data">
                                        <td><strong>Subtotal: </strong></td>
                                        <td>${{$total}}</td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Total: </strong></td>
                                        <td>${{$total}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="cart-buttons">
                                    <form action="{{route("shopcart.order")}}" method="post">
                                        @csrf
                                        <input name="total" value="{{$total}}" type="hidden">
                                        <button type="submit" class="btn btn-primary btn-rounded btn-fw">
                                            Place Order
                                        </button>
                                        <a href="{{route('menu.menu')}}" class="btn btn-primary btn-rounded btn-fw">Update Cart</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end cart -->

        </div>
    </section>




    <!-- Prefooter Section  -->
    <div class="py-4 border border-lighter border-bottom-0 border-left-0 border-right-0 bg-dark">
        <div class="container">
            <div class="row justify-content-between align-items-center text-center">
                <div class="col-md-3 text-md-left mb-3 mb-md-0">
                    <img src="assets/imgs/navbar-brand.svg" width="100">
                </div>
                <div class="col-md-9 text-md-right">
                    <a href="#" class="px-3"><small class="font-weight-bold">Our Company</small></a>
                    <a href="#" class="px-3"><small class="font-weight-bold">Help Center</small></a>
                </div>
            </div>
        </div>
    </div>

    <!-- End of PreFooter Section -->
    <!-- jquery -->
    <script src="/assets/tempassets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="/assets/tempassets/bootstrap/js/bootstrap.min.js"></script>
    <!-- count down -->
    <script src="/assets/tempassets/js/jquery.countdown.js"></script>
    <!-- isotope -->
    <script src="/assets/tempassets/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- waypoints -->
    <script src="/assets/tempassets/js/waypoints.js"></script>
    <!-- owl carousel -->
    <script src="/assets/tempassets/js/owl.carousel.min.js"></script>
    <!-- magnific popup -->
    <script src="/assets/tempassets/js/jquery.magnific-popup.min.js"></script>
    <!-- mean menu -->
    <script src="/assets/tempassets/js/jquery.meanmenu.min.js"></script>
    <!-- sticker js -->
    <script src="/assets/tempassets/js/sticker.js"></script>
    <!-- main js -->
    <script src="/assets/tempassets/js/main.js"></script>
@endsection

