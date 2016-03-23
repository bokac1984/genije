<?php

App::uses('AppModel', 'Model');

/**
 * Banner Model
 *
 */
class Banner extends AppModel {
    /**
     *
     * @var string Naziv slika koja treba da se obrise
     */
    public $imageToDelete = '';
    /**
     *
     * @var string Adresa na serveru foldera gde su slike banera 
     */
    public $bannerFolder = '/photos/banners/';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'img_url' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'link' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'status' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
//        'link' => array(
//            'url' => array(
//                'rule' => array('url'),
//            'message' => 'Unesite ispravan URL',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),        
    );
    
    public function afterDelete() {
        $this->deleteImageFile($this->imageToDelete, $this->bannerFolder);
        parent::afterDelete();
    }

    public function beforeDelete($cascade = true) {
        $image = $this->find('first', array(
            'conditions' => array(
                'Banner.id' => $this->id
            ),
            'fields' => array(
                'Banner.img_url'
            )
        ));
        
        if (count($image) > 0) {
            $this->imageToDelete = $image['Banner']['img_url'];
        }
        parent::beforeDelete($cascade);
    }
}
