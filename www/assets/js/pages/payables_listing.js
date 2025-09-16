$(document).ready(function(){
    var today = moment().format('YYYY-MM-DD');
    $('input[name=payment_date]').val(today)
    console.log(today)
    $("input[name=search_by]").on('change',function(){
        var elem = $("input[name=search_by]:checked").val()
        alert(elem);
    })

    var currentPathname = window.location.pathname;
    var protocol = window.location.protocol;
    var host = window.location.host
    var pos = currentPathname.indexOf('listing');
    var newUrl = protocol+'//'+host+currentPathname.substr(0,pos+7);
    
    $('body').on('click','.select_vehicle',function(){
        var vehicle_name = $(this).closest('tr').data('vehiclename');
        var price = parseFloat($(this).closest('tr').data('price'));
        var balance = parseFloat($(this).closest('tr').data('balance'));
        var stockref = $(this).closest('tr').data('stockref');
        var vehicleID = $(this).closest('tr').data('vehicle');
        var currency = $(this).closest('tr').data('currency');
        console.log('vehicleID:',vehicleID, vehicle_name, price, stockref)
        loader('on')
        $.ajax({
            url:base_url+'payables/getPayments',
            data:{vehicle_id:vehicleID},
            dateType:'html',
            type:'post',
            success:function(data){
                window.history.pushState("Payables Listing", document.title, newUrl+'/'+vehicleID);
                $('#payments').html(data);
                $('.payment_block').removeClass('hidden')
                $('.payables_list').addClass('hidden')
                $('input[name=vehicle_id]').val(vehicleID);
                $('input[name=currency]').val(currency);
                $('input[name=vehicle_name]').val(vehicle_name);
                $('input[name=price]').val(numeral(price).format('0,0.00'));
                $('input[name=balance]').val(numeral(balance).format('0,0.00'));
                $('input[name=stockref]').val(stockref);
                $('input[name=amount], input[name=rate]').closest('.row').removeClass('hidden');
                $('input[name=amount]').val(balance).focus().select();
                $('#savePayment').removeClass('hidden');
                // getRate(currency,'#rate');
                $('#rate').val('0.000');
                loader('off')
            },
            error:function(){
                loader('off')
            }
        })
        // $('.payables_list').addClass('hidden')
    })

    $('#savePayment').on('click',function(){
        var errorMessage = "";
        $('.has-error').removeClass('has-error');
        
        var amount = parseFloat($('input[name=amount]').val().replace(/,/g, ''))
        if( (amount.length==0) || (amount <=0) ){
            errorMessage += "<li>Please enter amount to pay</li>";
        }
        
        var payment_date = $('input[name=amount]').val()
        if(payment_date.length==0) errorMessage += "<li>Please enter payment date</li>";
        
        var rate = parseFloat($('input[name=rate]').val().replace(/,/g,''));
        if( (rate.length==0) || (rate<=0) ){
            $('input[name=rate]').closest('.row').addClass('has-error');
            errorMessage += "<li>Please enter rate of exchange at time of payment</li>";
        }
        
        var vehicleID = $('input[name=vehicle_id]').val();
        var currency = $('input[name=currency]').val();
        var payment_date = $('input[name=payment_date]').val();
        var balance = parseFloat($('input[name=balance]').val().replace(/,/g, ''));

        if(amount>balance){
            errorMessage += "<li>Please enter an amount less than the balance due ("+currency+" "+balance+")";
            $('input[name=amount]').val(numeral(balance).format('0,0.00'));
        } 

        if(errorMessage.length>0){
            errorMessage = "Please correct the following errors:<ul>"+errorMessage+"</ul>";
            bootbox.alert(errorMessage);
            return false;
        }

        $.ajax({
            url:base_url+'payables/savePayment',
            data:{vehicle_id:vehicleID, amount:amount, currency:currency, rate:rate, payment_date:payment_date},
            dateType:'html',
            type:'post',
            success:function(data){
                var referer = $('#savePayment').data('referer');
                //var stockref = $('#savePayment').data('stockref');
                if(referer.length>0){
                    window.location.href = referer//+'#'+stockref;
                    return false;
                }
                cleanup();
                $('#vehicle_list').html(data);
            },
            error:function(){

            }
        })        

        return false;
    })

    $('#morePayment').on('click',function(){
        //getUpdatedPayables
        var referer = $(this).data('referer');
        //var stockref = $('#savePayment').data('stockref');
        if(referer.length>0){
            window.location.href = referer//+'#'+stockref;
            return false;
        }
        loader('on');
        $.ajax({
            url:base_url+'payables/getUpdatedPayables',
            dateType:'html',
            success:function(data){
                cleanup();
                $('#vehicle_list').html(data);
                loader('off');
            },
            error:function(){
                loader('off');
            }
        })          
        return false;
    })

    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    })
      
})

function cleanup()
{
    $('input[name=amount]').val(null);
    $('input[name=rate]').val(null);
    $('input[name=vehicle_id]').val(null);
    $('input[name=currency]').val(null);
    $('input[name=vehicle_name]').val(null);
    $('input[name=price]').val(null);
    $('input[name=stockref]').val(null);    

    $('#payments').html(null);
    $('.payment_block').addClass('hidden')
    $('.payables_list').removeClass('hidden')

}

function getRate(cur,fieldName)
{
    var base_api_url = location.protocol+'//free.currencyconverterapi.com/api/v5/';
    var from_cur = 'MUR';
    var to_cur = cur;
    var currency = to_cur+"_"+from_cur;
    loader('off');
    $.ajax({
        url:base_api_url+'convert',
        type:'get',
        data:{q:currency,compact:'y'},
        dataType:'json',
        success:function(response){
            var rate_of_exchange = parseFloat(response[currency]['val']);
            $(fieldName).val(numeral(rate_of_exchange).format('0.000'));
            loader('off');
        },
        error:function(){
            loader('off');
        }
    })    
}