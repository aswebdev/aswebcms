<?php

// Create a new instance of a slideshow
class Slideshow {
	
	private $images = array(); // the slideshow images array
	private $width; // the width of the slideshow
	private $height; // the height of the slideshow
	
	function __construct($width,$height) {
		if((empty($width)) || (empty($height))) {
			throw new Exception("Slideshow Dimensions need to be set. Width = $width, Height = $height");
		}
		$this->width = $width;
		$this->height = $height;
	}
	
	// Adds an image file to the slideshow
	function addImage($arr) {
		// Check the image exists on the server
		$file = $arr['file'];
		if ( $fileAtt = getimagesize($file) ) {
    		if( $fileAtt ==! false ) {
				// Has a valid image, get the dimensions
				list($imgWidth,$imgHeight) = $fileAtt;
				if($imgWidth != $this->$width) { // Width of the image does not match the width of the slideshow
					echo "File ($fileAtt) width (".$imgWidth.") does not match the width of the banner (".$this->width.").";
					return false;					
				}
				if($imgHeight != $this->$height) { // Width of the image does not match the width of the slideshow
					echo "File ($fileAtt) height (".$imgheight.") does not match the height of the banner (".$this->height.").";
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
	function outputSlideshow() {
		if(is_array($this->images)) {
			echo "<div class=\"slider\">\n";
			foreach($this->images as $im) {
				echo "<img src=\"".$im."\" border=\"0\" />\n";
			}
			echo "</div>\n";
			echo "<script>\n";
			echo "$(window).load(function() {\n";
    		echo "$('.slider').nivoSlider();\n";
			echo "});\n";
			echo "</script>\n";
		} else {
			echo "No Files associated with the banner";
			return false;
		}
	}
}

// Class for the Headers in the HTML script, links and meta attributes
class Headers {
	
	private $includes = array(); // array of URLs
	private $includeType; // Is CSS, JavaScript, icons or other
	
	function __construct($includeType) {
		switch($includeType) {
			case 'script':
				$this->name = 'script';
				$this->inc = 'src';
			break;
			case 'link':
				$this->name = 'link';
				$this->inc = 'href';
			break;
			case 'meta':
				$this->name = 'meta';
				$this->inc = 'name';
			break;
		}
	}
	
	// Add the headers to the page
	function addHeaders($attr) {
		if(is_array($attr)) {
			foreach($files as $f) {
				echo "<".$this->name." ".$this->inc."=\"".$f['src']."\" ";
				if(is_array($f['atts'])) { foreach($f['atts'] as $k => $v) { echo "$k=\"".$v."\""; } } // Loop through the extra attributes for the headers to determine what to include
				echo " />";
			}
		}
	}
}

?>