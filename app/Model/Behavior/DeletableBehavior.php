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
        return false;
    }
    
    /**
     * Ttrebalo bi da provjeri da li ima glavne slike prije brisanja, i ako ima da i nju pobrise
     * ali ako brisemo sliku koja je glavna da se odabere prvo neka koja bi trebala biti glavna
     */
    public function checkMainImage() {
        
    }
}