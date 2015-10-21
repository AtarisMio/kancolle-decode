<?php

/*
    SWFextractImages.php: Utility to extract images from Macromedia Flash (SWF) files
    Copyright (C) 2012 Thanos Efraimidis (4real.gr)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


class SWFextractImages {
    private $swf; // SWF file parser
    private $jpegTables;
    
    public function doExtractImages($b) {
	$this->swf = new SWF($b); // Parse .swf file
	$this->jpegTables = '';
	echo '<pre>';
	
	// Collect and process DefineBits, JPEGTables, DefineBitsJPEG... and DefineBitsLossless... tags
	foreach ($this->swf->tags as $tag) {
	    switch ($tag['type']) {
	    case 6: // DefineBits
			
			$this->defineBits($tag); print_r($tag);
		break;
	    case 8: // JPEGTables
		$this->jpegTables($tag); print_r($tag);
		break;
	    case 20: // DefineBitsLossless
		$this->defineBitsLossless($tag); print_r($tag);
		break;
	    case 21: // DefineBitsJPEG2
		$this->defineBitsJPEG23($tag); print_r($tag);
		break;
	    case 36: // DefineBitsLossless2
		$this->defineBitsLossless2($tag); print_r($tag);
		break;
	    case 35: // DefineBitsJPEG3
		$this->defineBits($tag);
		// $this->defineBitsJPEG23($tag);
		print_r($tag);
		break;
	    case 90: // DefineBitsJPEG4
		$this->defineBitsJPEG4($tag); print_r($tag);
		break;
	    }
	}
	echo '</pre>';
    }

    private function jpegTables($tag) {
	// Save 'JPEGData'
	$ret = $this->swf->parseTag($tag);
	$this->jpegTables = $ret['JPEGData'];
    }

    private function defineBits($tag) {
	$ret = $this->swf->parseTag($tag);

	$imageData = $ret['imageData'];
	if (strlen($this->jpegTables) > 0) {
	    // Concatenate JPEGData and imageData
	    $imageData = substr($this->jpegTables, 0, -2) . substr($imageData, 2);
	}
	file_put_contents(sprintf('images/extract/img_%d.jpg', $ret['characterId']), $imageData);
    }

    private function defineBitsJPEG23($tag) {
	$ret = $this->swf->parseTag($tag);
	
	$imageData = $ret['imageData'];

	if (($extension = $this->guessExtension($imageData)) == null) {
	    error_log(sprintf('DefineBitsJPEG2: Cannot determine image type, skipping...'));
	    echo sprintf("[%s]\n", substr($imageData, 0, 8));
	    return;
	}
	file_put_contents(sprintf('images/img_%d.%s', $ret['characterId'], $extension), $imageData);
    }

    private function defineBitsJPEG4($tag) {
	// TODO
    }

    private function defineBitsLossless($tag) {
	$ret = $this->swf->parseTag($tag);

	$bitmapFormat = $ret['bitmapFormat'];
	$bitmapWidth = $ret['bitmapWidth'];
	$bitmapHeight = $ret['bitmapHeight'];
	$pixelData = $ret['pixelData'];

	$img = imageCreateTrueColor($bitmapWidth, $bitmapHeight);
	
	if ($bitmapFormat == 3) {
	    $colorTable = $ret['colorTable'];

	    // Construct the colormap
	    $colors = array();
	    $i = 0;
	    $len = strlen($colorTable);
	    while ($i < $len) {
		$red = ord($colorTable[$i++]);
		$green = ord($colorTable[$i++]);
		$blue = ord($colorTable[$i++]);
		$colors[] = imageColorAllocate($img, $red, $green, $blue);
	    }

	    $bytesPerRow = $this->alignTo4bytes($bitmapWidth * 1); // 1 byte per sample

	    // Construct the image
	    for ($row = 0; $row < $bitmapHeight; $row++) {
		$off = $bytesPerRow * $row;
		for ($col = 0; $col < $bitmapWidth; $col++) {
		    $idx = ord($pixelData[$off++]);
		    imageSetPixel($img, $col, $row, $colors[$idx]);
		}
	    }
	} else if ($bitmapFormat == 4) {
	    $bytesPerRow = $this->alignTo4bytes($bitmapWidth * 2); // 2 bytes per sample
	    
	    // Construct the image
	    for ($row = 0; $row < $bitmapHeight; $row++) {
		$off = $bytesPerRow * $row;
		for ($col = 0; $col < $bitmapWidth; $col++) {
		    $lo = ord($pixelData[$off++]);
		    $hi = ord($pixelData[$off++]);
		    $rgb = $lo + $hi * 256;
		    $red = ($rgb >> 10) & 0x1f; // 5 bits
		    $green = ($rgb >> 5) & 0x1f; // 5 bits
		    $blue = ($rgb) & 0x1f; // 5 bits
		    $color = imageColorAllocate($img, $red, $green, $blue);
		    imageSetPixel($img, $col, $row, $color);
		}
	    }
	} else if ($bitmapFormat == 5) {
	    $bytesPerRow = $this->alignTo4bytes($bitmapWidth * 4); // 4 bytes per sample

	    // Construct the image
	    for ($row = 0; $row < $bitmapHeight; $row++) {
		$off = $bytesPerRow * $row;
		for ($col = 0; $col < $bitmapWidth; $col++) {
		    $off++; // Reserved
		    $red = ord($pixelData[$off++]);
		    $green = ord($pixelData[$off++]);
		    $blue = ord($pixelData[$off++]);
		    $color = imageColorAllocate($img, $red, $green, $blue);
		    imageSetPixel($img, $col, $row, $color);
		}
	    }
	}
	imagePNG($img, sprintf('images/img_%d.png', $ret['characterId']));
	imageDestroy($img);
    }

    private function defineBitsLossless2($tag) {
	$ret = $this->swf->parseTag($tag);

	$bitmapFormat = $ret['bitmapFormat'];
	$bitmapWidth = $ret['bitmapWidth'];
	$bitmapHeight = $ret['bitmapHeight'];
	$pixelData = $ret['pixelData'];

	$img = imageCreateTrueColor($bitmapWidth, $bitmapHeight);
	imageAlphaBlending($img, false);
	imageSaveAlpha($img, true);

	if ($bitmapFormat == 3) {
	    $colorTable = $ret['colorTable'];

	    // Construct the colormap
	    $colors = array();
	    $i = 0;
	    $len = strlen($colorTable);
	    while ($i < $len) {
		$red = ord($colorTable[$i++]);
		$green = ord($colorTable[$i++]);
		$blue = ord($colorTable[$i++]);
		$alpha = ord($colorTable[$i++]);
		$alpha = 127 - floor($alpha / 2); // Alpha correction to PHP values
		$colors[] = imageColorAllocateAlpha($img, $red, $green, $blue, $alpha);
	    }

	    $bytesPerRow = $this->alignTo4bytes($bitmapWidth * 1); // 1 byte per sample
	    
	    // Construct the image
	    for ($row = 0; $row < $bitmapHeight; $row++) {
		$off = $bytesPerRow * $row;
		for ($col = 0; $col < $bitmapWidth; $col++) {
		    $idx = ord($pixelData[$off++]);
		    imageSetPixel($img, $col, $row, $colors[$idx]);
		}
	    }
	} else if ($bitmapFormat == 5) {
	    $bytesPerRow = $this->alignTo4bytes($bitmapWidth * 4); // 4 byte per sample

	    // Construct the image
	    for ($row = 0; $row < $bitmapHeight; $row++) {
		$off = $bytesPerRow * $row;
		for ($col = 0; $col < $bitmapWidth; $col++) {
		    $alpha = ord($pixelData[$off++]);
		    $red = ord($pixelData[$off++]);
		    $green = ord($pixelData[$off++]);
		    $blue = ord($pixelData[$off++]);
		    $alpha = 127 - floor($alpha / 2); // Alpha correction to PHP values
		    $color = imageColorAllocateAlpha($img, $red, $green, $blue, $alpha);
		    imageSetPixel($img, $col, $row, $color);
		}
	    }
	}
	imagePNG($img, sprintf('images/img_%d.png', $ret['characterId']));
	imageDestroy($img);
    }

    private function alignTo4Bytes($num) {
	while (($num % 4) != 0) {
	    $num++;
	}
	return $num;
    }

    private function guessExtension($imageData) {
	if (strlen($imageData) > 2 && strcmp(substr($imageData, 0, 2), "\xff\xd8") == 0) {
	    return 'jpg';
	} else if (strlen($imageData) > 2 && strcmp(substr($imageData, 0, 2), "\xff\xd9") == 0) { // Erroneous older header
	    return 'jpg';
	} else if (strlen($imageData) > 8 && strcmp(substr($imageData, 0, 8), "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A") == 0) {
	    return 'png';
	} else if (strlen($imageData) > 6 && strcmp(substr($imageData, 0, 6), "\x47\x49\x46\x38\x39\x61") == 0) {
	    return 'gif';
	} else {
	    return null;
	}
    }
}

?>