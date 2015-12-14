<?php
App::uses('AppModel', 'Model');
/**
 * LocationProduct Model
 *
 */
class LocationProduct extends AppModel {
    public $useTable = 'map_objects_products'; 
    
    public $belongsTo = array('Product');
    
    public function saveAllLocationsForProduct($productId, $locationsIds) {
        $dataToSave =  array();
        debug($productId);exit();
        $this->deleteAll(array('fk_id_products' => $productId));
        
        foreach ($locationsIds as $subtype) {
            $dataToSave[]['LocationProduct'] = array(
                'fk_id_map_objects' => $subtype,
                'fk_id_products' => $productId
            );
        }
        
        return $this->saveAll($dataToSave);
    }
}
