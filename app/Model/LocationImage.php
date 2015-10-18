<?php
App::uses('AppModel', 'Model');
App::uses('File', 'Utility');
/**
 * LocationImage Model
 *
 */
class LocationImage extends AppModel {
       
    public $useTable = 'map_objects_images'; 
    public $primaryKey = 'id';
    
    /**
     * Brise slike prvo iz baze, a onda i sa fajl sistema
     * 
     * @param int $id Broj lokacije u slikama
     * @return array Ako je prazna znaci da nema slika za brisanje
     */
    public function deleteImages($id = null) {
        $images = $this->getImageNames($id);
        
        if (count($images) > 0) {
            $delConditions = array(
                'LocationImage.fk_id_map_objects' => $id
            );

            if ($this->deleteAll($delConditions)) {
                return $this->deleteAllImages($images);
            }
        }
        
        return $images;
    }
    
    
    /**
     * Brise sve slike sa nazvima slika sa fajls sistema
     * Ako ne uspije da obrise jednu sliku, ubaci je u niz koji ce reci da 
     * treba te slike rucni obrisati
     * 
     * @param array $imageNames
     * @return array Niz nepobrisanih slika
     */
    public function deleteAllImages($imageNames = array()) {
        $notDeleted = array();
        foreach ($imageNames as $imageName) {
            if (!$this->deleteImageFile($imageName)) {
                $notDeleted[] = $imageName;
            }
        }
        
        return $notDeleted;
    }
    
    /**
     * Brise jednu sliku sa fajl sistema, ako ne uspiuje vraca false
     * 
     * @param string $fileName
     * @return boolean
     */
    public function deleteImageFile($fileName = '') {
        if ('' !== $fileName) {
            $file = new File(WWW_ROOT . '/photos/' . $fileName, false, 0777);
            return $file->delete(); 
        }
        
        return false;
    }
    
    /**
     * Vraca niz naziva slika za zadani ID lokacije
     * 
     * @param int $id
     * @return array Niz naziva slika
     */
    public function getImageNames($id = null) {
        $names = $this->find('all', array(
            'conditions' => array(
                'LocationImage.fk_id_map_objects' => $id
            ),
            'fields' => array(
                'LocationImage.img_name'
            )
        ));

        $imgNames = array();
        if (count($names) > 0) {
            foreach ($names as $name) {
                $imgNames[] = $name['LocationImage']['img_name'];
            }
        }
        
        return $imgNames;
    }
}
