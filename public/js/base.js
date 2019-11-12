$(document).ready(function(){

	$(".dropdown-trigger").dropdown();

	CalculateHeight();

	$(window).resize(function(){
		CalculateHeight();
	})
});

function CalculateHeight(){
	let height_safe = 300; 
	$('.base-container').css({'min-height': height_safe});
	if($('.body').height()<$(window).height())
	{
		let height_calc = 
			$(window).height()-
			$('.page-footer').height()-
			$('.nav-wrapper').height();

		$('.base-container').css({'min-height': height_calc})
	}
}