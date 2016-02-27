$(document).ready(function(){
    $("#my_logintab").find("li:last").css({"border-left":"1px solid #CCCCCC","border-bottom":"1px solid #ccc"});
    $("#my_logintab").find("li:last").hover(function(){$(this).addClass("hover")},function(){$(this).removeClass("hover")});
    $("#form_forum").hide();
    $("#my_logintab").find("li:first").click(function(){
        $("#form_forum").hide();
        $("#form_name").show();
        $(this).next().css({"border-left":"1px solid #CCCCCC","border-bottom":"1px solid #ccc"});
        $(this).css("border","1px solid white");
        //$(this).next().removeClass("white");
        $(this).next().hover(function(){$(this).removeClass("white").addClass("hover")},function(){$(this).removeClass("hover")});
        $(this).off("mouseenter mouseleave");
        $(this).addClass("white");
    });
    $("#my_logintab").find("li:last").click(function(){
        $("#form_forum").show();
        $("#form_name").hide();
        $(this).prev().css({"border-right":"1px solid #CCCCCC","border-bottom":"1px solid #ccc"});
        $(this).css("border","1px solid white");
        //$(this).prev().removeClass("white");
        $(this).prev().hover(function(){$(this).removeClass("white").addClass("hover")},function(){$(this).removeClass("hover")});
        $(this).off("mouseenter mouseleave");
        $(this).addClass("white");
    });
});
