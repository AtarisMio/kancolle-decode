<?php
class StatusController extends KController {
	
	public function actionIndex(){
		Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().'/status.css');
		Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl().'/status.js', CClientScript::POS_END);
		$this->render('event.views.status', array(
		
		));
	}
	
	public function actionPing(){
		if(!isset($_REQUEST['ip'])){ $_REQUEST['ip'] = '203.104.209.39'; }
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://'.$_REQUEST['ip'].'/kcs/mainD2.swf');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		$response = curl_exec($ch); 
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$headers = explode("\r\n", substr($response, 0, $header_size));
		foreach($headers as $header){
			$expl = explode(": ", $header);
			if($expl[0]=='Last-Modified'){
				echo date("Y-m-d H:i:s", strtotime($expl[1]));
			}
		}
	}
	
}