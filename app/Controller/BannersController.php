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
        if ($this->request->is(array('post', 'put'))) {
            $sourceDir = !empty($this->request->data['Banner']['source']) ?
                    $this->request->data['Banner']['source'] :
                    'photos';
            $destinationDir = !empty($this->request->data['Banner']['thumb_folder']) ?
                    $this->request->data['Banner']['thumb_folder'] :
                    'thumbnails';
            $percentage = $this->request->data['Banner']['percent'];

            $folderForThumbnails = new Folder($sourceDir . DS . $destinationDir, true, 0777);
            $dirPath = WWW_ROOT . $sourceDir;
            $dirPhoto = WWW_ROOT . $sourceDir . DS;
            $dirPhotoExit = WWW_ROOT . $sourceDir . DS . $destinationDir . DS;

            $folderStructure = array(
                $dirPath,
                $dirPhotoExit
            );
            $i = 0;
            $slike = array();
            $neuspjele = array();


            $dir = new FilesystemIterator($dirPath, FilesystemIterator::SKIP_DOTS);       
            foreach ($dir as $fileinfo) {

                if ($fileinfo->isFile()) {
                    $i++;
                    $fileName = $fileinfo->getFilename();
                    $ext = $fileinfo->getExtension();

                    $destination = $dirPhotoExit . $fileName;
                    $source = $dirPhoto . $fileName;
                    $slike[] = $destination;
                    if (file_exists($destination)) {
                        continue;
                    }

                    if ($ext == 'bmp') {
                        $neuspjele[] = $destination;
                        continue;
                    }

                    $s = $this->createthumb($source, $destination, $ext, $percentage);
                    if ($s) {
                        $slike[] = $destination;
                    }
                }
            }
            $this->set(compact('slike', 'folderStructure'));
        }
    }

    private function createthumb($src, $dest, $file_ext, $percent = 0.45) {
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
        $desired_height = $height * $percent;
        $desired_width = $width * $percent;

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
        $uspjeh = false;
        /* create the physical thumbnail image to its destination */
        switch ($file_ext) {
            case 'jpg' || 'jpeg':
                $uspjeh = imagejpeg($virtual_image, $dest);
                break;
            case 'png':
                $uspjeh = imagepng($virtual_image, $dest);
                break;

            case 'gif':
                $uspjeh = imagegif($virtual_image, $dest);
                break;
            default:
                $uspjeh = imagejpeg($virtual_image, $dest);
        }

        return $uspjeh;
    }

}
