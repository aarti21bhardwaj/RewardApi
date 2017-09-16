$(document).ready(function(){
//alert('outside');
var host = $('#baseUrl').val();
$('#saveUserPassword').on('click',function(event){
        //alert('change password');
        if($(this).hasClass('disabled')){
            event.preventDefault();
        }
        var oldPwd = $('#old_pwd').val();
        //alert(oldPwd); die('sss');
        var staffId = $('input[name=staffId]').val();
        var newPwd = $('#new_pwd').val();
        var cnfNewPwd = $('#cnf_new_pwd').val();
        if(oldPwd && newPwd && cnfNewPwd && (newPwd == cnfNewPwd)){
            $.ajax({
                url: host+"reseller/staffs/updatePassword/",
                headers:{"accept":"application/json"},
                dataType: 'json',
                data:{
                    "staff_id" : staffId,
                    "old_password" : oldPwd,
                    "new_password" : newPwd,
                },
                type: "post",
                success:function(data){
                    if($('#rsp_msg').hasClass('alert-danger')){
                        $('#rsp_msg').removeClass('alert-danger');
                    }
                    if($('#rsp_msg').hasClass('alert-success')){
                        $('#rsp_msg').removeClass('alert-success');
                    }
                    $('#rsp_msg').addClass('alert-success');
                    $('#rsp_msg').append('<strong>Password changed successfully.</strong>');
                    $('#rsp_msg').show();
                    setTimeout(function(){
                        $('#rsp_msg').fadeIn(500);
                        $('#changePasswordModal').modal('hide');
                        $('#rsp_msg').removeClass('alert-success');
                        $('#rsp_msg').hide();
                        $('#rsp_msg').html('');
                    }, 2000);
                },
                error:function(data){
                    var className = 'alert-danger';
                    if($('#rsp_msg').hasClass('alert-success')){
                        $('#rsp_msg').removeClass('alert-success');
                    }
                    $('#rsp_msg').addClass(className);
                    $('#rsp_msg').append('<strong>' + data.responseJSON.message + '</strong>');
                    setTimeout(function(){
                        if($('#rsp_msg').hasClass(className)){
                            $('#rsp_msg').removeClass(className);
                        }
                        $('#rsp_msg').hide();
                        $('#rsp_msg').html('');

                    }, 2000);
                    $('#rsp_msg').fadeIn(500);

                },
                beforeSend: function() {

                }
            });

        }
        event.preventDefault();
    });

$('.clone-program').on('click',function(event){
    toastr.options = {
        "debug": false,
        "newestOnTop": true,
        "positionClass": "toast-top-center",
        "closeButton": true,
        "toastClass": "animated fadeInDown",
    };
    var programId =  ($(this).attr('data-program-id'));
    if(!programId){
        toastr.error("Unable to process your request. Kindly try after sometimne");
    }else{
        $('#selected-program-id').val(programId);
        $.ajax({
            url:host+"reseller/resellerPrograms/"+programId,
            headers:{"accept":"application/json"},
            dataType: 'json',
            type: "GET",
            success:function(data){
             var $featuresNode = $('<div class="dd" id="nestable"></div>');
             $featuresNode.append("<ol class='dd-list'></ol>");
             for(x in data.features){ 
                $featuresNode.find('ol').append('<li class="dd-item">'+data.features[x]+'</li>');
            }
            $("#featureListInProgram").parents('.row').append($featuresNode);

            $('#cloneModal').modal();

        },
        error:function(data){
            toastr.error("Unable to process your request. Kindly try after sometime");
        },
        beforeSend: function() {
            console.log('loading')
        }
    });
    }

    
})

$('#submitCloneRequest').on('click', function(event){
    $.ajax({
        type:"POST",
        url:host+"reseller/resellerPrograms/",
        headers:{"accept":"application/json"},
        dataType: 'json',
        data:{

            'program-id': $('#selected-program-id').val(),
            'program_name': $('#program_name').val(),
            
        },
        success:function(data){
                // console.log(data.features);
                $('#cloneModal').modal('hide');
                window.location.reload();


            },
            error:function(data){
                toastr.error("Unable to process your request. Program Name already exist!");
            },

        });
});

});

// $('#IDModal').modal('toggle');