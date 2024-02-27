$(document).ready(function () {

    $("#issued_on").datepicker({
        dateFormat: 'dd-mm-yy', 
        changeYear: true, 
        changeMonth: true 
    });

    
    $("#returned_on").datepicker({
        dateFormat: 'dd-mm-yy', 
        changeYear: true, 
        changeMonth: true 
    });
    
  

    $(document).on('click','#users-tab',function (e) { 
      $('#allocation-form').trigger("reset");
      $("#id").val('');
    });
  
    $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });

    function formatDate(dateString) {
      if(dateString != null){
        var date = new Date(dateString);
        var day = String(date.getDate()).padStart(2, '0');
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var year = date.getFullYear();
        return day + '-' + month + '-' + year;
      }
      return '';
      
    }

    function formatDateFromDB(f_date)
        {
          var f_date = new Date(f_date);
          var formattedDate = $.datepicker.formatDate('dd-mm-yy', f_date);
          return formattedDate;
        }
  
    $.ajax({
      type: "POST",
      url: "/allocation-view-data",
      success: function (response) {
          var table = '';
          $(".user-table tbody").empty();
          $.each(response, function (indexInArray, valueOfElement) {
    
               table += '<tr>'+
               '<td class="text-center">'+ ++indexInArray+ '</td>'+
               '<td class="text-center">'+ valueOfElement.employee.emp_code+ '</td>'+
               '<td class="text-center">'+ valueOfElement.device.oem_relation.oem_name +'-'+valueOfElement.device.category_relation.category_name +'-'+valueOfElement.device.item_type.item_name+ '</td>'+
               '<td class="text-center">'+ formatDate(valueOfElement.issued_on)+ '</td>'+
               '<td class="text-center">'+ formatDate(valueOfElement.returned_on)+ '</td>'+
               '<td class="text-center">'+ valueOfElement.assigned_to.assigned_to+ '</td>';
               table += '<td class="text-center"><span style="color:darkblue;" data-id="'+ valueOfElement.id+'"class="icon ri-edit-2-fill allocation-edit"></span> &nbsp; &nbsp;<span style="color:red;" data-id="'+ valueOfElement.id+'" class="icon ri-chat-delete-fill allocation-delete"></span> </td>'
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
  
      
      $('#allocation-form').on('submit', function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          $.ajax({
            type:'POST',
            url:'/allocation-store-data',
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
        
      $(document).on('click','.allocation-edit',function (e) { 
          e.preventDefault();
          var id = $(this).data('id');
          var value;
          $.ajax({
            type: "POST",
            url: "/allocation-show-data",
            data: {id},
            cache:false,
            success:function(data){
              console.log(data[0]['device']);
              $('#allocation-form').trigger("reset");
              $("#id").val(data[0]['id']);
              $("#emp_code").val(data[0]['emp_code']);
              $("#issued_on").val(formatDateFromDB(data[0]['issued_on']));
              $("#returned_on").val(formatDateFromDB(data[0]['returned_on']));
              $("#assigned_to").val(data[0]['assigned_to']);

              var category_name = data[0]['device']['category_relation']['category_name'];
              var oem_name = data[0]['device']['oem_relation']['oem_name'];
              var item_name = data[0]['device']['item_type']['item_name'];
              
             
              $("#device").val(data[0]['device_id']);
            //   $('#device option').each(function () {
            //     if ($(this).val() == data[0]['device_id']) {
            //         $(this).prop('selected', true);
            //     }
            // });
               $("#device option[value='" + data[0]['device_id'] + "']").prop('selected', true);
  


              $("#users-tab").tab('show');
            }
          });
        });
  
        $(document).on('click','.allocation-delete',function (e) { 
          e.preventDefault();
          var id = $(this).data('id');
          $.ajax({
            type: "POST",
            url: "/allocation-delete-data",
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