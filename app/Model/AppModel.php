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
App::uses('CakeTime', 'Utility');
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
    public $recursive = -1;
    
    public $actsAs = array('Containable'); 
    
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
    
    /**
     * Brise sve slike sa nazvima slika sa fajls sistema
     * Ako ne uspije da obrise jednu sliku, ubaci je u niz koji ce reci da 
     * treba te slike rucni obrisati
     * 
     * @param string $path Location of image path on disk 
     * @param array $imageNames
     * @return array Niz nepobrisanih slika
     */
    public function deleteAllImages($path, $imageNames = array()) {
        $notDeleted = array();
        foreach ($imageNames as $imageName) {
            if (!$this->deleteImageFile($imageName, $path)) {
                $notDeleted[] = $imageName;
            }
        }
        
        return $notDeleted;
    }
    
    /**
     * Brise jednu sliku sa fajl sistema, ako ne uspisuje vraca false
     * 
     * @param string $fileName
     * @return boolean
     */
    public function deleteImageFile($fileName = '', $path = '/photos/') {
        if ('' !== $fileName) {
            $file = new File(WWW_ROOT . $path . $fileName, false, 0777);
            return $file->delete(); 
        }
        
        return false;
    }  
    
    /**
     * Hrki se bori protiv ovog frameworka :D
     * 
     * @param type $options
     * @return type
     */
    public function beforeSave($options = array()) {
        // it's an insert, so add `created`
        if(empty($this->data[$this->alias][$this->primaryKey])) {
            $this->data[$this->alias]['creation_date'] = $this->getDataSource()->expression('NOW()');
        }

        // modified is set anyway
        $this->data[$this->alias]['modified_date'] = $this->getDataSource()->expression('NOW()');

        return parent::beforeSave($options);
    }    
    
    /**
     *
     * Daj broj objava za odgovarajuci Model 
     * @param int $locationId
     * @return int broj objava
     */
    public function publishedByLocationIdLastMonth($locationId = null) {
        return $this->find('count', array(
            'conditions' => array(
                "$this->alias.fk_id_map_objects" => $locationId,
                "$this->alias.creation_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()"
            )
        ));        
    }    
}
