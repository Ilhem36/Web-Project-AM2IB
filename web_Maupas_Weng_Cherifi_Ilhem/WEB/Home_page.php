<!DOCTYPE html>
<!-- This page is the home page of the website-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> </title>
    <link rel="stylesheet" href="home_page.css">
   </head>
<body>
<!--For tha navigation bar -->
  <nav>
    <div class="nav-content">
      <div class="logo">
        <a href="Home_page.php">GenAnnot.</a>
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
    <p><h2> Welcome to GenAnnot ! </h2><br>
    <p>This web application was created by four students in Computational Biology (AMI2B), in Paris-Saclay University. GenAnnot is full of information about bacterial genomes, genes and proteins.
        <br>The aim of the website is to make functional annotations on genes and proteins. The new annotations will be validated or rejected before submitting them to the database. The database is <br>
        written in PostgreSQL. As an user you have the right to choose your role as a reader, validator or annotator :
        <br>
        <br> -  If you sign up as a reader, you can only search, read information about bacterial genomes, genes and protein. You can also check the annotation in the process of validation and download the<br>database data.<br>
        <br> -  However, if you sign up as an annotator or validator, you will be able to perform annotation and functional analysis on bacterial genome.<br>
        <br> -  Otherwise, if you choose a validator role you have the permission to validate or reject annotations. You are totally  free to choose the role you want.<br>
        <br> -  There is also the admin page for the GenAnnot Admin, where the admin can consult information about registered users and delete unwanted users. Nevertheless, the admin role can't be chosen <br>in the sign in form. <br>
        <br><br> <strong>/!\ Important information :</strong> If you already have an account, you can't re-register on the website. Only existing users in the website can check and search information in the GenAnnot database.
    </p>
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

