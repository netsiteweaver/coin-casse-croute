var products = [];
var myCart = [];
var selectedTable = 0;
var selectedSource = null;
var selectedDestination = null;
var timeout = null;
var str = "";
var x=0;
var maxTables = 13;
var tableNames = ['0','1','2','3','4','5','6','7','8','9','10','11','12','Terrasse'];
var sHeight = $(window).height();

jQuery(function(){
    
    $(window).on("resize", function(){
        $('#items-cart').css("height",(sHeight - 250)+'px')
    })
    $('#items-cart').css("height",(sHeight - 250)+'px')

    selectedTable = localStorage.getItem("selectedTable");
    if(typeof selectedTable == 'undefined') selectedTable = 0;

    initTables();

    $('#searchCustomer').on('keyup',function(e){
        Filter("customer_list",$(this).val().toLowerCase(),".name");
    })

    checkUnsavedOrder();

    $.ajax({
        url: base_url + "ajax/products/getCategories",
        method:"GET",
        dataType:"JSON",
        success:function(response) {
            if(response.result) {
                if(response.rows > 0) {
                    $('#categories .row > div.target').empty();
                    $(response.categories).each(function(i,j){
                        var output = '<div class="col-md-4 btn pos-btn btn-default select-category" data-category-id="'+j.id+'">';
                        output += '<div class="image"><img src="'+ base_url + "uploads/product_categories/" + j.photo + '" alt=""></div>';
                        output += '<div class="label">'+j.name+'</div>'
                        output += '</div>'
                        $('#categories .row > div.target').append(output);
                    })
                    
                }
            }
        }
    })

    $('#selectTable2').on("click",".select-table",function(){
        let tbl = $(this).data("table");
        $('.selected-table').html("Table: " + tbl )
        selectedTable = ((tbl=='x')?0:tbl);
        localStorage.setItem("selectedTable", selectedTable);
        $('#items-cart').empty();
        loadTable(selectedTable)
        $('.backToCategories').trigger("click");
        $('#selectTable2').modal("hide");
    })

    $('#assignTable .select-table').on("click",function(e){
        let tbl = $(this).data("table");
        let myCartJSON = localStorage.getItem("myCart"+tbl);
        // $('.selected-table').html("Table: " + ((selectedTable=='0')?'None':selectedTable) )

        let myCart = null;
        if(myCartJSON !== null) {
            myCart = JSON.parse(myCartJSON);
        }else{
            return false;
        }
        console.log(myCart.length)
        if(myCart.length>0){
            alertify.confirm('Table '+tbl+' is not empty. Click on OK to merge Table '+tbl+' with Table '+selectedTable+'. Or click on Cancel to overwite it')
            .set('on')
            .set('oncancel', function(ev){
                    alert(2)
                }
            )
        }
    })

    $('.openTableModal').on("click",function(){
        Notify("swing")
        var x = initTables(true);
        $('#selectTable2 .modal-body .row').empty();
        $(JSON.parse(x)).each(function(i,j){
            let line = '<div class="col-sm-3 '+((selectedTable==i)?'selected-table':'')+'">';
            line += '<div data-table="'+tableNames[i]+'" class="resto-table select-table btn btn-lg btn-block btn-default" data-id="'+i+'">'+tableNames[i];
            if(j.items>0){
                line += '<div class="ctn ">'+(j.items)+'</div>'
            }
            line += '</div>'
            line += '</div>'
            $('#selectTable2 .modal-body .row').append(line)
        })
        $('#selectTable2').modal("show")
    })

    $('.clearAllTables').on("click",function(){
        Notify("swing")
        alertify.confirm("Are you sure you want to empty all tables?")
            .set('onok',function(e){
                emptyTables();
                initTables();
                loadTable(0);
                selectedTable = 0;
                $('#turret_display').text("0")
            })
    })

    $('.openAssignModal').on("click",function(){
        Notify("swing")
        var x = initTables(true);
        
        $('#assignTable2 .source .list-group').empty();
        $('#assignTable2 .destination .list-group').empty();

        $(JSON.parse(x)).each(function(i,j){
            let line = "<li data-items='"+j.items+"' data-table='"+tableNames[i]+"' class='list-group-item text-center'>"+tableNames[i]+ ( (j.items>0) ? " ("+j.items+")" : "") +"</li>"
            $('#assignTable2 .source .list-group').append(line)
            $('#assignTable2 .destination .list-group').append(line)
        })

        $('#assignTable2').modal("show");

    })

    $('body').on("click","#assignTable2 .source .list-group-item",function(){
        let items = $(this).data("items");
        let table = $(this).data("table");
        // console.log(items);
        if(items==0) {
            toastr["error"]("Select table is empty");
            return;
        }else{
            selectedSource = table;
            $('#assignTable2 .source .list-group-item').removeClass("active");
            $(this).addClass("active");
        }
    })

    $('body').on("click","#assignTable2 .destination .list-group-item",function(){
        let items = $(this).data("items");
        let table = $(this).data("table");
        if(table == selectedSource) {
            toastr["error"]("Source and Destination cannot be Same")
            return
        }
        selectedDestination = table;
        $('#assignTable2 .destination .list-group-item').removeClass("active");
        $(this).addClass("active");
    })

    $('#replaceTable').on("click", function(){
        if( (selectedSource == null) || (selectedDestination == null) ) {
            alertify.alert("Please select source and destination. Ensure that both are highlighted when clicked before proceeding")
            return
        }
        if(selectedSource == selectedDestination) {
            alertify.alert("Source and Destination must not be the same")
            return
        }
        let sTable = localStorage.getItem("myCart"+selectedSource);
        localStorage.setItem("myCart"+selectedDestination,sTable);
        localStorage.setItem("myCart"+selectedSource,"[]");
        $('#items-cart').empty();
        $('.selected-table').html("Table: " )
        $('#assignTable2').modal("hide");
    })

    $('#mergeTable').on("click", function(){
        if( (selectedSource == null) || (selectedDestination == null) ) {
            alertify.alert("Please select source and destination. Ensure that both are highlighted when clicked before proceeding")
            return
        }
        if(selectedSource == selectedDestination) {
            alertify.alert("Source and Destination must not be the same")
            return
        }
        let sTableJson = JSON.parse(localStorage.getItem("myCart"+selectedSource));
        let dTableJson = JSON.parse(localStorage.getItem("myCart"+selectedDestination));
        let merged = sTableJson.concat(dTableJson);
        localStorage.setItem("myCart"+selectedDestination,JSON.stringify(merged))
        localStorage.setItem("myCart"+selectedSource,"[]");
        $('#items-cart').empty();
        $('.selected-table').html("Table: " )
        $('#assignTable2').modal("hide");
    })

    $('#categories').on("click",".select-category", function(){
        let categoryId = $(this).data("category-id");
        let categoryName = $(this).find(".label").text();
        Notify('one-beep');
        myloader("on")
        $.ajax({
            url: base_url + "ajax/products/getByCategoryId",
            data:{id:categoryId},
            method:"GET",
            dataType:"JSON",
            success:function(response) {
                if(response.result) {
                    if(response.rows > 0) {
                        $('#products .row > div.target').empty();
                        $(response.products).each(function(i,j){
                            var output = '<div class="col-md-4 btn pos-btn btn-default select-product" data-product-id="'+j.id+'" data-product-price="'+j.selling_price+'" data-product-vat="'+j.vat+'"data-product-name="'+j.name+'" data-category="'+j.categoryName+'">';
                            if( (j.photo=="") || (j.photo == null) ){
                                output += '<div class="image"><img src="'+ base_url + "assets/images/image-placeholder-200px.png" +  '" alt=""></div>';
                            }else{
                                output += '<div class="image"><img src="'+ base_url + "uploads/products/" + j.photo + '" alt=""></div>';
                            }
                            output += '<div class="label">'+j.name+'</div>'
                            output += '<div class="price">Rs '+(j.selling_price).toLocaleString("en-US")+'</div>'
                            output += '</div>'
                            $('#products .row > div.target').append(output);
                        })
                        $('#categories').addClass("d-none")
                        $('#products').removeClass("d-none");
                        $('#products .category-name').text(categoryName)
                        if(response.addons.length>0){
                            $('#addons-block .content').empty();
                            $(response.addons).each(function(i,j){
                                var output = '<div class="col-md-4 btn addon-btn btn-default select-addon" data-product-id="'+j.id+'" data-product-price="'+j.selling_price+'" data-product-vat="'+j.vat+'" data-product-name="'+j.name+'" data-category="'+j.categoryName+'">';
                                if(j.photo==""){
                                    output += '<div class="image"><img src="'+ base_url + "assets/images/image-placeholder-200px.png" +  '" alt=""></div>';
                                }else{
                                    output += '<div class="image"><img src="'+ base_url + "uploads/addons/" + j.photo + '" alt=""></div>';
                                }
                                output += '<div class="label">'+j.name+'!</div>'
                                output += '<div class="price">Rs '+(j.selling_price).toLocaleString("en-US")+'</div>'
                                output += '</div>';
                                $('#addons-block .content').append(output);
                            })
                            $('#addons-block').removeClass("d-none");
                        }else{
                            $('#addons-block .content').empty();
                            $('#addons-block').addClass("d-none");
                        }
                    }else{
                        toastr["info"]("Sorry ! There are no items in "+categoryName)
                    }
                }
            },
            complete:function(){
                myloader("off")
            }
        })
    })

    $('#products').on("click",".select-product",function(){
        Notify('one-beep');
        let id = $(this).data("product-id");
        let name = $(this).data("product-name");
        let category = $(this).data("category");
        let price = parseFloat($(this).data("product-price"));
        let vat = parseFloat($(this).data("product-vat"));

        $('.calc').removeClass("selected");
        
        let html = '<div class="row calc selected cursor-pointer" data-id="'+id+'">';
        html += '<div class="col-sm-5 text-left name">['+category+'] '+name+'</div>';
        html += '<div class="col-sm-1 text-center quantity">1</div>';
        html += '<div class="col-sm-2 text-right price">'+price.toLocaleString()+'</div>';
        html += '<div class="col-sm-2 text-right amount">'+price.toLocaleString()+'</div>';
        html += '<div class="col-sm-1 text-center vat">'+vat+'%</div>';
        html += '<div class="col-sm-1"><i class="fa fa-times"></i></div>'

        $('#items-cart').append(html);

        let cart = document.getElementById("items-cart");
        cart.scrollTop = cart.scrollHeight;
        
        calculateTotals();
        initTables();
    })

    $('#addons-block').on("click",".select-addon",function(){
        Notify('one-beep');
        let id = $(this).data("product-id");
        let name = $(this).data("product-name");
        let category = $(this).data("category");
        let price = parseFloat($(this).data("product-price"));
        let vat = parseFloat($(this).data("product-vat"));

        $('.calc').removeClass("selected");
        
        let html = '<div class="row calc selected cursor-pointer" data-id="'+id+'">';
        html += '<div class="col-sm-5 text-left name">+'+name+'</div>';
        html += '<div class="col-sm-1 text-center quantity">1</div>';
        html += '<div class="col-sm-2 text-right price">'+price.toLocaleString()+'</div>';
        html += '<div class="col-sm-2 text-right amount">'+price.toLocaleString()+'</div>';
        html += '<div class="col-sm-1 text-center vat">'+vat+'%</div>';
        html += '<div class="col-sm-1"><i class="fa fa-times"></i></div>'

        $('#items-cart').append(html);
        calculateTotals();
    })

    $('.backToCategories').on("click",function(){
        $('#products .row > div.target').empty();
        unhide(['#categories']);
        hide(['#addons-block','#products']);
    })

    $('.deleteAll').on("click",function(){
        if(confirm("Are you sure you want to remove all items from the cart?")){
            $('#items-cart .row').remove();
            calculateTotals();
            initTables();
        }
    })

    $('#addons-block #hideshow').on("click",function(){
        if($('#addons-block').hasClass("hide")) {
            $('#addons-block').removeClass("hide");
            $('#addons-block .fa-chevron-right').removeClass('d-none')
            $('#addons-block .fa-chevron-left').addClass('d-none')
        }else{
            $('#addons-block').addClass("hide")
            $('#addons-block .fa-chevron-left').removeClass('d-none')
            $('#addons-block .fa-chevron-right').addClass('d-none')
        }
    })

    $('#items-cart').on("click",".fa-times",function(){
        if(confirm("Are you sure you want to remove the selected item from the cart?")){
            $(this).closest(".row").remove();
            calculateTotals();
            initTables();
            window.setTimeout(function(){
                $('#items-cart .row.calc').last().addClass("selected")
            },50)
        }
    })

    $('#items-cart').on("click",".calc",function(){
        $('.calc').removeClass("selected");
        $(this).addClass("selected");
    })

    $('#addCustomer').on("click",function(){
        $('#createCustomerModal').modal("show")
    })

    $('#saveCustomer').on("click",function(){
        sendData();
    })

    $('.calc-btn').on("click",function(){
        //first check if there are any rows
        if( ($(this).hasClass("inactive")) || ($('.row.selected').length == 0) ) return;

        let num = $(this).text().trim();
        Notify("one-beep");
        str = str + num
        clearTimeout(timeout);
        timeout = setTimeout(()=> {
            console.log(num,str);
            str = "";
            
        },1000)
        let price = parseFloat($('.row.selected .price').text().replace(/\,/g,''));
        let amount = price * parseFloat(str);
        $('.row.selected .quantity').text(str);
        $('.row.selected .amount').text(amount.toLocaleString());

        calculateTotals();
    })

    $('.save').on("click",function(){
        if($(this).hasClass("inactive")) return;
        saveOrder();
    })

    $('#customerModal').on("shown.bs.modal",function(){
        $('#searchCustomer').trigger("focus")
    })

    $('.select-customer').on("click",function(){
        let id = $(this).data("id");
        let name = $(this).text();
        $('input[name=customer_id]').val(id);
        $('#customerModal').modal("hide");
        $('#popup_customer').val(name);
    })

    $('.select-payment-mode').on("click",function(){
        let id = $(this).data("id");
        let name = $(this).text();
        $('input[name=payment_mode_id]').val(id);
        $('#paymentModeModal').modal("hide");
        $('#popup_payment_mode').val(name);
    })

    $('#createCustomerModal').on("hidden.bs.modal",function(){
        $('#createCustomerModal input').each(function(){
            if($(this).attr("name")!=='title') {
                $(this).val("");
            }
        })
        $(this).find("textarea").val("");
        $('input#title_mr[name=title]').prop("checked",true);
    })

})

