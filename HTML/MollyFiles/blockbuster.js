const moviebutton = document.getElementById('moviebutton');
const lnbtn = document.getElementById('logbutton');
const spbtn = document.getElementById('signupbutton');
var eml = document.getElementById('email');
var pass = document.getElementById('password');
var cpass = document.getElementById('cpassword');
var inputname = document.getElementById('name')

/*Home Page*/

if(moviebutton) {
moviebutton.addEventListener('click', function() {
    window.location.href = "silence-of-the-lambs-movie.html";
});
}

/*Login Page*/

if(lnbtn){
lnbtn.addEventListener('click', function() {

    if (eml.value == "") {
        alert("Please enter an email.");
    } else if (pass.value == "") {
        alert("Please enter a password.");
    } else if (eml.value.toLowerCase() != "admin@bbv.com") {
        alert("Email or Password is incorrect. Try again.");
    } else if (pass.value != "12345") {
        alert("Email or Password is incorrect. Try again.");
    } else {
        alert("Welcome to Blockbuster video!");
        window.location.href = "home-page.html";
    }

});
}

/*Signup Page*/

if(spbtn){
spbtn.addEventListener('click', function() {

    if (inputname.value == "" || eml.value == "" || pass.value == "") {
        alert("Please verify all fields are filled.");
    } else if (eml.value.toLowerCase() == "admin@bbv.com") {
        alert("Email is already in use. Please login or use a different email.");
    } else if (pass.value.length < 8) {
        alert("Password must be 8 characters long. Please try again.");
    } else if (pass.value != cpass.value) {
        alert("Passwords must match. Please try again.");    
    } else {
        alert("Welcome to Blockbuster video " + inputname.value + "!");
        window.location.href = "home-page.html";
    }

});
}
