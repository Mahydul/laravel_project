@extends('main.layout')
@section('content')
    <div class="container">
        <br />
        <h3>Unit Of Measurement</h3>
        <br />
        <div class="row">
            <form id="uom" data-route="{{route('saveUom')}}">
                @csrf
                <label>Name:</label>
                <input type="text" class="form-control" name="name" id="title">
                <label>Description</label>
                <input type="text" class="form-control" name="description" id="des">
                <input type="hidden" id="uom_id" value="0" name="id">
                <button type="submit" class="mt-1 mb-2 btn btn-success">Save</button>
            </form>
        </div>
        <br />
        <h3>Unit of Measurement List</h3>
        <br />
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="uom_table">
                <thead>
                <tr>
                    <th width="35%">Name</th>
                    <th width="35%">Description</th>
                    <th width="30%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
        <br />
        <br />
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('assets/scripts/uom.js')}}"></script>
@endsection