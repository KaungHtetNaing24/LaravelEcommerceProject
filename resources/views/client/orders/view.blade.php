@extends('layouts.front')

@section('title')
    Order-detail
@endsection

@section('content')
<div class="container py-5 my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="uicard">
                <div class="card-header bg-primary ">
                    <h4 class="text-light py-2 rounded">Order detail
                        <a href="{{ url('my-orders') }}" class="btn btn-info float-end">Back</a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection