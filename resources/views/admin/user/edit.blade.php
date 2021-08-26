@extends('layouts.admin')

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
                    alert("Please select at least one role");
                    return false;
                }
                return true;
            }
        </script>
@endsection