@extends('layouts.front')

@section('title')
    My Orders
@endsection

@section('content')
<div class="py-3 shadow-sm bg-warning">
    <div class="container">
        <h5 class="mt-5 tag">
        <a href="{{ url('/') }}">Home</a>/
            My Orders
        </h5>
    </div>
</div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="uicard">
                    <div class="card-header bg-primary">
                        <h4 class="text-light">My Orders</h4>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order date</th>
                            <th>Order number</th>
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
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->status == '0' ? 'pending' : 'completed' }}</td>
                            <td>
                                <a href="{{ url('view-order/'.$order->id) }}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection