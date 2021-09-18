@extends('layouts.front')

@section('title')
    My Profile
@endsection

@section('content')
<div class="py-3 shadow-sm bg-warning">
    <div class="container">
        <h5 class="mt-5 tag">
        <a href="{{ url('/') }}">Home</a>/
            My Profile
        </h5>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="uicard">
                <div class="card-header bg-primary">
                    <h3 class="text-light"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;My Profile</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-center">
                            @if(Auth::user()->image)
                            <img src="{{ asset('storage/images/profile/'. Auth::user()->id . '/' . Auth::user()->image) }}" alt="Image" class="img-fluid" style="clip-path: circle();width: 300px;">
                            @else
                            <img src="{{ asset('image/profile/profile.png') }}" alt="Image" class="img-fluid" style="clip-path: circle();width: 300px;">
                            @endif
                            <hr><br>
                        </div>
                        <div class="col-md-8 p-4">
                            <h4>Information&nbsp;<i class="fa fa-info-circle" aria-hidden="true"></i></h4><hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Name</h4>
                                    <h5 class=fw-light>{{ Auth::user()->name }}</h5>
                                </div><br>
                                <div class="col-md-6">
                                    <h4>Email</h4>
                                    <h5  class=fw-light>{{ Auth::user()->email }}</h5>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Phone</h4>
                                    <h5 class=fw-light>{{ Auth::user()->phone_no }}</h5>
                                </div><br>
                                <div class="col-md-6">
                                    <h4>Address</h4>
                                    <h5  class=fw-light>{{ Auth::user()->address }}</h5>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ url('profile/edit') }}" class="btn btn-warning">Edit Profile&nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a href="{{ url('profile/change-password') }}" class="btn btn-success">Change Password&nbsp;<i class="fa fa-unlock-alt" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection