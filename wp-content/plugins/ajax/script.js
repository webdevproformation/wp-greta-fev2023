(function($){
    $(".card-header").on("click", function(e){
        $.ajax({
            url : $(this).data("ajaxurl") ,
            method : "POST",
            data : {
                "action" : "add", // le suffixe du hook wp_ajax_
                "article" : [$(this).data("id"), $(this).text().trim()]
            },
            success : function(msg){
                console.log("success" , JSON.parse(msg));
            },
            error : function(ex){
                console.log("error" , ex);
            }
        })
    })

    $(".vider").on("click" , function(){
        $.ajax({
            url : $(this).data("ajaxurl") ,
            data : {
                "action" : "empty"
            },
            success : function(msg){
                console.log("success" , JSON.parse(msg));
            },
            error : function(ex){
                console.log("error" , ex);
            }
        })
    })
})(jQuery)