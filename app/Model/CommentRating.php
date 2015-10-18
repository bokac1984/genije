<?php
App::uses('AppModel', 'Model');
/**
 * CommentRating Model
 *
 */
class CommentRating extends AppModel {
       
    public $useTable = 'map_objects_comments_ratings'; 
    public $primaryKey = 'id';

    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'fk_id_map_objects_comments',
        ),
    );
}
