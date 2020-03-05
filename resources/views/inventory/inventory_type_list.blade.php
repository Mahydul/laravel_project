@extends('main.layout')
@section('content')
    <style>

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 5%;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <div class="container">

        <h3>Category List</h3>
        <br />
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                <tr>
                    <th width="10%">Image</th>
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

    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Record</h4>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-4" >First Name : </label>
                            <div class="col-md-8">
                                <input type="text" name="first_name" id="first_name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Last Name : </label>
                            <div class="col-md-8">
                                <input type="text" name="last_name" id="last_name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Select Profile Image : </label>
                            <div class="col-md-8">
                                <input type="file" name="image" id="image" />
                                <span id="store_image"></span>
                            </div>
                        </div>
                        <br />
                        <div class="form-group" align="center">
                            <input type="hidden" name="action" id="action" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h2>Modal Example</h2>

    <!-- Trigger/Open The Modal -->
    <button id="myBtn">Open Modal</button>

    <!-- The Modal -->
    <div class="row justify-content-center">
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <h3>Create Category</h3>
                <br />
                <div class="row">
                    <form id="create_category" data-route="{{route('saveCategory')}}">
                        @csrf
                        <label>Title:</label>
                        <input type="text" class="form-control" name="title" id="title">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" id="des">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" id="image" />
                        <input type="hidden" id="category_id" value="0" name="id">
                        <button type="submit" class="mt-1 mb-2 btn btn-success">Save</button>
                        <button id="close" class="btn btn-success">&times;</button>
                    </form>
                </div>

            </div>

        </div>
    </div>



@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/scripts/inventory_type.js') }}"></script>
@endsection