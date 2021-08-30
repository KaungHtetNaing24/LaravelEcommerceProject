@extends('layouts.front')

@section('title')
    {{ $category->name }}
@endsection

@section('content')

<div class="py-3 shadow-sm bg-warning">
    <div class="container">
        <h6 class="mt-5">Collection/ {{ $category->name }}</h6>
    </div>
</div>

<div class="py-5">
        <div class="container">
            <div class="row">
                <h2>{{ $category->name }}</h2><br>
                <p>{{ $category->description }}</p>
                <hr>
                    @foreach($products as $product)
                        <div class="col-md-3 mt-3">
                            <div class="card">
                            <a href="{{ url('category/'.$category->slug.'/'.$product->slug) }}">
                                <img src="{{ asset('storage/images/product/'. $product->name . '/' . $product->image) }}" style="height:250px;" alt="Product Image" class="image-fluid">
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
            </div>
        </div>
</div>

@endsection