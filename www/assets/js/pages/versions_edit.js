jQuery(function(){
    $('#remove_brochure').on('click',function(){
        $(this).closest(".row").find('.col-md-12').removeClass("hidden");
        $(this).parent().remove();
    })
    $('#download_brochure').on('click',function(){
        let filename = $(this).data("filename");
        window.location.href = front_url + "uploads/brochures/" + filename;
    })
    $('body').on('click', '.edit-block', function () {
        let pageID = $('input[name=id]').val();
        let pageBlockID = $(this).closest('.block-group').find('.page_block_id').val();
        //window.location.href = 
        let url = base_url + 'versions/blockcontent/' + pageBlockID;
        // let win = window.open(url, 'Edit Content', 'height=500,width=1000,menubar=no,toolbar=no,location=no');
        window.open(url, '_blank');
  
    })
})
