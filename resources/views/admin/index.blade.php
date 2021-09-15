@extends('layouts.admin')
<?php
 use App\Http\Controllers\Admin\ProductController;
 use App\Http\Controllers\Admin\OrderController;
 use App\Http\Controllers\UserController;
 $total_outstock = ProductController::productOutStock();
 $total_items = ProductController::productItems();
 $new_orders = OrderController::newOrder();
 $total_users = UserController::userCount();
?>

@section('title')
    Dashboard
@endsection
@section('nav')
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
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
                <input type="text" value="" name="search" class="form-control" placeholder="Search by order no">
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
                    Stats
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card py-5 px-5">
                <div class="row">
                    <div class="col-md-3 mb-2">
                    <a href="{{ url('admin/products') }}">
                        <div class="card-body bg-primary shadow rounded" style="height: 7rem;">
                        <h2 class="text-light font-weight-bold">{{  $total_items }} Products</h2>
                            <h4 class="text-light font-weight-bold">In Inventory</h4>
                        </div>
                    </a>
                    </div>
                    <div class="col-md-3 mb-2">
                    <a href="{{ url('admin/products') }}">
                        <div class="card-body bg-info shadow rounded" style="height: 7rem;">
                        <h2 class="text-light font-weight-bold">{{  $total_outstock }} Products</h2>
                            <h4 class="text-light font-weight-bold">Out of Stock</h4>
                        </div>
                    </a>
                    </div>
                    <div class="col-md-3 mb-2">
                    <a href="{{ url('admin/orders') }}">
                        <div class="card-body bg-success shadow rounded" style="height: 7rem;">
                        <h2 class="text-light font-weight-bold">{{  $new_orders }} orders</h2>
                            <h4 class="text-light font-weight-bold">In pending state</h4>
                        </div>
                    </a>
                    </div>
                    <div class="col-md-3 mb-2">
                    <a href="{{ url('admin/users') }}">
                        <div class="card-body bg-dark shadow rounded" style="height: 7rem;">
                        <h2 class="text-light font-weight-bold">{{  $total_users }} total</h2>
                            <h4 class="text-light font-weight-bold">Users</h4>
                        </div>
                    </a>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="card-header bg-secondary shadow rounded">
                        <h4 class="text-light font-weight-bold">New orders</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order date</th>
                            <th>Order number</th>
                            <th>Customer Name</th>
                            <th>Total price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                            <td>{{ $order->order_no }}</td>
                            <td>{{ $order->users->name }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->status == '0' ? 'pending' : 'completed' }}</td>
                            <td>
                                <a href="{{ url('admin/view-order/'.$order->id) }}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <span>{{ $orders->links() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection