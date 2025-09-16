jQuery(function(){

    _autocomplete();


    $('#supplier_id').on('change',function(){
        var value = this.value;
        $.ajax({
         type: 'GET',
         url:base_url+"purchases/getSupplierDetails", 
         method:'POST',
         data:{q:value},
         dataType:"JSON",
         success:function(response){
             $.each(response.response, function (i, item) {
                let data = item.company_name + "<br>" + item.address + "<br>Email: " + item.email + "<br>Phone: " + item.phone_number 
                $('.supplier_info').html(data)
             });
         },
         complete: function()
         {
             
         }
     })
        
   }); 

    $('#itemcode').on('shown.bs.modal', function (e) {
        $('#itemcodes').focus();
        
    })


    $('#my_table').on('click', '.select_product',function(){
        var elem = $(this).closest('tr').data('id');
        getItemdetails(elem);
        // $("#itemcode").removeData('modal');
        // window.setTimeout(function(){
            // $('#itemcode').modal('hide');
        // },500)
        // $('tr.active .add_row').trigger("click");
        $('table#item-list tbody tr:last-child').find(".item_id").focus();
        $('tr.po-item.active .stockref').val(100) 
      }); 

      $('#itemcode').on('hidden.bs.modal', function (e) {
        $('#itemcodes').val('');
        $('#my_table tbody').empty();
        $('tr').removeClass("active");
        $('.targeted').select().removeClass("targeted");
      })

    // $(".stockref").on('click',function(){
    $("body").on("click",".stockref",function(){
        $(this).closest('tr').addClass('active');
        $('#itemcode').modal("show");
    });

    
    $('#item-list').on('click','.add_row',function(){
        var tr = $('#item-clone tr').clone()
        $('#item-list tbody').append(tr)
       
        tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
            calculate()
        })
       
        tr.find(".item_id").on('click',function(){
            $(this).closest('tr').addClass('active');
            $('#itemcode').modal("show");
        });
    })

    $('#item-list').on('click','.remove_row',function(){
        if( $("tr.po-item").length == 2 ) return false;
        let pd_id = $(this).closest('tr').data("id");
        if(pd_id > 0) {
            let status = JSON.parse($('input[name=deleted_rows]').val());
            status.push(pd_id);
            $('input[name=deleted_rows]').val(JSON.stringify(status));
        }
        $(this).closest("tr").remove();
    })

    if($('#item-list .po-item').length > 0){

        $('#item-list .po-item').each(function(){
            var tr = $(this)
          
            tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
                calculate();
            })

            $('#item-list tfoot').find('[name="discount"]').on('input keypress',function(e){
                calculate();
            })
        
            tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('keypress')
        })
    }else{
        $('#add_row').trigger('click')
    }

 

    $('.select2').select2({placeholder:"Please Select here",width:"relative"})

    $('#po-form').submit(function(e){
        e.preventDefault();
        console.log(new FormData)
        var _this = $(this)
        $('.err-msg').remove();
        $('[name="po_no"]').removeClass('border-danger')
        if($('#item-list .po-item').length <= 0){
            bootbox.alert("Please add atleast 1 item on the list");
            return false;
        }
        
        $.ajax({
            url:base_url+"purchases/save_purchase",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            success:function(response){
                if(response.result) {
                    window.location.href = base_url+"/purchases/listing";
                   }else{
                    bootbox.alert(response.msg)
                    return false;
                }
            }
        })
    })

    $('.delete_purchase').on("click",function(e){
        let number = $(this).closest("tr").data("number");
        let url = $(this).attr("href")
        let row = $(this).closest("tr");

        e.preventDefault();
        bootbox.confirm({
	        message: "Are you sure you want to delete Purchase no. "+number+"?",
	        buttons: {
	            confirm: {
	                label: 'Yes, Delete It !',
	                className: 'btn-danger'
	            },
	            cancel: {
	                label: 'No',
	                className: 'btn-primary'
	            }
	        },
	        callback: function (result) {
	        	if(result==true){
                    
                    
                    console.log(url)
                    $.ajax({
                        url: url,
                        method:"POST",
                        dataType:"JSON",
                        success:function(response){
                            toastr.info("Purchase "+number+" has been deleted");
                            $(row).remove();
                        }
                    })
	        	}
	        }
	    });		

        return false;
    })

    $('#po-form_update').submit(function(e){
        e.preventDefault();
        var _this = $(this)
        $('.err-msg').remove();
        $('[name="po_no"]').removeClass('border-danger')
        if($('#item-list .po-item').length <= 0){
            bootbox.alert("Please add atleast 1 item on the list");
            return false;
        }
        
        $.ajax({
            url:base_url+"purchases/update_purchase",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            success:function(response){
                if(response.result) {
                    window.location.href = base_url+"/purchases/listing";
                   }else{
                    bootbox.alert(response.msg)
                    return false;
                   }
            }
        })
    })

})

