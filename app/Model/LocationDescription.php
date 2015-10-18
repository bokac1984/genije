<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 */
class LocationDescription extends AppModel {
       
    public $useTable = 'map_objects_description'; 
    public $primaryKey = 'id';
    public $displayField = 'html_text';

}
