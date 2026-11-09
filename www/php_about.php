<?php 
require "php_connection.php"; 
$result = $conn->query("SELECT movieID, title, movieImg, trailer FROM Movie ORDER BY title");
require "php_navbar.php"
?>

    <div class="aboutus">
        <h1>Blockbuster</h1>
        <h3>About Us</h3>
        <p>
            Blockbuster or Blockbuster Video is an American multimedia brand 
            which was founded by David Cook in 1985 as a single home video 
            rental shop, but later became a public store chain featuring video 
            game rentals, DVD-by-mail, streaming, video on demand, and cinema 
            theater. The company expanded internationally throughout the 1990s. 
            At its peak in 2004, Blockbuster employed 84,300 people worldwide and 
            operated 9,094 stores. <a href="https://en.wikipedia.org/wiki/Blockbuster_(retailer)">Source</a>
        </p> 
        <h3>Our Socials</h3>
        <p>
            There are no Blockbuster socials as the company went out of business January 2014.
        </p>

        
    </div>

<?php require "php_footer.php"; ?>