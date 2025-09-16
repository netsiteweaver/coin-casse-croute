var reportType = null;

jQuery(function(){

    $('#type').on("change",function(){
        let reportType = $(this).val();
        if(reportType.length>0){
            $('#dayBlock, #monthBlock, #yearBlock, #customBlock').addClass("d-none");
            $('#'+reportType+"Block").removeClass("d-none");
            $('#action').removeClass("d-none");
        }else{
            $('#dayBlock, #monthBlock, #yearBlock, #customBlock, #action').addClass("d-none");
        }

    })

    $('#btnOptions').on("click",function(){
        let state = $('#options').hasClass("d-none") ? 'hidden' : 'visible';
        
        if(state == 'hidden'){
            $('#options').removeClass("d-none");
        }else{
            $('#options').addClass("d-none");
        }
    })

    $('#proceed').on("click",function(){
        let type = $('#type :selected').val();
        let singleDate = $('input[name=singleDate]').val();
        let mMonth = $('select[name=mMonth] :selected').val();
        let mYear = $('select[name=mYear] :selected').val();
        let year = $('select[name=year] :selected').val();
        let dateRange = $('input[name=dateRange]').val();
        let url = base_url + "reports/orders"

        let options = {};
            options.sort_by = $('select[name=sort_by] :selected').val();
            options.sort_dir = $('select[name=sort_dir] :selected').val();
            options.payment_mode_only = $('select[name=payment_mode_only] :selected').val();
            options.agent_only = $('select[name=agent_only] :selected').val();
        let optionQuery = "&sort_by="+options.sort_by+"&sort_dir="+options.sort_dir+"&payment_mode="+options.payment_mode_only+"&agent_only="+options.agent_only

        if(type == 'day') {
            window.history.pushState({},"", url + "?type=day&date="+singleDate+optionQuery)
        } else if(type == 'month') {
            window.history.pushState({},"", url + "?type=month&month="+mMonth+"&year="+mYear+optionQuery)
        } else if(type == 'year') {
            window.history.pushState({},"", url + "?type=year&year="+year+optionQuery)
        } else {
            window.history.pushState({},"", url + "?type=custom&dateRange="+dateRange+optionQuery)
        }

        let rupee = new Intl.NumberFormat('en-UK', {
            style: 'currency',
            currency: 'MUR',
        });

        $.ajax({
            url: base_url + "reports/orders",
            method:"POST",
            dataType:"JSON",
            data:{type:type,singleDate:singleDate,mMonth:mMonth, mYear:mYear,year:year,dateRange:dateRange,options:options},
            success: function(response) {
                if(response.result){
                    if(response.rows == 0){
                        $('#result table tbody').empty();
                        $('#result').addClass("d-none");
                        toastr["error"]("Unfortunately your query returned no rows")
                        return false;
                    }
                    $('#result table tbody').empty();
                    let total = 0;
                    $(response.orders).each(function(i,row){
                        total += parseFloat(row.amount);
                        let html = "<tr>";
                        html += "<td>" + row.created_date + "</td>";
                        html += "<td><a href='"+base_url+"orders/receipt/"+row.uuid+"'>" + row.document_number + "</a></td>";
                        html += "<td class='text-right'>" + rupee.format(row.amount) + "</td>";
                        html += "<td>" + row.paymentMode + "</td>";
                        html += "<td>" + row.agent + "</td>";
                        html += "</tr>";
                        $('#result table tbody').append(html);
                        
                    })
                    $('#result table tbody').append("<tr><td colspan='2'>Total</td><td class='text-right'>"+rupee.format(total)+"</td><td colspan='2'></tr>");
                    $('#result').removeClass("d-none");

                }

            }
        })
    })

    $('.rangepicker').daterangepicker({
        "showDropdowns": true,
        "autoApply": true,
        "locale": {
            "format": "YYYY-MM-DD",
            "separator": " - ",
            "firstDay": 1
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,
        "startDate": moment(),
        "endDate": moment()
    }, 
    function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    $('.singledatepicker').daterangepicker({
        "singleDatePicker": true,
        "showDropdowns": true,
        "maxYear": 2024,
        "autoApply": true,
        "locale": {
            "format": "YYYY-MM-DD",
            "separator": " - ",
            "firstDay": 1
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,
        "startDate": moment(),
        "endDate": "2024-02-27"
    }, 
    function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
})