function saveOrder()
{
    $.ajax({
        url : base_url + "orders/save",
        data: {rows:myCart,customer_id:$('input[name=customer_id]').val(), payment_mode_id:$('input[name=payment_mode_id]').val(),table_number:selectedTable},
        method: 'POST',
        dataType:'JSON',
        success:function(response){
            if(response.result){
                localStorage.removeItem("myCart"+selectedTable);
                window.location.href = base_url + "orders/receipt/" + response.uuid ;//+ "?print=yes";
            }else{
                toastr["info"]("An error occurred");
            }
        }
    })
}

function checkUnsavedOrder()
{
    let myCartJSON = localStorage.getItem("myCart"+selectedTable);
    $('.selected-table').html("Table: " + (( (selectedTable=='0') || (selectedTable === null) )?'0':selectedTable) )
    let myCart = null;
    if(myCartJSON !== null) {
        myCart = JSON.parse(myCartJSON);
    }else{
        return false;
    }
    if(myCart.length>0){
        $(myCart).each(function(i,j){
            let html = '<div class="row calc '+((i==myCart.length-1)?'selected':'')+' cursor-pointer" data-id="'+j.id+'">';
            html += '<div class="col-sm-5 text-left name">'+j.name+'</div>';
            html += '<div class="col-sm-1 text-center quantity">'+j.quantity+'</div>';
            html += '<div class="col-sm-2 text-right price">'+j.price.toLocaleString()+'</div>';
            html += '<div class="col-sm-2 text-right amount">'+(j.price*j.quantity).toLocaleString()+'</div>';
            html += '<div class="col-sm-1 text-center vat">'+( (typeof j.vat == 'undefined' ) ? '15' : j.vat)+'%</div>';
            html += '<div class="col-sm-1"><i class="fa fa-times"></i></div>'

            $('#items-cart').append(html);
        })
        $('.calc-btn,.nocalc-btn').removeClass("inactive");
        calculateTotals();
    }
}

