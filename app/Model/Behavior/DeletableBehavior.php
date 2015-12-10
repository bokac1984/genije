<?php
App::uses('ModelBehavior', 'Model');

/**
 * Neke zajednicke metode, naprimjer za brisanje i dodavanje slika mozda
 *
 * @author bokac
 */
class DeletableBehavior extends ModelBehavior {
    
    public $settings = array();
    
    public $_defaults = array(
        'baseImageLocation' => '/photos/',
        'imageModel' => ''
    );
    
    public function setup(Model $model, $config = array()) {
        parent::setup($model, $config);
        
        if (!isset($this->settings[$model->alias])) {
            $this->settings[$model->alias] = $this->_defaults;
            $this->settings[$model->alias]['imageModel'] = $model->alias . 'Image';
        }
        
        $this->settings[$model->alias] = array_merge($this->settings[$model->alias], $config);
    }
    
    /**
     * Brise slike iz baze
     * 
     * @param int $model
     * @param int $fid
     * @param string $jpg
     * @return boolean
     */
    public function deleteImage(Model $model, $fid, $jpg) {
        if ($model->{$this->settings[$model->alias]['imageModel']}->delete($fid)) {
            return $model->deleteImageFile($jpg, $this->settings[$model->alias]['baseImageLocation']);
        }
        //TODO: mozda napraviti da se provjeri je li ovo glavna slika, i ako jeste da izbrise i polje tamo
        // je ce se na ovaj nacin pobrisati slika i ostace njen naziv i onda ce biti broken file name
        return false;
    }
}

?>
