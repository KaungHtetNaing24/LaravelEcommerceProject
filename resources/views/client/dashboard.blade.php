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
                    <h4>Popular Items<a href="{{ url('popular-products') }}" class="btn btn-primary float-end">Shop more</a></h4>
                    
                </div>
                <div class="owl-carousel popular-carousel owl-theme">
                    @foreach($popular_products as $popular)
                        <div class="item mt-3">
                            <div class="card">
                            <a href="{{ url('category/'.$popular->category->slug.'/'.$popular->slug) }}">
                                <img src="{{ asset('storage/images/product/'. $popular->name . '/' . $popular->image) }}" alt="Product Image" class="image-fluid">
                                <div class="card-body">
                                    <h5>{{ $popular->name }}</h5>
                                    <span class="float-first fs-5 fw-bold">{{ $popular->final_price }} Ks</span>
                                    @if($popular->final_price != $popular->original_price)
                                        <span class="float-end fw-light"><s>{{ $popular->original_price }} Ks</s></span>
                                        <span class="float-end fw-light"> (-{{ $popular->discount }}%)</span>
                                    @endif()
                                </div>
                            </a>
                            </div>
                        </div>
                     @endforeach
                </div><br>
                
                
                
                <div class="col-md-12">
                    <h4>Feature Items<a href="{{ url('all-products') }}" class="btn btn-primary float-end">Shop more</a></h4>
                    
                </div>
                <div class="owl-carousel popular-carousel owl-theme">
                    @foreach($products as $product)
                        <div class="item mt-3">
                            <div class="card">
                                <a href="{{ url('category/'.$product->category->slug.'/'.$product->slug) }}">
                                <img src="{{ asset('storage/images/product/'. $product->name . '/' . $product->image) }}"  alt="Product Image" class="image-fluid">
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
                </div><br><hr>

                @foreach($categories as $category)
                <div class="col-md-12">
                    <h4>{{ $category->name }} Items<a href="{{ url('category/'.$category->slug) }}" class="btn btn-primary float-end">Shop more</a></h4>
                </div>
                <div class="owl-carousel category-carousel owl-theme">
                    @foreach($cateprod as $prod)
                    @if($prod->category_id == $category->id)
                        <div class="item mt-3">
                            <div class="card">
                                <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
                                <img src="{{ asset('storage/images/product/'. $prod->name . '/' . $prod->image) }}"  alt="Product Image" class="image-fluid">
                                <div class="card-body">
                                    <h6>{{ $prod->name }}</h6>
                                    <span class="float-first fs-5 fw-bold">{{ $prod->final_price }} Ks</span>
                                    @if($prod->final_price != $prod->original_price)
                                        <span class="float-end fw-light"><s>{{ $prod->original_price }} Ks</s></span>
                                        <span class="float-end fw-light"> (-{{ $prod->discount }}%)</span>
                                    @endif()
                                    
                                </div>
                                </a>
                            </div>
                        </div>
                     @endif
                     @endforeach
                </div>
                @endforeach
                </div>
                <br>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function (){
        $('.popular-carousel').owlCarousel({
            loop:false,
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

    $(document).ready(function (){
        $('.category-carousel').owlCarousel({
            loop:false,
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
                    items:5
                }
            }
        })
    });

</script>
@endsection
