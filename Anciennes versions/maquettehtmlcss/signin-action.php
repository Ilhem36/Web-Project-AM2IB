<!DOCTYPE html>
<?php
session_start();
require_once 'db_utils.php';
?>
    <html lang="fr">
<?php
connect_db();
if (isset($_POST['submit'])) {
    $username=$_POST["email"];
    $password=$_POST["Password"];
    $sql_Query = "SELECT * FROM w_gene.users WHERE email='.{$username}.' and Password='.{$password}.'";
    $result_query=pg_query($db_conn,$sql_Query);
    while ($row=pg_fetch_assoc($result_query)){
        echo $row['email'];
        $_SESSION['email']=$row['email'];
        $_SESSION['role']=$row['role'];
    }
    $time_conn=time();
    $date_conn=date("m-d-Y H:i:s",$time_conn);
    $update_date_conn="UPDATE w_gene.users SET date= '".$date_conn."' WHERE email='".$_POST["email"]."'";
    $result_udc=pg_query($db_conn,$sql_Query);
    //Check the role of users:
    if(pg_num_rows($result_query!=0)) {
        if ($_SESSION['role'] == 'annotator') {
            header('Location= annot_menu.php');
        } else if ($_SESSION['role'] == 'validator') {
            header('Location= Valid_Menu.php');
        } else if ($_SESSION['role'] == 'Reader') {
            header('Location= Reader_Menu.php');
        }
    }else{
        header('Location : Admin_Menu.php');

    }
}
disconnect_db();

?>