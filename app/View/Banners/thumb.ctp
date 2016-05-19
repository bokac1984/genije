<?php

?>
<div class="banners row">
    <div class="col-md-6">
        <?php
        echo $this->Form->create('Banner');
        $this->Form->inputDefaults(array(
            'error' => array(
                'attributes' => array(
                    'wrap' => 'span',
                    'class' => 'help-block'
                )
            ),
            'div' => 'form-group',
            'class' => 'form-control'
                )
        );
        ?>        
        <div class="row">
            <div class="col-md-12">

            <?php
            echo $this->Form->input('source', array(
                'label' => 'Source folder',
                'placeholder' => 'Ostaviti prazno u slucaju /photos/'
            ));
            
            echo $this->Form->input('thumb_folder', array(
                'label' => 'Thumbnail folder name'
            ));
            
            echo $this->Form->input('percent', array(
                'label' => '% of resizing'
            ));
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-yellow btn-block" type="submit"> 
                    Generiši thumbnails <i class="fa fa-arrow-circle-right"></i> 
                </button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <ul>
        <?php 
        if (!empty($folderStructure)) {
            foreach ($folderStructure as $slika ) {
                echo "<li>$slika</li>";
            }
        }
        ?>        
        </ul>
    </div>
    <div class="col-md-6">
        <ul>
        <?php 
        if (!empty($neuspjele)) {
            foreach ($neuspjele as $slika ) {
                echo "<li>$slika</li>";
            }
        }
        ?>        
        </ul>
    </div>    
</div>