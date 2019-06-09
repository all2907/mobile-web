$('document').ready(function() {

  $('.slideshow').each(function(){
    $('.slideshow').height($('.slideshow').width()/3);
  });
  $('.centerVertical').each(function(){
    $(this).css("margin-top", $(this).parent().height()/2 - $(this).height()/2);
  });
  $('.centerHorizontal').each(function(){
    $(this).css("margin-left", $(this).parent().width()/2 - $(this).width()/2);
  });

  $('.widthRect').each(function(){
    $(this).css("width", $(this).height());
  });

  $('.heightRect').each(function(){
    $(this).css("height", $(this).width());
  });

  $('.heightParent').each(function(){
    $(this).css("height", $(this).parent().width());
  });

  $('.widthParent').each(function(){
    $(this).css("width", $(this).parent().height());
  });

  $('.layout-img-icon').each(function(){
    $(this).hover(
      function(){
        console.log($(this).children());
        $(this).children().fadeIn();
      },
      function(){
        $(this).children().fadeOut();
      }
    );
  });



  $('.centerVerticalWindow').each(function(){
    $(this).css("margin-top", $(window).height()/2 - $(this).height()/2);
  });

  $('.centerHorizontalWindow').each(function(){
    $(this).css("margin-left", $(window).width()/2 - $(this).width()/2);
  });

  $('.content-main').each(function(){
    $(this).height($(window).height());
  });
  $('.map-container').each(function(){
    $(this).height($(window).height());
  });

});
