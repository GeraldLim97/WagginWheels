<?php include "alertLevels.php"; ?>
<link rel="stylesheet" href="styles/alerts.css">
<?php $alertLevel =  $alertLevel??0?>
<?php if ($alertLevel !=0){ ?>
    <div class="<?php echo Alert::key($alertLevel); ?>">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong><?php echo Alert::key($alertLevel); ?></strong>: <?php echo $alertMsg; ?>
    </div>
<?php } ?>