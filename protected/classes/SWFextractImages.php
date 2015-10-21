<?php
class SWFextractImages {
    private $swf;
    private $jpegTables;
	
    private $shipID;
    private $compareType;
	
    private $mapID;
    private $mapNum;
    
	/* CARDS
	--------------------------------------*/
    public function doExtractImages($shipID, $b) {
		$this->shipID = $shipID;
		$this->swf = new SWF($b);
		$this->jpegTables = '';
		foreach ($this->swf->tags as $tag) {
			if($tag['type']==6){
				if($this->defineBits($tag)){
					continue;
				}
			}
		}
    }
	
    private function defineBits($tag) {
		$ret = $this->swf->parseTag($tag);
		$imageData = $ret['imageData'];
		if (strlen($this->jpegTables) > 0) {
			$imageData = substr($this->jpegTables, 0, -2) . substr($imageData, 2);
		}
		if($ret['characterId']==5){
			$filename = sprintf('images/'.$this->shipID.'.jpg', $ret['characterId']);
			file_put_contents($filename, $imageData);
			return true;
		}
    }
	
	/* ART COMPARE
	--------------------------------------*/
	public function extractAsCompareCG($type, $shipID, $b){
		$this->compareType = $type;
		$this->shipID = $shipID;
		$this->swf = new SWF($b);
		$this->jpegTables = '';
		foreach ($this->swf->tags as $tag) {
			if($tag['type']==35){
				if($this->defineBitsForOld($tag)){
					continue;
				}
			}
		}
    }
	
	 private function defineBitsForOld($tag) {
		$ret = $this->swf->parseTag($tag);
		$imageData = $ret['imageData'];
		if($ret['characterId']==17){
			$filename = sprintf('images/compare/'.$this->compareType.'/'.$this->shipID.'.jpg');
			file_put_contents($filename, $imageData);
			return true;
		}
    }
	
	/* MAPS
	--------------------------------------*/
	public function extractMapImage($id, $num, $b){
		$this->mapID = $id;
		$this->mapNum = $num;
		$this->swf = new SWF($b);
		$this->jpegTables = '';
		foreach ($this->swf->tags as $tag) {
			if($tag['type']==35){
				if($this->defineBitsMap($tag)){
					continue;
				}
			}
		}
    }
	
	 private function defineBitsMap($tag) {
		$ret = $this->swf->parseTag($tag);
		if($ret['characterId']==1){
			$imageData = $ret['imageData'];
			if(!file_exists('images/maps/'.$this->mapID)){ mkdir('images/maps/'.$this->mapID); }
			$filename = sprintf('images/maps/'.$this->mapID.'/'.$this->mapNum.'.jpg');
			file_put_contents($filename, $imageData);
		}
		return true;
    }
}