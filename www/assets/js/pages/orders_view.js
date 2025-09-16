jQuery(function(){
    $('.pdf').on("click",function(){
        $(this).addClass("hidden");
        const element = document.getElementById('order_sheet_pdf');
        const orderNumber = $('#order_sheet_pdf .order-number').text();
        html2pdf().from(element).save("Order-"+orderNumber+".pdf");
        window.setTimeout(function(){
            $('.pdf').removeClass("hidden");
        },1000)
    })
})