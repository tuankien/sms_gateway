var formCreator={
    buildSideBar:function(id) {
        jQuery(document).ready(function($) {
            var $slideBar = $("#"+id+" >li");
            var $slideBarItems = $slideBar.children("a");

            // init
            $(".group-info").hide();
            $(".show").show();

            $slideBarItems.each(function(i) {
                var $currObj = $(this);
                if($currObj.attr('rel')!=""){
                    $currObj.click(function() {
                        if(($currObj.attr("href") != "#") && (!$currObj.hasClass("loaded"))) {
                            $.ajax({
                               type: "GET",
                               url: $currObj.attr("href"),
                               data: 'ajax=1',
                               success: function(res){
                                 $currObj.addClass('loaded');
                                 $("#"+$currObj.attr('rel')).html(res);

                               }
                             });
                        }
                        $slideBar.children("a").removeClass('active');
                        $(".group-info").hide();
                        $currObj.addClass('active');
                        $("#"+$currObj.attr('rel')).show();
                        return false;
                    });
                }
            });

            // display default item            
            if($slideBar.children('a.active').attr('name') == null){
                var $default = $slideBar.children("a:eq(0)");
                $default.addClass("active");
                $($default.attr('rel')).show();
            }else{
                $($('a.active').attr('rel')).show();
            }
        });
    }
}