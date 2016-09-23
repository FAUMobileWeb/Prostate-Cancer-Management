$(document).ready(function() {
    var defaultPos = parseInt($('.NavItem').css("top"));
    var newPos = defaultPos + 6;

   $('.NavItem').hover(function() {
       $(this).stop(true);
       var dist = parseInt($(this).css("top")) - newPos;
       $(this).animate({top: "-=" + dist + "px"}, 300);
   }, function() {
       $(this).stop(true);
       var dist = parseInt($(this).css("top")) - defaultPos;
       $(this).animate({top: "-=" + dist + "px"}, 300);
   });
    
    var $current = $('.news');
    
    $('.news-item').click(function() {
        if ($current.index() != $('.news').index()) {
            $current.next().next().css("display", "none");
            $current.next().next().next().remove();
        }
        
        if ($current.index() != $(this).index()) {
            $(this).next().next().css("display", "inline-block");
            $(this).next().next().after("<br>");
            $current = $(this);
        } else {
            $current = $('.news');
        }
    });
});