<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="signin.css">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <div> 
  <nav>
    <div class="menu">
                   <ul id='MenuItems'>
                       <li><a href="admin.html">Administrator</a></li>
                       <li><a href="AnnotValid.html" target="_blank">Annotator/Validator</a></li>
                       
                       </li>
                   </ul>
               </nav>
    </div>
  </div>
    <div class="title"> Choose your output file: </div><br>
    <form  action="genomeform.html" method="post" >
      <select name="filetype">
      <option value="Genome">Genome</option>
      <option value="Geneprot">Geneprot</option>
      </select>
     <input type="submit" value="envoyer" name="envoyer"> <br>
</body>
</html>
