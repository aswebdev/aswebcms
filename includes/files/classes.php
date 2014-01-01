<?php

// Create a new instance of a slideshow
class Slideshow {
	
	private $images = array(); // the slideshow images array
	private $width; // the width of the slideshow
	private $height; // the height of the slideshow
	
	public function __construct($width,$height) {
		if((empty($width)) || (empty($height))) {
			throw new Exception("Slideshow Dimensions need to be set. Width = $width, Height = $height");
		}
		$this->width = $width;
		$this->height = $height;
	}
	
	// Adds an image file to the slideshow
	public function addImage($file) {
		// Check the image exists on the server
		if ( $fileAtt = getimagesize($file) ) {
    		if( $fileAtt ==! false ) {
				// Has a valid image, get the dimensions
				list($imgWidth,$imgHeight) = $fileAtt;
				if($imgWidth != $this->width) { // Width of the image does not match the width of the slideshow
					echo "File ($fileAtt) width (".$imgWidth.") does not match the width of the banner (".$this->width.").";
					return false;					
				}
				if($imgHeight != $this->height) { // Width of the image does not match the width of the slideshow
					echo "File ($fileAtt) height (".$imgHeight.") does not match the height of the banner (".$this->height.").";
					return false;					
				}
				// Has validated image with slideshow. Add it to the Class
				$this->images[] = $file;
			} else {
				echo "File ($fileAtt) does not exist on the server.";
				return false;
			}
		}
	}
	
	// Outputs the slideshow on the page
	public function outputSlideshow() {
		if(is_array($this->images)) {
			echo "<div class=\"slider\">\n";
			foreach($this->images as $im) {
				echo "<img src=\"".$im."\" border=\"0\" />\n";
			}
			echo "</div>\n";
			echo "<script>\n";
			echo "window.onload = function() {\n";
    		echo "$('.slider').nivoSlider({directionNav:false,controlNav:false});\n";
			echo "};\n";
			echo "</script>\n";
		} else {
			echo "No Files associated with the banner";
			return false;
		}
	}
}
?>
