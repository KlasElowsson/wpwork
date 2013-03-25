jQuery(document).ready(function($){
	$(".hider a").click(function(){
		$("#metaHide").slideToggle('slow');
		$(this).text($(this).text() == unescape('Show %u2193') ? unescape('Hide %u2191') : unescape('Show %u2193'));
		return false;
	});
});