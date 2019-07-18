@extends('layouts.app')
@section('title', "Search result for: {$keyword}")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 my-2">
                                <form action="{{ route('search') }}" method="get">
                                    <label for="keyword">Search for : </label>
                                        <input name="keyword" type="text" class="form-control" placeholder="Type a keyword...">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @each('components.blog-card', $posts, 'data', 'components.blog-empty')
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@endsection
