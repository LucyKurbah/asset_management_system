$(document).ready(function () {


  
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
      url: "/user_allocation-view-data",
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
  
      
     
        $("#title").click(function(e){
          $(".msg1").hide();
        });
  
        $("#body").click(function(e){
          $(".msg2").hide();
        });
    });