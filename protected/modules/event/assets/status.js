$(document).ready(function(){
	$.ajax({
		type: 'GET',
		dataType: 'jsonp',
		url:'http://203.104.209.39/kcs/resources/swf/commonAssets.swf',
		success: function(data, textStatus, request){
			alert(request.getResponseHeader('Last-Modified'));
		}
	});
  
});