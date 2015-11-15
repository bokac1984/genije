<?php
$root = $this->Html->link('Gradovi', array('controller' => 'cities', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root);
$this->assign('crumb', 'Novi grad');
$this->assign('breadcrumb-icon', $icon);

$this->assign('title', 'Gradovi');
$this->assign('page-title', $city['City']['name'] . ' <small>pregled podataka</small>');

// zbog neke gluposti nije radilo, pa mora prije svega da se ucita gmaps
echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', array('block' => 'scriptBottom'));
echo $this->Html->script('/assets/plugins/gmaps/gmaps.js', array('block' => 'scriptBottom'));


echo $this->Html->script('/js/cities/view', array('block' => 'scriptBottom'));
echo $this->Html->scriptBlock("
	var long = {$city['City']['longitude']};
	var lati = {$city['City']['latitude']};
	FormValidator.init();",
array('block' => 'scriptBottom')
);
?>
<div class="row">
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<div class="map" id="map1"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label"> Geografska širina <span class="symbol required"></span> </label>
					<input disabled="disabled" class="form-control tooltips" type="text" name="data[City][longitude]" id="longitude" value="<?php echo $city['City']['longitude'] ?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label"> Geografska dužina <span class="symbol required"></span> </label>
					<input disabled="disabled" class="form-control tooltips" type="text" name="data[City][latitude]" id="latitude" value="<?php echo $city['City']['latitude'] ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<h4>Weather code</h4>
		<?php
			echo $city['City']['weather_code'];
		?>
	</div>
</div>
