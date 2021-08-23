@extends('layouts.admin')

@section('content')
        <div class="card">
            <div class="card-header">
                <h4>Categories</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Original Price</th>
                            <th>Discount %</th>
                            <th>Selling Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->original_price }}</td>
                            <td>{{ $product->discount }}</td>
                            <td>{{ $product->final_price }}</td>
                            <td>
                            <img src="{{ asset('storage/images/product/'. $product->image) }}" style="max-width:100px;" alt="Image">
                            </td>
                            
                            <td>
                                <a href="{{ url('admin/products/'.$product->id.'/edit') }}">
                                <button class="btn btn-primary">Edit</button>
                                </a>
                                <a href="{{ url('admin/products/'.$product->id.'/delete') }}">
                                <button class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
@endsection