<?php

App::uses('Component', 'Controller');
App::uses('DataTableConfig', 'DataTable.Controller/Component/DataTable');

/**
 * DataTable Component
 *
 * Available options:
 * - `columns` Defines column aliases and settings for sorting and searching.
 *   The keys will be fields to use and by default the label via Inflector::humanize()
 *   If the value is a string, it will be used as the label.
 *   If the value is false, bSortable and bSearchable will be set to false.
 *   If the value is null, the column will not be tied to a field and the key will be used for the label
 *   If the value is an array, it takes on the possible options:
 *    - `label` Label for the column
 *    - `bSearchable` A string may be passed instead which will be used as a model callback for extra user-defined
 *       processing
 *    - All of the DataTable column options, see @link http://datatables.net/usage/columns
 * - `scope` Scope of results to be searched and pagianated upon.
 * - `viewVar` Name of the view var to set the results to. Defaults to dtResults.
 * - `maxLimit` The maximum limit users can choose to view. Defaults to 100
 *
 * @package Plugin.DataTable
 * @subpackage Plugin.DataTable.Controller.Component
 * @author Tigran Gabrielyan
 */
class DataTableComponent extends Component {

    /**
     * Initialize this component
     *
     * @param Controller $controller
     * @return void
     */
    public function initialize(Controller $controller) {
        $this->Controller = $controller;
    }

    /**
     * Main processing logic for DataTable
     *
     * @param mixed $object
     * @param mixed $scope
     * @return DataTableConfig
     */
    public function paginate($name = null, $scope = array()) {
        if ($name === null) {
            $name = $this->Controller->request->params['action'];
        }

        $config = new DataTableConfig($name, $this->settings);
        $config->conditions = array_merge($config->conditions, $scope);
        
        $Model = $this->_getModel($config->model);
        $iTotalRecords = $Model->find('count', $config->getCountQuery());

        $this->_sort($config);
        $this->_search($config, $Model);
        $this->_paginate($config);

        $iTotalDisplayRecords = $Model->find('count', $config->getCountQuery());
        $results = $Model->find('all', $config->getQuery());

        $aaData = array();
        if ($config->autoData) {
            foreach ($results as $result) {
                $row = [];
                foreach ($config->columns as $column => $options) {
                    if (!$options['useField']) {
                        if ($column === 'Actions') {
                            // ovdje pozvati metodu koja svicuje izmedju modela
                            $row[] = $this->setColumnActions($config->model,$result);
                        } else {
                            $row[] = null;
                        }
                    } else {
                        if ($column === 'News.show_products') {
                            $row[] = $this->setProductHtml($config->model,$result);
                        } else {
                            
                            $value = Hash::extract($result, $column);
                            $row[] = $value ? $value[0] : null;
                        }
                    }
                }
                $aaData[] = $row;
            }
        }

        $dataTableData = array(
            'iTotalRecords' => $iTotalRecords,
            'iTotalDisplayRecords' => $iTotalDisplayRecords,
            'sEcho' => (int) Hash::get($this->_getParams(), 'sEcho'),
            'aaData' => $aaData,
        );

        if ($config->autoData && $config->autoRender) {
            $this->Controller->viewClass = 'Json';
            $this->Controller->set(compact('dataTableData'));
            $this->Controller->set('_serialize', 'dataTableData');
        } else {
            $this->Controller->viewClass = 'DataTable.DataTableResponse';
            $this->Controller->view = $config->view;
            $this->Controller->set($config->viewVar, $results);
            $this->Controller->set(compact('dataTableData'));
        }

        return $config;
    }
    
    public function setColumnActions($model, $result) {
        $a = '';
        switch($model) {
            case 'Location':
                $a = $this->setLocationColumns($model,$result);
                break;
            case 'Event':
                $a = $this->setEventsColumns($model,$result);
                break;
            case 'News':
                $a = $this->setNewsColumns($model,$result);
                break;
            case 'Product':
                $a = $this->setProductsColumns($model,$result);
                break;
            default:
                ;
                break;
        }
        return $a;
    }
    
    public function setLocationColumns($model, $result) {
        $location = $this->base . '/locations/edit/' . $result[$model]['id'];
        $gal = $this->base . '/locations/gallery/' . $result[$model]['id'];
        $row = '<div class="visible-md visible-lg hidden-sm hidden-xs">
                    <a href="' . $location . '" class="btn btn-xs btn-teal tooltips btn-edit" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="' . $gal . '" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Pictures"><i class="fa fa-picture-o"></i></a>
                    <a href="#" class="btn btn-xs btn-bricky tooltips btn-delete" data-placement="top" data-original-title="Remove" data-pk="' . $result[$model]['id'] . '" name=""><i class="fa fa-times fa fa-white"></i></a>
            </div>';
        return $row;
    }
    
    public function setEventsColumns($model, $result) {
        $event = $this->base . '/events/edit/' . $result[$model]['id'];
        $view = $this->base . '/events/view/' . $result[$model]['id'];
        $row = '<div class="visible-md visible-lg hidden-sm hidden-xs">
                    <a href="' . $event . '" class="btn btn-xs btn-teal tooltips btn-edit" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="' . $view . '" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Pictures"><i class="fa fa-eye"></i></a>
                    <a href="#" class="btn btn-xs btn-bricky tooltips btn-delete" data-placement="top" data-original-title="Remove" data-pk="' . $result[$model]['id'] . '" name=""><i class="fa fa-times fa fa-white"></i></a>
            </div>';
        return $row;
    }  
    
