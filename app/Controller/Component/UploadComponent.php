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
        if (empty($uploadedImage) && $uploadedImage['size'] === 0) {
            return $fileName;
        }
        
        $fileData = pathinfo($uploadedImage['name']);
        
        if (!$this->checkExtension($fileData['extension'])) {
            return $fileName;
        }
        
        $fileName = $this->changeNameOfFile($fileData['filename']) . '.' . strtolower($fileData['extension']);
        $uploadLocation = WWW_ROOT . $location . $fileName;

        if (move_uploaded_file($uploadedImage['tmp_name'], $uploadLocation )) {
            return $fileName;
        }

        return '';
    }
    
    public function changeNameOfFile($originalName = '') {
        $temporalName = '';
        if ($originalName !== '') {
            $temporalNameHashed = hash('sha512', $originalName);
            $temporalName = substr($temporalNameHashed, 0, 10) . '-';
            $temporalName = uniqid ($temporalName, false);
        }
        
        return $temporalName;
    }
    
    public function checkExtension($extension) {
        return in_array($extension, $this->allowedExtensions);
    }

}
