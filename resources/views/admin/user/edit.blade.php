@extends('layouts.admin')
@section('title')
    Manage Roles
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
            <div class="card-header  bg-primary text-white">
                <h4>Manage Roles<a href="{{ url('admin/users') }}" class="btn btn-success btn-sm float-right">Back</a></h4>
            </div>
                <div class="card-body">
                    <form action="{{ url('admin/users/'.$user->id.'/add-role') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <ul>
                                <li>Name: {{ $user->name }}</li>
                                <li>Email: {{ $user->email }}</li>
                                <li>Phone: {{ $user->phone_no }}</li>
                                <li>Address: {{ $user->address }}</li><br>
                                <img src="{{ asset('storage/images/profile/'.$user->name. '/' .$user->image) }}" style="max-width:150px;width:100%;height:auto;" alt="Image">
                                <hr>
                                <h5>Roles</h5>
                                @foreach($roles as $role)
                                    
                                    <div>
                                    <input type="checkbox" name="role_ids[]" value="{{$role->id}}"  id="label{{ $role->id }}"
                                    @foreach($user->roles as $userRole)
                                        @if($userRole->name == $role->name)
                                        checked
                                        @endif
                                    @endforeach
                                    >
                                    <label for="label{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                    
                                @endforeach
                                <br>
                                <button class="btn btn-primary" onclick="return val()">Add Role</button>
                            </ul>
                            
                        </div>
                    </form>
                </div>
            
        </div>

        <script>
            function val(){
                var chks = document.getElementsByName('role_ids[]');
                var hasChecked = false;
                for (var i = 0; i< chks.length; i++)
                {
                    if(chks[i].checked)
                    {
                        hasChecked = true;
                        break;
                    }
                }
                if(hasChecked == false)
                {
                  Swal.fire({
                    position: 'top',
                    icon:"warning",
                    text:"Please select at least one role.",
                    showConfirmButton: true,
                    })
                    return false;
                }
                return true;
            }
        </script>
@endsection