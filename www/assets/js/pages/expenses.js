jQuery(function(){
    $('#save').on("click",function(){
        $('#expenses').submit();
    })

    $('#apply').on("click",function(){
        let startDate = $('input[name=start_date]').val();
        let endDate = $('input[name=end_date]').val();
        let perPage = $('select[name=per_page] :selected').val();

        console.log(startDate,endDate,perPage)

        window.location.href = base_url + "expenses/listing?start_date="+startDate+"&end_date="+endDate+"&per_page="+perPage;
    })
})