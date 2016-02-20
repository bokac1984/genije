<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 */
class LocationDescription extends AppModel {
       
    public $useTable = 'map_objects_description'; 
    public $primaryKey = 'fk_id_map_objects';
    public $displayField = 'html_text';

}
