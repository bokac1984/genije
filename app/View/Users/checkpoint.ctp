<div class="row" style="padding-top: 10%;">
  <div class="col-lg-6">
    <h2>New place</h2>
    <p>We have noticed new place you are connecting from. Please take this final step towards your login</p>
  </div>
  <div class="col-lg-6">
    <?php
    echo $this->Form->create('User', array(
        'plugin' => null,
        'controller' => 'users',
        'action' => 'checkpoint',
        'method' => 'post'
    ));
    
    $this->Form->inputDefaults(array(
        'error' => array(
            'attributes' => array(
                'wrap' => 'div',
                'class' => 'label label-warning'
            )
        ),
            )
    );

    echo '<h2 class="form-signin-heading">' . $question . '</h2>';
    echo $this->Form->input('secret_answer', array(
        'class' => 'form-control',
        'placeholder' => 'Your Answer',
        'label' => false
    ));

    echo $this->Form->button('Tell me', array('type' => 'submit', 'class' => 'btn btn-large btn-primary', 'style' => 'margin-top: 20px;'));
    echo $this->Form->end();
    ?>
  </div>
</div>