jQuery(function(){

    $('.select-category').on("click",function(){
        if($(this).data("selected") == "0"){
            $(this).find(".choice").html('<i class="fa fa-check-square fa-2x"></i>');
            $(this).data("selected","1");
            $(this).find(".addon_category").attr("checked",true);
        }else{
            $(this).find(".choice").html('');
            $(this).data("selected","0");
            $(this).find(".addon_category").removeAttr("checked");
        }
    })

    $('#image-block').on("click",".delete-image",function(){
        let that = $(this);
        $('#upload_photo').removeClass("hidden");
        let img = $('#image-block').find('img').attr('src');
        // $('input[name=deleted_image]').val($(this).find('img').attr('src'))
        $("input[name=deleted_image]").val(img);
        // let c = JSON.parse(cJSON);
        // c.push($(this).parent().data("id"));
        // $("input[name=deleted_images]").val(JSON.stringify(c));
        $(that).parent().remove();
      })
})