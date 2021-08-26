@extends('layouts.admin')

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
                                    <td><img src="{{ asset('storage/images/profile/'.$user->name. '/' .$user->image) }}" style="max-width:100px;width:100%;height:auto;" alt="Image"></td>
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