jQuery(function(){

    tableSort('#versions','versions','id','display_order');
 
    Search('searchText','versions');
 
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
      let url = base_url + 'versions/blockcontent/' + pageBlockID;
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
          orders.push($(this).find('.block_order').val());
          console.log(orders);
      }
  })
  return Math.max.apply(Math,orders)+10;
}