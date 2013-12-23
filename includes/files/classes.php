<?php

// Create a new instance of a banner
class Banner {
	
	private $images = array(); // the banner images array
	private $width; // the width of the banner
	private $height; // the height of the banner
	
	function __construct($width,$height) {
		if((empty($width)) || (empty($height))) {
			throw new Exception("Banner Dimensions need to be set. Width = $width, Height = $height");
		}
		$this->width = $width;
		$this->height = $height;
	}
	
	function addImage($arr) {
		// Check the image exists on the server
		$file = $arr['file'];
		if ( $fileAtt = getimagesize($file) ) {
    		if( $fileAtt ==! false ) {
				// Has a valid image, get the dimensions
				list($imgWidth,$imgHeight) = $fileAtt;
				if($imgWidth != $this->$width) { // Width of the image does not match the width of the banner
					echo "File ($fileAtt) width (".$imgWidth.") does not match the width of the banner (".$this->width.").";
					return false;					
				}
				if($imgHeight != $this->$height) { // Width of the image does not match the width of the banner
					echo "File ($fileAtt) height (".$imgheight.") does not match the height of the banner (".$this->height.").";
					return false;					
				}
				// Has validated image with banner. Add it to the Class
				$this->images[] = $fileAtt;
			} else {
				echo "File ($fileAtt) does not exist on the server.";
				return false;
			}
		}
	}
	
	
	
}


?>