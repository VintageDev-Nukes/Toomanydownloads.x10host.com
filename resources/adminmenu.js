$('#adminmenu').prepend('<div id="indicatorContainer"><div id="pIndicator"><div id="cIndicator"></div></div></div>');
    var activeElement = $('#adminmenu>ul>li:first');

    $('#adminmenu>ul>li').each(function() {
        if ($(this).hasClass('active')) {
            activeElement = $(this);
        }
    });


  var posLeft = activeElement.position().left;
  var elementWidth = activeElement.width();
  posLeft = posLeft + elementWidth/2 -6;
  if (activeElement.hasClass('has-sub')) {
    posLeft -= 6;
  }

  $('#adminmenu #pIndicator').css('left', posLeft);
  var element, leftPos, indicator = $('#adminmenu pIndicator');
  
  $("#adminmenu>ul>li").hover(function() {
        element = $(this);
        var w = element.width();
        if ($(this).hasClass('has-sub'))
        {
          leftPos = element.position().left + w/2 - 12;
        }
        else {
          leftPos = element.position().left + w/2 - 6;
        }

        $('#adminmenu #pIndicator').css('left', leftPos);
    }
    , function() {
      $('#adminmenu #pIndicator').css('left', posLeft);
    });


  $('#adminmenu>ul>.has-sub>ul').append('<div class="submenuArrow"></div>');
  $('#adminmenu>ul').children('.has-sub').each(function() {
    var posLeftArrow = $(this).width();
    posLeftArrow /= 2;
    posLeftArrow -= 12;
    $(this).find('.submenuArrow').css('left', posLeftArrow);

  });

  $('#adminmenu>ul').prepend('<li id="menu-button"><a>Menu</a></li>');
  $( "#menu-button" ).click(function(){
        if ($(this).parent().hasClass('open')) {
          $(this).parent().removeClass('open');
        }
        else {
          $(this).parent().addClass('open');
        }
      });