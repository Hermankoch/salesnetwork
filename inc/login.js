function openLogin(){
    var login = document.getElementById('login');
    if (login.style.visibility == "hidden" || login.style.visibility == ""){
      login.style.visibility = "visible";
    } else if (login.style.visibility == "visible"){
      login.style.visibility = "hidden";
    }
}
function checkError(){
  if(document.getElementById('loginError') !== null){
    openLogin();
  }
}
if(window.addEventListener){
  window.addEventListener("load", checkError, false);
} else if (window.attachEvent){
  window.attachEvent("onload", checkError);
}
