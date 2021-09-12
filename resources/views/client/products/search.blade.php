@extends('layouts.front')

@section('title')
    Products
@endsection

@section('content')

<div class="py-3 shadow-sm bg-warning">
    <div class="container">
        <h5 class="mt-5 tag">
        <a href="{{ url('/') }}">Home</a>/
            Products
        </h5>
    </div>
</div>

<div class="py-5">
        <div class="container">
            <div class="row">
            @if ($products->isEmpty())
               <h4> No item found...</h4>
            @else
            @foreach($products as $product)
                        <div class="col-md-3 mt-3">
                            <div class="card">
                            <a href="{{ url('category/'.$product->category->slug.'/'.$product->slug) }}">
                                <img src="{{ asset('storage/images/product/'. $product->name . '/' . $product->image) }}" alt="Product Image" class="image-fluid">
                                <div class="card-body">
                                    <h5>{{ $product->name }}</h5>
                                    <span class="float-first fs-5 fw-bold">{{ $product->final_price }} Ks</span>
                                    @if($product->final_price != $product->original_price)
                                        <span class="float-end fw-light"><s>{{ $product->original_price }} Ks</s></span>
                                        <span class="float-end fw-light"> (-{{ $product->discount }}%)</span>
                                    @endif()
                                </div>
                            </a>
                            </div>
                        </div>
                     @endforeach
            @endif
            </div>
        </div>
</div>

@endsection