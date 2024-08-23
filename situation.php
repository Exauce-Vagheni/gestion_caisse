<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
body{
    font-family:arial;
}
input{
    font-size:20px;
    margin:5px;
}
form{
    margin-top:70px;
}
#btn{
    background-color:green;
    padding:5px;
    border-radius:50px;
    font-size:15px;
    cursor:pointer;
}
ul li{
    list-style-type:none;
    display:inline-block;
    color:white;
}
li a{
    color:white;
    text-decoration:none;
    padding-right:10px;
}
td{
    padding:5px;

}
table{
    width:65%;

}
</style>
<body>
<div  style="background-color:green;padding:2px;top:0;margin-left:10px;color:white;">
<h2 style="margin:4px;display:inline-block;">E-CAISSE</h2>
<div style="display:inline-block;">
<nav>
    <ul>
    <li><a href="situation.php">Situation</a></li>
    <li><a href="entrees.php">Entrees</a></li>
    <li><a href="sorties.php">Sorties</a></li>
    <li><a href="index.php">Deconnexion</a></li>
    </ul>
    </nav>
</div>
</div>
    <div>
    <form action="" method="POST">
        <div align="center">
        <h3>Situation de la caisse</h3>
        <table border="1">
            <tr id="entete">
                <td>Montant total</td>
                <td>Total entrees</td>
                <td>Total sorties</td>
            </tr>
            <tr>
            <?php 
            include("connexion.php");
           
            $select=$con->query("SELECT montant_total FROM situation");
            while($resultat=$select->fetch()){

              
                echo "<td>".$resultat['montant_total']."</td>";

            }
            $select=$con->query("SELECT sum(montant) as somme_entree FROM approvisionnements");
            while($resultat=$select->fetch()){

             
                echo "<td>".$resultat['somme_entree']."</td>";
                

            }
            $select=$con->query("SELECT sum(montant) as somme_sortie FROM depenses");
            while($resultat=$select->fetch()){

             
                echo "<td>".$resultat['somme_sortie']."</td>";
                

            }
        ?>
        </tr>
        </table>
       
</body>
</html>