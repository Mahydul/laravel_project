$(document).ready(function(){
    var base_path = $("#url").val();
    $('#uom_table').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            //url: "{{ route('categories.index') }}",
            url: "/uom-list",
        },
        columns:[
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
    $('#uom').submit(function (e) {
        //debugger;
        var route = $('#uom').data('route');
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
            url:"/uom-update",
            data:{
                "id":id
            },
            dataType:"json",
            success:function (response) {
                if(response.hasOwnProperty("status")){
                    if(response['status']==200){
                        var name = response['name'];
                        var des = response['description'];
                        var id = response['id'];
                        $('#name').val(name);
                        $('#des').val(des);
                        $('#uom_id').val(id);
                    }
                }
            }
        });
    });
    $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        $confirm_alert = alert('Are you sure to delete ?');

        $.ajax({
            type:"GET",
            url:"/uom-delete",
            data:{
                "id":id
            },
            dataType:"json",
            success:function (response) {
                if(response.hasOwnProperty("status")){
                    if(response['status']==200) {
                        alert(response['message']);
                        $('#uom_table').DataTable().ajax.reload();
                    }else{
                        alert(response['message']);
                    }
                }
            }
        });
    });
});