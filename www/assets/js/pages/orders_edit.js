var measurements = [];
var measurementZones = [];
var step = 0;
var data = new Object;
data.uuid = data.customer_id = data.product_id = data.measurements = data.delivery_date = data.delivery_time = data.delivery_store = null;
var minimumDepositPct = 0;

jQuery(function(){
    // checkSaveButton();
    timer = 0;
    function mySearch (){ 
        var searchTerm = $('#modalSearchClients').val();
        console.log(searchTerm); 
        if(searchTerm.length==0){
            $('#select_customer tbody').empty();
        }else if(searchTerm.length>=2){
            fetchClients(searchTerm);
        }else{

        }
    }

    // init();

    $('#modalSearchClients').on('keyup', function(e){
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(mySearch, 400); 
    });

    $('.process').on("click",function(){
        let step = $(this).data("step");
        if($(this).hasClass("disabled")) {
            return false;
        } 

        if(step == '1'){
            $('#modalSelectClient').modal("show");
        }else if(step == '2'){
            fetchProducts();
        }else if(step == '3'){
            if( !$("#process2").hasClass("btn-success") ){
                myAlert("Please select a product first before entering measurements");
            }else{
                $('#modalMeasurements').modal("show");
            }
        }else if(step == '4'){
            saveOrder()
        }else if(step == '5'){
            myAlert("Coming Soon");

        }
    })

    $('#modalSelectClient').on("shown.bs.modal",function(){
        $('#modalSearchClients').trigger("focus");
    })

    $('#modalSelectClient').on("hidden.bs.modal",function(){
        $('#modalSearchClients').trigger("focus");
        $('#modalSearchClients').val("");
        $('#select_customer tbody').empty();
        fetchProducts();
    })

    $("#select_customer").on("click",".select-customer",function(){
        let customer_id = $(this).closest("tr").data("customer-id");
        data.customer_id = customer_id;
        fetchClient(customer_id);
        $('#modalSelectClient').modal("hide");
        $('#process1').removeClass("btn-default").addClass("btn-success");
        checkSaveButton();
        fetchClientHistory(customer_id);
    })

    $('#modalSelectProducts').on("click",".product-modal",function(){
        let uuid = $(this).data("uuid");
        $.ajax({
            url: base_url + "products/fetchByUuid",
            data:{uuid:uuid},
            method:"POST",
            dataType:"JSON",
            success:function(response){
                if(response.result){

                    data.product_id = response.record[0].id;
                    $('#product_id').val(response.record[0].id);
                    $('#modalSelectProducts').modal("hide");
                    let html = "<div class='row'><div class='col-md-12' style='overflow-y:scroll;'><img src='"+base_url+"uploads/vetements/"+response.record[0].image+"' usemap='#image-map'>";
                    html += "<map name='image-map'>"+response.record[0].image_map+"</map>";

                    html += "</div></div>";
                    $('#modalMeasurements .modal-body').empty().append(html);
                    $('#modalMeasurements').modal("show");

                    displayItemDetails(response.record[0]);
                    $('#process2').removeClass("btn-default").addClass("btn-success");

                    //clear measurements, in case user is changing product
                    $('#process3').removeClass("btn-success").addClass("btn-default");
                    measurementZones = [];
                    measurements = [];
                    let total_fields = $('area.open-modal').length;
                    console.log(total_fields)
                    $('#modalMeasurements .modal-footer .badge').text('0 / ' + total_fields);
                    $('#item_details').collapse("show");
                    checkSaveButton();

                }
            }
        })
    })

    $('#item_details .quantity, #item_details .deposit').on("keyup",function(){
        reCalculate()
    })

    $('#modalMeasurements').on("click",".open-modal",function(e){
        e.preventDefault();
        let zone = $(this).attr("title");

        if(measurementZones.indexOf(zone)!==-1) {
            myAlert("Measurement for zone "+zone+" has already been recorded. To re-enter, please click on View Measurements and delete it first")
            return false;
        }

        $('#zone').text(zone)
        $('#measurementModal').modal("show");
        return false;
    })

    $('#measurementModal').on("shown.bs.modal",function(){
        $('#measurementModal input[name=measurement]').trigger("focus");
    })

    $('#measurementModal').on("hidden.bs.modal",function(){
        $('#measurementModal input[name=measurement]').parent().removeClass("has-error");
        $('#measurementModal textarea[name=measurements_remarks]').val("");
    })

    $("#saveMeasurement").on("click",function(e){
        e.preventDefault();
        let m = $('#measurementModal input[name=measurement]').val().trim();
        let remarks = $('#measurementModal textarea[name=measurements_remarks]').val();

        if(m=='') {
            $('#measurementModal input[name=measurement]').parent().addClass("has-error");
            $('#measurementModal input[name=measurement]').trigger('focus')
            return false;
        }
        let zone = $('#zone').text();
        if(measurementZones.indexOf(zone)==-1) {
            measurementZones.push(zone);
            measurements.push({
                zone: zone,
                value: m,
                remarks: remarks
            });      
            console.log(measurements.length)
            let total_fields = $('area.open-modal').length;
            $('#modalMeasurements .modal-footer .badge').text(measurements.length + " / " + total_fields);
            if(measurements.length == total_fields){
                $('#viewMeasurements').addClass("btn-info").removeClass("btn-default");
            }else{
                $('#viewMeasurements').removeClass("btn-info").addClass("btn-default");
            }
        }else{
            toastr["error"]("Measurement for zone "+zone+" has already been recorded. To re-enter, please click on View Measurements and delete it first")
        }

        $('#measurementModal input[name=measurement]').val('')
        $("#measurementModal").modal("hide");
        
    })

    $('#saveMeasurements').on("click",function(){
        let total_fields = $('area.open-modal').length;
        if(measurements.length==0){
            myAlert("No measurements have been recorded yet");
        }else if(measurements.length < total_fields){
            myAlert("Some measurements are missing. Currently only "+measurements.length+" of "+total_fields+" measurements have been recorded.")
        }else{
            $('#modalMeasurements').modal("hide");
            $('#item_details .quantity').trigger("focus");
            $('#process3').removeClass("btn-default").addClass("btn-success");
            $('#order_details').collapse("show");
            data.measurements = measurements;
            checkSaveButton();
        }
        
    })

    $('#viewMeasurementsModal').on("click",".delete-measurement",function(){
        let index = $(this).closest("tr").data("index");
        let zone = $(this).closest("tr").find("td").eq(0).text();
        measurementZones.splice(measurementZones.indexOf(zone),1);
        measurements.splice(index,1);
        $(this).closest('tr').remove();
        let total_fields = $('area.open-modal').length;
        $('#modalMeasurements .modal-footer .badge').text(measurements.length + ' / ' + total_fields);
        if(measurements.length == total_fields){
            $('#viewMeasurements').addClass("btn-info").removeClass("btn-default");
        }else{
            $('#viewMeasurements').removeClass("btn-info").addClass("btn-default");
        }

    })

    $('#viewMeasurements').on("click",function(){
        var lines = "";
        $(measurements).each(function(i,j){
            lines += "<tr class='text-center' data-index="+i+">";
            lines += "<td>"+j.zone+"</td>";
            lines += "<td>"+j.value+"</td>";
            lines += "<td>"+j.remarks+"</td>";
            lines += "<td>";
            // lines += "<div class='btn btn-xs btn-default'><i class='fa fa-edit'></i></div>";
            lines += "<div class='btn btn-xs btn-danger delete-measurement'><i class='fa fa-trash'></i></div>";
            lines += "</td>";
            lines += "</tr>";
        })
        $('#viewMeasurementsModal table tbody').empty().append(lines)
        $('#viewMeasurementsModal').modal("show")
    })

    $('#delivery_store').on("change",function(){
        checkSaveButton();
    })

    $('#quantity, #deposit').on("keyup",function(){
        checkSaveButton();
    })

    $('input[name=gender]').on("change",function(){
        let gender = $(this).val();
        if(gender=='m'){
            $("input[name=title][value='Mr']").prop("disabled",false);
            $("input[name=title][value='Mrs']").prop("disabled",true);
            $("input[name=title][value='Miss']").prop("disabled",true);
            $("input[name=title][value='Dr']").prop("disabled",false);
            $('input:radio[name=title]')[0].checked = true;
        }else{
            $("input[name=title][value='Mr']").prop("disabled",true);
            $("input[name=title][value='Mrs']").prop("disabled",false);
            $("input[name=title][value='Miss']").prop("disabled",false);
            $("input[name=title][value='Dr']").prop("disabled",false);
            $('input:radio[name=title]')[1].checked = true;
        }
    })

    $('#quick_save_customer').on("click",function(){
        var customer = new Object;
        customer.gender = $('#modalAddCustomer input[name=gender]').val();
        customer.title = $('#modalAddCustomer input[name=title]').val();
        customer.gender = $('#modalAddCustomer input[name=gender]').val();
        customer.first_name = $('#modalAddCustomer input[name=first_name]').val();
        customer.last_name = $('#modalAddCustomer input[name=last_name]').val();
        customer.address = $('#modalAddCustomer input[name=address]').val();
        customer.city = $('#modalAddCustomer input[name=city]').val();
        customer.nic = $('#modalAddCustomer input[name=nic]').val();
        customer.dob = $('#modalAddCustomer input[name=dob]').val();
        customer.nationality = $('#modalAddCustomer select[name=nationality]').val();
        customer.profession = $('#modalAddCustomer input[name=profession]').val();
        customer.marital_status = $('#modalAddCustomer input[name=marital_status]').val();
        customer.shoe_size = $('#modalAddCustomer input[name=shoe_size]').val();
        customer.clothes_size = $('#modalAddCustomer input[name=clothes_size]').val();
        customer.height = $('#modalAddCustomer input[name=height]').val();
        customer.sports = $('#modalAddCustomer input[name=sports]').val();
        customer.fidelity_card = $('#modalAddCustomer input[name=fidelity_card]').val();
        customer.email = $('#modalAddCustomer input[name=email]').val();
        customer.phone_number1 = $('#modalAddCustomer input[name=phone_number1]').val();
        customer.phone_number2 = $('#modalAddCustomer input[name=phone_number2]').val();

        $.ajax({
            url: base_url + "ajax/customers/save",
            data: customer,
            method:"POST",
            dataType:"JSON",
            success:function(response){

            }
        })
    })
    
})

