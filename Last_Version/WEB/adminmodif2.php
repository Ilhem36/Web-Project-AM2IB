<!-- This page is dedicated for admin to manage users -->
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
<?php
require_once 'db_utils.php';
require_once 'adminpage2.php';
connect_db();
    if(isset($_POST['submit']))
    {
        for($i=1;$i<=$n;$i++)
        {
            //if the box is checked, delete the user
            if(isset($_POST['delete_'.$i]))
            {
                //If an user already annotated a sequence, he can't be suppressed
                $res0= pg_query ($db_conn,"SELECT COUNT(*) FROM w_gene.annotation WHERE email_annot = '".$PK[$i]."'") or die( pg_last_error());
                if($res0>0){
                    echo "If an user already annotated a sequence, he can't be suppressed";
                    print_r($res0);
                }
                else{
                    $res1= pg_query ($db_conn,"DELETE FROM w_gene.users WHERE email = '".$PK[$i]."'") or die( pg_last_error());
                    if($res1)
                    {
                        echo "<div class='done' style='color:red' > </span>";
                        echo "Succesfully done";
                    }
                }
            }
            //if a new role is indicated for an user, modify it in the database
            if($_POST['role_'.$i]!='empty')
            {
                $role = $_POST['role_'.$i];
                $res2= pg_query ($db_conn,"UPDATE w_gene.users SET role = '".$role."' WHERE email = '".$PK[$i]."'") or die(pg_last_error());
                if($res2)
                {
                    echo "<div class='done' style='color:red' > </span>";
                    echo "Succesfully done";
                } 
            }
            
        }
    }

disconnect_db();
?>
</div>
</body>
</html>