function getItemdetails(id,tr)
{
   $.ajax({
    type: 'GET',
    url:base_url+"purchases/getProductDetailsbyId", 
    method:'POST',
    data:{q:id},
    dataType:"JSON",
    success:function(response){
        $('tr.active').find('.unit_price').val(parseFloat(response.response[0].unit_price));
        $('tr.active').find('.category').text(response.response[0].category_name); 
        $('tr.active').find('.description').val(response.response[0].product_name);
        $('tr.active').find('.item_id').val(response.response[0].stockref); 
        $('tr.active').find('.item_id_id').val(response.response[0].product_id); 
        $('tr.active .qty').val(1) 
    },
    complete: function()
    {
        
    }
})

}


function isNumberKey(evt, element) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
      return false;
    else {
      var len = $(element).val().length;
      var index = $(element).val().indexOf('.');
      if (index > 0 && charCode == 46) {
        return false;
      }
      if (index > 0) {
        var CharAfterdot = (len + 1) - index;
        if (CharAfterdot > 3) {
          return false;
        }
      }
  
    }
    return true;
  }

function getItemdetails(id)
{
    Overlay("on");
   $.ajax({
    type: 'GET',
    url:base_url+"purchases/getProductDetailsbyId", 
    method:'POST',
    data:{q:id},
    dataType:"JSON",
    success:function(response){
        $('tr.active').find('.unit_price').val(parseFloat(response.response[0].unit_price));
        $('tr.active').find('.category').text(response.response[0].category_name); 
        $('tr.active').find('.color').text(response.response[0].color_name); 
        $('tr.active').find('.description').val(response.response[0].product_name); 
        $('tr.active').find('.stockref').val(response.response[0].stockref); 
        $('tr.active').find('.item_id').val(response.response[0].product_id); 
        $('tr.active .qty').val(1).addClass('targeted');
        calculate();

        $('#itemcode').modal('hide');
    },
    complete: function()
    {
        Overlay("off")
    }
})

}

function calculate(){
    var _total = 0
    $('#item-list .po-item').each(function(i,j){
        var qty = $(this).find("[name='qty[]']").val();
        var unit_price = $(this).find("[name='unit_price[]']").val();
        // if(qty > 0 && unit_price > 0){
            var row_total = parseFloat(qty) * parseFloat(unit_price);
            _total += row_total;
        // }
        //$(this).find('.total-price').val(parseFloat(row_total).toLocaleString('en-US'))
        $(this).find('.total-price').val(row_total)
    })

    var discount_amount = $('#discount').val();
    $('#sub_total').val(_total);
    $('#total').val(_total-discount_amount);
}

function _autocomplete(){
    $( "#itemcodes" ).autocomplete({
        source: function (request, response) {
            let options = [];
            $('.search-option').each(function(i,row){
                let option = $(this).data("option");
                let check = $(this).find('span i').hasClass("fa-check");
                if(check){
                    options.push(option)
                }
            })
            if(options.length == 0) {
                bootbox.alert("No columns selected");
                return false;
            }
            console.log(options.length)
            $.ajax({
                url: base_url+"ajax/misc/search_items",
                type: "POST",
                data: {data:request,search_in:options},
                dataType: 'json',
                success: function (data) {
                    $("#my_table tbody").empty();
                    $.each(data.response, function (i, item) {
                        $('<tr data-id="'+item.id+'">').append(
                            $('<td class="select_product cursor-pointer">').text(item.stockref),
                            $('<td class="select_product cursor-pointer">').text(item.description),
                            $('<td class="select_product cursor-pointer text-right">').text("Rs "+item.unit_price),
                            $('<td class="select_product cursor-pointer text-right">').text("Rs "+item.selling_price),
                            $('<td class="select_product cursor-pointer">').text(item.compartments),
                            $('<td class="select_product cursor-pointer">').text(item.size),
                            // $('<td class="select_product cursor-pointer">').html("<div style='width:100%;text-align:center;color:#fff;height:20px;background-color:"+item.color+"'>"+item.color_name+"</div>"),
                            $('<td class="select_product cursor-pointer">').html(item.color_name),
                            $('<td class="select_product cursor-pointer text-center">').text(item.quantity)
                        ).appendTo('#my_table tbody');
                    });
                }
            });
            }
        });
}

