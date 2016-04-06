<?php

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

/**
 * Banners Controller
 *
 * @property Banner $Banner
 * @property PaginatorComponent $Paginator
 */
class BannersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    public $helpers = array('Time', 'MyHtml');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Banner->recursive = 0;
        $this->set('banners', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Banner->exists($id)) {
            throw new NotFoundException(__('Invalid banner'));
        }
        $options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
        $this->set('banner', $this->Banner->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Banner->set($this->request->data);
            if ($this->Banner->validates()) {
                $filename = $this->uploadFile($this->request->data['Banner']['img_url'], '/photos/banners/');
                if ($filename !== '') {
                    $this->request->data['Banner']['img_url'] = $filename;
                }
                $this->Banner->create();
                if ($this->Banner->save($this->request->data, false)) {
                    $this->Flash->success(__('The banner has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The banner could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('The banner could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Banner->exists($id)) {
            throw new NotFoundException(__('Invalid banner'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Banner->save($this->request->data)) {
                $this->Flash->success(__('The banner has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The banner could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
            $this->request->data = $this->Banner->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Banner->id = $id;
        if (!$this->Banner->exists()) {
            throw new NotFoundException(__('Invalid banner'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Banner->delete()) {
            $this->Flash->success(__('The banner has been deleted.'));
        } else {
            $this->Flash->error(__('The banner could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /* AJAX METHOD */

    /**
     * Prima podatke u obliku
     *  array(
      'name' => 'can_do_checks',
      'value' => '0',
      'pk' => '1'
      )
     * @throws NotFoundException
     */
    public function changeStatus() {
        $this->request->allowMethod('ajax');
        $this->viewClass = 'Json';
        $response = array(
            'status' => '404',
            'value' => 'label-danger'
        );

        $bannerClasses = array(
            'label-danger', 'label-warning', 'label-success'
        );

        $this->Banner->id = $this->request->data['pk'];
        if (!$this->Banner->exists()) {
            throw new NotFoundException(__('Ne postoji banner!'));
        }

        $dataToSave = array(
            'id' => $this->request->data['pk'],
            $this->request->data['name'] => $this->request->data['value']
        );

        if ($this->Banner->save($dataToSave)) {
            $response = array(
                'status' => '200',
                'value' => $bannerClasses[$this->request->data['value']]
            );
        }

        $this->set(compact('response'));
    }

    public function thumb() {
        $this->autoRender = false;
        $folder = new Folder('/photos/thumbnails', true, 0777);
        $dirPath = WWW_ROOT . 'photos' . DS . 'banners';
        $dirPhoto = WWW_ROOT . 'photos' . DS;
        $dirPhotoExit = WWW_ROOT . 'photos' . DS . 'thumbnails' . DS;
        echo "<br>";
        $i = 0;
        $dir = new DirectoryIterator(dirname($dirPath));
        foreach ($dir as $fileinfo) {

            if ($fileinfo->isFile()) {
                $i++;
                $fileName = $fileinfo->getFilename();
                $ext = $fileinfo->getExtension();
                echo $fileName . " $i <br>";
                $destination = $dirPhotoExit . $fileName;
                $source = $dirPhoto . $fileName;
                if (file_exists($destination)) {
                    echo "The file $destination exists <br>";
                    continue;
                }

                if ($ext == 'bmp') {
                    echo "The file is of wierd extansion exists <br>";
                    continue;
                }

                $this->createthumb($source, $destination, $ext);
            }
        }

        echo 'done';
    }

    private function createthumb($src, $dest, $file_ext) {
        /* read the source image */
        switch ($file_ext) {
            case 'jpg':
                $source_image = imagecreatefromjpeg($src);
                break;
            case 'jpeg':
                $source_image = imagecreatefromjpeg($src);
                break;

            case 'png':
                $source_image = imagecreatefrompng($src);
                break;
            case 'gif':
                $source_image = imagecreatefromgif($src);
                break;
            default:
                $source_image = imagecreatefromjpeg($src);
        }
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        /* find the "desired height" of this thumbnail, relative to the desired width  */
        $desired_height = $height * 0.45;
        $desired_width = $width * 0.45;

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        /* create the physical thumbnail image to its destination */
        switch ($file_ext) {
            case 'jpg' || 'jpeg':
                imagejpeg($virtual_image, $dest);
                break;
            case 'png':
                imagepng($virtual_image, $dest);
                break;

            case 'gif':
                imagegif($virtual_image, $dest);
                break;
            default:
                imagejpeg($virtual_image, $dest);
        }
    }

}