    public function setNewsColumns($model, $result) {
        $event = $this->base . '/news/edit/' . $result[$model]['id'];
        $gal = $this->base . '/news/images/' . $result[$model]['id'];
        $row = '<div class="visible-md visible-lg hidden-sm hidden-xs">
                    <a href="' . $event . '" class="btn btn-xs btn-teal tooltips btn-edit" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="' . $gal . '" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Pictures"><i class="fa fa-picture-o"></i></a>
                    <a href="#" class="btn btn-xs btn-bricky tooltips btn-delete" data-placement="top" data-original-title="Remove" data-pk="' . $result[$model]['id'] . '" name=""><i class="fa fa-times fa fa-white"></i></a>
            </div>';
        return $row;
    }

    public function setProductsColumns($model, $result) {
        $product = $this->base . '/products/edit/' . $result[$model]['id'];
        $gal = $this->base . '/products/view/' . $result[$model]['id'];
        $img = $this->base . '/products/gallery/' . $result[$model]['id'];
        $row = '<div class="visible-md visible-lg hidden-sm hidden-xs">
                    <a href="' . $product . '" class="btn btn-xs btn-teal tooltips btn-edit" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="' . $gal . '" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Pregled"><i class="fa fa-eye"></i></a>
                        <a href="' . $img . '" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Galerija"><i class="fa fa-picture-o"></i></a>
                    <a href="#" class="btn btn-xs btn-bricky tooltips btn-delete" data-placement="top" data-original-title="Remove" data-pk="' . $result[$model]['id'] . '" name=""><i class="fa fa-times fa fa-white"></i></a>
            </div>';
        return $row;
    }
    /**
     * Prikazi ono dugme za "prikazi proizvode"
     * @param type $model
     * @param type $result
     * @return string
     */
    public function setProductHtml($model, $result) {
        $product = $result[$model]['show_products'] ? "checked" : "";
        $row = '<div class="switch switch-mini" data-on-label="Da" data-pk="'.$result[$model]['id'].'" data-off-label="Ne" data-on="success" data-off="danger">
                            <input type="checkbox" id="show_products" name="show_products" '.$product.'>
                        </div>';
        return $row; 
    }

    /**
     * Sets view vars needed for the helper
     *
     * @param array|string $names
     * @return void
     */
    public function setViewVar($names) {
        $dtColumns = array();
        foreach ((array) $names as $name) {
            $dtColumns[$name] = (new DataTableConfig($name, $this->settings))->columns;
        }
        $this->Controller->set(compact('dtColumns'));
    }

    /**
     * Sets pagination limit and page
     *
     * @param DataTableConfig $config
     * @return void
     */
    protected function _paginate(DataTableConfig $config) {
        $params = $this->_getParams();
        if (!isset($params['iDisplayLength'], $params['iDisplayStart'])) {
            return;
        }

        $config->limit = min($params['iDisplayLength'], $config->maxLimit);
        $config->offset = $params['iDisplayStart'];
    }

    /**
     * Adds conditions to filter results
     *
     * @param DataTableConfig $config
     * @param Model $Model
     * @return void
     */
    protected function _search(DataTableConfig $config, Model $Model) {
        $i = 0;
        $conditions = array();
        $params = $this->_getParams();
        $searchTerm = Hash::get($params, 'sSearch');
        foreach ($config->columns as $column => $options) {
            if ($options['useField']) {
                $searchable = (boolean)$options['bSearchable'];
                if ($searchable === false) {
                    $i++;
                    continue;
                }
                $searchKey = "sSearch_$i";
                $columnSearchTerm = Hash::get($params, $searchKey);

                if ($searchTerm && ($searchable === true || $searchable === DataTableConfig::SEARCH_GLOBAL)) {
                    $conditions[] = array("$column LIKE" => '%' . $searchTerm . '%');
                }
                if ($columnSearchTerm && ($searchable === true || $searchable === DataTableConfig::SEARCH_COLUMN)) {
                    $conditions[] = array("$column LIKE" => '%' . $columnSearchTerm . '%');
                }
                if ($columnSearchTerm === '0' && ($searchable === true || $searchable === DataTableConfig::SEARCH_COLUMN)) {
                    $conditions[] = array("$column LIKE" => '%' . $columnSearchTerm . '%');
                }
                if (is_callable(array($Model, $searchable))) {
                    $Model->$searchable($column, $searchTerm, $columnSearchTerm, $config);
                }
            }
            $i++;
        }
        if (!empty($conditions)) {
            $config->conditions['AND'] = Hash::merge((array) Hash::get($config->conditions, 'AND'), $conditions);
        }
    }

    /**
     * Sets sort field and direction
     *
     * @param DataTableConfig $config
     * @return void
     */
    protected function _sort(DataTableConfig $config) {
        $params = $this->_getParams();
        for ($i = 0; $i < count($config->columns); $i++) {
            $sortColKey = "iSortCol_$i";
            if (!isset($params[$sortColKey])) {
                continue;
            }

            $column = Hash::get(array_keys($config->columns), $params[$sortColKey]);
            if (!$column || !$config->columns[$column]['bSortable']) {
                continue;
            }

            $direction = Hash::get($params, "sSortDir_$i") ? : 'asc';
            $config->order[$column] = in_array(strtolower($direction), array('asc', 'desc')) ? $direction : 'asc';
        }
    }

    /**
     * Gets the model to be paginated
     *
     * @param string $model Name of the model to load
     * @return Model
     */
    protected function _getModel($model) {
        $this->Controller->loadModel($model);
        return $this->Controller->$model;
    }

    /**
     * Gets datatable request params
     *
     * @return array
     */
    protected function _getParams() {
        $property = $this->Controller->request->is('get') ? 'query' : 'data';
        return $this->Controller->request->$property;
    }

}
