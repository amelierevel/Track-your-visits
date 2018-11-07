<?php 
include_once 'classes/path.php';
include_once path::getRootPath() . 'header.php'; 
include_once path::getControllersPath() . 'addPlaceCtrl.php' 
?>
<div>
    <h2 class="center-align">Ajout d'un nouveau site touristique</h2>
    <div class="row">
        <form action="#" method="POST" class="col s12" id="addPlace">
            
        </form>
    </div>
</div>
<?php include_once path::getRootPath() . 'footer.php'; ?>    