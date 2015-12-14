<?php
$root = $this->Html->link('Vijesti', array('controller' => 'news', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Pregled galerije' );

$this->assign('title', 'Vijesti');
$this->assign('page-title', $news['News']['title'] . ' <small>pregled galerije vijesti</small>');

$this->assign('breadcrumb-icon', $icon);

$id = $news['News']['id'];

echo $this->Html->script('/assets/plugins/dropzone/downloads/dropzone.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modal', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/colorbox/jquery.colorbox-min', array('block' => 'scriptBottom'));
echo $this->Html->script('/lightbox/js/lightbox', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/news/images', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("NewsImages.init(".$id.");", array('block'=>'scriptBottom'));

echo $this->Html->css('/assets/plugins/dropzone/downloads/css/dropzone', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-modal/css/bootstrap-modal', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/colorbox/example2/colorbox', array('block' => 'css'));
echo $this->Html->css('/lightbox/css/lightbox', array('block' => 'css'));

//debug($news);
$mainImage = $news['News']['fk_id_gallery'];
?>
<style type="text/css">
    .wrap-image img {
        max-height: 150px;
        min-height: 150px;
        min-width: auto;
    }
</style>
<div class="row">
    <div class="col-sm-12">							
        <button type="button" id="btn-add-photos" class="btn btn-primary btn-sm">
            Dodaj nove slike
        </button>
        <button type="button" onclick="window.location.href = '/news/edit/<?php echo $id; ?>'" class="btn btn-success btn-sm">
            Izmjeni vijest
        </button>
    </div>
</div>
<div class="separator">
    <br />
</div>
<div class="row">
    <?php if (count($images) > 0): ?>
    <?php foreach ($images as $currentImage) : ?>
    <?php 
        $file = WWW_ROOT . "/photos/news/" . $currentImage['Gallery']['img_name'];
        if (file_exists($file)): ?>
        <div class="col-md-2 col-sm-3 gallery-img">
            <div class="wrap-image <?php if ($mainImage == $currentImage['Gallery']['id']) echo 'selected'; ?>">
                <a data-lightbox="galerija" class="group1" href="/photos/news/<?php echo $currentImage['Gallery']['img_name']; ?>" pk="<?php echo $currentImage['Gallery']['id']; ?>" title="<?php echo $currentImage['Gallery']['text']; ?>" data-id="<?php echo $currentImage['Gallery']['id']; ?>" data-jpg="<?php echo $currentImage['Gallery']['img_name']; ?>">
                    <img src="/photos/news/<?php echo $currentImage['Gallery']['img_name']; ?>" 
                         alt="" 
                         class="img-responsive <?php if ($mainImage == $currentImage['Gallery']['id']) echo 'selected'; ?>"
                         style="max-height: 150px;">
                </a>
                <div class="chkbox"></div>
                <div class="tools tools-left">
                    <a class="photo-remove" data-id="<?php echo $currentImage['Gallery']['id']; ?>" data-jpg="<?php echo $currentImage['Gallery']['img_name']; ?>" data-name="<?php echo $currentImage['Gallery']['img_name']; ?>" href="#">
                        <i class="clip-remove"></i>
                    </a>
                </div>
            </div>
        </div> 
    <?php endif; ?>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="col-md-12 col-sm-12 gallery-img">
        <h3>Nema fotografija za ovu vijest. Molimo dodajte nove fotografije.</h3>
    </div>
    <?php endif; ?>
</div>
<!-- DIALOG -->
<div id="ajax-modal" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false" style="display: none;">
   <div class="modal-body" style="margin-bottom:0">
       <form action="/news/uploadPhotos" class="dropzone" method="post" id="my-awesome-dropzone">
           <input name="idNews" type="hidden" value="<?php echo $id ?>">
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