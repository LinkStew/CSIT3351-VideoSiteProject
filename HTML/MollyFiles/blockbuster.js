const moviebutton = document.getElementById('moviebutton');
const lnbtn = document.getElementById('logbutton');
const spbtn = document.getElementById('signupbutton');
const rentBtn = document.getElementById('rentBtn');
const btn1 = document.getElementById('btn1');
const btn2 = document.getElementById('btn2');
const gridA = document.getElementById('gridA');
const gridB = document.getElementById('gridB');
const imagePreview = document.getElementById('image-preview');
const videoPreview = document.getElementById('video-preview');

var eml = document.getElementById('email');
var pass = document.getElementById('password');
var cpass = document.getElementById('cpassword');
var inputname = document.getElementById('name');

const deleteMovChk = document.getElementById('deleteMovChk');
const deleteMovBtn = document.getElementById('deleteMovBtn');
const addMovChk = document.getElementById('addMovChk');
const addMovBtn = document.getElementById('addMovBtn');

var movieAdd = document.getElementById('movieAdd');
var movieDelete = document.getElementById('movieDelete');
var movieDropdown = document.getElementById('movieDropdown');
var movImageUpload = document.getElementById('movImageUpload');
var genereDropdown = document.getElementById('genereDropdown'); 
var movSummary = document.getElementById('movSummary');
var movYear = document.getElementById('movYear');
var movDirector = document.getElementById('movDirector');
var movCast = document.getElementById('movCast'); 
var movRating = document.getElementById('movRating');
var movLang = document.getElementById('movLang');
var movVideoUpload = document.getElementById('movVideoUpload');

/* Home Page Navigation */
if (moviebutton) {
    moviebutton.addEventListener('click', function() {
        window.location.href = "silence-of-the-lambs-movie.html";
    });
}

/* Login Validation */
if (lnbtn) {
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

/* Signup Validation */
if (spbtn) {
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

/* Movie Page Navigation */
if (rentBtn) {
    rentBtn.addEventListener('click', function() {
        window.location.href = "Form.html";
    });
}

/* Admin Panel Grid Toggling */
if (btn1) {
    btn1.addEventListener('click', function() {
        gridA.style.display = 'grid';
        gridB.style.display = 'none';
    });
}

if (btn2) {
    btn2.addEventListener('click', function() {
        gridB.style.display = 'grid';
        gridA.style.display = 'none';
    });
}

/* Image Media Preview */
if (movImageUpload) {
    movImageUpload.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
        }
    });
}

/* Video Media Preview */
if (movVideoUpload) {
    movVideoUpload.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            videoPreview.src = URL.createObjectURL(file);
            videoPreview.style.display = 'block';
            videoPreview.load();
        }
    });
}

/* Admin Form - Add Movie Validation */
if (addMovBtn) {
    addMovBtn.addEventListener('click', function() {
        if (movieAdd.value.trim() === "") {
            alert("Please enter a movie title.");
        } else if (movImageUpload.files.length === 0) {
            alert("Please upload a movie poster.");
        } else if (genereDropdown.value === "" || genereDropdown.value === "NULL") {
            alert("Please select a genre.");
        } else if (movSummary.value.trim() === "") {
            alert("Please add a movie Summary.");
        } else if (movYear.value.trim() === "") {
            alert("Please add a movie release year.");
        } else if (movDirector.value.trim() === "") {
            alert("Please add a director.");
        } else if (movCast.value.trim() === "") {
            alert("Please add the cast.");
        } else if (movRating.value.trim() === "") {
            alert("Please add the content rating.");
        } else if (movLang.value.trim() === "") {
            alert("Please add the movie language.");
        } else if (movVideoUpload.value.trim() === "" || movVideoUpload.value === "0") {
            alert("Please upload the movie trailer.");
        } else if (!addMovChk.checked) {
            alert("Please verify that all information is correct, then check the box.");
        } else {
            alert(movieAdd.value + " has been added.");
            window.location.href = "Admin-home.html";
        }
    });
}

/* Admin Form - Remove Movie Validation */
if (deleteMovBtn) {
    deleteMovBtn.addEventListener('click', function() {
        if (movieDropdown.value === "NULL" || movieDropdown.value === "") {
            alert("Please select a movie to remove.");
        } else if (!deleteMovChk.checked) {
            alert("Please confirm you want to delete this movie by checking the verification box.");
        } else {
            const selectedMovieText = movieDropdown.options[movieDropdown.selectedIndex].text;
            alert(selectedMovieText + " has been removed.");
            window.location.href = "Admin-home.html";
        }
    });
}
