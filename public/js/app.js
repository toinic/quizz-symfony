(function(){


$(document).ready(function(){

  let pathname=window.location.pathname;
	$('.navbar-nav > li > a[href="'+pathname+'"]').parent().addClass('active');

})


})()
