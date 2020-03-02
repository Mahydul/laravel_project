@extends('main.layout')
@section('content')
    <div class="container">
        <br />
        <h3 align="center">Create Category</h3>
        <br />
        <div class="row justify-content-center align-self-center">
            <form id="create_category" data-route="{{route('saveCategory')}}">
                @csrf
                <label>Title:</label>
                <input type="text" class="form-control" name="title">
                <label>Description</label>
                <input type="text" class="form-control" name="description">
                <label>Image</label>
                <input type="file" class="form-control" name="image" id="image" />
                <button type="submit" class="mt-1 mb-2 btn btn-success">Save</button>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/scripts/category.js') }}"></script>
@endsection