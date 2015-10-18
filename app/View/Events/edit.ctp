<?php
$event = $event['Event'];

$root = $this->Html->link('Događaji', array('controller' => 'events', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Uređivanje' );

$this->assign('title', $event['name']);
$this->assign('page-title', $event['name'].' <small>izmjena događaja</small>');



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
echo $this->Html->script('/assets/plugins/ladda-bootstrap/dist/spin.min.js', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/ladda-bootstrap/dist/ladda.min.js', array('block' => 'scriptBottom'));

echo $this->Html->scriptBlock("$.fn.editable.defaults.pk = {$event['id']};", array('block'=>'scriptBottom'));
echo $this->Html->script('/js/event-edit', array('block' => 'scriptBottom'));



echo $this->Html->css('/assets/plugins/select2/select2', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/bootstrap-datetimepicker/css/datetimepicker', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/x-editable/css/bootstrap-editable', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/typeaheadjs/lib/typeahead.js-bootstrap', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/jquery-address/address', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2', array('block' => 'css'));
echo $this->Html->css('/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color', array('block' => 'css'));

?>
<div class="row">
    <div class="col-md-6"> 
        <table id="user" class="table table-bordered table-striped" style="clear: both">
            <tbody>
                <tr>
                    <td class="column-left">Naziv</td>
                    <td class="column-right">
                        <a href="#" id="name" data-type="text" data-title="Naziv događaja"><?php echo $event['name']; ?></a>
                    </td>
                </tr>
                <tr>
                    <td>Lid</td>
                    <td>
                        <a href="#" id="lid" data-type="text" data-original-title="Unesite lid"><?php echo $event['lid']; ?></a>
                    </td>
                </tr>
                <tr>
                    <td>Vrijeme početka</td>
                    <td>
                        <a href="#" id="start_time" data-type="datetime" data-original-title="Unesite novi datum"><?php echo $event['start_time']; ?></a>
                    </td>
                </tr>
                <tr>
                    <td>Vrijeme završetka</td>
                    <td>
                        <a href="#" id="end_time" data-type="datetime" data-original-title="Unesite novi datum"><?php echo $event['end_time']; ?></a>
                    </td>
                </tr>
                <tr>
                    <td>Detaljan info <a id="edit-html-text" href="#"><i class="fa fa-pencil"></i> [uredi]</a>
                        <br>
                        <span class="text-muted">Opis događaja
                            <br>
                            dešavanja, program, itd...</span></td>
                    <td>
                        <div data-original-title="Enter notes" data-toggle="manual" data-type="wysihtml5" id="html_text" class="editable" tabindex="-1" style="display: block;">
                            <?php echo $event['html_text']; ?>
                        </div></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">                                  



    </div>
</div>
