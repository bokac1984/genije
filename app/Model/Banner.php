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
                'rule' => array('notEmptyImage'),
                'message' => 'Odaberite sliku!'
            ),
            'type' => array(
                'rule' => array(
                    'extension',
                    array('jpeg','jpg','png','gif')
                ),
                'message' => 'Pogrešna ekstanzija slike, mora biti jedna od: jpeg, jpg, png, gif.'
            ),
            'size' => array(
                'rule' => array('validateImageSize', 5242880),
                'message' => 'Slika je preteska za baner, ne smije biti vec od 5 Mb.'
            ),
            'dimensions' => array(
                'rule' => array('dimensions', 0.3),
                'message' => 'Slika nije odgovarajucih dimenzija, idealno je da je širina veca od visine za 3.'
            ),            
        ),
        'link' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'status' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),     
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

    /**
     * 
     * @param array $data Podaci za testiranje velicine slike
     * @param int $size Velicina slike u bajtima
     * @return boolean
     */
    public function validateImageSize($data, $size) {
        if ($data['img_url']['size'] >= $size) {
            return false;
        }
        
        return true;
    }

    
    public function notEmptyImage($data = array()) {
        if ($this->data[$this->alias]['img_url']['size'] == 0) {
            return false;
        }
        
        return true;
    }
    
    public function dimensions($data, $ratio) { 
        list($width, $height) = getimagesize($data['img_url']['tmp_name']);
        $uploadedImageRatio = $height/$width;
        //debug($size[1]/$size[0]);exit();
        
        if (($uploadedImageRatio+0.05) > $ratio || ($uploadedImageRatio-0.05) < $ratio) {
            return false;
        }
        
        return true;
    }
}
