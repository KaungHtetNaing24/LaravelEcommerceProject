@extends('layouts.admin')
@section('title')
    Edit Category
@endsection
@section('content')
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Edit/Update Category<a href="{{ url('admin/categories') }}" class="btn btn-success float-right">Back</a></h4>
                
            </div>
            <div class="card-body">
                <form action="{{ url('admin/update-category/'.$category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Name</label>
                            <input type="text" value="{{ $category->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Slug</label>
                            <input type="text" value="{{ $category->slug }}" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" id="description">{{ $category->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        
                        
                    </div>
                </form>
            </div>
        </div>
@endsection