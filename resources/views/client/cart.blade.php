@extends('layouts.front')

@section('title')
    My Cart
@endsection

@section('content')

<div class="py-3 shadow-sm bg-warning">
    <div class="container">
        <h5 class="mt-5 tag">
        <a href="{{ url('/') }}">Home</a>/
            Cart
        </h5>
    </div>
</div>
    
<div class="container my-5">
        <div class="uicard shadow">
            @if($cartitems->count() > 0)
            <div class="card-body">
                @php $total = 0; @endphp
                @foreach($cartitems as $cartitem)
                <div class="row product_data py-2 mb-3">
                    <div class="col-md-2 my-auto">
                        <img src="{{ asset('storage/images/product/'. $cartitem->products->name . '/' . $cartitem->products->image) }}" alt="Image" class="w-50 h-100">
                    </div>
                    <div class="col-md-3 my-auto">
                    <br>
                        <h5 class="mb=0">{{ $cartitem->products->name  }}</h5>
                    </div>
                    <div class="col-md-2 my-auto">
                    <br>
                        <h5 class="mb=0">{{ $cartitem->products->final_price  }} Ks</h5>
                    </div>
                    <div class="col-md-3 my-auto">
                        <input type="hidden" class="prod_id" value="{{ $cartitem->product_id }}">
                        <input type="hidden" value="{{ $cartitem->products->quantity }}" class="prod_qty">
                        @if($cartitem->products->quantity >= $cartitem->product_quantity)
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center">
                                    <button class="input-group-text changeQuantity decrement-btn">-</button>
                                    <input type="text" name="quantity" class="form-control qty_input text-center" value="{{ $cartitem->product_quantity }}"  />
                                    <button class="input-group-text changeQuantity increasement-btn">+</button>
                                </div>
                                @php $total += $cartitem->products->final_price * $cartitem->product_quantity; @endphp
                        @else
                        <br>
                            <h6 class="badge bg-danger">Out of Stock</h6>
                        @endif
                    </div>
                    <div class="col-md-2 my-auto">
                        <br>
                        <div class="d-grid gap-2">
                        <button class="btn btn-danger delete-cart-item">Remove</button>
                        </div>
                    </div>
                    
                </div>
                @endforeach

            </div>
            
                <div class="card-footer">
                        <h5 class="float-first">Total Price: {{ $total }} Ks</h5>
                        <div class="d-grid gap-2">
                        <a href="{{ url('checkout') }}" class="btn btn-success">Process to Checkout</a>
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                        </div>
                </div>
            @else
            <div class="card-body text-center">
                <h2><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Your cart is empty&nbsp;<i class="fa fa-shopping-cart" aria-hidden="true"></i></h2><br>
                <div class="d-grid gap-2">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection