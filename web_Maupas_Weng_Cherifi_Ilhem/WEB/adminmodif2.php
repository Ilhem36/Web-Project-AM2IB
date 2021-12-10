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
    error_reporting(0);
    if(isset($_POST['submit']))
    {
        for($i=0;$i<count($PK);$i++)
        {
            //if the box is checked, delete the user
            if(isset($_POST['delete_'.$i]))
            {
                try {
                    $res1= pg_query ($db_conn,"DELETE FROM w_gene.users WHERE email = '".$PK[$i]."'");
                    //If an user already annotated a sequence, he can't be suppressed
                    if(!$res1){
                        echo $PK[$i]." already annotated a sequence, he can't be suppressed";
                    }
                    if($res1)
                    {
                        echo "<div class='done' style='color:red' > </span>";
                        echo "Succesfully done";
                    }
                } catch(Exception $e){
                    echo "If an user already annotated a sequence, he can't be suppressed";
                }
                // }
            }
            //if a new role is indicated for an user, modify it in the database
            if(isset($_POST['role'][$i]) and $_POST['role'][$i] != 'empty')
            {
                $role = $_POST['role'][$i];
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