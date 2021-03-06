@extends('layouts.admin')
@section('title')
    Edit Product
@endsection
@section('nav')
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Products</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form" action="{{ url('admin/prod-search') }}" method="GET">
              <div class="input-group no-border">
                <input type="text" value="" name="search" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                  <i class="material-icons" title="User dashboard">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    User Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="{{ url('profile') }}">Profile</a>
                  
                  <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                          </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
@endsection
@section('content')
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Edit/Update Product<a href="{{ url('admin/products') }}" class="btn btn-success btn-sm float-right">Back</a></h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/update-product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                        <select class="form-select form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" >
                                <b><option value="{{ $product->category->id }}">{{ $product->category->name }}</option></b>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id  }}">{{ $category->name  }}</option>
                                @endforeach
                                

                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    
                    
                    
                        <div class="col-md-6 mb-3">
                            <label for="">Name</label>
                            <input type="text" value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Slug</label>
                            <input type="text" value="{{ $product->slug }}" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description"  rows="3" class="form-control @error('description') is-invalid @enderror" id="description">{{ $product->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="">Quantity</label>
                            <input type="number" value="{{ $product->quantity }}" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Original Price</label>
                            <input type="number" value="{{ $product->original_price }}" class="form-control @error('original_price') is-invalid @enderror" id="original_price" name="original_price">
                            @error('original_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Discount</label>
                            <input type="number" value="{{ $product->discount }}" class="form-control" id="discount" name="discount">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Selling Price</label>
                            <input type="number" value="{{ $product->final_price }}" class="form-control @error('final_price') is-invalid @enderror" id="final_price" name="final_price">
                            @error('final_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="">Popular</label>
                            <input type="checkbox" {{ $product->popular == "1" ? 'checked' : '' }} name="popular">
                        </div>

                        <div class="col-md-12 mb-3">
                          @if($product->image)
                        <img id="previewImg" src="{{ asset('storage/images/product/'. $product->id . '/' . $product->image) }}" alt="Product image" style="max-width:250px;"/>
                        @else
                        <img id="previewImg" src="{{ asset('image/product/default-image.jpg') }}" alt="Product image" style="max-width:250px;"/>
                        @endif
                        </div>
                        
                        <div class="col-md-12 mb-3">
                        <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror" onchange="previewFile(this)" id="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        
                        
                        
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        
                        
                    </div>
                </form>
            </div>
        </div>
        <script>
            function previewFile(input){
            var file=$("input[type=file]").get(0).files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                $('#previewImg').attr("src",reader.result);
                }
                reader.readAsDataURL(file);
            }
            }
        </script>
@endsection