jQuery(function () {

  $('.input-group-text.clear-search').on("click",function(){
    let elem = $(this).siblings("input").val();
    if(elem=="") return false;
    $(this).siblings("input").val("");
  })

  toggleCompartments();

  $('#search_text').on("focus",function(){
    $('.showOnFocus').removeClass("hidden");
  })

  $('#search_text').on("blur",function(){
    $('.showOnFocus').addClass("hidden");
  })

  $('#search_text').on("keyup",function(e){
    $.debounce(250, function(){
      let elem = $(this).val();
      console.log(elem)  
    })
  })

  $('select[name=rows_per_page]').on("change",function(){
    let elem = $(this).val();
    if(elem.length==0) return;
    let URL = document.location.toString();
    let segments = URL.split("/");
    if(typeof segments[5]!='undefined'){
      segments[5] = segments[5].split("?")[0];
    }
    document.location.href = base_url + "products/listing/" + ((typeof segments[5]=='undefined')?'1':segments[5]) + "?rows_per_page="+elem;
  })

  $('input[name=stockref]').on("blur",function(){
    let stockref = $('input[name=stockref]').val()
    if( (stockref.length > 0) && (stockRefExists()) ){
      toastr.error("Stockref <strong>"+$('input[name=stockref]').val()+"</strong> already exists");
        $('input[name=stockref]').val("").trigger("focus");
    }
  })

  $('#add_product, #edit_product').on("submit",function(){
    if (stockRefExists()) {
      return false;
    }
  })

  $('select[name=category_id]').on("change",function(){
    toggleCompartments();
  })

  $(".allow_decimal").on("input", function (event) {
    $(this).val($(this).val().replace(/[^0-9\.]/g, ""));
    if ((event.which != 46 || $(this).val().indexOf(".") != -1) && (event.which < 48 || event.which > 57)) {
      event.preventDefault();
    }
  });

  $('.re-order').on("click",function(){
    let category_id = $('select[name=category_id]').val();
    if(category_id == ""){
      alertify.alert("Please select a category first");
      return;
    }
    window.location.href = base_url + "products/reorder?category_id=" + category_id;
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

  $('#autogenerate').on('click',function(){
    let state = $('#autogenerate').is(":checked");
    if(state){
      $('input[name=stockref]').attr("disabled",true);
      $('input[name=stockref]').attr("required",false);
      $('input[name=stockref]').removeClass("required");
      $('input[name=stockref]').val("Auto Generated");
      $('input[name=product_name]').focus();
    }else{
      $('input[name=stockref]').removeAttr("disabled");
      $('input[name=stockref]').removeAttr("required");
      $('input[name=stockref]').addClass("required");
      $('input[name=stockref]').val("");
      $('input[name=stockref]').focus();
    }
  })

  $('#activate-auto').on('click',function(){
    $('#autogenerate').trigger("click");
  })
});


var showPreview = function(event) {
   
    var filesAmount = event.target.files.length;
   
    if (event.target.files) {
        [].forEach.call(event.target.files, readAndPreview);
       
      }
   
    }

function readAndPreview(file) {
    var preview = document.querySelector('#preview');

  
    
    var reader = new FileReader();
    
    reader.addEventListener("load", function() {
      var image = new Image();
      image.title  = file.name;
      image.height = 200;
      image.src    = this.result;
      preview.appendChild(image);
    });
    
    reader.readAsDataURL(file);
}

function toggleCompartments()
{
  let term1 = 'bag';
  let term2 = 'backpack'
  let category = $('select[name=category_id] :selected').text().toLowerCase();
  if( (category.search(term1) > -1) || (category.search(term2) > -1) ){
    $('input[name=compartments]').parent().removeClass("hidden");
  }else{
    $('input[name=compartments]').parent().addClass("hidden");
  }
}

function stockRefExists()
{
  let valid;
  let stockref = $('input[name=stockref]').val()
  let id = $('input[name=id]').val()

  if(stockref.length == 0) {
    toastr.error("Stockref cannot be empty");
    return true;
  }
  
  $.ajax({
    url: base_url + "products/stockRefExists",
    method: "GET",
    dataType: "JSON",
    data: {stockref:stockref, id:id},
    async: false,
    success: function(response){
      valid = response.result;
    }
  })
  
  return valid;
}