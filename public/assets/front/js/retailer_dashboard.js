$(function(){
	$(".select-type").on('change', function(e){
		var val = $(this).val();
		$('.lowtension').addClass("hidden");
		$('.hightension').addClass("hidden");
		$(val).removeClass("hidden");
	});
});