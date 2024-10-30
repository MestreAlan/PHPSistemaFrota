$(function(){
	$("a[data-toggle], button[data-toggle]").on("click", function(e) {
		var selector = $(this).data("toggle");
		if ($(selector).css('display') != 'block') {
			$('form').hide();
		}
		$(selector).animate({height: "toggle", opacity: "toggle"}, "slow");
	});
});