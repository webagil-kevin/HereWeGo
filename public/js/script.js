$(window).scroll(function() {
  var scroll = $(window).scrollTop();
	$(".zoom").css({
		backgroundSize: (100 + scroll/5)  + "%",
		top: -(scroll/10)  + "%"
	});
});
