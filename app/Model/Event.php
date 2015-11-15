<?php
App::uses('AppModel', 'Model');
App::uses('CakeTime', 'Utility');
/**
 * Contact Model
 * @property Location $Location
 */
class Event extends AppModel {
       
    public $useTable = 'events'; 
    public $primaryKey = 'id';
    public $displayField = 'name';

    /**
     * Naziv slike za brisanje
     *
     * @var string naziv slike
     */
    public $imageToDelete;
    
    public $actsAs = array('Containable');

    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Naziv ne smije biti prazan.'
            ),
        ),
        'price' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Naziv ne smije biti prazan.'
            ),
        ),
    );
    
    public $belongsTo = array(
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'fk_id_map_objects',
        ),
    );   
    
    public $hasMany = array(
        'News' => array(
            'className' => 'News',
            'foreignKey' => 'fk_id_events',
        )
    );
    
    public function afterFind($results, $primary = false) {
        parent::afterFind($results, $primary);
        
        foreach ($results as $key => $val) {
            if (isset($val['Event']['online_status'])) {
                $results[$key]['Event']['online_status'] = $this->modifyOnlineStatus($val['Event']['online_status'],$val['Event']['id'], '/events/editStatus/');
            } 
            
            if (isset($val['Event']['start_time'])) {
                $results[$key]['Event']['start_time'] = $this->formatTimeResult($val['Event']['start_time']);
            }
            
            if (isset($val['Event']['end_time'])) {
                $results[$key]['Event']['end_time'] = $this->formatTimeResult($val['Event']['end_time']);
            }
            
            if (isset($val['Event']['fk_id_map_objects'])) {
                $results[$key]['Event']['fk_id_map_objects'] = $this->getLocationName($val['Event']['fk_id_map_objects']);
            }

            if (isset($val['Event']['img_url'])) {
                /**
                 * Trebalo bi napraviti ovdje neki fallback na sliku lokacije, za one lokacije
                 * koje nisu kreirane sa novim sistemom, gdje bi bilo korisno da postoji slika za njih u folderu events
                 * Znam da je glupo da se iste slike nalaze na istom mjestu dva puta, ali za sad nema puno dogadjaja, pa
                 * nije puno prostora. Jer ako ne zelimo sliku lokacije onda
                 */
                $results[$key]['Event']['img_url'] = $this->getImage($val['Event']['img_url']);
            }
        }
        return $results;
    }

    /**
     * @param array $options
     * @return type
     */
    public function beforeSave($options = array()) {
        parent::beforeSave($options = array());

        if (isset($this->data['Event']['value_time']) &&
            ('' === $this->data['Event']['start_time'] || '' === $this->data['Event']['end_time'])) {
            $times = explode(" - ", $this->data['Event']['value_time']);

            $this->data['Event']['start_time'] = date("Y-m-d H:i:s", strtotime($times[0]));
            $this->data['Event']['end_time'] = date("Y-m-d H:i:s", strtotime($times[1]));
            unset($this->data['Event']['value_time']);
        }

        if (isset($this->data['Event']['img_url']) && 4 === $this->data['Event']['img_url']['error']) {
            $image = $this->setLocationsMainImageToEvent($this->data['Event']['fk_id_map_objects']);

            //$this->copyLocationImageToEventFolder($image);

            $this->data['Event']['img_url'] = $image;
        }

        // unset some variable to have clean data for saving
        unset($this->data['Event']['city_id']);
    }

    /**
     * Nadji naziv lokacije za zadati ID lokacije
     * @param $id
     * @return type
     */
    public function getLocationName($id) {
        return $this->Location->getLocationName($id);
    }

    /**
     * Sacuvamo novi event ali prije toga vidimo da li je poslato dobro start i end vrijeme
     * i ako nije rastavimo ono originalno  i onda sacuvamo
     * @param array $data
     * @return boolean Vracamo da li je uspjesno sacuvano ili ne
     */
    public function saveEvent($data = array()) {
        debug($this->data);
        return $this->save($data);
    }

    /**
     * Nadji sve evente za odredjenu lokaciju, tj listu eventa za lokaciju
     * @param null $locationId
     * @return array
     */
    public function getAllLocationEvents($locationId = null) {
        $this->recursive = -1;
        $eventsOut = array();        
        $events = $this->find('all', array(
            'conditions' => array(
                'Event.fk_id_map_objects' => $locationId
            ),
            'fields' => array(
                'Event.id', 'Event.name'
            )
        ));
        if (count($events) > 0) {
            foreach ($events as $l) {
                $eventsOut[] = array(
                    'id' => $l['Event']['id'],
                    'name' => $l['Event']['name']
                );
            }
        }
        
        return $eventsOut;        
    }

    /**
     * Nadji sliku od lokacije ako nema slike u img_url polju kad dodajemo novi event
     * Ovdje cemo za sad uraditi ovako, ako se zeli slika lokacije za event onda samo kopiramo id slike
     * @param null $id
     * @return string image location
     */
    public function setLocationsMainImageToEvent($id = null) {
        if (null !== $id) {
            return '/photos/' . $this->Location->getMainImage($id);
        }

        return '';
    }


    /**
     * Kopiraj sliku sa locations lokacije na lokaciju za events, da bih mogao obrisati
     * @param string $image
     */
    public function copyLocationImageToEventFolder($image = '') {
        if ('' !== $image) {
            $file = new File(WWW_ROOT . '/photos/' . $image, false, 0777);

            if ($file->exists()) {
                $dir = new Folder(WWW_ROOT . '/photos/events/', true);
                $file->copy($dir->path . DS . $file->name);
                $file->close();
            }
        }
    }
    
    public function getEventName($id) {
        $this->recursive = -1;
        $l = $this->find('first', array(
            'conditions' => array('id' => $id),
            'fields' => array('name')
        ));
        return $l[$this->name]['name'];
    }

    public function getImage($image = '') {
        if ('' !== $image) {
            $file = new File(WWW_ROOT . '/photos/events/' . $image, false, 0777);
            if (!$file->exists()) {
                $file = new File(WWW_ROOT . '/photos/' . $image, false, 0777);

                if ($file->exists()) {
                    return '/photos/'. $image;
                }
            }
        }

        return $image;
    }

    public function sredislike() {
        $events = $this->find('all', array(
            'contain' => array(
                'Location' => array(
                    //'fields' => array('Location.img_url')
                )
            ),
            'fields' => array(
                //'Event.id', 'Event.img_url'
            ),
            'conditions' => array(
                'Event.id' => '195'
            )
        ));
            debug($this->getLastQuery());
        debug($events);
    }

    /**
     * Pobrisi sliku nakon brisanja podatka iz baze
     * Ali samo ako postoji, ako ne postoji onda postoji sansa da je slika iskoristena sa lokacije
     */
    public function afterDelete() {
        if (!empty($this->imageToDelete)) {
            $file = new File(WWW_ROOT . '/photos/events/' . $this->imageToDelete, false, 0777);
            if ($file->exists()) {
                $file->delete();
            }
            $file->close();
        }
    }

    /**
     * Provjeri prvo da li postoji dogadjaj, i ako ga ima dostavi sliku u model polje za cuvanje slike
     *
     * @param bool|true $cascade
     * @return bool
     */
    public function beforeDelete($cascade = true) {
        $this->imageToDelete = '';
        $count = $this->find('first', array(
            'conditions' => array('Event.id' => $this->id),
            'fields' => array('Event.img_url')
        ));

        if (count($count) > 0) {
            $this->imageToDelete = $count['Event']['img_url'];
            return true;
        }

        return false;
    }
}