function loadTable(selectedTable)
{
    $('#items-cart').empty();
    let myCartJSON = localStorage.getItem("myCart"+selectedTable);
    $('.selected-table').html("Table: " + selectedTable )
    let myCart = null;
    if(myCartJSON !== null) {
        myCart = JSON.parse(myCartJSON);
    }else{
        return false;
    }
    if(myCart.length>0){
        $(myCart).each(function(i,j){
            let html = '<div class="row calc '+((i==myCart.length-1)?'selected':'')+' cursor-pointer" data-id="'+j.id+'">';
            html += '<div class="col-sm-5 text-left name">'+j.name+'</div>';
            html += '<div class="col-sm-1 text-center quantity">'+j.quantity+'</div>';
            html += '<div class="col-sm-2 text-right price">'+j.price.toLocaleString()+'</div>';
            html += '<div class="col-sm-2 text-right amount">'+(j.price*j.quantity).toLocaleString()+'</div>';
            html += '<div class="col-sm-1 text-center vat">'+j.vat+'%</div>';
            html += '<div class="col-sm-1"><i class="fa fa-times"></i></div>'

            $('#items-cart').append(html);
        })
        $('.calc-btn,.nocalc-btn').removeClass("inactive");
        calculateTotals();
    }
}

function calculateTotals()
{
    let totalQuantity = 0;
    let totalAmount = 0;
    myCart = [];
    $('#items-cart .row').each(function(i,row){
        if($(this).hasClass("calc")){
            let id = $(this).data("id")
            let name = $(this).find(".name").text();
            let quantity = parseFloat($(this).find(".quantity").text().replace(/\,/g,''));
            let price = parseFloat($(this).find(".price").text().replace(/\,/g,''));
            let vat = parseFloat($(this).find(".vat").text());
            let category = $(this).find(".category").text();
            let amount = quantity * price;

            let line = {
                "id":id,
                "quantity":quantity,
                "category":category,
                "name":name,
                "price":price,
                "vat":vat
            };
            myCart.push(line)
            totalQuantity += quantity;
            totalAmount += amount;
            
        }
    })
    localStorage.setItem("myCart"+selectedTable,JSON.stringify(myCart))
    localStorage.setItem("selectedTable", selectedTable);
    displayTotals('#totalRow',totalQuantity,totalAmount);
    
}

