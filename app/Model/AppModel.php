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
     * Daj broj objava za odgovarajuci Model u periodu koji se racuna od dana pretplate
     * pa svaki mjesec do tog dana u mjesecu kao u primjeru objasnjenom u metodi correctDateForMonttlySubscription
     * @param int $locationId
     * @return int broj objava
     */
    public function publishedByLocationIdLastMonth($locationId = null, $startDate = null) {
        $date = $this->correctDateForMonthlySubscription($startDate);
        return $this->find('count', array(
            'conditions' => array(
                "$this->alias.fk_id_map_objects" => $locationId,
                "$this->alias.creation_date >= " => $date
            )
        ));        
    }    
    
    /**
     * Ovdje bi trebalo da odredimo koji je to datum
     * u odnosu na koji cemo da gledamo da li je objavljeno dogadjaja ili svega ostalog
     * tipa ako je danas 13.03.2016  a pretplata pocela 18.01.2016 onda cemo
     * da vidimo je li prvi datum (13.03.2016) veci od 18.03.2016
     * ako nije onda cemo da smanjimo jedan mjesec i racunamo od 18.02.2016 broj objava
     * @param datetime $startDate
     */
    public function correctDateForMonthlySubscription($startDate = null) {
        $now = new DateTime("now");
        $date1 = new DateTime($startDate);
        
        $day = $date1->format('d'); // stavi tacan dan kojeg je nastala pretpplata
        $month = $now->format('m');
        $year = $now->format('Y');
        $hour = $date1->format('H');
        $min = $date1->format('i');
        $sec = $date1->format('s');
        
        $projectedDateOfExpire = new DateTime("$year-$month-$day");
        $projectedDateOfExpire->setTime($hour, $min, $sec);
        
        if ($now < $projectedDateOfExpire) {
            $projectedDateOfExpire->modify('-1 month');
        }
        
        return $projectedDateOfExpire->format('Y-m-d H:i:s');
    }    
    
    /**
     * Da li ima pravo da jos objavljuje
     * 
     * @param int $subscribedCount Broj pretplacenih objava
     * @param int $publishedCount Broj objavljenih objava
     * @return bolean
     */
    public function canPostMore($subscribedCount, $publishedCount) {
        return $publishedCount >= $subscribedCount;
    }
}
