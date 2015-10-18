<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
    protected function modifyOnlineStatus($value, $key, $url) {
        $status = 'Nepoznato';
        switch ($value) {
            case 0:
                $status = '<a href="#" id="online_status" data-url="'.$url.'" class="editable editable-click online-status label label-sm label-danger" data-pk="'.$key.'" data-value="0" data-title="Izmjeni status">Offline</a>';
                break;
            case 1:
                $status = '<a href="#" id="online_status" data-url="'.$url.'" class="editable editable-click online-status label label-sm label-warning" data-pk="'.$key.'" data-value="1" data-title="Izmjeni status">Pending</a>';
                break;
            case 2;
                $status = '<a href="#" id="online_status" data-url="'.$url.'" class="editable editable-click online-status label label-sm label-success" data-pk="'.$key.'" data-value="2" data-title="Izmjeni status" data-original-title="" title="">Online</a>';
                break;
            default:
                break;
        }
        return $status;
    }  
    
    public function formatTimeResult($time) {
        return CakeTime::format($time, '%d.%m.%Y %H:%M %p');
    }
    
    /**
     * Vraća zadnji kveri na bazu
     * 
     * @return string Kveri koji je zadnji iniciran
     */
    public function getLastQuery() {
        $dbo = $this->getDatasource();
        $logs = $dbo->getLog();
        $lastLog = end($logs['log']);
        return $lastLog['query'];
    }
}
