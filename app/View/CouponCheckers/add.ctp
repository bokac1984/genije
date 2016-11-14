<?php
$root = $this->Html->link('Ponistavanje kodova', array('controller' => 'coupon_checkers', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Dodavanje korisnika');

$this->assign('title', 'Ponistavaci');
$this->assign('page-title', 'Ponistavaci <small>dodavanje korisnika</small>');
//debug($eventsTickets);

echo $this->Html->script('/assets/plugins/select2/select2.min.js', array('block' => 'scriptBottom'));

echo $this->Html->css('/assets/plugins/select2/select2.css', array('block' => 'css'));

echo $this->Html->script('/js/checkers/new', array('block' => 'scriptBottom'));

echo $this->Html->scriptBlock("FormValidator.init();", array('block' => 'scriptBottom'));
?>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <?php 
                echo $this->Form->create('CouponChecker'); 
                $this->Form->inputDefaults(array(
                        'error' => array(
                            'attributes' => array(
                                'wrap' => 'span',
                                'class' => 'help-block'
                            )
                        ),

                    )
                );
                ?>
                <fieldset>
                    <?php
                    echo $this->Form->input('username', array(
                        'label' => 'Korisničko ime',
                        'class' => 'form-control',
                        'before' => '<div class="form-group">',
                        'after' => '</div>',
                        'required' => 'required',
                        'div' => 'form-group ' . ($this->Form->isFieldError('username') ? 'has-error' : '')
                    ));
                    ?>

            </div>
        </div>
        <?php if ($loggedInUser === '1'): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="control-label">
                            Lokacija <span class="symbol required"></span> 
                        </label>
                        <select id="map_object" name="data[CouponChecker][fk_id_map_objects]" class="form-control search-select">
                            <option selected="selected" value=""></option>
                            <?php
                            foreach ($locations as $k => $v) {
                                echo '<option value="' . $k . '">' . $v . '</option>';
                            }
                            ?>                    
                        </select>
                    </div>
                </div>
            </div>        
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-yellow btn-block" type="submit"> 
                    Novi QR poništavač <i class="fa fa-arrow-circle-right"></i> 
                </button>
            </div>
        </div>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>

</div>

