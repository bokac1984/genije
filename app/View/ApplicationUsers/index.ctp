<?php 
$root = $this->Html->link('Korisnici', array('controller' => 'application_users', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Pregled' );

$this->assign('title', 'Korisnici');
$this->assign('page-title', 'Korisnici <small>pregled</small>');
?>
<div class="row">
    <div class='col-md-12'>
        <table class="table table-striped table-bordered table-hover" id="sample-table-2">
            <thead>
                <tr>
                    <th class="center">
            <div class="checkbox-table">
                <label>
                    <input type="checkbox" class="flat-grey">
                </label>
            </div>
            </th>
            <th class="center">Slika</th>
            <th>Puno ime</th>
            <th class="hidden-xs">Email</th>
            <th class="hidden-xs">Tip logina</th>
            <th> </th>
            </tr>
            </thead>
            <tbody>
<?php foreach ($users as $user): ?>
                    <tr>
                        <td class="center">
                            <div class="checkbox-table">
                                <label>
                                    <input type="checkbox" class="flat-grey">
                                </label>
                            </div>
                        </td>
                        <td class="center">
                        <?php
                        echo $this->Html->image($user['ApplicationUser']['img_url'], array(
                            'height' => '50',
                            'width' => '50',
                            'alt' => 'my image'
                                )
                        );
                        ?>
                        </td>
                        <td>
                            <?php
                            echo $this->Html->link($user['ApplicationUser']['display_name'], array(
                                'controller' => 'application_users',
                                'action' => 'view',
                                $user['ApplicationUser']['id']
                                    )
                            );
                            ?>
                        </td>
                        <td class="hidden-xs">
                            <a href="#" rel="nofollow" target="_blank">
                                <?php echo $user['ApplicationUser']['email'] ?>
                            </a></td>
                        <td class="hidden-xs"><?php echo $user['ApplicationUser']['login_type'] == 2 ? 'FB' : "Google"; ?></td>
                        <td class="center">
                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                <a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                            </div>
                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                        <i class="fa fa-cog"></i> <span class="caret"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu pull-right">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class='col-md-12'>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>