jQuery(function(){

    $('#select-all').on("click",function(){
        if($(this).is(":checked")){
            $('.select-table').each(function(i,row){
                if(!$(row).prop("disabled")){
                    $(row).prop("checked",true);
                }
            })
        }else{
            $('.select-table').prop("checked",false);
        }
    })

    $('.select-table').on("click",function(){
        let total = 0;
        let checked=0;
        $('.select-table').each(function(i,row){
            if(!$(row).prop("disabled")) total++
            if($(row).is(":checked")) checked++;
        })

        if(total == checked) {
            $('#select-all').prop("checked",true);
        }else{
            $('#select-all').prop("checked",false);
        }
    })

    $('#proceed').on("click",function(){
        let valid = true;
        let tables = [];

        $('#tables-list tbody tr').each(function(){
            let selected = $(this).find("input[type=checkbox]").is(":checked");
            if(selected){
                tables.push($(this).find("td").eq(0).text())
            }
        })

        if(valid){
            $.ajax({
                url: base_url + "reset/proceed",
                data: {tables:tables},
                method:"POST",
                dataType: "JSON",
                success: function(response){
                    if(response.result){
                        if(response.login){
                            alert("The users has been re-initialised, your current session has been destroyed and you will now re-directed to the sign in page. Please login using:\r\n\r\nUsername: root\r\nPassword:"+response.password+"\r\n\r\n3 other users have also been created, with the following usernames:\r\n storekeeper, sales and delivery,\r\nall having the same password as the one generated above.")
                            window.location.href = base_url + "users/signout";
                        }else{
                            window.location.reload();
                        }
                    }else{
                        alert(response.reason)
                    }
                    
                    
                }
            })
        }

    })

    
})