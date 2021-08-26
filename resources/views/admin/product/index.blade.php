@extends('layouts.admin')

@section('content')
        <div class="card">
            <div class="card-header bg-primary text-white">
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
                            <img src="{{ asset('storage/images/product/'. $product->name . '/' . $product->image) }}" style="max-width:100px;width:100%;height:auto;" alt="Image">
                            </td>
                            
                            <td>
                                <a href="{{ url('admin/products/'.$product->id.'/edit') }}">
                                <button class="btn btn-primary">Edit</button>
                                </a>
                                <a href="" data-toggle="modal" data-target="#exampleModal{{ $product->id }}">
                                <button class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                        
                        <div class="modal" tabindex="-1" role="dialog" id="exampleModal{{ $product->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                 <form action="{{ url('admin/products/'.$product->id.'/delete') }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-body">
                                        <p>Are You Sure Want To Delete? {{ $product->name }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href=""><button type="submit" class="btn btn-danger">Delete</button></a>
                                    </div>
                                 </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </tbody>
                </table>
                <span>{{ $products->links() }}</span>
            </div>
        </div>
@endsection