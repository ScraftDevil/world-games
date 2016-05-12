$( document ).ready(function() {
    $("#login").click(login);
});


function login() {
    $.ajax({
        async:true,
        url:"../controller/adminAuthLoginController.php",
        data: {username: $("#username").val(), password: $("#password").val() },
        type: "POST",
        dataType: 'json',
        success: submit
    });
}

function submit(data) {
    if (data.status == 1) {
        $(location).attr("href", "adminView.php");
    } else {
        $("#message").html("Login incorrecte!");
    }
}
