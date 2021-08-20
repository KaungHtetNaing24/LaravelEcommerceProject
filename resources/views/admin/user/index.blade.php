@extends('layouts.admin')

@section('content')
        <div class="card">
            <div class="card-header">
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
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td><img src="{{ asset('storage/images/profile/'. $user->image) }}" style="max-width:100px;" alt="Image"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_no }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach(Auth::user()->roles as $role)
                                            @if($role->name == 'Manager')
                                            <a href="{{ url('/admin/users/'.$user->id.'/edit') }}" class="btn btn-sm btn-info">Manage Roles</a>
                                            @endif
                                        @endforeach

                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <span>{{ $users->links() }}</span>
                </div>
            
        </div>
@endsection