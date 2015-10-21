<?php
class RecordController extends KController {

	public function actionIndex($date, $master, $id){
		$data = KFile::readJSON('data/master/'.$date.'/'.$master.'/'.$id.'.json');
		$labels = KFile::readJSON('data/json/fieldNames.json');
		$this->render('decodes.views.record', array(
			'labels' => $labels,
			'data' => $data,
		));
	}
	
	public function actionMaster($date, $master){
		$records = glob('data/master/'.$date.'/'.$master.'/*.json');
		
		$this->render('decodes.views.master', array(
			'records' => $records,
		));
	}
	
}