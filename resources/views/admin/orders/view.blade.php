@extends('layouts.admin')

@section('title')
    Order-detail
@endsection
@section('nav')
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Orders</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form" action="{{ url('admin/order-search') }}" method="GET">
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
                <div class="card-header bg-primary ">
                    <h4 class="text-light">Order detail
                        <a href="{{ url('admin/orders') }}" class="btn btn-info float-right">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Shipping Detail</h5><hr>
                            <label for="">Order No</label>
                            <input type="text" class=form-control value="{{ $orders->order_no }}" readonly>
                            <label for="">Name</label>
                            <input type="text" class=form-control value="{{ $orders->users->name }}" readonly>
                            <label for="">Email</label>
                            <input type="text" class=form-control value="{{ $orders->users->email }}" readonly>
                            <label for="">Phone</label>
                            <input type="text" class=form-control value="{{ $orders->users->phone_no }}" readonly>
                            <label for="">Address</label>
                            <input type="text" class=form-control value="{{ $orders->users->address }}" readonly>
                            <label for="">Address detail</label>
                            <textarea rows="3" class="form-control" readonly>{{ $orders->address_detail }}</textarea>
                            <label for="">Status</label>
                            <input type="text" class=form-control value="{{ $orders->status == '0' ? 'pending' : 'completed' }}" readonly>
                            <label for="">Payment method</label>
                            <input type="text" class=form-control value="{{ $orders->payment_method }}" readonly>
                        </div>
                        <div class="col-md-6">
                        <h5>Order Detail</h5><hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders->orderdetails as $order)
                                    <tr>
                                        <td>{{ $order->products->name }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->price }} Ks</td>
                                        <td>
                                        @if($order->products->image)
                                            <img src="{{ asset('storage/images/product/'. $order->products->id . '/' . $order->products->image) }}" style="max-width:75px;" alt="Product Image" class="image-fluid">
                                            @else
                                            <img src="{{ asset('image/product/default-image.jpg') }}" style="max-width:75px;" alt="Product Image" class="image-fluid">
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h5>Total amount: {{ $orders->total_price }} Ks</h5>
                            <div class="mt-5 px-2">
                            <label for="">Order Status</label>
                            <form action="{{ url('admin/update-status/'.$orders->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <select class="form-select" name="order_status">
                                    <option {{ $orders->status == '0'? 'selected':'' }} value="0">Pending</option>
                                    <option {{ $orders->status == '1'? 'selected':'' }} value="1">Completed</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection