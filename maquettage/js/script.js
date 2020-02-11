$(window).scroll(function() {
  var scroll = $(window).scrollTop();
	$(".zoom").css({
		backgroundSize: (100 + scroll/5)  + "%",
		top: -(scroll/10)  + "%",

		//Blur suggestion from @janwagner: https://codepen.io/janwagner/ in comments
		//"-webkit-filter": "blur(" + (scroll/200) + "px)",
		//filter: "blur(" + (scroll/200) + "px)"
	});
});

let duration = 0.8;
let delay = 0.3;
let revealText = document.querySelector(".reveal");
let letters = revealText.textContent.split("");
revealText.textContent = "";
let middle = letters.filter(e => e !== " ").length / 2;
letters.forEach((letter, i) => {
  let span = document.createElement("span");
  span.textContent = letter;
  span.style.animationDelay = `${delay + Math.abs(i - middle) * 0.1}s`;
  revealText.append(span);
});