function saveOrder()
{
    // console.log(data);
    // return;
    if(validate()) {
        $.ajax({
            url: base_url + "orders/update",
            method: "POST",
            data: data,
            dataType: "JSON",
            success: function(response){
                if(response.result){
                    window.location.href = base_url + "orders/listing";
                }else{
                    myAlert("Error saving the Order");
                }
            }
        })
    }
    
}
function validate()
{
    let valid = true;
    let errorMessage = [];
    data.quantity = $('#quantity').val();
    data.price = $('#price').val();
    data.price = parseFloat(data.price.replace(/,/g,''));
    data.amount = $('#amount').val();
    data.amount = parseFloat(data.amount.replace(/,/g,''));
    data.discount = $('#discount').val();
    data.deposit = $('#deposit').val();
    data.delivery_date = $('#delivery_date').val();
    data.delivery_time = $('#delivery_time').val();
    data.delivery_store = $('#delivery_store').val();
    if(data.customer_id === null){
        errorMessage.push("select or create a customer");
        valid = false;
    }
    if(data.product_id === null) {
        errorMessage.push("select an item");
        valid = false;
    }
    if(data.measurements === null) {
        errorMessage.push("enter measurements");
        valid = false;
    }
    if( (data.deposit.length == 0 ) || (isNaN(data.deposit)) || (data.deposit==0) ) {
        errorMessage.push("enter deposit");
        valid = false;
    }
    if(data.delivery_date.length != 10) {
        errorMessage.push("enter delivery date");
        valid = false;
    }
    if(data.delivery_time.length != 5) {
        errorMessage.push("enter delivery time");
        valid = false;
    }
    if(data.delivery_store.length == 0) {
        errorMessage.push("enter delivery store");
        valid = false;
    }
    if(!valid){
        displayMessage(errorMessage);
        return false;
    }
    return true;
}

