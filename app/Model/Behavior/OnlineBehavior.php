<?php
App::uses('ModelBehavior', 'Model');

/**
 * Neke zajednicke metode, naprimjer za brisanje i dodavanje slika mozda
 *
 * @author bokac
 */
class OnlineBehavior extends ModelBehavior {
    
    public $settings = array();
    
    public $_defaults = array(
        'baseImageLocation' => '/photos/',
    );
    
    public function setup(Model $model, $config = array()) {
        parent::setup($model, $config);
        
        if (!isset($this->settings[$model->alias])) {
            $this->settings[$model->alias] = $this->_defaults;
        }
        
        $this->settings[$model->alias] = array_merge($this->settings[$model->alias], $config);
    }
    
    public function afterFind(\Model $model, $results, $primary = false) {
        parent::afterFind($model, $results, $primary);
        
        $this->modifyResults($model, $results);
        
        return $results;
    }
    
    public function modifyResults(\Model $model, &$rezultati) {
        switch ($model->alias) {
            case 'Location': 
                $this->modifyLocation($model, $rezultati);
                break;
            case 'Product':
                $this->modifyProduct($model, $rezultati);
                break;
            case 'News':
                $this->modifyNews($model, $rezultati);
                break;
            case 'Event':
                $this->modifyEvent($model, $rezultati);
                break;
            default:
                break;
        }
    }
    
    public function modifyProduct(\Model $model, &$results) {
        foreach ($results as $key => $val) {
            if (isset($val[$model->alias]['online_status'])) {
                $results[$key][$model->alias]['online_status'] = $this->modifyOnlineStatus($val[$model->alias]['online_status'],$val[$model->alias]['id'], '/products/editStatus/');
            }
            
            if (isset($val[$model->alias]['price'])) {
                /**
                 * @todo Povezati sa nekom tabelom vezanom za drzave pa da chita podatak o valuti odatle
                 */
                $results[$key][$model->alias]['price'] = $val[$model->alias]['price'] . " KM";
            }            
        }
    }
    
    public function modifyLocation(\Model $model, &$results) {
        foreach ($results as $key => $val) {
            if (isset($val[$model->alias]['online_status'])) {
                $results[$key][$model->alias]['online_status'] = $this->modifyOnlineStatus($val[$model->alias]['online_status'],$val[$model->alias]['id'], '/locations/editStatus/');
            } 
            if (isset($val[$model->alias]['fk_id_cities'])) {
                $results[$key][$model->alias]['fk_id_cities'] = $model->getCityName($val[$model->alias]['fk_id_cities']);
            }
        }
        return $results;
    }
    
    public function modifyEvent(\Model $model, &$results) {
        foreach ($results as $key => $val) {
            if (isset($val[$model->alias]['online_status'])) {
                $results[$key][$model->alias]['online_status'] = $this->modifyOnlineStatus($val[$model->alias]['online_status'],$val[$model->alias]['id'], '/events/editStatus/');
            } 
            
            if (isset($val[$model->alias]['start_time'])) {
                $results[$key][$model->alias]['start_time'] = $model->formatTimeResult($val[$model->alias]['start_time']);
            }
            
            if (isset($val[$model->alias]['end_time'])) {
                $results[$key][$model->alias]['end_time'] = $model->formatTimeResult($val[$model->alias]['end_time']);
            }
            
            if (isset($val[$model->alias]['fk_id_map_objects'])) {
                $results[$key][$model->alias]['fk_id_map_objects'] = $model->getLocationName($val[$model->alias]['fk_id_map_objects']);
            }

            if (isset($val[$model->alias]['img_url'])) {
                /**
                 * Trebalo bi napraviti ovdje neki fallback na sliku lokacije, za one lokacije
                 * koje nisu kreirane sa novim sistemom, gdje bi bilo korisno da postoji slika za njih u folderu events
                 * Znam da je glupo da se iste slike nalaze na istom mjestu dva puta, ali za sad nema puno dogadjaja, pa
                 * nije puno prostora. Jer ako ne zelimo sliku lokacije onda
                 */
                $results[$key][$model->alias]['img_url'] = $model->getImage($val[$model->alias]['img_url']);
            }
        }
        return $results;
    }   
    
    public function modifyNews(\Model $model, &$results) {
        foreach ($results as $key => $val) {
            if (isset($val[$model->name]['online_status'])) {
                $results[$key][$model->name]['online_status'] = $this->modifyOnlineStatus($val[$model->name]['online_status'],$val[$model->name]['id'], '/news/editStatus/');
            }
            
            if (isset($val[$model->name]['fk_id_map_objects'])) {
                $results[$key][$model->name]['fk_id_map_objects'] = $model->Location->getLocationName($val[$model->name]['fk_id_map_objects']);
            } 
            
            if (isset($val[$model->name]['fk_id_events'])) {
                $results[$key][$model->name]['fk_id_events'] = $model->Event->getEventName($val[$model->name]['fk_id_events']);
            } 
            
            if (isset($val[$model->alias]['creation_date'])) {
                //$results[$key][$model->alias]['creation_date'] = $model->formatTimeResult($val[$model->alias]['creation_date']);
            }

            if ($val[$model->alias]['title'] == null || empty($val[$model->alias]['title'])) {
                $results[$key][$model->alias]['title'] = '<i class="no-comment">Prazno</i>';
            }
            if ($val[$model->alias]['lid'] == null || empty($val[$model->alias]['lid'])) {
                $results[$key][$model->alias]['lid'] = '<i class="no-comment">Prazno</i>';
            }            
        }
    }
    
    
    public function modifyOnlineStatus($value, $key, $url) {
        $status = 'Nepoznato';
        switch ($value) {
            case 0:
                $status = '<a href="#" id="online_status" data-url="'.$url.'" class="editable editable-click online-status label label-sm label-danger" data-pk="'.$key.'" data-value="0" data-title="Izmjeni status">Offline</a>';
                break;
            case 1:
                $status = '<a href="#" id="online_status" data-url="'.$url.'" class="editable editable-click online-status label label-sm label-warning" data-pk="'.$key.'" data-value="1" data-title="Izmjeni status">Pending</a>';
                break;
            case 2;
                $status = '<a href="#" id="online_status" data-url="'.$url.'" class="editable editable-click online-status label label-sm label-success" data-pk="'.$key.'" data-value="2" data-title="Izmjeni status" data-original-title="" title="">Online</a>';
                break;
            default:
                break;
        }
        return $status;
    } 
}