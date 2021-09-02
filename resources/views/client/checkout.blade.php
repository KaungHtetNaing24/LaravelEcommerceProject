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
        <form action="{{ url('place-order') }}" method="POST">
            @csrf
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
                            <textarea name="address_detail" rows="3" class="form-control @error('address_detail') is-invalid @enderror" id="address_detail"></textarea>
                            @error('address_detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <br>
                            <label for="" class="fw-bold">Payment method</label>
                              <input type="radio" id="cash" name="payment_method" value="cash" class="@error('payment_method') is-invalid @enderror" id="payment_method">
                              <label for="cash">Payment on delivery</label>
                              <input type="radio" id="online" name="payment_method" value="online"  class="@error('payment_method') is-invalid @enderror" id="payment_method">
                              <label for="online">Online Payment</label>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="uicard">
                    @if($cartitems->count() > 0)
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
                           @php $total = 0; @endphp
                           @foreach($cartitems as $item)
                               <tr>
                                    <td>{{ $item->products->name }}</td>
                                    <td>{{ $item->products->final_price }}</td>
                                    <td>{{ $item->product_quantity }}</td>
                                
                               </tr>
                               @php $total += $item->products->final_price * $item->product_quantity; @endphp
                               @endforeach
                           </tbody>
                       </table>
                        <hr>
                        
                        <div class="d-grid gap-2">
                        <h5 class="float-first">Total Price: {{ $total }} Ks</h5>
                        <button type="submit" class="btn btn-success">Place Order</button>
                        </div>
                        
                    </div>
                    @else
                    <div class="card-body text-center">
                    <h2>Your cart is empty</h2><br>
                    <div class="d-grid gap-2">
                    <a href="{{ url('/') }}" class="btn btn-success">Continue Shopping</a>
                    </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection