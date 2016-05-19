$(document).ready(load);

function load() {
    var data = {"group": deleteGetTrash(group), "id": id};
    getUser(data);
}

function getUser(data) {
   var user = JSON.stringify(data);
   $.ajax({
      data:  "data=" + user,
      url:   '../../controller/userControllers/getUserInfoController.php',
      type:  'POST',
      dataType: 'json',
      success: getUpdateUserProcess
  });
}

function getUpdateUserProcess(data) {
	$("#username").val(data.username);
	$("#password").val(data.password);
	$("#email").val(data.email);
	$("#bannedtime").val(data.bannedtime);
	$("#calendar").val(data.birthdate);
	$("#paypal").val(data.paypal);
	$("#country").val(country);
}

function deleteGetTrash(data) {
	var pos = 0;
	for (var i = 0; i < data.length; i++) {
		if (data[i] == "&") {
			pos = i;
			i = data.length;
		}
	}
	return data.substring(0, pos);
}