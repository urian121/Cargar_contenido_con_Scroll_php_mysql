<?php
sleep(1);
if(!empty($_POST["id_inmueble"])){
require 'dbConfig.php';

$lastID    = $_POST['id_inmueble'];
$showLimit = 10;  //Límite en la visualización de datos

//Consultando la Cantidad de Registros
$queryAll = ("SELECT COUNT(*) as num_rows FROM inmuebles WHERE id_inmueble < ".$lastID." ORDER BY id_inmueble DESC");
$rowAll = mysqli_query($con, $queryAll);
$DataAll  = mysqli_fetch_array($rowAll);
$allNumRows = $DataAll['num_rows'];


//Consultando los Registro deacuerdo al limite de Id
$queryRegist = ("SELECT * FROM inmuebles WHERE id_inmueble < ".$lastID." ORDER BY id_inmueble DESC LIMIT ".$showLimit);
$SqlRegist   = mysqli_query($con, $queryRegist);
$totalRegist = mysqli_num_rows($SqlRegist);

if($totalRegist> 0){
while($row = mysqli_fetch_array($SqlRegist)){
    $postID = $row["id_inmueble"]; ?>
<div class="list-item" style="border: 1px solid red;">
    <h4>
        <?php echo $row['tipo_inmueble']; ?>
    </h4>
</div>
<?php } ?>
<?php if($allNumRows > $showLimit){ ?>
    <div class="load-more" lastID="<?php echo $postID; ?>" style="display: none; border:1px solid yellow;">
        <img src="loading.gif"/>
    </div>
<?php }else{ ?>
    <div class="load-more" lastID="0" style="border: 1px solid crimson;">
        Ya no hay más Registros...
    </div>
<?php }
}else{ ?>
    <div class="load-more" lastID="0" style="border: 1px solid black;">
        That's Ally...!
    </div>
<?php
    }
}
?>