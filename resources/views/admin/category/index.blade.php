@extends('layouts.admin')

@section('content')
        <div class="card">
            <div class="card-header">
                <h4>Categories</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ url('admin/categories/'.$category->id.'/edit') }}">
                                <button class="btn btn-primary">Edit</button>
                                </a>
                                <a href="{{ url('admin/categories/'.$category->id.'/delete') }}">
                                <button class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
@endsection