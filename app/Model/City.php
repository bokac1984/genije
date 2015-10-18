<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 */
class City extends AppModel {
       
    public $useTable = 'cities'; 
    public $primaryKey = 'id';
    public $displayField = 'name';

}
