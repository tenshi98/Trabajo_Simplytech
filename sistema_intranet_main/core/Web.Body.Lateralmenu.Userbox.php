<div class="media user-media">
    <div class="user-media-toggleHover">
        <span class="fa fa-user"></span> 
    </div>
    <div class="user-wrapper">
        <a class="user-link" href="principal_datos.php">
        <?php if ($_SESSION['usuario']['basic_data']['Direccion_img']=='') { ?>
        	<img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/usr.png">
        <?php }else{  ?>
        	<img class="media-object img-thumbnail user-img" alt="User Picture" src="upload/<?php echo $_SESSION['usuario']['basic_data']['Direccion_img']; ?>">
        <?php }?>      
        </a> 
        <div class="media-body">
            <h5 class="media-heading"><?php echo $_SESSION['usuario']['basic_data']['Nombre'] ?></h5>
            <ul class="list-unstyled user-info">
                <li> <a href="principal_datos.php"><?php echo $_SESSION['usuario']['basic_data']['Usuario_Tipo'] ?></a></li>
            </ul>
      </div>
  </div>
</div>
