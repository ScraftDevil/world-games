$( document ).ready(function() {
    $("#login").click(login);
});


function login() {
    $.ajax({
        async:true,
        type: "POST",
        url:"../controller/adminAuthLoginController.php",
        data: 'username=' + $("#username").val() + '&password=' + $("#password").val(),
        beforeSend:Enviar,
        success:submit
    });
}

function Enviar() {
  var x=$("#message");
  x.html('<img src="img/ajax_wait.gif">');
}

function submit(data) {
    if (data.status) {
        window.location.replace("adminView.php");
    } else {
        $("#message").html("Login incorrecte!");
    }
}
