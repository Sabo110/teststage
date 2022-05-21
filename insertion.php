<?php
    
    if(isset($_POST["envoyer"])){
        if(!empty($_POST["nom"]) and !empty($_POST["prenom"]) and !empty($_POST["email"]) and !empty($_POST["mdp"]) and !empty($_POST["sexe"]) and !empty($_POST["confirmation"]) and !empty($_POST["tab"])){
            $tab=$_POST["tab"];
            $ch=implode("-",$tab);
            $nom=htmlspecialchars($_POST["nom"]);
            $prenom=htmlspecialchars($_POST["prenom"]);
            $email=htmlspecialchars($_POST["email"]);
            $mdp=md5($_POST["mdp"]);
            $sexe=$_POST["sexe"];
            $confirmation=$_POST["confirmation"];
            include("connexionbd.php");
            $pdostat=$pdo->prepare("select * from information where email=?");
            $pdostat->bindparam(1,$email);
            $pdostat->execute();
            $res=$pdostat->rowcount();
            if($res==0){
                $pdostat=$pdo->prepare("insert into information values(?,?,?,?,?,?,?)");
                $pdostat->bindparam(1,$nom);
                $pdostat->bindparam(2,$prenom);
                $pdostat->bindparam(3,$email);
                $pdostat->bindparam(4,$mdp);
                $pdostat->bindparam(5,$sexe);
                $pdostat->bindparam(6,$confirmation);
                $pdostat->bindparam(7,$ch);
                $pdostat->execute();
                $rep="Enregistrer avec succè !!";
            }
            else{
                $rep="Ce compte existe déja !!";
            }
        }
        else{
            $rep="Veuillez remplir tous les champs et cocher les cases nécessaires !!";
            
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>insertion</title>
</head>
<body>
    <section>
        <form action="#" method="post" >
            <div class="row" style="margin-bottom: 10px;">
                <div class="col">
                    
                    <input style="width: 300px; " type="text" name="nom"  class="form-control" placeholder="entrer votre nom" autocomplete="off">
                </div>
                <div class="col">
                    
                    <input style="width: 300px;" type="text" name="prenom"  class="form-control" placeholder="entrer votre prenom" autocomplete="off">
                </div>
            </div>
            <div  class="row"  style="margin-bottom: 10px;">
                <div class="col">
                    
                    <input style="width: 300px; " type="email" name="email" class="form-control" placeholder="entrer votre email" autocomplete="off">
                </div>
                <div class="col">
                    
                    <input style="width: 300px;" type="password" name="mdp" class="form-control" placeholder="entrer votre mot de passe">
                </div>
            </div>
            <div class="divrbtn">
                <input type="radio" name="sexe" id="" class="form-check-input" value="M" >
                <label for="" >masculin</label>
                <input type="radio" name="sexe" id="" class="form-check-input" value="F">
                <label for="">feminin</label>
            </div>
            <label for="">langue parlée </label>
           <div class="form-check" style="margin-bottom: 10px; margin-top:10px;">
               <input type="checkbox" name="tab[]" class="form-check-input" value="francais" <?php if(@in_array("francais",$tab)){ echo "checked";} ?>>
               <label for="">français</label>
            </div>
           <div class="form-check" style="margin-bottom: 10px;">
                <input type="checkbox" name="tab[]"class="form-check-input" value="anglais" <?php if(@in_array("anglais",$tab)){ echo "checked";} ?>>
                <label for="">anglais</label>
           </div>
           <div class="form-check" style=" margin-bottom: 10px;">
                <input type="checkbox" name="tab[]"class="form-check-input" value="italien" <?php if(@in_array("italien",$tab)){ echo "checked";} ?>>
                 <label for="">italien</label>
           </div>
            <div class="form-check" style=" margin-bottom: 10px;">
                <input type="checkbox" name="confirmation" id="" class="form-check-input" value="condition acceptées">
                <label for="">accepter les conditions</label>
            </div>
            <button type="submit" name="envoyer"class="btn btn-primary btn-sm">Envoyer</button>
        </form>
        
    </section>
    <p>
    <?php
        if(!empty($rep)){
            echo $rep;
        }
    ?>
    </p>
</body>
</html>