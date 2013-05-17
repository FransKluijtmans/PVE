$('#buttonStateful').click(function() {
    var btn = $(this);
    btn.button('loading'); // call the loading function
    setTimeout(function() {
        btn.button('reset'); // call the reset function
    }, 3000);
});

//open deatils of the activiteiten overview page
$('.detailsGrid a').click(function() {
	$(this).parent().parent().next('.tableDetailRow').toggleClass("activeDisplay");
});

//fix on top sidebar when scroll
$(document).ready(function() {  
 // check where the nav element is  
 var offset = $('.peevee').offset();  
  
 $(window).scroll(function () {  
   var scrollTop = $(window).scrollTop(); // check the visible top of the browser  
  
    if (offset.top<scrollTop){ 
    	//get parent outerwidth px
		//$(this).outerWidth();
		$('.peevee').addClass('fixed').css('width', ($('.sub-content').outerWidth() - 26));  
	}else{ $('.peevee').removeClass('fixed').css('width', '100%'); }
  });  
});