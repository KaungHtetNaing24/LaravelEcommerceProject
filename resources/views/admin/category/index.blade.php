@extends('layouts.admin')

@section('content')
        <div class="card">
            <div class="card-header bg-primary text-white">
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
                                <a href="" data-toggle="modal" data-target="#exampleModal{{ $category->id }}">
                                <button class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                        <div class="modal" tabindex="-1" role="dialog" id="exampleModal{{ $category->id }}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are You Sure Want To Delete? {{ $category->name }}</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ url('admin/categories/'.$category->id.'/delete') }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                        
                    </tbody>
                </table>
                <span>{{ $categories->links() }}</span>
            </div>
        </div>
@endsection