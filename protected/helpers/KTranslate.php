<?php

class KTranslate {

	private static function loadTranslationFiles(){
		if(isset(Yii::app()->params['translations'])){ return true; }
		$allTLs = array();
		$allTLs = array_merge($allTLs, (array)KFile::readJSON('data/translations/furniture.json'));
		$allTLs = array_merge($allTLs, (array)KFile::readJSON('data/translations/ship.json'));
		$allTLs = array_merge($allTLs, (array)KFile::readJSON('data/translations/slotitem.json'));
		$allTLs = array_merge($allTLs, (array)KFile::readJSON('data/translations/stype.json'));
		$allTLs = array_merge($allTLs, (array)KFile::readJSON('data/translations/useitem.json'));
		Yii::app()->params['translations'] = $allTLs;
	}
	
	public static function t($kanji, $type='ship'){
		self::loadTranslationFiles();
		$T = Yii::app()->params['translations'];
		
		$last1 = mb_substr($kanji,-1,1, "utf-8");
		$bare1 = mb_substr($kanji,0,-1, "utf-8");
		$last2 = mb_substr($kanji,-2,2, "utf-8");
		$bare2 = mb_substr($kanji,0,-2, "utf-8");
		$last4 = mb_substr($kanji,-4,4, "utf-8");
		$bare4 = mb_substr($kanji,0,-4, "utf-8");
		
		if(isset($T[$kanji])){
			$romaji = $T[$kanji];
		}else{
			if($last1=="改"){
				if(isset($T[$bare1])){
					$romaji = $T[$bare1]." Kai";
				}else{
					$romaji = "";
				}
			}else if($last1=="*"){
				if(isset($T[$bare1])){
					$romaji = $T[$bare1]."*";
				}else{
					$romaji = "";
				}
			}else if($last2=="改二"){
				if(isset($T[$bare2])){
					$romaji = $T[$bare2]." Kai2";
				}else{
					$romaji = "";
				}
			}else if($last4=="zwei"){
				if(isset($T[$bare4])){
					$romaji = $T[$bare4]." Zwei";
				}else{
					$romaji = "";
				}
			}else{
				$romaji = "";
			}
		}
		
		if($romaji==""){
			return '['.$kanji.']?';
		}else{
			return $romaji;
		}
	}
	
	public function custom($type, $JP){
		if(!isset(Yii::app()->params['custom_TL_'.$type])){
			Yii::app()->params['custom_TL_'.$type] = KFile::readJSON('data/json/'.$type.'.json');
		}
		if(isset(Yii::app()->params['custom_TL_'.$type]->{$JP})){
			return Yii::app()->params['custom_TL_'.$type]->{$JP};
		}else{
			return false;
		}
	}
	
}