var colors = new Array();
// var colors.data = null;
// var colors.timestamp = null
jQuery(function(){

    $('#query').on('click', function () {
        $(this).addClass('btn-info').removeClass('btn-default');
        $('#form').removeClass('btn-info').addClass('btn-default');
        $('#form').removeClass('active');
        $('#query-block').removeClass("hidden");
        $('#form-block').addClass("hidden");
    })
  
    $('#form').on('click', function () {
        $(this).addClass('btn-info').removeClass('btn-default');
        $('#query').removeClass('btn-info').addClass('btn-default');
        $('#query').removeClass('active');
        $('#form-block').removeClass("hidden");
        $('#query-block').addClass("hidden");
    })

    $('#delete_line').on("click",function(){
        $(this).closest('.row').remove();
        $('#select_model_block').removeClass("hidden");
        $('select[name=version]').addClass("required")
        $('input[name=label]').val('');
        $('#line_label_block').removeClass("hidden");
    })

    $('body').on('change','#select_model',function(){
        let elem = $(this).val();
        if(elem=="") return false;

        $.ajax({
            url: base_url + "ajax/misc/getSubmodels",
            data: {model_id:elem},
            method:"POST",
            dataType:"JSON",
            success:function(response){
                if(response.result){
                    $('#select_submodel').find("option").remove();
                    $('#select_submodel').append("<option value=''>Select Sub Model</option>")
                    $(response.data).each(function(i,j){
                        $('#select_submodel').append("<option data-amg='"+j.isAMG+"' value='"+j.id+"'>"+j.sub_model+"</option>")
                    })
                    $('#select_submodel_block').val('').removeClass("hidden");
                }else{
                    $('#select_submodel').find("option").remove();
                    $('#select_version').find("option").remove();
                    $('#select_submodel_block').addClass("hidden");
                    $('#select_version_block').addClass("hidden");
                }
            },
            complete: function(){

            }
        })
        
    })

    $('body').on('change','#select_submodel',function(){
        let elem = $(this).val();
        if(elem=="") return false;

        let amg = $('#select_submodel :selected').data('amg');
        if(amg=='1') {
            $('input[name=label]').prop("readonly",true).removeClass("required");
            $('.label_block').addClass("hidden");
        }else{
            $('input[name=label]').prop("readonly",false).addClass("required");
            $('.label_block').removeClass("hidden");
        }
        $('input[name=amg]').val(amg)
        $.ajax({
            url: base_url + "ajax/misc/getVersions",
            data: {submodel_id:elem},
            method:"POST",
            dataType:"JSON",
            success:function(response){
                if(response.result){
                    $('#select_version').find("option").remove();
                    $('#select_version').append("<option value=''>Select Version</option>")
                    $(response.data).each(function(i,j){
                        $('#select_version').append("<option value='"+j.id+"'>"+j.version+"</option>")
                    })
                    $('#select_version_block').val('').removeClass("hidden");
                }else{
                    $('#select_version').find("option").remove();
                    $('#select_version_block').addClass("hidden");
                }
            },
            complete: function(){

            }
        })
        
    })

    $('body').on('change','#select_version',function(){
        let elem = $('#select_version :selected').data('amg');
        console.log(elem)
    })




    $('body').on('click', '.add-block', function () {


        //clone the button and removes it
        let btn = $(this).closest('.col-sm-12').clone();
        $(this).closest('.col-sm-12').remove();
    
        let newOrderValue = getOrder();
        //clone the proto and append it
        let block = $('.proto').clone().removeClass('hidden proto');
        $('.block-container').append(block)
    
        //append the cloned button
        $('.block-container').append(btn)
    
        $('.block-group').last().find('.block_order').val(newOrderValue)
    
    })
  
  
    $('body').on('click', '.edit-block', function () {
        let pageID = $('input[name=id]').val();
        let pageBlockID = $(this).closest('.block-group').find('.page_block_id').val();
        //window.location.href = 
        let url = base_url + 'lines/blockcontent/' + pageBlockID;
        // let win = window.open(url, 'Edit Content', 'height=500,width=1000,menubar=no,toolbar=no,location=no');
        window.open(url, '_blank');
    
    })
  
  
    $('body').on('click', '.delete-block', function () {
        // $('input[name=deletedBlocks]').val('100000')
        let blockID = $(this).closest('.block-group').data('page-block-id');
        // alert(blockID)
    
        let obj = $(this);
        bootbox.confirm({
            title: "Needs Confirmation",
            message: "Deleting a block from a page will also delete all its content (for this page only). Are you sure you want to proceed?",
            callback: function (e) {
                if (e) {
                    $(obj).closest('.block-group').remove();
                    let deletedBlocksJSON = $('input[name=deletedBlocks]').val();
                    let deletedBlocks = JSON.parse(deletedBlocksJSON);
                    deletedBlocks.push(blockID);
                    $('input[name=deletedBlocks]').val(JSON.stringify(deletedBlocks));
                }
            }
        })
    })
  
    $('#open-color-modal').on("click",function(){
        var selected_colors = JSON.parse($('input[name=selected_colors]').val());
        
        $.ajax({
            url: base_url + 'ajax/misc/getColors',
            method:'GET',
            dataType: 'JSON',
            success: function(response){
                if(response.result){
                    colors['data'] = response.data;
                    colors['timestamp'] = Math.floor(Date.now()/1000);
                    var html = "<ul class='list-group'>";
                    $(response.data).each(function(i,j){
                        // console.log(selected_colors,j.id);
                        if(selected_colors.includes(parseInt(j.id))){
                            // console.log(j.id)
                        }else{
                            console.log('-')
                        }
                        html += "<li data-id='"+j.id+"' class='list-group-item cursor-pointer select-color "+((selected_colors.includes(parseInt(j.id)))?'selected':'')+"'>";
                        html += "<img src='"+base_url+'uploads/vehicles/color_swatches/'+j.color_swatch+"' style='height:50px;width:50px;' alt='"+j.color+"'>";
                        html += "<span class='color-name' data-id='"+j.id+"'>"+j.color+"</span>";
                        html += "<span class='selection pull-right'><i class='fa fa-2x "+((selected_colors.includes(parseInt(j.id)))?'fa-check-square-o':'fa-square-o')+"'></i></span>";
                        html += "<span class='pull-right'><input type='file' name="+j.id+"vehicle_photo' class='form-control-file'  onchange='showPreview(event)'></span>";
                        html += "</li>";
                    })
                    html += "</ul>";
                    $('#selectColorModal .modal-body').html('').append(html);
                    $('#selectColorModal').modal("show")
                }else{
                    toastr["error"](response.reason);
                }

            },
            complete:function(){

            }
        })
    })

    

    $('#selectColorModal').on('click','.select-color',function(){
        if($(this).hasClass('selected')){
            $(this).removeClass("selected");
            $(this).find('span.selection').html('<i class="fa fa-2x fa-square-o"></i>')
        }else{
            $(this).addClass("selected");
            $(this).find('span.selection').html('<i class="fa fa-2x fa-check-square-o"></i>')
        }
    })

    $('#selectColorModal #proceed').on("click",function(){
        let count = 0;
        let selected_colors = [];
        let selected_photos = [];
    
        const form = document.querySelector('form');
        const files = document.querySelector('[type=file]').files;

        for (let i = 0; i < files.length; i++) {
            let file = files[i]
          
            selected_photos.push(file);
          }

          console.log(selected_photos);
        $('#selectColorModal .list-group-item').each(function(i,j){
            if($(this).hasClass("selected")){
                count++;
                selected_colors.push($(this).data("id"))
                //selected_photos.push($(this).data("id")+"vehicle_photo")

            }
        })
       
        
     

        console.log(selected_photos);
        $('#selectColorModal').modal("hide");
        $('#colors_block .selected-colors').text(count+' color'+ ((count>1)?'s have':' has') + ' been selected')
        $('input[name=selected_colors]').val(JSON.stringify(selected_colors));
        $('input[name=selected_photos]').val(JSON.stringify(selected_photos));

    })

    $('.delete_thumbnail').on('click',function(){
        let elem = $(this);
        let color_id = $(this).closest("tr").data("color-id");
        $(this).closest("td").find('img').fadeOut(500);
        window.setTimeout(function(){
            $(elem).closest("td").find('input').removeClass("hidden");
            $(elem).closest("td").find('img').remove();
            $(elem).remove();
            let deleted_colors = JSON.parse($('input[name=deleted_thumbnails]').val());
            deleted_colors.push(color_id);
            $('input[name=deleted_thumbnails]').val(JSON.stringify(deleted_colors));
        },500)
        
    })

    $('body').on("click","#saveTransmissionType",function(){
        let elem = $('input[name=add_transmission_type]').val();
        if(elem.length==0) return false;
        $.ajax({
            url: base_url + "transmission_types/save",
            method:"POST",
            data:{name:elem,ajax:1},
            dataType:"JSON",
            success:function(response){
                if(response.result){
                    var options = $('select[name=transmission_type_id]');
                    options.empty();
                    $(response.data).each(function(i,row){
                        options.append($('<option value='+row.id+'>'+row.name+'</option>'));
                    })
                    options.val(response.new_id);
                }else{
                    alert(response.reason);
                }
            },
            complete: function(){
                $('#saveNewTransmissionTypeModal').modal("hide");

            }
        })
    })

    $('#saveNewTransmissionTypeModal').on("shown.bs.modal",function(){
        $('input[name=add_transmission_type]').focus();
    })
})


var showPreview = function(event) {
    var output = document.getElementById('preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
};
  
function getOrder()
{
    var orders = [];
    $('.block-group').each(function(i,j){
        if(!$(this).hasClass('proto')) {
        console.log($(this).find('.block_order').val());
            orders.push($(this).find('.block_order').val());
            console.log(orders);
        }
    })
    return Math.max.apply(Math,orders)+10;
}

function isNumber(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
}
