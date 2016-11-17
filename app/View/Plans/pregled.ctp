<?php
$root = $this->Html->link('Vijesti', array('controller' => 'news', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Pregled');

$this->assign('title', 'Vijesti');
$this->assign('page-title', 'Vijesti <small>pregled vijesti</small>');
$this->assign('breadcrumb-icon', $icon);
?>
<div class="row">
    <div class="col-md-12">
        <div id="pricing_table_example1" class="row">
            <div class="col-sm-12">
                <?php foreach ($plans as $plan) : ?>
                <div class="pricing-table col-sm-3 col-xs-12">
                    <h3>Enterprise<span>$59</span></h3>
                    <a href="" class="btn btn-green">
                        Sign up
                    </a>
                    <ul>
                        <li>
                            <b>10GB</b> Disk Space
                        </li>
                        <li>
                            <b>100GB</b> Monthly Bandwidth
                        </li>
                        <li>
                            <b>20</b> Email Accounts
                        </li>
                        <li>
                            <b>Unlimited</b> subdomains
                        </li>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
