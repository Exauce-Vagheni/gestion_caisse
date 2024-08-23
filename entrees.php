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
    color:white;
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
        <h3>Approvisionnements de la caisse</h3>
        <?php 
            include("connexion.php");
            if(isset($_GET['id'])){
                $annuler=$con->prepare("DELETE FROM approvisionnements WHERE id=?");
                $annuler->execute(array($_GET['id']));
                $annuler=$con->prepare("UPDATE situation SET montant_total=montant_total-?");
                $annuler->execute(array($_GET['montant']));
                echo"
                <script>
                alert('Opéraion d'approvisionnement annulé!');
                </script>
                ";}
                ?>
         <?php 
            include("connexion.php");
            if(isset($_POST['montant']) AND isset($_POST['libelle'])){
                $ajout=$con->prepare("INSERT INTO approvisionnements(montant,operation,date) VALUES(?,?,NOW())");
                $ajout->execute(array($_POST['montant'],$_POST['libelle']));
                $ajout=$con->prepare("UPDATE situation SET montant_total=montant_total+?");
                $ajout->execute(array($_POST['montant']));
                echo"
                <script>
                alert('Montant ajouté avec succès!');
                </script>
                ";
            }
        ?>
       <div> 
       <label for="">Montant à ajouter</label><br>
        <input type="number" name="montant" min="1"><br>
       </div>
       <div> 
       <label for="">Libellé de l'opération</label><br>
        <input type="text" name="libelle"><br>
       </div><br>
       <div>
       </div>
       
        <input type="submit" value="Ajouter en caisse" id="btn">
        </div>
        
        <div align="center">
        <h3>Details des approvisionnements</h3>
        <table border="1">
            <tr id="entete">
                <td>Numero id</td>
                <td>Montant</td>
                <td>Libellé de l'opération</td>
                <td>Date</td>
                <td>Opération</td>
            </tr>
            <tr>
            <?php 
            include("connexion.php");
           
            $select=$con->query("SELECT * FROM approvisionnements");
            while($resultat=$select->fetch()){

                echo "<tr>";
                echo "<td>".$resultat['id']."</td>";
                echo "<td>".$resultat['montant']."</td>";
                echo "<td>".$resultat['operation']."</td>";
                echo "<td>".$resultat['date']."</td>";
                echo "<td><a href='entrees.php?id=".$resultat['id']."&montant=".$resultat['montant']."'>Annuler</a></td>";
                echo "<tr>";

            }
          
        ?>
        </tr>
        </table>
       
</body>
</html>