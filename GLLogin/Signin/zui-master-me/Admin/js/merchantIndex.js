/**
 * Created by Administrator on 2015/10/27.
 */

var hat="../frame/hat.html"; //加载
var head="../frame/head.html";
var middletitle="../frame/middletitle.html";
var mycontent="../content/P1S1.html";
$(document).ready(function(){
    //
    //afterPageLoad();
    //function divLoad(objdiv,url){
    //   objdiv.load(url,function(a,status,c){
    //        console.log(status);
    //        if(status=="error"){
    //            objdiv.text("判断加载失败");
    //        }
    //    });
    //}
    //divLoad($("#myhat"),hat);
    //divLoad($("#myhead"),head);
    //divLoad($("mymiddletitle"),middletitle);
    //divLoad($("mycontent"),mycontent);
    function hatLoad(){
        $("#myhat").load(hat,function(a,status,c){
            console.log(status);
            if(status=="error"){
                $("#myhat").text("判断加载失败");
            }
        });
    }
    function headLoad(){
        $("#myhead").load(head,function(a,status,c){
            console.log(status);
            if(status=="error"){
                $("#myhead").text("判断加载失败");
            }
        });
    }
    function middletitleLoad(){
        $("#mymiddletitle").load(middletitle,function(a,status,c){
            console.log(status);
            if(status=="error"){
                $("#mymiddletitle").text("判断加载失败");
            }
        });
    }
    function contentLoad(){
        $("#mycontent").load(mycontent,function(a,status,c){
            console.log(status);
            if(status=="error"){
                $("#mycontent").text("判断加载失败");
            }
        });
    }

    hatLoad();
    headLoad();
    middletitleLoad();
    contentLoad();
    menuStyle();



    function menuStyle(){                    //menu菜单样式
        $("ul.nav.nav-primary a").attr("draggable","false");
        var parentLi=$("li.nav-parent.show");
        function down(objLi){objLi.find("a i.icon-chevron-right.nav-parent-fold-icon").removeClass("icon-chevron-right,nav-parent-fold-icon").addClass("icon-rotate-90");}  //icon的图标变为向下
        down(parentLi);       //初始化：商户信息的icon

        //点击a
        $("a").on("click",function(){
            var objli=$(this).closest("li");

            //如果有子列表
            if(objli.hasClass("nav-parent")){
                //如果子列表已显示
                if(objli.hasClass("show")){
                    $(this).find("i.icon-rotate-90").addClass("icon-chevron-right,nav-parent-fold-icon").removeClass("icon-rotate-90");//icon的图标为向右
                    objli.removeClass("show");
                    $("li.active").removeClass("active");
                }
                //子列表未显示
                else{
                    down(objli);
                    objli.addClass("show");
                }
            }
            //点击的是没有子列表的li
            else{
                $("li.active").removeClass("active");
                objli.addClass("active");
            }
        })
    }


});
