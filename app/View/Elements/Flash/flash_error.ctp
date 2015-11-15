<?php
// Flash element
?>
<div class="alert alert-warning alert-warning-shadow" onclick="$(this).fadeOut();return false;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Upozorenje!</strong> <?php echo $message; ?>
</div>