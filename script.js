//JAVASRIPT for singIN button and
//JavaScript for button onclick  
  /* When the user clicks on the button, 
  toggle between hiding and showing the dropdown content */

  // Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
if (!event.target.matches('.dropbtn')) {
  var dropdowns = document.getElementsByClassName("dropdown-content");
  var i;
  for (i = 0; i < dropdowns.length; i++) {
     var openDropdown = dropdowns[i];
       if (openDropdown.classList.contains('show')) {
         openDropdown.classList.remove('show');
      }
    }
  }
}  
function dropDownButton() {
  document.getElementById("myDropdown").classList.toggle("show");
}


document.addEventListener('DOMContentLoaded', function(){
let signupBtn = document.getElementById("signupBtn");
let signinBtn = document.getElementById("signinBtn");
let firstnameField = document.getElementById("firstnameField");
let lastnameField = document.getElementById("lastnameField");
let title = document.getElementById("title");

signinBtn.onclick = function () {
  firstnameField.style.maxHeight = "0px";
  lastnameField.style.maxHeight = "0px";
  title.innerHTML = "Sign In";
}
signupBtn.onclick = function () {
  firstnameField.style.maxHeight = "65px";
  lastnameField.style.maxHeight = "65px";
  title.innerHTML = "Sign Up";
} 
});
