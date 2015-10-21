<?php

class KModule extends CWebModule {
	protected $_moduleAlias;
	protected $_assetsUrl;
	
	public function getAssetsUrl(){
		if ($this->_assetsUrl === null){
			$assetsFolder =  Yii::getPathOfAlias($this->_moduleAlias.'.assets');
			$this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsFolder, false, -1, YII_DEBUG);
		}
		return $this->_assetsUrl;
	}
	
}