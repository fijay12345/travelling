@extends('layouts.app')
@section('title', 'View All Category')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Category</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('categories.create') }}" class="btn btn-primary float-right">Add New Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="table-categories" class="table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Views Count</th>
                                    <th>Comments Count</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category>title }}</td>
                                        <td>{{ $category->views }} views</td>
                                        <td>{{ count($category->comments) }} comments</td>
                                        <td>
                                                @if (is_null($category->deleted_at))
                                                Active
                                                @else
                                                Deleted
                                                @endif
    
                                            </td>
                                            <td>
                                                @if (is_null($category->deleted_at))
                                                <a href="{{ route('view-catgory', ['slug' => $category->slug]) }}" class="btn btn-sm btn-success">View</a>
                                                <a href="{{ route('categories.edit', ['slug' => $category->slug]) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ route('categories.delete', ['slug' => $category->slug]) }}" class="btn btn-sm btn-danger">Delete</a>
                                                @else
                                                <a href="{{ route('categories.restore', ['slug' => $category->slug]) }}" class="btn btn-sm btn-primary">Restore</a>
                                                <a href="{{ route('categories.force-delete', ['slug' => $category->slug]) }}" class="btn btn-sm btn-danger">Force Delete</a>
                                                @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#table-categories').DataTable();
        });
    </script>
@endsection