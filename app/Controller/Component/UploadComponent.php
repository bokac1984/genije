<?php

App::uses('Component', 'Controller');

/**
 * Description of UploadComponent
 *
 * @author bokac
 * 
 */
class UploadComponent extends Component {

    /**
     * Dozvoljene ekstenzije
     *
     * @var array 
     * 
     */
    private $allowedExtensions = array('jpg', 'jpeg', 'png');

    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->controller = $controller;
    }

    public function uploadFile($uploadedImage, $location = '/photos/') {
        $fileName = '';
        if (!empty($uploadedImage) && $uploadedImage['size'] > 0) {
            $fileName = 'Ne postoji slika';
        }
        
        $fileData = pathinfo($uploadedImage['name']);
        
        if (!$this->checkExtension($fileData['extension'])) {
            $fileName = 'Ekstenzija nije dozvoljena.';
        }
        
        $fileName = $this->changeNameOfFile($fileData['filename']) . strtolower($fileData['extension']);
        $uploadLocation = WWW_ROOT . $location;
        
        if (!move_uploaded_file($uploadedImage['tmp_name'], $uploadLocation . $fileName)) {
            $fileName = 'Nije moguce uploadovati';
        }

        return $fileName;
    }
    
    public function changeNameOfFile($originalName = '') {
        $temporalName = '';
        if ($originalName !== '') {
            $temporalName = hash('sha512', $originalName);
            $temporalName = substr($originalName, 0, 10) . "-";
        }
        
        return $temporalName;
    }
    
    public function checkExtension($extension) {
        return in_array($extension, $this->allowedExtensions);
    }

}
