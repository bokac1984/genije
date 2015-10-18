<?php
App::uses('AppModel', 'Model');
/**
 * ProductFeature Model
 *
 */
class ProductFeature extends AppModel {
       
    public $useTable = 'products_features'; 
    public $primaryKey = 'id';
    public $displayField = 'title';
}
