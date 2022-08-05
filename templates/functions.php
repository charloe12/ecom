


<?php

function connect(){
   // 1- connexion vers la BD

$servername="localhost";
$DBuser="root";
$DBpassword="";
$DBname="ecommerce";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$DBname", $DBuser, $DBpassword);
    // set the PDO error mode to      exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  return $conn;
}



function getAllcategories(){

 
// 1- connexion vers la BD

$conn=connect();
// 2- creation de la requette
$requette="SELECT * FROM categories";
// 3-execution de la requette
$resultat=$conn->query($requette);
// 4- resultat de la requette 
$categories = $resultat->fetchAll();

// var_dump($categories)


return $categories;
}

function getAllproduct(){

    

// 1- connexion vers la BD
$conn=connect();
// 2- creation de la requette
$requette="SELECT * FROM produits";
// 3-execution de la requette
$resultat=$conn->query($requette);
// 4- resultat de la requette 
$produits= $resultat->fetchAll();

// var_dump($produits)


return $produits;

}


function searchProduits($keywords){
  
  $conn=connect();
  //2 - creation de la requette
  $requette = "SELECT * FROM categories where nom LIKE '%$keywords%' ";
  //3 - execution de la requette
  $resultat = $conn->query($requette);
  //4 - resultat
  $produits=$resultat->fetchAll();

  return $produits;
}


function getProduitByNom($nom){
  $conn = connect();
  //1-creation de la requette
  $requette="SELECT * FROM produits where categorie like '%$nom%'";
    //3 - execution de la requette
    $resultat = $conn->query($requette);
    //4 - resultat
    $produits=$resultat->fetchAll();
  
    return $produits;
}
function getProduitById($id){
  $conn = connect();
  //1-creation de la requette
  $requette="SELECT * FROM produits where id=$id";
    //3 - execution de la requette
    $resultat = $conn->query($requette);
    //4 - resultat
    $produits=$resultat->fetchAll();
  
    return $produits;
}




function AddVisteur($data){
 $conn =connect();
$mphash = md5($data['mp']);
$requette="INSERT INTO visiteurs(nom,prenom,email,mp,telephone) VALUES('".$data['nom']."','".$data['prenom']."','".$data['email']."','".$mphash."','".$data['telephone']."')";

$resultat=$conn->query($requette);

if($resultat){
  return true;
}else{
  return false;
}
}

function ConnectVisiteur($data){
  $conn = connect();
  $email = $data['email'];
  $mp = md5($data['mp']);
  $requette="SELECT * FROM visiteurs WHERE email='$email' AND mp='$mp'";

  $resultat =$conn->query($requette);

  $user=$resultat->fetch();
  return $user;
}

function ConnectAdmin($data){
  $conn = connect();
  $email = $data['email'];
  $mp = $data['mp'];
  $requette="SELECT * FROM administrateur WHERE email='$email' AND mp='$mp'";

  $resultat =$conn->query($requette);

  $user=$resultat->fetch();
  return $user;
}


function getAllUsers(){
  $conn = connect();
  $requette="SELECT * FROM visiteurs WHERE etat=0";
  $resultat =$conn->query($requette);
  $users = $resultat->fetchAll();
  return $users;
}




function getStocks(){
  $conn = connect();
  $requette="SELECT s.id,p.nom,s.quantite FROM produits p, stocks s WHERE p.id = s.produit";
$resultat=$conn->query($requette);
 $stocks=$resultat->fetchAll();
 return $stocks;
}

?>