function displayTotals(element,totalQuantity,totalAmount)
{
    if ($('.row.calc').length == 0) {
        $('#totalRow').remove();
        $('.calc-btn, .nocalc-btn').addClass("inactive");
        $('#turret_display').text('0.00')
        return;
    }
    $('.calc-btn, .nocalc-btn').removeClass("inactive");
    $(element).remove();
    let totalRow = "<div id='totalRow' class='row'>"
    totalRow += "<div class='col-sm-5'></div>";
    totalRow += "<div class='col-sm-1 text-center'>"+totalQuantity+"</div>";
    totalRow += "<div class='col-sm-2 text-right'></div>";
    totalRow += "<div class='col-sm-2 text-right text-bold'>Rs "+totalAmount.toLocaleString()+"</div>";
    totalRow += "<div class='col-sm-1'></div>";
    totalRow += "<div class='col-sm-1'></div>";
    totalRow += "</div>";
    $('#items-cart').append(totalRow);
    $('#turret_display').text(Number(totalAmount.toFixed(2)).toLocaleString('en'))
}

function initTables(jsonOutput) {
    if(typeof jsonOutput == 'undefined') jsonOutput = false;
    let output = [];
    for(let i = 0;i <= maxTables;i++) {
        let tbl = localStorage.getItem("myCart"+tableNames[i]);
        if(tbl===null) {
            localStorage.setItem("myCart"+i,'[]');
            output.push({table:i,items:0})
        } else {
            if(JSON.parse(tbl).length > 0){
                if(jsonOutput) {
                    output.push({table:i,items:(JSON.parse(tbl).length)})
                }else{
                    $('#selectTable2 .row .col-sm-3').find("[data-table='"+ tableNames[i]+"']").html(i + "<div class='ctn'>" + (JSON.parse(tbl).length) + "</div>")
                }
                
            }else{
                if(jsonOutput){
                    output.push({table:i,items:0})
                }else{
                    $('#selectTable2 .row .col-sm-3').find("[data-table='"+i+"']").html(i)
                }
            }
        }
    }
    if(localStorage.getItem('selectedTable') == null) localStorage.setItem('selectedTable','0')
    if(jsonOutput) return JSON.stringify(output);
}

function emptyTables() {
    for(let i = 0;i <= maxTables;i++) {
        let tbl = localStorage.getItem("myCart"+i);
        console.log(i,tbl)

        // localStorage.setItem("myCart"+i,'[]');
        // localStorage.removeItem("myCart"+i);

        localStorage.removeItem("myCart"+i);
        localStorage.removeItem("selectedTable");
    }
}

async function sendData() {

    const form = document.querySelector('#saveCustomerForm');
    const formData = new FormData(form);

    var newClient = $('#createCustomerModal input[name=title]').val() + " " + $('#createCustomerModal input[name=first_name]').val() + " " + $('#createCustomerModal input[name=last_name]').val()

    try {
        const response = await fetch(base_url + "ajax/customers/save", {
            method: "POST",
            // Set the FormData instance as the request body
            body: formData,
        });
        const data = await response.json();
        if(!data.result) {
            alertify.alert(data.reason)
        }else{
            $('#createCustomerModal').modal("hide");
            window.setTimeout(function(){
                $('#customerModal').modal("hide");
                $('input[name=customer_id]').val(data.id);
                $('#popup_customer').val( newClient );
            },750)
            
        }
    } catch (e) {
        // console.error(e);
    }
}