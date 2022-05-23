$(document).ready(function(){
	const IMG_WIDTH = 175;
	var slideContainer = $('#slides-book');
	var slideImages = slideContainer.children().length;
	var rong = slideImages * 200;
	slideContainer.css("width", rong+"px");
	slideContainer.css("height", "245px");
	console.log(slideImages);

	var index = 0;

	function next(){
		if(index < slideImages-1)
			index++;
		else
			index = 0;

		var temp = -((IMG_WIDTH*index) + index);
		console.log(temp);
		slideContainer.css("transform", "translateX("+temp+"px)");
	}

	setInterval(next, 3000);

	function clsAnimation(){
		$('#phan-sildebarrr').removeClass('animate__animated');
		$('#phan-sildebarrr').removeClass('animate__rotateInDownLeft');
		$('#phan-sildebarrr').removeClass('animate__delay-2s');
	}
})