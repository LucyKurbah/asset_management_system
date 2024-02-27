$(document).ready(function () {

    $("#install_date").datepicker({
        dateFormat: 'dd-mm-yy', 
        changeYear: true, 
        changeMonth: true 
    });

    
    $("#delivery_date").datepicker({
        dateFormat: 'dd-mm-yy', 
        changeYear: true, 
        changeMonth: true 
    });
    
    $("#warranty_from").datepicker({
        dateFormat: 'dd-mm-yy', 
        changeYear: true, 
        changeMonth: true 
    });
    
    $("#warranty_to").datepicker({
        dateFormat: 'dd-mm-yy', 
        changeYear: true, 
        changeMonth: true 
    });


    $(document).on('click','#users-tab',function (e) { 
      $('#purchase-form').trigger("reset");
      $("#id").val('');
    });
  
    $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });

    function formatDate(dateString) {
      var date = new Date(dateString);
      var day = String(date.getDate()).padStart(2, '0');
      var month = String(date.getMonth() + 1).padStart(2, '0');
      var year = date.getFullYear();
      return day + '-' + month + '-' + year;
    }

    function formatDateFromDB(f_date)
        {
          var f_date = new Date(f_date);
          var formattedDate = $.datepicker.formatDate('dd-mm-yy', f_date);
          return formattedDate;
        }
  
    $.ajax({
      type: "POST",
      url: "/purchase-view-data",
      success: function (response) {
          var table = '';
          $(".user-table tbody").empty();
          $.each(response, function (indexInArray, valueOfElement) { 



               table += '<tr>'+
               '<td class="text-center">'+ ++indexInArray+ '</td>'+
               '<td class="text-center">'+ valueOfElement.po_no+ '</td>'+
               '<td class="text-center">'+ formatDate(valueOfElement.installation_date)+ '</td>'+
               '<td class="text-center">'+ formatDate(valueOfElement.delivery_date)+ '</td>'+
               '<td class="text-center">'+ formatDate(valueOfElement.warranty_start)+ '</td>'+
               '<td class="text-center">'+ formatDate(valueOfElement.warranty_end)+ '</td>'+
               '<td class="text-center">'+ valueOfElement.purchased_by+ '</td>';
               table += '<td class="text-center"><span style="color:darkblue;" data-id="'+ valueOfElement.id+'"class="icon ri-edit-2-fill purchase-edit"></span> &nbsp; &nbsp;<span style="color:red;" data-id="'+ valueOfElement.id+'" class="icon ri-chat-delete-fill purchase-delete"></span> </td>'
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
  
      
      $('#purchase-form').on('submit', function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          $.ajax({
            type:'POST',
            url:'/purchase-store-data',
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
        
      $(document).on('click','.purchase-edit',function (e) { 
          e.preventDefault();
          var id = $(this).data('id');
          var value;
          $.ajax({
            type: "POST",
            url: "/purchase-show-data",
            data: {id},
            cache:false,
            success:function(data){
              $('#purchase-form').trigger("reset");
              $("#id").val(data[0]['id']);
              $("#po_no").val(data[0]['po_no']);
              $("#install_date").val(formatDateFromDB(data[0]['installation_date']));
              $("#warranty_from").val(formatDateFromDB(data[0]['warranty_start']));
              $("#warranty_to").val(formatDateFromDB(data[0]['warranty_end']));
              $("#delivery_date").val(formatDateFromDB(data[0]['delivery_date']));
              $("#purchased_by").val(data[0]['purchased_by']);
              $("#users-tab").tab('show');
            }
          });
        });
  
        $(document).on('click','.purchase-delete',function (e) { 
          e.preventDefault();
          var id = $(this).data('id');
          $.ajax({
            type: "POST",
            url: "/purchase-delete-data",
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