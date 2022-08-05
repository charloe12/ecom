<?php 
include 'templates/functions.php';

if(isset($_GET['id'])){
// lorsque nous appuyons sur le bouton afficher
// echo $_POST['search'];
 $product =getProduitById($_GET['id']);
 #print_r ($product);
}else{
  header('location: ../com/home.php');
}
?>
<?php include 'templates/header.php'?>

<div id='order_table'>
 
  
</div>


<section class="all">
  <?php
  print '<div class="image0">
    <img class="image" src="img/'.$product[0]['image'].'"></img>
  </div>
  <div class="all0">
    <div class="titre">
      <h2>'.$product[0]['nom'].'</h2>
    <h5>ref '.$product[0]['id'].'</h3></div>  
    <aside class="infos">
    
    <div class="livraison"> Livraison à domicile(Maroc) Gratuite sur Agadir</div>
    <div class="paiement"> Paiement sécurisé au choix</div>
    
    <div class="qnt">
        <h6>  QANTITE: </h6>
      
    <form>
        <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
        <input type="number"  name="quantity" id="quantity'.$product[0]['id'].'" class="number form-control" value="1"/>
        <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
</form>


    </div>
    <h1>'.$product[0]['prix'].' DHs</h1>
    
<input type="hidden" name="hidden_name" id="name'.$product[0]['id'].'"
value="'.$product[0]['nom'].'"/>
<input type="hidden" name="hidden_price" id="price'.$product[0]['id'].'" value="'.$product[0]['prix'].'"/>
<input type="hidden" name="hidden_image" id="image'.$product[0]['id'].'" value="'.$product[0]['image'].'"/>
<input type="button" name="cart" id="'.$product[0]['id'].'" class="cart" value="Add To Cart"/>
  

  </aside>
  </div>';
  ?>


</section>
<script >
  $(document).ready(function(data){
    $('.cart').click(function(){
      var product_id=$(this).attr('id');
      var product_name=$('#name'+product_id).val();
      var product_price=$('#price'+product_id).val();
      var product_quantity=$('#quantity'+product_id).val();
      var action='add';
      console.log('click true');
      if(product_quantity>0){
        console.log('if true');
        $.ajax({
          url:'cart.php',
          method:'POST',
          dataType:'json',
          data:{
            product_id:product_id,
            product_name:product_name,
            product_price:product_price,
            product_quantity:product_quantity,
      
            action:action
          },
          success:function(data){
            $('.badge').text(data.cart_items);
            $('#order_table').html(data.order_table);
            alert('add');
          }
        })
      }else{
        alert('qntt');
      }
    })
  });
</script>




















<style type="text/css">
  body{
    background-color:   #F8F8F8;
  }
  .all0, .image0{
    background-color: white;
  }
  .butt{
    margin: 40px;
    width: 80%;
    height: 50px;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    
  }
  .butt > div{
    cursor: pointer;
    color: white;
    font-size: 100%;
    width: 40%;
    height: 95%;
    font-family: monospace;
    padding: 0px 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    background-color: #1e718e!important;
  }
  aside{

    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;

    flex-direction: column;
  }
  .all0{
    padding: 20px;
    display: flex;
    align-items: center;
    flex-direction: column;


    width: 45%;
   
   
    margin: 0% 5%;


  }
  .livraison{
    padding: 5px;
    background-color: #F0F0F0;
    margin: 10px 0px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 8px;
   
   
  }
  .paiement{
    padding: 5px;
    width: 100%;
    background-color: #F0F0F0;
    margin: 10px 0px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 8px;
   
  }
  .titre{
    width: 100%;
    
    left: 0px;
  }
  .titre {
    font-family: 'Poppins', sans-serif;
  }
  .titre > h5{
    color: #666;
  }
  
  form {
    display: flex;
    flex-direction: row;


  }
  .value-button{
    width: 40px;
    background-color: #D8D8D8;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  input.number {
  text-align: center;
  border: none;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  margin: 0px;
  width: 40px;
  height: 40px;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
  form #decrease {
    cursor: pointer;
  margin-right: -4px;
  border-radius: 8px 0 0 8px;
}

form #increase {
  cursor: pointer;

  border-radius: 0 8px 8px 0;
}
  .qnt{
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    margin: 20px;
 
 
  }
    .qnt > h6{
  
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    margin-right: 10px;
    margin-top: 10px;
 
  }  
  .infos > h1{
  
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    margin-top: 30px;
    
 
  }
  .all{
    margin: 20px 40px;
    display: flex;
    flex-direction: row;
    padding: 10px;
  
 
  }
  .image0{
   
    display: flex;
   align-items: center;
    justify-content: center;
   
    
  }
  .image0 , .all0{
    box-shadow: 0 4px 20px -10px gray;
     border-radius: 20px;
  }
   .image{
    width:70%;
    height:80%;
  }
  @media (orientation: portrait) {
    .all{

    flex-direction: column;
    justify-content: center;
    align-items: center;
 
  }
  .image{
    width: 100%;
  }
  .all0{
    margin-top: 20px;
    width: 100%;
    padding: 20px;
  }
  }
  
  
</style>
<script type="text/javascript">
  function increaseValue() {
  var value = parseInt(document.querySelector('.number').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.querySelector('.number').value = value;
}

function decreaseValue() {
  var value = parseInt(document.querySelector('.number').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  document.querySelector('.number').value = value;
}
</script>




<?php include 'templates/footer.php'?>

