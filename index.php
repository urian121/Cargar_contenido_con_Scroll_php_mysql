<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Scroll</title>
  <style>
#postList{ 
    margin-bottom:20px;
}
.list-item {
    background-color: #F1F1F1;
    margin: 5px 15px 2px;
    padding: 2px;
    font-size: 14px;
    line-height: 1.5;
    height: 120px;
}
.list-item h4 {
    color: #0074a2;
    margin-left: 10px;
}
.load-more {
    margin: 15px 25px;
    cursor: pointer;
    padding: 10px 0;
    text-align: center;
    font-weight:bold;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(window).scroll(function(){
        var lastID = $('.load-more').attr('lastID');
        if(($(window).scrollTop() == $(document).height() - $(window).height()) && (lastID != 0)){
            $.ajax({
                type:'POST',
                url:'getData.php',
                data:'id_inmueble='+lastID,
                beforeSend:function(){
                    $('.load-more').show();
                },
                success:function(html){
                    $('.load-more').remove();
                    $('#postList').append(html);
                }
            });
        }
    });
});
</script>
</head>
<body>

<div id="postList">
<?php
require 'dbConfig.php';

$sqlClientes = ("SELECT * FROM inmuebles  ORDER BY id_inmueble DESC LIMIT 10");
$mostarInmuebles = mysqli_query($con, $sqlClientes);
$totalClientes = mysqli_num_rows($mostarInmuebles);

if($totalClientes > 0){
    while($row = mysqli_fetch_array($mostarInmuebles)){
        $postID = $row["id_inmueble"];
?>
    <div class="list-item">
      <?php echo $row["codigo"]; ?></span>
      <h4><?php echo $row['tipo_inmueble']; ?></h4>
    </div>
<?php } ?>
    <div class="load-more" lastID="<?php echo $postID; ?>" style="display: none;">
        <img src="loading.gif"/>
    </div>
<?php } ?>
</div>

</body>
</html>