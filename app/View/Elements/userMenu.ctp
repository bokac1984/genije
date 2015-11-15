<?php
?>
<ul class="nav navbar-right">
    <!-- start: USER DROPDOWN -->
    <li class="dropdown current-user">
        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
            <?php 
            
            $slika = '/photos-profiles/default.jpg';
            if (!empty(AuthComponent::user('img'))) {
                $slika = '/photos-profiles/' . AuthComponent::user('img');
            }
            
            echo $this->Html->image($slika, array(
                'height' => '30',
                'width' => '30',
                'class' => 'circle-img',
                'alt' => AuthComponent::user('fullname')
            )); ?>
            <span class="username"><?php echo AuthComponent::user('fullname'); ?></span>
            <i class="clip-chevron-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <?php echo $this->Html->link('<i class="clip-user-2"></i> &nbsp;Moj profil', array(
                    'controller' => 'users',
                    'action' => 'profile',
                    AuthComponent::user('id')
                ),array(
                    'escape' => false
                )); ?>
            </li>
            <li>
                <?php echo $this->Html->link('<i class="clip-locked"></i> &nbsp;Promjeni šifru', array(
                    'controller' => 'users',
                    'action' => 'password',
                    AuthComponent::user('id')
                ),array(
                    'escape' => false
                )); ?>
            </li>
            <li class="divider"></li>
            <li>
                <a href="/users/logout">
                    <i class="clip-exit"></i>
                    &nbsp;Log Out
                </a>
            </li>
        </ul>
    </li>
    <!-- end: USER DROPDOWN -->
</ul>
