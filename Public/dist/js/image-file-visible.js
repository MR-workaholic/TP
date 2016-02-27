/**
 * Created by Administrator on 2015/12/31.
 */
//图片显示插件
(function($) {
    $.imageFileVisible = function(options) {
        // 默认选项
        var defaults = {
//包裹图片的元素
            wrapSelector: null,
//<input type=file />元素
            fileSelector:  null ,
            width : '100%',
            height: 'auto',
            errorMessage: "不是图片"
        };
        // Extend our default options with those provided.
         opts = $.extend(defaults, options);
        $(opts.fileSelector).on("change",function(){
            //alert($(this).attr("id"));
            var file = this.files[0];
            var imageType = /image.*/;
            if (file.type.match(imageType)) {
                var reader = new FileReader();
                reader.onload = function(){
                    var img = new Image();
                    img.src = reader.result;
                    $(img).width( opts.width);
                    $(img).height( opts.height);

                    //赖晓青改（2015、12、31）
                    $(opts.wrapSelector).empty();

                    $( opts.wrapSelector ).append(img);
                    alert($( opts.wrapSelector).children("img").length);
                };
                reader.readAsDataURL(file);
            }else{
                alert(opts.errorMessage);
            }
        });
    };
})(jQuery);
