
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Sticky Navigation Bar | CodingLab </title>
    <link rel="stylesheet" href="home_page.css">
   </head>
<body>
<!-- pour la barre de navigation (home) -->
  <nav>
    <div class="nav-content">
      <div class="logo">
        <a href="#">GenAnnot.</a>
      </div>
      <ul class="nav-links">
        <li><a href="Home_page.php">Home</a></li>
        <li><a href="signup.php">Sign Up</a></li>
        <li><a href="signIn.php">Sign In</a></li>
      </ul>
    </div>
  </nav>
  <section class="home"></section>
  <div class="text">
    <p><h2>Welcome to GenAnnot ! </h2>
    <p>This web application was  created by four students in Computational Biology. GenAnnot is full of  information about bacterial genes. As a user you have the right to choose your role as a reader, validator or annotator.If you sign up as a reader, you can only search and read information about bacterial genome&gene. However, if you sign up as an annotator or validator, you will be able to  perform annotation and functional analysis on bacterial genome. Otherwise, if you choose a validator role you have the permission to validate or reject annotations. You are totally  free to choose the role you want.   </p>
    <br><p></p>
  </div>
<!--Javascript for the logo transition-->
  <script>
let nav = document.querySelector("nav");
    window.onscroll = function() {
        if(document.documentElement.scrollTop > 20){
            nav.classList.add("sticky");
        }else {
            nav.classList.remove("sticky");
        }
    }
  </script>

</body>
</html>

