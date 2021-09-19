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
            <div class="card-body text-center bg-light">
                <h2>No item found.</h2><br>
                <div class="d-grid gap-2">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                </div>
            </div>
            @else
            @foreach($products as $product)
                        <div class="col-md-3 mt-3">
                            <div class="card">
                            <a href="{{ url('category/'.$product->category->slug.'/'.$product->slug) }}">
                                @if($product->image)
                                <img src="{{ asset('storage/images/product/'. $product->id . '/' . $product->image) }}" alt="Product Image" class="image-fluid">
                                @else
                                <img src="{{ asset('image/product/default-image.jpg') }}" alt="Product Image" class="image-fluid">
                                @endif
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