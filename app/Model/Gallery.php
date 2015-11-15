<?php
App::uses('AppModel', 'Model');
App::uses('File', 'Utility');

/**
 * Gallery Model
 *
 * @property News $News
 */
class Gallery extends AppModel {
    /**
     * Naziv slike za brisanje
     *
     * @var string naziv slike
     */
    public $imageToDelete;

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'gallery';

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'News' => array(
            'className' => 'News',
            'joinTable' => 'news_images',
            'foreignKey' => 'fk_id_gallery',
            'associationForeignKey' => 'fk_id_news',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

    public function afterDelete() {
        parent::afterDelete();
        if ('' !== $this->imageToDelete) {
            $file = new File(WWW_ROOT . '/gallery/' . $this->imageToDelete, false, 0777);
            $file->delete();
        }
    }
}