function displayMessage(message)
{
    if( (typeof message === 'undefined') || (message.length==0) ) return false;

    if(Array.isArray(message)) {
        var list = '<ul class="list-group">';
        list += '<li class="list-group-item">Please correct the following errors:</li>';
        $(message).each(function(i,j){
            list += '<li class="list-group-item red"><i class="fa fa-circle-o"></i> '+j+'</li>';
        })
        list += "</ul>";
        $('#message-box').html(list);
    }else{
        $('#message-box').html(message);
    }
}

function checkSaveButton()
{
    
    if(!validate()){
        // myAlert(errorMessage);
        $('#process4').addClass("btn-default").removeClass("btn-success");
        return false;
    }
    $('#process4').removeClass("btn-default").addClass("btn-success");
    return true;
    if( (data.customer_id!==null) && 
        (data.product_id!==null) && 
        (data.measurements !== null) && 
        ( (data.quantity.length >0 ) && (!isNaN(data.quantity)) ) && 
        ( (data.deposit.length >0 ) && (!isNaN(data.deposit)) && (data.deposit>0) ) && 
        (data.delivery_date.length === 10) && 
        (data.delivery_time.length === 5) && 
        (data.delivery_store.length > 0) 
        ){
        $('#process4').removeClass("btn-default").addClass("btn-success");
        return true;
    }else{
        $('#process4').addClass("btn-default").removeClass("btn-success");
        return false;
    }

}

