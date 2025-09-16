jQuery(function(){

    $('.input-group-text.clear-search').on("click",function(){
        let elem = $(this).siblings("input").val();
        if(elem=="") return false;
        $(this).siblings("input").val("");
    })

})