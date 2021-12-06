<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!--link for css file -->
    <link rel="stylesheet"  href="admin.css">
</head>
<body>
<div class ="container">
<?php require_once 'db_utils.php';
require_once 'adminpage2.php';
connect_db();
    if(isset($_POST['submit']))
    {
        for($i=1;$i<=$n;$i++)
        {
            #si checkbox cochée
            if(isset($_POST['delete_'.$i]))
            {
               $res1= pg_query ($db_conn,"DELETE FROM w_gene.users WHERE email = '".$PK[$i]."'") or die( pg_last_error);
                if($res1)
                {
                    echo "<div class='done' style='color:red' > </span>";
                    echo "Succesfully done";
                }
            }
            #si rôle différent de role bd
            if($_POST['role_'.$i]!='empty')
            {
                $role = $_POST['role_'.$i];
                $res2= pg_query ($db_conn,"UPDATE w_gene.users SET role = '".$role."' WHERE email = '".$PK[$i]."'") or die(pg_last_error);
                if($res2)
                {
                    echo "<div class='done' style='color:red' > </span>";
                    echo "Succesfully done";
                } 
            }
            
        }
    }
header("Location: adminpage2.php");
disconnect_db();
?>
</div>
</body>
</html>

