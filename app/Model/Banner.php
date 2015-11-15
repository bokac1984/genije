<?php
App::uses('AppModel', 'Model');
/**
 * Banner Model
 *
 */
class Banner extends AppModel {
       
    public $useTable = 'banners'; 
    public $primaryKey = 'id';
    public $displayField = 'title';

}
