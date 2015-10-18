<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 */
class News extends AppModel {
       
    public $useTable = 'cities'; 
    public $primaryKey = 'id';
    public $displayField = 'title';

}
