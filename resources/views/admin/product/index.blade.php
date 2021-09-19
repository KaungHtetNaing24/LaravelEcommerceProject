@extends('layouts.admin')
@section('title')
    Products
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
                <h4>Products</h4>
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
                            @if($product->image)
                            <img src="{{ asset('storage/images/product/'. $product->id . '/' . $product->image) }}" style="max-width:100px;width:100%;height:auto;" alt="Image">
                            @else
                            <img src="{{ asset('image/product/default-image.jpg') }}" style="max-width:100px;width:100%;height:auto;" alt="Image">
                            @endif
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