<?php
App::uses('HtmlHelper', 'View/Helper');

/**
 * Description of Display
 *
 * @author bokac
 */
class StarHelper extends HtmlHelper {
    
    public $settings = array(
        'starSign' => '\ue006',
        'percentFull' => 5,
        'size' => 'xs',
        'numberOfStars' => 5
    );
    
    public $content = '';


    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
    }
    
    public function afterRender($viewFile) {
        parent::afterRender($viewFile);
        $this->script('/js/libs/stars/star-rating', array('block' => 'scriptBottom'));
        $this->css('/js/libs/stars/star-rating', array('block' => 'css'));
    }

    public function calculateWidth($value = null) {
        return $value / $this->settings['percentFull'] * 100;
    }

    public function star($starValue = null, $options = array()) {
        $width = $this->calculateWidth($starValue);
        
        if (isset($options['size'])) {
            $this->settings['size'] = $options['size'];
        }
        
        $this->prepareStars();
        $starHTML = <<<EOD
<div class="star-rating rating-{$this->settings['size']} rating-disabled">
    <div class="rating-container rating-gly-star" data-content="$this->content">
        <div class="rating-stars" data-content="$this->content" style="width: $width%;"></div>
        <input class="stars-location form-control hide" value="$starValue">
    </div>
</div>
EOD;
        return $starHTML;
        
    }
    
    public function prepareStars() {
        $this->content = '';
        for ($i = 0; $i < $this->settings['numberOfStars']; $i++) {
            $this->content .= json_decode('"'.$this->settings['starSign'].'"');
        }
    }

}
?>

