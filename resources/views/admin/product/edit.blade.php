@extends('layouts.admin')
@section('title')
    Edit Product
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
                        <img id="previewImg" src="{{ asset('storage/images/product/'. $product->name . '/' . $product->image) }}" alt="Product image" style="max-width:250px;"/>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <input type="file" name="image" class="form-control" onchange="previewFile(this)">
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