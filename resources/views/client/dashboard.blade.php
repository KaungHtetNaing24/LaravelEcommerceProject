@extends('layouts.front')

@section('title')
    Welcome to my Shop
@endsection

@section('content')
    @include('layouts.inc.slider')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Popular Items<a href="" class="btn btn-primary float-end">Shop more</a></h4>
                    
                </div>
                <div class="owl-carousel popular-carousel owl-theme">
                    @foreach($popular_products as $popular)
                        <div class="item mt-3">
                            <div class="card">
                                <img src="{{ asset('storage/images/product/'. $popular->name . '/' . $popular->image) }}" style="height:250px;" alt="Product Image" class="image-fluid">
                                <div class="card-body">
                                    <h5>{{ $popular->name }}</h5>
                                    <span class="float-first fs-5 fw-bold">{{ $popular->final_price }} Ks</span>
                                    @if($popular->final_price != $popular->original_price)
                                        <span class="float-end fw-light"><s>{{ $popular->original_price }} Ks</s></span>
                                        <span class="float-end fw-light"> (-{{ $popular->discount }}%)</span>
                                    @endif()
                                </div>
                            </div>
                        </div>
                     @endforeach
                </div><br>
                
                
                
                <div class="col-md-12">
                    <h4>Feature Items<a href="" class="btn btn-primary float-end">Shop more</a></h4>
                    
                </div>
                <div class="owl-carousel popular-carousel owl-theme">
                    @foreach($products as $product)
                        <div class="item mt-3">
                            <div class="card">
                                <img src="{{ asset('storage/images/product/'. $product->name . '/' . $product->image) }}" style="height:250px;" alt="Product Image" class="image-fluid">
                                <div class="card-body">
                                    <h5>{{ $product->name }}</h5>
                                    <span class="float-first fs-5 fw-bold">{{ $product->final_price }} Ks</span>
                                    @if($product->final_price != $product->original_price)
                                        <span class="float-end fw-light"><s>{{ $product->original_price }} Ks</s></span>
                                        <span class="float-end fw-light"> (-{{ $product->discount }}%)</span>
                                    @endif()
                                    
                                </div>
                            </div>
                        </div>
                     @endforeach
                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function (){
        $('.popular-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            dots:true,
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    });

</script>
@endsection