function toggleSaveButton(valid)
{
    if(valid) {
        $('#process4').removeClass("btn-default").addClass("btn-success");
    }else{
        $('#process4').addClass("btn-default").removeClass("btn-success");
    }
}

function init()
{
    // $.ajax({
    //     url : base_url + "ajax/misc/getParam",
    //     method:"GET",
    //     dataType:"JSON",
    //     data:{param:'minimum_deposit_pct'},
    //     success:function(response){
    //         minimumDepositPct = response.param
    //     }
    // })

    // data.uuid = $('#uuid').val();
    // data.customer_id = $('#customer_id').val();
    // data.product_id = $('#product_id').val();
    // data.measurements = JSON.parse($('#measurements').val());
    // console.log(data)
    // $('#modalSelectClient').modal("show");
    //fetchClients("",true);
}

function fetchProducts()
{
    $.ajax({
        url: base_url + "products/fetchAll",
        method:"POST",
        dataType:"JSON",
        success:function(response){
            if(response.result){
                var data = "<div class='row'>";
                $(response.rows).each(function(i,j){
                    data += "<div data-uuid="+j.uuid+" class='col-md-4 product-modal cursor-pointer'>";
                    data += "<img src='"+base_url+"uploads/products/"+j.photo+"' class='img-thumbnail'>"
                    data += "<h6>"+j.name+"</h6>";
                    data += "</div>";
                })
                data += "</div>";
                $('#modalSelectProducts .modal-body').empty().append(data);
                $('#modalSelectProducts').modal("show");
            }
            
        }
    })
}


function fetchClients(searchTerm,random)
{
    if( (typeof (random) === 'undefined') || (random===null) ){
        random = false;
    }
    $('#modal-client-overlay').removeClass("hidden");
    $.ajax({
        url: base_url + "ajax/customers/get",
        method: "POST",
        dataType: "JSON",
        data:{searchTerm:searchTerm,random:random},
        success: function(response){
            $('#select_customer tbody').empty();
            if(response.result){
                $(response.customers).each(function(i,row){
                    $('#select_customers').append("<option value='"+row.customer_id+"'>"+row.title+" "+row.last_name+" "+row.first_name+" | "+row.phone_number1+"</option>")
                    let line = "<tr data-customer-id='"+row.customer_id+"'>";
                    line += "<td>"+row.customer_code+"</td>";
                    line += "<td>"+row.title+" "+row.last_name+" "+row.first_name+"</td>";
                    line += "<td>"+row.nationality+"</td>";
                    line += "<td>"+row.fidelity_card+"</td>";
                    line += "<td>"+row.address+", "+row.city+"</td>";
                    if(row.phone_number1 !== null) line += "<td>"+row.phone_number1+"</td>";
                    if( (row.phone_number2 !== null) || (row.phone_number2 == "") ) {
                        line += "<td>"+row.phone_number2+"</td>";
                    }else{
                        line += "<td></td>";
                    
                    }
                    // line += "<td class='select-customer'><div class='btn btn-primary btn-sm'><i class='fa fa-check'></i> Select</div></td>";
                    line += "<td class='select-customer'><div class='btn btn-info btn-sm'>Select</div></td>";
                    line += "</tr>";
                    $('#select_customer tbody').append(line);
                })
            }else{
                window.location.href = base_url +"users/signin";
            }
        },
        complete: function(){
            window.setTimeout(function(){
                $('#modal-client-overlay').addClass("hidden");
            },250)
            
        }
    })
}

