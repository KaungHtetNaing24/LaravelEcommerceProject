@extends('layouts.admin')

@section('title')
    Orders
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
                <div class="card-header bg-primary">
                    <h4 class='text-white'>New Orders
                        <a href="{{ 'order-history' }}" class="btn btn-sm btn-warning float-right">Order history</a>
                    </h4>
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
           
@endsection