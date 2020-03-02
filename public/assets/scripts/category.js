
$(document).ready(function(){
    var base_path = $("#url").val();
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
                    return "<img src="+base_path+"/images/" + data + " width='70' class='img-thumbnail' />";
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
            //data:form_data.serialize(),
            data:new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success:function (response) {
                if(response.hasOwnProperty("status")){
                    if(response['status']==200){
                        alert(response['success']);
                        location.reload();
                    }else{
                        if(response.hasOwnProperty("errors")){
                            alert(response['errors']);
                        }
                        //alert(response['errors'].join("\n"));

                    }
                }
                //location.reload();
            }
        });
        e.preventDefault();
    });

    $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        $.ajax({
            type:"GET",
            url:"/update-category",
            data:{
                "id":id
            },
            dataType:"json",
            success:function (response) {
            }
        });
    });
});