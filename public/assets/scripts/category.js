
$(document).ready(function(){
    $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            //url: "{{ route('categories.index') }}",
            url: "/categories",
        },
        columns:[
            {
                data: 'image',
                name: 'image',
                render: function(data, type, full, meta){
                    return "<img src={{ URL::to('/') }}/images/" + data + " width='70' class='img-thumbnail' />";
                },
                orderable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
    });
    $('#create_category').submit(function (e) {
        //debugger;
        var route = $('#create_category').data('route');
        var form_data = $(this);
        $.ajax({
            type:'POST',
            url:route,
            data:form_data.serialize(),
            success:function (response) {
                //console.log(response);
                window.reload();
            }
        });
        e.preventDefault();
    });

    $('#create_record').click(function(){
        $('.modal-title').text("Add New Record");
        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#formModal').modal('show');
    });

    $('#sample_form').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == 'Add')
        {
            $.ajax({
                //url:"{{ route('categories.store') }}",
                url:"categories/store",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            })
        }

        if($('#action').val() == "Edit")
        {
            $.ajax({
                //url:"{{ route('categories.update') }}",
                url:"categories/update",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#store_image').html('');
                        $('#user_table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            });
        }
    });

    $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url:"/categories/"+id+"/edit",
            dataType:"json",
            success:function(html){
                $('#first_name').val(html.data.first_name);
                $('#last_name').val(html.data.last_name);
                $('#store_image').html("<img src={{ URL::to('/') }}/images/" + html.data.image + " width='70' class='img-thumbnail' />");
                $('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.image+"' />");
                $('#hidden_id').val(html.data.id);
                $('.modal-title').text("Edit New Record");
                $('#action_button').val("Edit");
                $('#action').val("Edit");
                $('#formModal').modal('show');
            }
        })
    });

    var user_id;

    $(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
        $.ajax({
            url:"categories/destroy/"+user_id,
            beforeSend:function(){
                $('#ok_button').text('Deleting...');
            },
            success:function(data)
            {
                setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    $('#user_table').DataTable().ajax.reload();
                }, 2000);
            }
        })
    });

});