@extends('layouts.front')

@section('title', $product->name)


@section('content')


<div class="py-3 mb-4 shadow-sm bg-warning">
    <div class="container">
        <h6 class="mt-5">Collection/ {{ $product->category->name }}/ {{ $product->name }}</h6>
    </div>
</div>
    
<div class="container">
        <div class="uicard shadow mt-5">
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
                            <div class="col-md-2">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mt-3">
                                    <span class="input-group-text">-</span>
                                    <input type="text" name="quantity" value="1" class="form-control" />
                                    <span class="input-group-text">+</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <br>
                               <p class="fs-6 mt-4">Only {{ $product->quantity }} items left</p> 
                            </div>
                            <div class="col-md-7">
                                <br>
                                <button class="btn btn-primary mt-3">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection