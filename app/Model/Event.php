<?php
App::uses('AppModel', 'Model');

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
    
    public $actsAs = array(
        'Deletable' => array(
            'baseImageLocation' => '/photos/events/'
        ),
    );

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
    
    public function getAllLocationEventsAjax($locationId = null) {
        $this->recursive = -1;   
        return $this->find('all', array(
            'conditions' => array(
                'Event.fk_id_map_objects' => $locationId
            )
        ));
    }
    
    /**
     * Nadji sve dogadjaje iz nekog grada
     * 
     * @param int $cityId
     * @return array
     */
    public function allCityEvents($cityId = null) {
        if ($cityId !== null) {
            $events = $this->find('all', array(
                'contain' => array(
                    'Location' => array(
                        'fields' => array(
                            'id'
                        )
                    )
                ),
                'conditions' => array(
                    'Location.fk_id_cities' => $cityId
                ),
                'fields' => array(
                    'Event.name',
                    'Event.id'
                )
            ));
            
            return $events;
        }
        
        return array();
    }

    /**
     * Nadji sliku od lokacije ako nema slike u img_url polju kad dodajemo novi event
     * Ovdje cemo za sad uraditi ovako, ako se zeli slika lokacije za event onda samo kopiramo id slike
     * @param null $id
     * @return string image location
     */
    public function setLocationsMainImageToEvent($id = null) {
        if (null !== $id) {
            return $this->Location->getMainImage($id);
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
    
    public function getImageForEvent($id = null) {
        return $this->find('first', array(
            'conditions' => array(
                'Event.id' => $id
            ),
            'fields' => 'Event.img_url'
        ));
    }
    /**
     *
     * Nadji da li korisnik smije sada da objavljuje, ako mu broj objava
     * bude veci za neki datum od ukupnog mjesecnog broja onda ne smije 
     * @param type $userLocaton
     * @param type $startDate
     */
    public function checkIfUserCanPublish($userLocaton, $startDate) {
        return $this->find('count', array(
            'conditions' => array(
                'Event.fk_id_map_objects' => $userLocaton,
                'Event.creation_date >= ' => $this->correctDateForMonthlySubscription($startDate)
            )
        ));
    }
}
