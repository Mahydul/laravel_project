@extends('main.layout')
@section('content')
    <div class="container">
        <br />
        <h3 align="center">Laravel 5.8 Ajax Crud Tutorial - Delete or Remove Data</h3>
        <br />
        <div class="row justify-content-center align-self-center">
            <form id="create_category" data-route="{{route('saveCategory')}}">
                @csrf
                <label>Title:</label>
                <input type="text" class="form-control" name="title">
                <input type="text" class="form-control" name="description">
                <button type="submit">Save</button>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/scripts/category.js') }}"></script>
@endsection