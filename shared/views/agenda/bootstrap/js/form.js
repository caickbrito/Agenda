$(function (){
    $("a.delete").click(function (e){
        e.preventDefault();
        var data = $(this).data()
        var div = $(this).closest(".contact");


        $.ajax({
            url: data.action,
            data: data,
            type: "post",
            dataType: "json",
            success: function (su){
                if (su.message)
                {
                    var view = '<div class="alert alert-' + su.message.type + '">' + su.message.message + '</div>';
                    $("#message").fadeIn(300).html(view);
                    div.fadeOut(400)
                    $("#message").fadeOut(1100);
                }
            }
        })
    })
})