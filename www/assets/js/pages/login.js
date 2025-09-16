$(function() {
    var x = document.getElementById('background-video');

    $('#controls div').on('click', function() {
        let elem = $(this);
        let btn = $(this).find('i');

        if ($(btn).hasClass("fa-play")) {
            $('#controls div.btn').eq(0).removeClass('btn-info').addClass("btn-outline-info");
            $('#controls div.btn').eq(1).addClass('btn-info').removeClass("btn-outline-info");
            x.play()
        }
        if ($(btn).hasClass("fa-pause")) {
            $('#controls div.btn').eq(0).addClass('btn-info').removeClass("btn-outline-info");
            $('#controls div.btn').eq(1).removeClass('btn-info').addClass("btn-outline-info")
            x.pause();
        }
    })

    $('.form-control').keypress(function(e) {
        var c = String.fromCharCode(e.which);
        if (c.toUpperCase() === c && c.toLowerCase() !== c && !e.shiftKey) {
            $('#message').show();
        } else {
            $('#message').hide();
        }
    });

    $("#signin").on("click", function() {
        if ($(this).hasClass("processing")) return false;

        $(this).addClass("processing");

        var valid = true;
        $(".required1").closest(".form-group").find("p").html("");
        $("#result").removeClass("error").html("");

        $(".required1").each(function() {
            var elem = $(this).val();
            if (elem.length == 0) {
                valid = false;
                $(this).closest(".form-group").find("p.error").html(
                    "This field is required")
            }
        })

        if (valid) {
            $("#signin").addClass("d-none");
            $.ajax({
                url: base_url + "users/authenticate",
                type: "POST",
                dataType: "JSON",
                data: {
                    inputEmail: $("input[name=inputEmail").val(),
                    inputPassword: $("input[name=inputPassword").val()
                },
                success: function(response) {
                    if (response.result == false) {
                        window.setTimeout(()=>{
                            $("#signin").removeClass("d-none");
                            $("#result").addClass("error").text(response
                                .reason);
                        },500);
                        playLoginSound("failed");
                    } else {
                        playLoginSound("success")
                        let html = "<div class='login-result'>";
                        if(response.logo.length>0) html += "<img src='../uploads/logo/"+response.logo+"' style='width:100px;'>"
                        html+= "<p>Authentication Successfull</p></div>"
                        $('.login-box').html(html)
                        window.setTimeout(()=>{
                            // if(response.userLevel == "Normal"){
                                window.location = base_url + "orders/add";
                            // }else{
                                // window.location = base_url + "dashboard/index";
                            // }
                        },3000)
                    }
                },
                error: function() {
                    $("#result").addClass("alert alert-danger").text(
                        "1200: An error has occurred");
                    $("#signin").removeClass("d-none");
                },
                complete: function() {
                    $('#signin').removeClass("processing");
                }
            })
        } else {
            $("#signin").removeClass("processing")
        }

        return false;
    })
    $("#forget_password").on("click", function() {
        $(".login-container").addClass("d-none")
        $(".forgetpassword-container").removeClass("d-none")
        $("#email_to_reset").focus();
        return false;
    })
    $("#back_to_signin").on("click", function() {
        $(".login-container").removeClass("d-none")
        $(".forgetpassword-container").addClass("d-none")
        return false;
    })

    $('#reset_password').on("click", function() {
        var email = $('#email_to_reset').val();
        if (email.length == 0) return false;
    })
});


function playLoginSound(state)
{	
    //var soundFiles = ['success.wav','failed.wav'];
    var states = ['success','failed'];
    if(!states.includes(state)) state = 'success';
    // var index = states.indexOf(state);
    console.log(state)
	if(document.getElementById(state) !== null) document.getElementById(state).play()
}
