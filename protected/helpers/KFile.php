<?php

class KFile {
	
	public static function readJSON($filename){
		return json_decode(file_get_contents($filename));
	}
	
	public static function mapStats($record) {
		return array(
			"hp" => @$record->api_taik,
			"fp" => @$record->api_houg,
			"ar" => @$record->api_souk,
			"tp" => @$record->api_raig,
			"ev" => @$record->api_kaih,
			"aa" => @$record->api_tyku,
			"ac" => @$record->api_tous,
			"as" => @$record->api_tais,
			"sp" => @$record->api_soku,
			"ls" => @$record->api_saku,
			"rn" => @$record->api_leng,
			"lk" => @$record->api_luck,
		);
	}
	
	public function ensureSWF($id, $filename){
		if(!file_exists('images/compare/swf/'.$id.'.swf')){
			@file_put_contents('images/compare/swf/'.$id.'.swf', @file_get_contents('http://203.104.209.71/kcs/resources/swf/ships/'.$filename.'.swf?VERSION='.time()));
		}
	}
	
	public function ensureCG($id, $filename){
		if(!file_exists('images/'.$id.'.jpg')){
			$s = new SWFextractImages();
			
			$a = @file_get_contents('http://203.104.209.71/kcs/resources/swf/ships/'.$filename.'.swf?VERSION='.time());
			if($a){
				$s->doExtractImages($id, $a);
			}
			unset($s);
		}
	}
	
	public function setAsCompareCG($type, $id, $filename){
		$s = new SWFextractImages();
		$a = @file_get_contents('http://203.104.209.71/kcs/resources/swf/ships/'.$filename.'.swf?VERSION='.time());
		if($a){
			$s->extractAsCompareCG($type, $id, $a);
		}
		unset($s);
	}
	
	public function ripMapImages($id, $num){
		$s = new SWFextractImages();
		
		$dest = 'images/maps/'.$id.'/'.$num.'.jpg';
		if(!file_exists($dest)){
			$a = @file_get_contents('http://203.104.209.71/kcs/resources/swf/map/'.$id.'_'.$num.'.swf');
			if($a){
				$s->extractMapImage($id, $num, $a);
			}
		}
	}
	
	public static function getVersions(){
		$allobj = glob('data/master/*');
		$masters = array();
		foreach($allobj as &$obj){
			if(is_dir($obj)){
				$obj = explode('/', $obj);
				$obj = array_pop($obj);
				array_push($masters, $obj);
			}
		}
		return $masters;
	}
	
	public static function rrmdir($dir) {
		foreach(glob($dir . '/*') as $file) {
			if(is_dir($file))
				self::rrmdir($file);
			else
				unlink($file);
		}
		rmdir($dir);
	}
	
	public function isIdentical($file_a, $file_b){
		if(filesize($file_a) == filesize($file_b)){
			return true;
		}
		return false;
	}
	
}