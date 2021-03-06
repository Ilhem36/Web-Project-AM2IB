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
            <h1 class="heading">Genome for annotation </h1>
            <form action="Attribution.php" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Genome Name </th>
                            <th> Species </th>
                            <th> Strain </th>
                            <th> Annotator ID </th>

                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td Nom-genome="Nom-genome">Genome 1</td>
                                <td Nom-genome="Species">Species 1</td>
                                <td Nom-genome="Strain">strain 1</td>
                                <td><input type="text" name="AnnotID"></td>
                            </tr>
                            <tr>
                                <td Nom-genome="Nom-genome">Genome 2</td>
                                <td Nom-genome="Species">Species 2</td>
                                <td Nom-genome="Strain">strain 2</td>
                            </tr>
                    </tbody>
                </table><br> 
                <input type="submit" name = "Soumettre" value="Soumettre">
            </form>
        </div>
        <div class="table-container">
            <h1 class="heading"> Validation of annotators suggestions   </h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th> Genome name </th>
                            <th> Species </th>
                            <th> Strain </th>
                            <th> Annotator ID </th>
                            <th> Annotator name </th>
                            <th> Annotator  family name </th>
                            <th> Annotator  suggestions </th>
                            <th> Validation </th>
                            

                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td Nom-genome="Nom-genome">Genome 1</td>
                                <td Nom-genome="Species">Species 1</td>
                                <td Nom-genome="Strain">strain 1</td>
                                <td Nom-genome="Genome Name"> WL </td>
                                <td Nom-genome="Genome Name"> Weng </td>
                                <td Nom-genome="Genome Name"> Lorraine </td>
                                <td><input type="button" value ="Download"></td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <tr>
                                <td Nom-genome="Nom-genome">Genome 2</td>
                                <td Nom-genome="Species">Species 2</td>
                                <td Nom-genome="Strain">strain 2</td>
                                <td Nom-genome="Genome Name"> WL </td>
                                <td Nom-genome="Genome Name"> Weng </td>
                                <td Nom-genome="Genome Name"> Lorraine </td>
                                <td><input type="button" value ="Download"></td>
                                <td><input type="checkbox"></td>
                            </tr>
                    </tbody>
                </table><br> 
                <input type="button" value="Soumettre">

        </div>
</html>
