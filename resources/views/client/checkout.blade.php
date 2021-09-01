@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')

    <div class="py-3 shadow-sm bg-warning">
        <div class="container">
            <h5 class="mt-5 tag">
            <a href="{{ url('/') }}">Home</a>/
            <a href="{{ url('cart') }}">Cart</a>/
            Checkout
            </h5>
        </div>
    </div>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-7">
                <div class="uicard">
                    <div class="card-body">
                        <h6>Basic Details</h6><hr><br>
                        <div class="row">
                            <div class="col-md-12">
                            <label for="" class="fw-bold">Name</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name" readonly>
                            <label for="" class="fw-bold">Phone No</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->phone_no }}" name="phone_no" readonly>
                            <label for="" class="fw-bold">E-mail</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->email }}" name="email" readonly>
                            <label for="" class="fw-bold">Address</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->address }}" name="address" readonly><br>
                            <label for="" class="fw-bold">Address Detail</label>
                            <textarea name="detail_address" rows="3" class="form-control"></textarea><br>
                            <label for="" class="fw-bold">Payment method</label>
                              <input type="radio" name="delivery" id="" value="">
                              <label for="">Payment on delivery</label>
                              <input type="radio" name="online" id="" value="">
                              <label for="">Online Payment</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="uicard">
                    <div class="card-body">
                       <h6>Order Details</h6><hr>
                       <table class="table table-striped table-bordered">
                           <thead>
                               <tr>
                                   <th>Name</th>
                                   <th>Price</th>
                                   <th>Quantity</th>
                               </tr>
                           </thead>
                           <tbody>
                           @foreach($cartitems as $item)
                               <tr>
                                    <td>{{ $item->products->name }}</td>
                                    <td>{{ $item->products->final_price }}</td>
                                    <td>{{ $item->product_quantity }}</td>
                                
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                        <hr>
                        <div class="d-grid gap-2">
                        <button class="btn btn-success">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection