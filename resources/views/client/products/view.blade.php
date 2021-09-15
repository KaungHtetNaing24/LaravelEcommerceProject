@extends('layouts.front')

@section('title', $product->name)


@section('content')


<div class="py-3 mb-4 shadow-sm bg-warning">
    <div class="container">
        <h5 class="mt-5 tag">
            <a href="{{ url('/') }}">Home</a>/ 
            <a href="{{ url('/category/'.$product->category->slug) }}">{{ $product->category->name }}</a>/ 
            {{ $product->name }}
        </h5>
    </div>
</div>
    
<div class="container">
        <div class="uicard shadow mt-5 product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{ asset('storage/images/product/'. $product->name . '/' . $product->image) }}" alt="Product Image" style="height:400px;" class="w-100 image-fluid">
                    </div>
                    <div class="col-md-7">
                        <h3 class="mb-0 mt-3">{{ $product->name }}
                        @if($product->quantity > 0)
                            <label class="badge bg-success float-end fs-6 m-2">Instock</label>
                        @else
                            <label class="badge bg-danger float-end fs-6 m-2">Out of stock</label>
                        @endif
                        
                        @if($product->popular == '1')
                            <label class="badge bg-info float-end fs-6 m-2">Popular</label>
                        @endif
                        </h3>
                        <hr>
                        
                        <h4 class="text-primary mb-0 mt-5">{{ $product->final_price }} Ks<h4>
                        @if($product->final_price != $product->original_price)
                            <span class="float-first fw-light fs-6"><s>{{ $product->original_price }} Ks</s></span>
                            <span class="float-first fw-light fs-6"> (-{{ $product->discount }}%)</span>
                        @endif()
                        <p class="mt-3 fs-6">{{ $product->description }}</p>
                        <hr>

                        <div class="row mb-0 mt-5">
                            <div class="col-md-3">
                                <input type="hidden" value="{{ $product->id }}" class="prod_id">
                                <input type="hidden" value="{{ $product->quantity }}" class="prod_qty">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mt-3">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" class="form-control qty_input text-center" value="1"  />
                                    <button class="input-group-text increasement-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <br>
                                @if($product->quantity > 0 && $product->quantity <= 10)
                               <p class="fs-6 mt-4">Only {{ $product->quantity }} items left</p>
                                @elseif($product->quantity > 10) 
                                <p class="fs-6 mt-4">Available</p>
                                @elseif($product->quantity == 0)
                                <label class="badge bg-danger float-end fs-6 mt-4">Out of stock</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <br>
                                @if($product->quantity > 0)
                                <button class="btn btn-primary mt-3 addToCartBtn">Add to Cart&nbsp;<i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