function fetchClient(customer_id)
{
    $.ajax({
        url: base_url + "ajax/customers/get",
        data:{customer_id:(customer_id==null)?0:customer_id},
        method: "POST",
        dataType: "JSON",
        success: function(response){
            if(response.result){
                let row = response.customers[0];
                $('#customer_info').empty();
                let table = "<table class='table table-bordered table-condensed table-striped'>";
                table += "<tr><td>Customer Code:</td><td>"+row.customer_code+"</td></tr>";
                table += "<tr><td>Name:</td><td>"+row.title+" "+row.first_name+' '+row.last_name+"</td></tr>";
                table += "<tr><td>Address:</td><td>"+row.address+', '+row.city+"</td></tr>";
                if(row.phone_number1 !== null) table += "<tr><td>Phone 1:</td><td>"+row.phone_number1+"</td>";
                if( (row.phone_number2 !== null) || (row.phone_number2 == "") ) {
                    table += "<tr><td>Phone 2:</td><td>"+row.phone_number2+"</td>";
                }
                table += "<tr><td>Nationality:</td><td>"+row.nationality+"</td></tr>";
                table += "<tr><td>Fidelity:</td><td>"+row.fidelity_card+"</td></tr>";
                table += "<tr><td>Discount:</td><td>"+row.discount+"%</td></tr>";
                $('#item_details .discount').val(row.discount);
                $('#customer_info').append(table);
                $('#customer_info').collapse("show");
            }else{
                window.location.href = base_url +"users/signin";
            }
            
        }
    })
}

function displayItemDetails(item)
{
    $('#item_details .itemcode').val(item.stockref);
    $('#item_details .description').val(item.name);
    
    $('#item_details .price').val( parseFloat(item.selling_price).toLocaleString("en-US"));
    $('#item_details .quantity').val(1);
    $('#item_details .amount').val( parseFloat(item.selling_price).toLocaleString("en-US") );

    reCalculate()
}

function reCalculate()
{
    let price = $('#item_details .price').val();
    let quantity = $('#item_details .quantity').val();
    let discount = $('#item_details .discount').val();
    let deposit = $('#item_details .deposit').val();
    if( (quantity.isNaN) || (quantity=="") ){
        quantity = 1;
        $('#item_details .quantity').val(quantity)
    }
    if( (deposit.isNaN) || (deposit=="") ){
        deposit = 0;
        $('#item_details .deposit').val(deposit)
    }
    let amount = parseFloat(price.replace(/,/g,'')) * parseFloat(quantity.replace(/,/g,''))
    let discountAmount = amount * discount / 100
    let netAmount = amount - parseFloat(discountAmount);
    let balance = netAmount - parseFloat(deposit);
    // let minDeposit = netAmount * minimumDepositPct / 100;
    // if( (deposit > 0) && (deposit < minDeposit) ){
    //     toastr["error"]("Minimum deposit required is "+minimumDepositPct+"%, which represents Rs "+minDeposit.toLocaleString("en-US"));
    // }else{
    //     toastr.clear();
    // }
    // console.log(deposit,netAmount,amount,discountAmount,balance)
    if(deposit > netAmount) $('#item_details .deposit').val(netAmount)
    $('#item_details .amount').val(formatNumber(amount));
    $('#item_details .discountamount').val(formatNumber(discountAmount));
    $('#item_details .netamount').val(formatNumber(netAmount));
    $('#item_details .balance').val(formatNumber(balance));
}

function formatNumber(number)
{
    return parseFloat(number).toLocaleString("en-US",{maximumFractionDigits:2,minimumFractionDigits:2});
}

function fetchClientHistory(customer_id)
{
    console.log(customer_id)
    $.ajax({
        url: base_url + "ajax/customers/getHistory",
        data:{customer_id:customer_id},
        method:"POST",
        dataType:"JSON",
        success:function(response)
        {
            console.log(response)
            if( (response.result) && (response.orders.length>0) ){
                $('#customer_history tbody').empty();
                var rows = "";
                $(response.orders).each(function(i,j){
                    rows += '<tr class="text-center">';
                    rows += '<td>'+j.order_date+"</td>";
                    rows += '<td>'+j.document_number+"</td>";
                    rows += '<td>'+j.productName+"</td>";
                    rows += '<td>'+(parseFloat(j.amount) - parseFloat(j.discount)).toLocaleString("en-US")+"</td>";
                    rows += '<td>'+j.stageName+"</td>";
                    rows += "</tr>";
                })
                console.log(rows)
                $('#customer_history tbody').append(rows);
                $('#customer_history table').removeClass("hidden");
            }else{
                $('#customer_history').find("table").addClass("hidden");
            }
        }
    })
}