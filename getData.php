<?php
sleep(1);
if(!empty($_POST["id_inmueble"])){
require 'dbConfig.php';

$lastID    = $_POST['id_inmueble'];
$showLimit = 50;  //Límite en la visualización de datos


$queryAll   = $db->query("SELECT COUNT(*) as num_rows FROM inmuebles WHERE id_inmueble < ".$lastID." ORDER BY id_inmueble DESC");
$rowAll     = $queryAll->fetch_assoc();
$allNumRows = $rowAll['num_rows'];

$query      = $db->query("SELECT * FROM inmuebles WHERE id_inmueble < ".$lastID." ORDER BY id_inmueble DESC LIMIT ".$showLimit);

if($query->num_rows > 0){
$a =1;    
while($row = $query->fetch_assoc()){ 
    $postID = $row["id_inmueble"]; ?>
<div class="list-item" style="border: 1px solid red;">
    <span><?php echo $a++; ?><br>
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
        That's Allx..!
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