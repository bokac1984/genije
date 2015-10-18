<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 */
class ContactType extends AppModel {    
    public $useTable = 'contact_types';
    public $displayField = 'name';
}
