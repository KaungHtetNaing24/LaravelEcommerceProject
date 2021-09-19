@extends('layouts.admin')
@section('title')
    Users
@endsection
@section('nav')
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Users</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form" action="{{ url('admin/user-search') }}" method="GET">
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
                <h4>Users</h4>
            </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    @foreach(Auth::user()->roles as $role)
                                        @if($role->name == 'Manager')
                                        <th>Action</th>
                                        @endif
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td><img src="{{ asset('storage/images/profile/'.$user->id. '/' .$user->image) }}" style="max-width:100px;width:100%;height:auto;" alt="Image"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_no }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                        @foreach(Auth::user()->roles as $role)
                                            @if($role->name == 'Manager')
                                            <td><a href="{{ url('/admin/users/'.$user->id.'/edit') }}" class="btn btn-sm btn-info">Manage Roles</a></td>
                                            @endif
                                        @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <span>{{ $users->links() }}</span>
                </div>
            
        </div>
@endsection