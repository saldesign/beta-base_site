//Menu Icon Switch

$(document).ready(function() {
  $('body').addClass('js');
  var $menulink = $('.menu-link'),
  $mainnav = $('.main-nav'),
  $searchlink = $('.search-link'),
  $searchinput = $('.searchinput');
  

  $menulink.click(function() {
   $(this).toggleClass('active');
   $searchinput.toggleClass('active');
   $mainnav.toggleClass('active');
   if($(this).hasClass('active')){
    	$(this).removeClass('icon-menu').addClass('icon-cancel')
	  }else{
	    $(this).removeClass('icon-cancel').addClass('icon-menu');			
	  }
	  return false;
	});//End menulink.click

  $searchlink.click(function(){
  	$(this).toggleClass('active');
  	$searchinput.toggleClass('active');
  	return false;
  });

  // Show or hide the sticky back to top button
  $(window).scroll(function() {
      if ($(this).scrollTop() > 200) {
        $('.go-top').fadeIn(200);
      } else {
        $('.go-top').fadeOut(200);
      }
    });
    
    // Animate the scroll to top
    $('.go-top').click(function(event) {
      event.preventDefault();
      
      $('html, body').animate({scrollTop: 0}, 300);
    })



      $('a[href^="#"]').on('click',function (e) {
          e.preventDefault();

          var target = this.hash;
          var $target = $(target);

          $('html, body').stop().animate({
               'scrollTop': $target.offset().top
          }, 900, 'swing');
      });





});//End document.ready 
