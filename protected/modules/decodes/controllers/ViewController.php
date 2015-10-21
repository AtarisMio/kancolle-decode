<?php
class ViewController extends KController {
	public $layout = 'listing';
	
	public function actionIndex($date=null){
		if(!$date){
			$versions = KFile::getVersions();
			$date = $versions[count($versions)-1];
		}
		Yii::app()->params['activeVersion'] = $date;
		
		if(!file_exists('data/master/'.$date.'/changes.json')){
			$this->viewUnprocessed($date);
		}else{
			$this->viewExisting($date);
		}
	}
	
	private function viewUnprocessed($date){
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/process.css');
		$this->render('decodes.views.process', array(
			'date' => $date,
		));
	}
	
	private function viewExisting($date){
		$changes = KFile::readJSON('data/master/'.$date.'/changes.json');
		$stypes = KFile::readJSON('data/master/'.$date.'/stype/_summary.json');
		$slotitems = KFile::readJSON('data/master/'.$date.'/slotitem/_summary.json');
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/listing.css');
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/css/view.css');
		Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl().'/js/view.js', CClientScript::POS_END);
		$this->render('decodes.views.view', array(
			'date' => $date,
			'changes' => $changes,
			'stypes' => $stypes,
			'slotitems' => $slotitems,
			'speeds' => array(0=>"N/A", 5=>"Slow", 10=>"Fast"),
			'ranges' => array("N/A","Short","Medium","Long","Very Long"),
			'rarity' => array("","SkyBlue","SkyBlue","Cyan","Silver","Gold","Violet","Violet","Violet"),
		));
	}
	
	public function actionImage($date){
		$changes = KFile::readJSON('data/master/'.$date.'/changes.json');
		$stypes = KFile::readJSON('data/master/'.$date.'/stype/_summary.json');
		$slotitems = KFile::readJSON('data/master/'.$date.'/slotitem/_summary.json');
		
		$this->layout = '';
		$this->render('decodes.views.image', array(
			'date' => $date,
			'changes' => $changes,
			'stypes' => $stypes,
			'slotitems' => $slotitems,
			'speeds' => array(0=>"N/A", 5=>"Slow", 10=>"Fast"),
			'ranges' => array("N/A","Short","Medium","Long","Very Long"),
			'rarity' => array("","SkyBlue","SkyBlue","Cyan","Silver","Gold","Violet","Violet","Violet"),
		));
	}
	
}