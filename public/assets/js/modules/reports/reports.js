$(document).ready(function () {


     var reportsTable  = $('#reports-table').DataTable();

    //  $('#emp_code').on('change', function(){
    //     reportsTable.clear().draw();
    //     $('#print_div').hide();
    //  });

    $(document).on('change', '#emp_code', function () {

        $('.loader-overlay').show();
        var emp_code = $('#emp_code').val();
        
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: 'POST',
            url: '/get_report', 
            data: {
                emp_code: emp_code,
            }, 
            dataType: 'json',
            success: function (data) {
                $('.loader-overlay').hide();
                reportsTable.clear();
                if (data.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'No Data Found',
                        text: 'There is no data available for the selected dates.',
                        confirmButtonText: 'OK'
                    });
                    reportsTable.clear().draw();
                    $('#print_div').hide();
                } else {
                    console.log(data);
                    populateReportTable(data,emp_code);
                }
            },
            error: function (error) {
                console.log('Error:', error);
                $('.loader-overlay').hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while fetching data. Please try again later.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
    $(document).on('click', '.btn-print-report', function () {

        $('.loader-overlay').show();
        var emp_code = $('#emp_code').val();
        
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: 'POST',
            url: '/print_report', 
            data: {
                emp_code: emp_code,
            }, 
            dataType: 'json',
            success: function (data) {
                $('.loader-overlay').hide();
                reportsTable.clear();
                if (data.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'No Data Found',
                        text: 'There is no data available for the selected dates.',
                        confirmButtonText: 'OK'
                    });
                    reportsTable.clear().draw();
                    $("#print_div").hide();
                    // console.log($("#printButtonPlaceholder").val());
                } else {
                    console.log(data);
                    populateReportTable(data,emp_code);
                }
            },
            error: function (error) {
                console.log('Error:', error);
                $('.loader-overlay').hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while fetching data. Please try again later.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    function populateReportTable(response,emp_code) {
        reportsTable.clear();
        $.each(response, function (indexInArray, allocation) { 
        var issueDate = formatDate(allocation.issued_on);
        var returned_on = formatDate(allocation.returned_on);
        reportsTable.row.add([
                    indexInArray + 1,
                    allocation.employee.name,
                    allocation.device.serial_no,
                    issueDate,
                    returned_on
                ]).draw();
        });
        reportsTable.draw();
        var jsonData = JSON.stringify(response);
        var encodedData = encodeURIComponent(jsonData);
        var printButton = '<br><a href="/reports/print_emp_register/' + emp_code +'" style="color: white; font-size: 15px;"  class="btn btn-secondary emp_register" target="_blank" >Print</a>';
        $("#print_div").show();
        $("#printButtonPlaceholder").html(printButton);
    }
    
    function formatDate(dateString) {
        if(dateString!=null)
        {
            var date = new Date(dateString);
            var day = String(date.getDate()).padStart(2, '0');
            var month = String(date.getMonth() + 1).padStart(2, '0');
            var year = date.getFullYear();
            return day + '-' + month + '-' + year;
        }
        return null;
      }
  
    function formatDateFromDB(f_date)
    {
            var f_date = new Date(f_date);
            var formattedDate = $.datepicker.formatDate('dd-mm-yy', f_date);
            return formattedDate;
    }
    
});