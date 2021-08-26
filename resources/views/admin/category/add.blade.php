@extends('layouts.admin')

@section('content')
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Add Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/insert-category') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        
                        
                    </div>
                </form>
            </div>
        </div>
@endsection