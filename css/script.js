$(document).ready(function() {
//Add class js and set variables
  $('body').addClass('js');
  var $menulink = $('.menu-link'),
  $mainnav = $('.main-nav');
  
//Menu Click Icon Switch
  $menulink.click(function() {
   $(this).toggleClass('active');
   $mainnav.toggleClass('active');
   if($(this).hasClass('active')){
    	$(this).removeClass('icon-menu').addClass('icon-cancel')
	  }else{
	    $(this).removeClass('icon-cancel').addClass('icon-menu');			
	  }
	  return false;
	});//End menulink.click


//Ratings
  //Star Click
  $(":radio").click(function() { 
      //get the value of the category they clicked
      var rating = this.value;      
      var climb_id = $(this).data("id");        
      //create an ajax request to display.php
      $.ajax({   
          type: "GET",
          url: "rate-parse.php",  
          data: { 'rating': rating, 'climb_id' : climb_id },   
          dataType: "html",   //expect html to be returned
        success: function(response){
          $("#display-area").html(response);
          }
      });
  });
   //do stuff during and after ajax is loading (like visual feedback)
  $(document).on({
      ajaxStart: function() { $("#display-area").addClass("loading");    },
      ajaxStop: function() { $("#display-area").removeClass("loading"); } 
  });






/*
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

*/



});//End document.ready 
