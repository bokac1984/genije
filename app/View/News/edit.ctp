<?php
$news = $news['News'];

$root = $this->Html->link('Vijesti', array('controller' => 'news', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Uređivanje' );

$this->assign('title', $news['title']);
$this->assign('page-title', $news['title'].' <small>izmjena vijesti</small>');

$this->assign('breadcrumb-icon', $icon);

echo $this->Html->script('/assets/plugins/jquery-mockjax/jquery.mockjax', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/moment/moment', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/select2/select2.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/x-editable/js/bootstrap-editable.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/typeaheadjs/typeaheadjs', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/jquery-address/address', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/wysihtml5/wysihtml5', array('block' => 'scriptBottom'));
echo $this->Html->script('/lightbox/js/lightbox', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/ladda-bootstrap/dist/spin.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/ladda-bootstrap/dist/ladda.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/bootstrap-switch/static/js/bootstrap-switch', array('block' => 'scriptBottom'));

echo $this->Html->scriptBlock("$.fn.editable.defaults.pk = {$news['id']};", array('block'=>'scriptBottom'));
echo $this->Html->script('/js/news/news-edit', array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/select2/select2', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-datetimepicker/css/datetimepicker', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/x-editable/css/bootstrap-editable', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/typeaheadjs/lib/typeahead.js-bootstrap', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/jquery-address/address', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch', array('block' => 'css'));
echo $this->Html->css('/lightbox/css/lightbox', array('block' => 'css'));

?>
<div class="row">
    <div class="col-md-6"> 
        <table id="user" class="table table-bordered table-striped" style="clear: both">
            <tbody>
                <tr>
                    <td class="column-left">Naziv</td>
                    <td class="column-right">
                        <a href="#" id="title" data-type="text" data-title="Naziv događaja"><?php echo $news['title']; ?></a>
                    </td>
                </tr>
                <tr>
                    <td>Lid</td>
                    <td>
                        <a href="#" id="lid" data-type="text" data-original-title="Unesite lid"><?php echo $news['lid']; ?></a>
                    </td>
                </tr>
                <tr>
                    <td>Prikaži proizvode</td>
                    <td>
                        <div class="switch" data-pk="<?php echo $news['id']; ?>" data-on-label="Da" data-off-label="Ne" data-on="success" data-off="danger">
                            <input type="checkbox" id="show_products" name="data[News][show_products]" 
                                <?php echo $news['show_products'] ? "checked" : "" ?>>
                        </div>                    
                    </td>
                </tr>                
                <tr>
                    <td>Tekst vijesti <a id="edit-html-text" href="#"><i class="fa fa-pencil"></i> [uredi]</a>
                        <br>
                        <span class="text-muted">Sadržaj teksta:
                            <br>
                            tekst o proizvodima, lokacijam itd.</span></td>
                    <td>
                        <div data-original-title="Enter notes" data-toggle="manual" data-type="wysihtml5" id="text" class="editable" tabindex="-1" style="display: block;">
                            <?php echo $news['text']; ?>
                        </div></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">   
        <div class="row">
        <?php if ($image): ?>
            <div class="col-md-12">
                <h4>Glavna fotografija vijesti</h4>
            </div>
            <div class="col-md-12">
                <div class="thumbnail" style="max-width: 200px; margin-bottom:0px;">
                    <a data-lightbox="galerija" class="group1" href="/photos/news/<?php echo $image['Gallery']['img_name']; ?>">
                        <img src="/photos/news/<?php echo $image['Gallery']['img_name']; ?>" alt="" class="img-responsive">
                    </a>
                </div> 
            </div>
            <div class="col-md-12">
                <?php echo $this->Html->link('Uredite fotografije', array(
                    'controller' => 'news',
                    'action' => 'images',
                    $news['id']
                ), array('class' => 'btn btn-teal ladda-button', 'style' => 'margin-top: 20px;'));
                ?>
            </div>
        <?php else: ?>
            <div class="col-md-12"> 
            <?php echo $this->Html->link('Dodajte nove fotografije', array(
                'controller' => 'news',
                'action' => 'images',
                $news['id']
            ), array('class' => 'btn btn-green btn-lg btn-block'));
            ?>
            </div>
        <?php endif; ?>
        </div>

    </div>
</div>
