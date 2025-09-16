jQuery(function(){

    tableSort('#vehicle_lines','lines','id','display_order');

	Search('searchText','vehicle_lines');
  
    // $('#query').on('click', function () {
	// 	$(this).addClass('btn-info').removeClass('btn-default');
	// 	$('#form').removeClass('btn-info').addClass('btn-default');
	// 	$('#form').removeClass('active');
	// 	$('#query-block').removeClass("hidden");
	// 	$('#form-block').addClass("hidden");
	// })

	// $('#form').on('click', function () {
	// 	$(this).addClass('btn-info').removeClass('btn-default');
	// 	$('#query').removeClass('btn-info').addClass('btn-default');
	// 	$('#query').removeClass('active');
	// 	$('#form-block').removeClass("hidden");
	// 	$('#query-block').addClass("hidden");
	// })

	// $('body').on('click', '.add-image', function () {
	// 	//clone the button and removes it
	// 	let btn = $(this).closest('.col-sm-12').clone();
	// 	$(this).closest('.col-sm-12').remove();

	// 	//clone the proto and append it
	// 	let block = $('.protoimage').clone().removeClass('hidden protoimage');
	// 	$('.image-container').append(block)

	// 	//append the cloned button
	// 	$('.image-container').append(btn)
	// })

	// $('body').on('click', '.delete-image', function () {
	// 	let blockID = $(this).closest('.image-group').data('line_image_id');
	// 				let obj = $(this);
	// 				$(obj).closest('.image-group').remove();
	// 				let deletedBlocksJSON = $('input[name=deletedImages]').val();
	// 				let deletedBlocks = JSON.parse(deletedBlocksJSON);
	// 				deletedBlocks.push(blockID);
	// 				$('input[name=deletedImages]').val(JSON.stringify(deletedBlocks));
	// })

	// $('body').on('click', '.add-colors', function () {
	// 	//clone the button and removes it
	// 	let btn = $(this).closest('.col-sm-12').clone();
	// 	$(this).closest('.col-sm-12').remove();

	// 	//clone the proto and append it
	// 	let block = $('.protocolor').clone().removeClass('hidden protocolor');
	// 	$('.colors-container').append(block)

	// 	//append the cloned button
	// 	$('.colors-container').append(btn)
	// })

	// $('body').on('click', '.delete-colors', function () {
	// 	let blockID = $(this).closest('.colors-group').data('line-color-id');
	// 				let obj = $(this);
	// 				$(obj).closest('.colors-group').remove();
	// 				let deletedBlocksJSON = $('input[name=deletedColors]').val();
	// 				let deletedBlocks = JSON.parse(deletedBlocksJSON);
	// 				deletedBlocks.push(blockID);
	// 				$('input[name=deletedColors]').val(JSON.stringify(deletedBlocks));
	// })

})
