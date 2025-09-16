jQuery(function(){
    $(".print").on("click",function(){
        window.print();
        window.location.href = base_url + "orders/add";
    })
})
