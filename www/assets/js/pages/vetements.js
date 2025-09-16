var measurements = [];
const chooseFile = document.getElementById("choose-file");
const imgPreview = document.getElementById("img-preview");
// chooseFile.addEventListener("change", function () {
    
// });


jQuery(function(){
    $.getScript("assets/js/autosize.min.js");

    window.setTimeout(function(){
        autosize($('textarea[name=image_map]'));
    },800)

    $('.open-modal').on("click",function(){
        let zone = $(this).attr("title");
        $('#zone').text(zone)
        $('#measurementModal').modal("show");
        return false;
    })

    $('#measurementModal').on("shown.bs.modal",function(){
        $('#measurementModal [name=measurement]').focus();
    })

    $('#saveMeasurement').on("click", function(){
        let m = $('#measurementModal input[name=measurement]').val().trim();
        let zone = $('#zone').text();
        measurements.push({
            zone: zone,
            value: m
        });

        $('#measurementModal input[name=measurement]').val('')
        $("#measurementModal").modal("hide")
    })

    $('#test').on("click", function(){
        console.log(measurements)
    })

    $('#choose-file').on("change",function(){
        getImgData();
    })

    $('textarea[name=image_map]').on("paste",function(){
        window.setTimeout(function(){
            processCode();
        },500)
    })

    $('#process').on("click",function(){
        //processCode();
    })

    $('select[name=order_by]').on("change",function(){
        let layout = 'grid';
        let order_dir = $('input[name=order_dir]:checked').val();
        if($(this).hasClass("fa-th-list")) layout = 'list'
        window.location.href = base_url + "vetements/listing?order_by="+$(this).val()+"&order_dir="+order_dir;
    })

    $('input[name=order_dir]').on("change",function(){
        let layout = 'grid';
        let order_by = $('select[name=order_by]').val();
        if($(this).hasClass("fa-th-list")) layout = 'list'
        window.location.href = base_url + "vetements/listing?order_dir="+$(this).val()+"&order_by="+order_by;
    })

    $('.change-layout').on("click",function(){
        let layout = 'grid';
        let order_by = $('select[name=order_by]').val();
        let order_dir = $('input[name=order_dir]:checked').val();
        if($(this).find("i").hasClass("fa-th-list")) layout = 'list';
        window.location.href = base_url + "vetements/listing?order_dir="+order_dir+"&order_by="+order_by+"&layout="+layout;
    })

    $('#additional-fields-block').on("click",".addRow",function(){
        let elem = $(this).closest(".row").clone();
        $(elem).find("input").val("");
        $(this).closest(".row").find(".addRow").addClass("d-none");
        $(this).closest(".row").find(".removeRow").removeClass("d-none");
        $('#additional-fields-block').append(elem);
        $("#additional-fields-block .row:last-child input").trigger("focus");
    })

    $('#additional-fields-block').on("click",".removeRow",function(){
        let check = $('#additional-fields-block .row').length;
        if(check == 1) return;
        let id = $(this).closest(".row").find(".field_name_ids").val();
        let deletedIds = JSON.parse($(".deleted_ids").val());
        deletedIds.push(id);
        $(".deleted_ids").val(JSON.stringify(deletedIds))
        $(this).closest(".row").addClass("d-none");
    })

})

function processCode()
{
    let data = $('textarea[name=image_map]').val();
    let lines = data.split("\n");
    let body = '';

    $(lines).each(function(i,j){
        let x = j.trim();
        let y = '';

        if(x.length>0){
            if(x.search('Image Map Generated')>=0){
                //skip
            }else if(x.search('img src')>=0){
                //skip
            }else if(x.search('map name')>0){
                body += "<map name=\"image-map\">\n";
            }else if(x.search('area target')>0){
                if( (x.search("class='open-modal'")==-1) && (x.search('class="open-modal"')==-1) ){
                    let t = x.substring(0,x.length-1);
                    t += " class='open-modal'>";
                    body += t+"\n";
                }else{
                    body += x+"\n";
                }
            }else{
                x = x.replace(/(\r\n|\n|\r)/gm, "");
                body += x+"\n";
            }
        }

        
    })
    $('textarea[name=image_map]').val(body);
}

function getImgData() {
    const files = chooseFile.files[0];
    if (files) {
      const fileReader = new FileReader();
      fileReader.readAsDataURL(files);
      fileReader.addEventListener("load", function () {
        imgPreview.style.display = "block";
        imgPreview.innerHTML = '<img src="' + this.result + '" />';
      });    
      getImageSizes();
    }else{
        alert()
    }
  }


function getImageSizes()
{
    var img = document.getElementById('img-preview'); 
    //or however you get a handle to the IMG
    var width = img.clientWidth;
    var height = img.clientHeight;
    console.log(width,height)
}