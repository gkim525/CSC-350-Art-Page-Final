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

function handleSubmit() {
  var selectedOption = document.getElementById("actionSelect").value;
  console.log("Selected Option:", selectedOption);
  if (selectedOption === "delete") {
    // Redirect to the new page for the delete action
    console.log("Redirecting to delete.php...");
    window.location.href = "http://localhost/art_page/delete.html";
    return false;
  } else if (selectedOption === "updateEmail") {
    // Redirect to the new page for the email update 
    window.location.href = "http://localhost/art_page/emailupdate.html";
    return false; // Prevent the form from submitting
  } else if (selectedOption === "updatePass") {
    // Redirect to the new page for the password update
    window.location.href = "http://localhost/art_page/passupdate.html";
    return false; // Prevent the form from submitting
  }	
 return true;
}