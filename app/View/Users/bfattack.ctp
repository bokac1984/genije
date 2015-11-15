<div class="row">
    <div class="col-lg-6">
        <?php echo $this->Html->image('locked.png', array('alt' => 'Google Plus')); ?>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <h3>Oh no, what have you done?</h3>
                <p>You have tried logging in <?php echo $attempts; ?> time(s), so you have to wait <?php echo $time; ?> to log in again.</p>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                echo $this->Html->link("Get me out of here", array('controller' => 'pages', 'action' => 'index'), array('class' => 'btn btn-large btn-block btn-primary'));
                ?>
            </div>
        </div>
    </div>
</div>
