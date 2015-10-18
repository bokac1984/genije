<?php
$root = $this->Html->link('Lokacije', array('controller' => 'locations', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Pregled galerije' );

$this->assign('title', 'Lokacije');
$this->assign('page-title', 'Lokacije <small>pregled galerije lokacije</small>');

echo $this->Html->script('/assets/plugins/dropzone/downloads/dropzone.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modal', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/colorbox/jquery.colorbox-min', array('block' => 'scriptBottom'));
echo $this->Html->script('/lightbox/js/lightbox', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/gallery', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("LocationGallery.init(".$id.");", array('block'=>'scriptBottom'));

echo $this->Html->css('/assets/plugins/dropzone/downloads/css/dropzone', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/colorbox/example2/colorbox', array('block' => 'css'));
echo $this->Html->css('/lightbox/css/lightbox', array('block' => 'css'));
?>
<div class="row">
    <div class="col-sm-12">							
        <button type="button" id="btn-add-photos" class="btn btn-primary btn-sm">
            Dodaj nove slike
        </button>
        <button type="button" onclick="window.location.href = '/locations/edit/<?php echo $id; ?>'" class="btn btn-success btn-sm">
            Izmjeni lokaciju
        </button>
    </div>
</div>
<div class="separator">
    <br />
</div>
<div class="row">
    <?php foreach ($images as $currentImage) : ?>
        <div class="col-md-3 col-sm-4 gallery-img">
            <div class="wrap-image <?php if ($mainImage == $currentImage['LocationImage']['img_name']) echo 'selected'; ?>">
                <a data-lightbox="galerija" class="group1" href="/photos/<?php echo $currentImage['LocationImage']['img_name']; ?>" pk="<?php echo $currentImage['LocationImage']['fk_id_map_objects']; ?>" title="<?php echo $currentImage['LocationImage']['text']; ?>" data-id="<?php echo $currentImage['LocationImage']['id']; ?>" data-jpg="<?php echo $currentImage['LocationImage']['img_name']; ?>">
                    <img src="/photos/<?php echo $currentImage['LocationImage']['img_name']; ?>" 
                         alt="" 
                         class="img-responsive <?php if ($mainImage == $currentImage['LocationImage']['img_name']) echo 'selected'; ?>"
                         >
                </a>
                <div class="chkbox"></div>
                <div class="tools tools-left">
<!--                    <a href="#">
                        <i class="clip-link-4"></i>
                    </a>
                    <a href="#">
                        <i class="clip-pencil-3 "></i>
                    </a>-->
                    <a class="photo-remove" data-id="<?php echo $currentImage['LocationImage']['id']; ?>" data-jpg="<?php echo $currentImage['LocationImage']['img_name']; ?>" data-name="<?php echo $currentImage['LocationImage']['img_name']; ?>" href="#">
                        <i class="clip-remove"></i>
                    </a>
                </div>
            </div>
        </div> 
    <?php endforeach; ?>   
</div>
<!-- DIALOG -->
<div id="ajax-modal" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false" style="display: none;">
   <div class="modal-body" style="margin-bottom:0">
       <form action="/locations/uploadPhotos" class="dropzone" method="post" id="my-awesome-dropzone">
           <input name="idLocation" type="hidden" value="<?php echo $id ?>">
       </form>
   </div>
   <div class="modal-footer" style="margin-top:0">       
       <button id="btn-dialog-dismiss" class="btn btn-primary" data-dismiss="modal">
           U redu
       </button>
   </div>
</div>
<!-- DIALOG -->
<div id="dialog-delete-image" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none; margin-top: -61.5px;" aria-hidden="true">
    <div class="modal-body">
        <p>
            Da li želite obrisati ovu fotografiju?
        </p>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">
            Odustani
        </button>
        <button id="dialogDeleteFoto" type="button" data-dismiss="modal" class="btn btn-primary">
            Obriši
        </button>
    </div>
</div>