/**
 * Created by Administrator on 2015/10/16.
 */

$(document).ready(function(){
    var tab=$("#my_signin_tab");
    $("#my_signin_tel").show();
    $("#my_signin_mail").hide();
    $("#my_signin_pic").hide();
    tab.find("li:first").addClass("tab_clicked");
    tab.find("li:nth-child(2)").addClass("tab_unclicked");
    tab.find("li:nth-child(3)").addClass("tab_unclicked");

    tab.find("li:first").click(function () {
        $("#my_signin_tel").show();
        $("#my_signin_mail").hide();
        $("#my_signin_pic").hide();
        $(this).removeClass("tab_unclicked").addClass("tab_clicked");
        $(this).next().removeClass("tab_clicked").addClass("tab_unclicked");
        $(this).next().next().removeClass("tab_clicked").addClass("tab_unclicked");
        //$(this).next().next().next().removeClass("liborder");
    });
    tab.find("li:nth-child(2)").click(function (){
        $("#my_signin_tel").hide();
        $("#my_signin_mail").show();
        $("#my_signin_pic").hide();
        $(this).removeClass("tab_unclicked").addClass("tab_clicked");
        $(this).prev().removeClass("tab_clicked").addClass("tab_unclicked").css("border-left", "white");
        $(this).next().removeClass("tab_clicked").addClass("tab_unclicked").css("border-left", "white");
        //$(this).next().addClass("liborder");
    });
    tab.find("li:nth-child(3)").click(function(){
        $("#my_signin_mail").hide();
        $("#my_signin_tel").hide();
        $("#my_signin_pic").show();
        $(this).removeClass("tab_unclicked").addClass("tab_clicked");
        $(this).prev().removeClass("tab_clicked").addClass("tab_unclicked").css("border-left", "white");
        $(this).prev().prev().removeClass("tab_clicked").addClass("tab_unclicked").css("border-left", "white");
    })
});

