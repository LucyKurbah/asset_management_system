$(document).ready(function () {

    $(document).on('click','#users-tab',function (e) { 
      $('#device-form').trigger("reset");
      $("#id").val('');
    });
  
    $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
    var user_id ;
  
    $.ajax({
      type: "POST",
      url: "/device-view-data",
      success: function (response) {
          var table = '';
          $(".user-table tbody").empty();
          $.each(response, function (indexInArray, device) { 
               table += '<tr>'+
               '<td class="text-center">'+ ++indexInArray+ '</td>'+
               '<td class="text-center">'+ device.serial_no+ '</td>'+
               '<td class="text-center">'+ device.category_relation.category_name+ '</td>'+
               '<td class="text-center">'+ device.item_type.item_name+ '</td>'+
               '<td class="text-center">'+ device.oem_relation.oem_name+ '</td>';
               table += '<td class="text-center"><span style="color:darkblue;" data-id="'+ device.id+'"class="icon ri-edit-2-fill device-edit"></span> &nbsp; &nbsp;<span style="color:red;" data-id="'+ device.id+'" class="icon ri-chat-delete-fill device-delete"></span> </td>'
               '</tr>';
          });
            $(".user-table tbody").append(table);
            $('.user-table').DataTable({               
              destroy:true,
              processing:true,
              select:true,
              paging:true,
              lengthChange:true,
              searching:true,
              info:false,
              responsive:true,
              autoWidth:false
          });
        }
      });
  
      
      $('#device-form').on('submit', function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          $.ajax({
            type:'POST',
            url:'/device-store-data',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
              console.log(data);
              if(data['flag']=='Y'){ //Succcess for creation of new user
                $(".table_msg1").show();
                $('.table_msg1').delay(2000).fadeOut();
                $('#table-form').trigger("reset");
                setTimeout(function(){
                  window.location.reload();
               }, 1500);
              }
              else if(data['flag']=='YY'){ //Succcess for editing an user
                $(".table_msg5").show();
                $('.table_msg5').delay(2000).fadeOut();
                $('#table-form').trigger("reset");
                setTimeout(function(){
                  window.location.reload();
               }, 1500);
              } 
              else if(data['flag']=='N'){  //Error while creation of new user
                $(".table_msg2").show();
                $('.table_msg2').delay(2000).fadeOut();
                $('#table-form').trigger("reset");
              }
              else if(data['flag']=='VE'){ //Validation Errors
                $(".table_msg2").show();
                $('.table_msg2').delay(2000).fadeOut();
                $('#table-form').trigger("reset");
              } 
             
              else if(data['flag']=='NN'){ //Error while editing an user
                $(".table_msg6").show();
                $('.table_msg6').delay(2000).fadeOut();
                $('#table-form').trigger("reset");
              } 
            },
            error: function(xhr, status, error){
              if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(field, messages) {
                    var fieldElement = $('[name="' + field + '"]');
                    var errorMessage = $('<span class="error">' + messages[0] + '</span>');
                    fieldElement.after(errorMessage);
                    errorMessage.css({
                      color: 'red',
                      fontSize: '12px'
                  });
                });
            }
           }
          });
        });
        
      $(document).on('click','.device-edit',function (e) { 
          e.preventDefault();
          var id = $(this).data('id');
          var value;
          $.ajax({
            type: "POST",
            url: "/device-show-data",
            data: {id},
            cache:false,
            success:function(data){
              $('#device-form').trigger("reset");
              $("#id").val(data[0]['id']);
              $("#serial_no").val(data[0]['serial_no']);
              $("#category option[value='" + data[0]['category'] + "']").prop('selected', true);
              $("#item_type option[value='" + data[0]['item_type'] + "']").prop('selected', true);
              $("#oem option[value='" + data[0]['oem'] + "']").prop('selected', true);

              $("#users-tab").tab('show');
            }
          });
        });
  
        $(document).on('click','.device-delete',function (e) { 
          e.preventDefault();
          var id = $(this).data('id');
          $.ajax({
            type: "POST",
            url: "/device-delete-data",
            data: {id},
            cache:false,
            success:function(data){
              if(data['flag']=='Y'){
                $(".table_msg3").show();
                $('.table_msg3').delay(5000).fadeOut();
                setTimeout(function(){
                  window.location.reload();
               }, 1000);
  
              }
              else {
                $(".table_msg4").show();
                $('.table_msg4').delay(1000).fadeOut();
                setTimeout(function(){
                  window.location.reload();
               }, 1500);
              }
            }
          });
        });
  
        $("#title").click(function(e){
          $(".msg1").hide();
        });
  
        $("#body").click(function(e){
          $(".msg2").hide();
        });
    });