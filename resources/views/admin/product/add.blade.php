@extends('layouts.admin')
@section('title')
    Add Product
@endsection
@section('content')
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Add Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/insert-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                        <select class="form-select form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" >
                                <option value="">Select a Category</option>
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
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ old('slug') }}" name="slug">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" id="description" value="{{ old('description') }}"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="">Quantity</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" value="{{ old('quantity') }}" name="quantity">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Original Price</label>
                            <input type="number" class="form-control @error('original_price') is-invalid @enderror" id="original_price" value="{{ old('original_price') }}" name="original_price">
                            @error('original_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Discount</label>
                            <input type="number" class="form-control" id="discount" value="{{ old('discount') }}" name="discount">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Selling Price</label>
                            <input type="number" class="form-control @error('final_price') is-invalid @enderror" id="final_price" value="{{ old('final_price') }}" name="final_price">
                            @error('final_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="">Popular</label>
                            <input type="checkbox" name="popular">
                        </div>
                        
                        <div class="col-md-12 mb-3">
                        <img id="previewImg" src="{{ asset('storage/images/product/product-image.jpg') }}" alt="Product image" style="max-width:150px;width:100%;height:auto;"/>
                        </div>
                        
                        
                        <div class="col-md-12 mb-3">
                            
                            <input type="file" name="image" class="form-control @error('category_id') is-invalid @enderror" onchange="previewFile(this)" id="category_id">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        
                        
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
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