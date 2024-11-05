$(function() {
    $('#contact-form').submit(function(e){
        e.preventDefault(); 
        $('.comment').empty();
        var postdata = $('#contact-form').serialize();

        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            datatype: 'json',
            success: function(result) {

                if(result.isSuccess){
                    $("#contact-form").append("<p>votre message a bien été envoyé. Merci de nous avoir contacté :) </p>");
                    $("#contact-form")[0].reset();
                }
                else{
                    $("#firstname + .comments").html(result.firstnameError);
                    $("#name + .comments").html(result.nameError);
                    $("#email + .comments").html(result.emailError);
                    $("#phone + .comments").html(result.phoneError);
                    $("#message + .comments").html(result.messageError);
                }
            }
        })
    })
})