$(document).ready(function () {

    var page=1;
    $(function () {
        getAjaxWithPage(page);
    });
    function getAjaxWithPage(page) {
        if(!page){
            page=1;
        }
        $.ajax({
            url: 'http://localhost/new%20code/student_crud_ajax/public/ajaxdata/getdata?page=' + page,
            type: "get",
            success: function (result) {
                html = '';
                htmlPage = '';
                $.each(result.data, function (index, value) {
                    html += '<tr>'
                    html += '<th scope="row">' + value.id + '</th>'
                    html += '<td>' + value.first_name + '</td>'
                    html += '<td>' + value.last_name + '</td>'
                    html += '<td><a href="#" class="btn btn-primary edit" data-id="'+value.id+'">Edit</a><a href="#" class="btn btn-danger delete" data-id = '+value.id+'>Delete</a>  </td>'
                    html += '</tr>'
                });
                if(result.last_page>1){
                    for (i = 1; i <= result.last_page; i++) {
                        htmlPage += '<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>';
                    };
                }

                $('.pagination').html(htmlPage);
                $('#list-item').html(html);

            }
        });
    }
    function sendValue(formData){
        $.ajax({
            url: "http://localhost/new%20code/student_crud_ajax/public/ajaxdata/postdata",
            method:"post",
            data:formData,
            dataType:'json',
            success:function (data) {
                html ='';
                if(data.error.length >0){
                    $.each(data.error,function (index,value) {
                        html+='<div class="alert alert-danger">'+value+'</div>';
                    });
                    $('.form-output').html(html);
                }else{
                    $('.form-output').html(data.success);
                }
                getAjaxWithPage(page);
            }
        })
    }
    function editDataAjax(id) {
        $.ajax({
            url:'http://localhost/new%20code/student_crud_ajax/public/ajaxdata/getfetchdata',
            data:{id:id},
            dataType:'json',
            success:function (data) {
                console.log(data);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#student_id').val(data.id);
                getAjaxWithPage(page);
            }
        })
    }
    function deleteDataAjax(id){
        $.ajax({
            url:'http://localhost/new%20code/student_crud_ajax/public/ajaxdata/deletedata',
            data:{student_id:id},
            success:function (data) {
                alert(data);
                getAjaxWithPage(page);
            }
        })
    }
    $('.pagination').on('click','.page-link',function (e) {
        e.preventDefault();
        getAjaxWithPage($(this).text());
    });

    $('#student_form').on('submit',function (event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        sendValue(form_data);
        getAjaxWithPage(page);
    });
    $('#add_data').on('click',function (e) {
        e.preventDefault();
        $('.form-output').text('')
        $('#modal-title').html('Add Data');
        $('#first_name').val('');
        $('#last_name').val('');
        $('#action').val('Add');
        $('#button_action').val('insert');
    });
    $('#student_table').on('click','.edit',function (e) {

        e.preventDefault();
        id = $(this).data('id');
        editDataAjax(id);
        $('.form-output').text('')
        $('.modal').modal('show');
        $('#modal-title').html('Edit Data');
        $('#action').val('Edit');
        $('#button_action').val('update');
    });
    $('#student_table').on('click','.delete',function (e) {
        e.preventDefault();
        id = $(this).data('id');
        if(confirm('Are you sure ?')){
            deleteDataAjax(id);
        }
        getAjaxWithPage(page);
    });
});
