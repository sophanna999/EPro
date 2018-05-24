$(function(){
	$(".select-type").on('change', function(e){
		var val = $(this).val();
		$('.residential').addClass("hidden");
		$('.business').addClass("hidden");
		$(val).removeClass("hidden");
	});
});