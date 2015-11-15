<?php
App::uses('AppModel', 'Model');
/**
 * ProductsImage Model
 *
 * @property Product $Product
 */
class ProductImage extends AppModel {

	public $useTable = 'products_images';
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'fk_id_products',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
