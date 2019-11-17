function CalculateHeightForTab(){
	let height_safe = 450; 
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

function CalculateHeightTabs(){
	// let height_safe = 500; 
	// $('.base-container .col.s12').css({'min-height': $('.base-container').height() - $('.tabs').height()});


	let height_safe = 450; 
	$('.base-container .tabContent').css({'min-height': height_safe});
	if($('.body').height()<$(window).height())
	{
		let height_calc = 
			$(window).height()-
			$('.page-footer').height()-
			$('.nav-wrapper').height();

		$('.base-container .col.s12').css({'min-height': height_calc})
	}
}

function checkPaginationVisibility($this){

	if($this){
		if( $this.children('a').attr('href') == '#test-swipe-2' ){
			$('.pagination_home').removeClass('hide');
		}
		else {
			$('.pagination_home').addClass('hide');	
		}
	}
	else {
		if($('.tab.col.s3 .active').attr('href') == '#test-swipe-2'){
			$('.pagination_home').removeClass('hide');
		}
		else {
			$('.pagination_home').addClass('hide');	
		}	
	}
}

function rafAsync() {
    return new Promise(resolve => {
        requestAnimationFrame(resolve);
    });
}

function checkElement(selector) {
    if (document.querySelector(selector) === null) {
        return rafAsync().then(() => checkElement(selector));
    } else {
        return Promise.resolve(true);
    }
}


$(document).ready(function(){

	CalculateHeightTabs();
	checkPaginationVisibility();

	$(window).resize(function(){
		CalculateHeightTabs();
	})

	$('.tabs .tab').click(function(){
		checkPaginationVisibility($(this))

		checkElement('.tab a[href="#test-swipe-3"].active') //use whichever selector you want
		.then((element) => {
			CalculateHeightForTab()
		});
        
	})

});

