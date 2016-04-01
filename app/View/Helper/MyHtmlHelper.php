<?php
App::uses('HtmlHelper', 'View/Helper');

/**
 * Description of Display
 *
 * @author bokac
 */
class MyHtmlHelper extends HtmlHelper {
    
    /**
     * Ovom metodom printamo zamjenski tekst ako je polje u bazi prazno
     * 
     * @param string $field Vriejdnost polja za koje gledamo je li prazno
     * @param string $customText text koji mozemo da unesemo
     * @return string Vrijednost koja ce se stampati na kraju
     */
    public function displayEmpty($field, $customText = 'Prazno') {
        if ($field === null || empty($field)) {
            return "<i class=\"no-comment\">$customText</i>";
        }
        
        return $field;
    }
    
    public function displayStatus($status) {
        $displayValue = array(
            'class' => 'label-info',
            'value' => 'Offline'
        );
        switch($status) {
            case 0: 
                $displayValue = array(
                    'class' => 'label-danger',
                    'value' => 'Offline'
                );
                break;
            case 1: 
                $displayValue = array(
                    'class' => 'label-warning',
                    'value' => 'Pending'
                );
                break;
            case 2: 
                $displayValue = array(
                    'class' => 'label-success',
                    'value' => 'Online'
                );
                break;           
            default:
                break;
        }
        return "<span class=\"label label-sm {$displayValue['class']}\">{$displayValue['value']}</span>";
    }
    
    public function displayCouponCheckerStatus($status) {
        $displayValue = array(
            'class' => 'label-danger',
            'value' => 'Neaktivan'
        );
        if ($status) {
            $displayValue = array(
                'class' => 'label-success',
                'value' => 'Aktivan'
            );
        }
        return "<span class=\"label label-sm {$displayValue['class']}\">{$displayValue['value']}</span>";
    }    
    
    
    public function displayStatusNotify($status) {
        $displayValue = array(
            'class' => 'label-info',
            'value' => 'Offline'
        );
        switch($status) {
            case 0: 
                $displayValue = array(
                    'class' => 'label-danger',
                    'value' => 'Obrisana'
                );
                break;
            case 1: 
                $displayValue = array(
                    'class' => 'label-warning',
                    'value' => 'Poslana'
                );
                break;
            case 2: 
                $displayValue = array(
                    'class' => 'label-success',
                    'value' => 'Pročitana'
                );
                break;           
            default:
                break;
        }
        return "<span class=\"label label-sm {$displayValue['class']}\">{$displayValue['value']}</span>";
    }    
    public function displayCouponStatus($status) {
        $displayValue = array(
            'class' => 'label-info',
            'value' => 'Offline'
        );
        switch($status) {
            case 1: 
                $displayValue = array(
                    'class' => 'label-warning',
                    'value' => 'Assigned'
                );
                break;
            case 2: 
                $displayValue = array(
                    'class' => 'label-success',
                    'value' => 'Checked'
                );
                break;           
            default:
                break;
        }
        return "<span class=\"label label-sm {$displayValue['class']}\">{$displayValue['value']}</span>";
    }    
    
    public function emptyLink($id, $name, $url, $customText = 'Prazno') {
        if (empty($id)) {
            return $this->displayEmpty(null,$customText);
        }
        array_push($url, $id); // postavi id na kraj niza $url
        return $this->link($name, $url);
    }

    public function showProducts($status) {
        if ($status == 0) {
            return "<span class=\"label label-sm label-danger\">Ne</span>";
        }
        return "<span class=\"label label-sm label-success\">Da</span>";
    }
    
    /**
     * 
     * @param type $value
     * @param type $key
     * @param type $url
     * @return string
     */
    public function onlineStatus($value, $key, $url) {
        $status = 'Nepoznato';
        switch ($value) {
            case 0:
                $status = '<a href="#" data-name="can_do_checks" data-type="select" data-url="'.$url.'" class="editable editable-click can-do-checks label label-sm label-danger" data-pk="'.$key.'" data-value="0" data-title="Promjeni dozvolu">Nedozvoljeno</a>';
                break;
            case 1:
                $status = '<a href="#" data-name="can_do_checks" data-type="select" data-url="'.$url.'" class="editable editable-click can-do-checks label label-sm label-success" data-pk="'.$key.'" data-value="1" data-title="Promjeni dozvolu">Dozvoljeno</a>';
                break;
            default:
                break;
        }
        return $status;
    } 
    
    /**
     * Statusi banera
     * 
     * @param int $value Vrijednost status
     * @param int $key ID datog bannera
     * @param string $url adresa na kojoj ce se to mijenjati
     * @return string
     */
    public function bannerStatus($value, $key, $url) {
        $status = 'Nepoznato';
        switch ($value) {
            case 0:
                $status = '<a href="#" data-name="status" data-type="select" data-url="'.$url.'" class="editable editable-click banner-status label label-sm label-danger" data-pk="'.$key.'" data-value="0" data-title="Promjeni status">Offline</a>';
                break;
            case 1:
                $status = '<a href="#" data-name="status" data-type="select" data-url="'.$url.'" class="editable editable-click banner-status label label-sm label-warning" data-pk="'.$key.'" data-value="1" data-title="Promjeni status">Pending</a>';
                break;
            case 2:
                $status = '<a href="#" data-name="status" data-type="select" data-url="'.$url.'" class="editable editable-click banner-status label label-sm label-success" data-pk="'.$key.'" data-value="2" data-title="Promjeni status">Online</a>';
                break;            
            default:
                break;
        }
        return $status;
    }     
}