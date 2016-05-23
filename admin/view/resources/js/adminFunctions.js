// GET URL PARAM
function getterURL(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("?");
  for (var i=0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    if (pair[0] == variable) {
      return pair[1];
    }
  } 
  return variable;
}


// DELETE FUNCTION CANCEL
function cancelDelete() {
   $(".delete").remove();
}


// DELETE EXTRA INFO TO GET URL
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

// GET PAGE FILE NAME WITHOUT EXTENSION
function getPageName() {
  var result = "";
  var pageName = (function () {
    var a = window.location.href,
    b = a.lastIndexOf("/");
    return a.substr(b + 1);
  }());
  for (var i = 0; i < pageName.length; i++) {
      if(pageName[i] == ".") {
        i = pageName.length;
      } else {
        result = result + pageName[i];
      }
  }
  return result;
}