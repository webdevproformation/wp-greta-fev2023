(function($){
    $(".card-header").on("click", function(e){
        $.ajax({
            url : $(this).data("ajaxurl") ,
            method : "POST",
            data : {
                "action" : "toto", // le suffixe du hook wp_ajax_
                "article" : [$(this).data("id"), $(this).text().trim()]
            },
            success : function(msg){
                console.log("success" , JSON.parse(msg));
            },
            error : function(ex){
                console.log("error" , ex);
            },
        })
    })
})(jQuery)