<!DOCTYPE html>
<style type="text/css">
    *{
        margin:0;
        padding:0;
        box-sizing: border-box;
    }
    body{
        background-color:darkmagenta;
        font-family: sans-serif;
    }
    .table-container{
        padding: 0 10%;
        margin: 40px auto 0;
    }
    .heading{
        font: size 40px;
        text-align: center;
        color:white;
        margin-bottom: 40px;
    }
    .table{
        width: 100%;
        border-collapse: collapse;
    }
    .table thead {
            background-color: white;
    }
    .table thead tr th {
        font-size: 14px;
        font-weight: medium;
        letter-spacing: 0.35px;
        color: black;
        opacity: 1;
        padding: 12px;
        vertical-align: top;
        border: 1px solid black;
    }
    .table tbody tr td{
        font-size: 14px;
        letter-spacing: 0.35;
        font-weight: normal;
        color:black;
        background-color:white;
        padding: 8px;
        text-align: center;
        border: 1px solid black; 

    }
    .table .text_open{
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 0.35px;
        color: cornflowerblue;
    }
    .table .tbody tr td .btn{
        width: 130px;
        text-decoration: none;
        line-height: 35px;
        display: block;
        background-color: #FF1046 ;
    }
</style>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
        <div class="table-container">
            <h1 class="heading"> Users List  </h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th> First Name </th>
                            <th> Family Name </th>
                            <th> Role </th>
                            <th> Email </th>
                            <th> Phone Number  </th>
                            <th> Date </th>
                            <th> Hour </th>
                            <th> Delete </th>
                            <th> Affect role</th>

                        </tr>
                    </thead>
                        <tr>
                            <td First-Name="First Name "> Weng </td>
                            <td Family-Name ="Family-Name">Lorraine</td>
                            <td Role ="Role "> Reader </td>
                            <td Email ="Email "> Weng.lorraine@gmail.com</td>
                            <td Phone Number ="Phone Number "> 0623562566 </td>
                            <td Date="Date ">02/12/2021</td>
                            <td Hour="Hour">12:55</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                        </tr>

                    
                    <tbody>
                </table><br> 
                <input type="button" value="Soumettre">
           
           <a href="ind.php" class ="button">logout</a>

        </div>
