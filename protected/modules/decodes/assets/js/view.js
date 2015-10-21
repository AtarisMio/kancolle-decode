$(document).ready(function(){
	$(".collapsible-toggle").on('click', function(){
		$(".collapsible-content", $(this).parent()).toggle();
	});
});