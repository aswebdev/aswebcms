<?php

if($isValidPage) {

	// Check the existing submitted forms
	$submittedForm = false; // Check if has been submitted
	$updatedMsg = false; // Update message may be populated later for display
	$hideElements = false; // Don't Hide Elements
	
	if(isset($_POST['submittedFormTrigger'])) { $submittedForm = true; }
	if($submittedForm) {
		
		// Check if has previous ID
		
		if(!empty($_POST[$VARS['DB-KEY']])) { $hasId = true; }
		if(!empty($hasId)) {
			$updateType = "UPDATE"; // Update
		} else {
			$updateType = "INSERT"; // Insert
		}
		
		// Could be a Delete!
		if(!empty($_POST['deleteEntry'])) {
			$updateType = "DELETE"; // Insert
		}
		
		if($id = updateDatabaseEntry($VARS['TABLE'],$VARS['DB-FIELDS'],$updateType, $VARS['DB-KEY'])) {
			$updatedMsg .= $VARS['LABELER']." update has been successful!<br />\n";
			// Check for Uploaded Files
			if(is_array($_POST['UPLOAD'])) {
				foreach($_POST['UPLOAD'] as $uploadFile => $uploadConents) {
					$imageDimensionsArray = '';
					$imageMaxWidth = '';
					$imageMaxHeight = '';
					$uploadContentsArray = '';
					
					// Separate the Directory and the Upload Name from the Hidden POST
					$uploadContentsArray = explode('|',$uploadConents);
					$uploadDirectory = $uploadContentsArray[0];
					$uploadName = $uploadContentsArray[1];
					$uploadAppend = $uploadContentsArray[2];
					
					// Check if has an Image Size Array
					if(!empty($uploadContentsArray[3])) {
						$imageDimensionsArray = explode('x',$uploadContentsArray[3]);
						$imageMaxWidth = $imageDimensionsArray[0];
						$imageMaxHeight = $imageDimensionsArray[1];
					}
					
					// Check if a file has been uploaded
					if(isset($_FILES[$uploadName]['tmp_name'])) {
						
						if(is_uploaded_file($_FILES[$uploadName]['tmp_name'])) {		
							
							// Setup the Filename
							$filenameSafe = seoUrl($id).$uploadAppend;
							$name = $_FILES[$uploadName]["name"];
							$ext = end(explode(".", $name));
							$filename = $filenameSafe.".".$ext;
							
							// If imageMaxWidth is set, its an image and we need to use UploadClass to resize it!
							if(!empty($imageMaxWidth)) {
								$filenameSafe = $filenameSafe."-".$imageMaxWidth."x".$imageMaxHeight;
								$filename = $filenameSafe.".".$ext;
								// Include the Upload CLass
								if(is_file(BASE_PATH.'includes/packages/upload.class/upload.class.php')) {
									require_once(BASE_PATH.'includes/packages/upload.class/upload.class.php');							
									// Set the Parameters for Upload Class
									$handle = new upload($_FILES[$uploadName]);							
									$handle->file_auto_rename = false;
									$handle->file_overwrite = true;
									$handle->file_safe_name = false;
									$handle->image_resize = true;
									$handle->image_ratio_no_zoom_in = true;
									$handle->file_new_name_body = $filenameSafe;
									$handle->image_ratio = true;
									$handle->image_x = $imageMaxWidth;
									$handle->image_y = $imageMaxHeight;
									$handle->Process(BASE_PATH.$uploadDirectory);
									if (!$handle->processed) {
										$updatedMsg .= "The file ($filename) has <span style=\"color:red;\">NOT</span> been uploaded! Please contact Xceed for a resolution. (".BASE_PATH.$uploadDirectory.$filename.")<br />";
									} else {
										$updatedMsg .= "The file ($filename) has been successfully resized and uploaded!<br />";	
									}
								} else {
									$updatedMsg .= "The file upload package is unavailable. Please contact Xceed for a resolution.";
								}
							} else {
								// Use the Standard Upload	
								if(@copy($_FILES[$uploadName]['tmp_name'], BASE_PATH.$uploadDirectory.$filename)) {
									// Save the Filename into the Database for safe keeping :)
									$sql = "UPDATE `".$VARS['TABLE']."` SET  `$uploadName` = '".$filename."' WHERE `".$VARS['DB-KEY']."` = '".mysql_real_escape_string($id)."' ";
									if(mysql_query($sql,$conn)) {
										$updatedMsg .= "The file ($filename) has been successfully uploaded!<br />";	
									}
								} else {
									$updatedMsg .= "The file ($filename) has <span style=\"color:red;\">NOT</span> been uploaded! Please contact Xceed for a resolution. (".BASE_PATH.$uploadDirectory.$filename.")<br />";
								}
							}
            			}
					}
				}
			}
			
			// Update the Password Field
			if(is_array($_POST['PASSWORD-SET'])) {
				foreach($_POST['PASSWORD-SET'] as $pw) {
					if(!empty($_POST[$pw.'-update'])) {
						// Has checked to reset password
						if(!empty($_POST[$pw])) {
							// Make Sure Password has contents
							$sql = "UPDATE `".$VARS['TABLE']."` SET  `$pw` = '".md5($_POST[$pw])."' WHERE `".$VARS['DB-KEY']."` = '".mysql_real_escape_string($id)."' ";
							if(mysql_query($sql,$conn)) {
								$updatedMsg .= "Your password has been updated!<br />";	
							}
						}
					}
				}
			}
						
		} else {
			$updatedMsg .= "Error has occured when updating your ".$VARS['LABELER'].". Please contact Xceed for a resolution. (TABLE:".$VARS['TABLE'].", KEY: ".$VARS['DB-KEY'].")";	
		}
		logActivity($_SERVER["SCRIPT_NAME"],print_r($_POST,1)); // Log the Update
	}

	// So the Content Selection
	if(isset($_REQUEST[$VARS['DB-KEY']])) { $id = urldecode($_REQUEST[$VARS['DB-KEY']]); }
	if(!empty($id)) {
		$sql = "SELECT * FROM `".$VARS['TABLE']."` WHERE `".$VARS['DB-KEY']."` = '".mysql_real_escape_string($id)."'";
		if($res = mysql_query($sql,$conn)) {
			$r = mysql_fetch_array($res);
		}
	}

	// Check if this is an 'Update Only' Management Tool. If so we hide all the elements if no row is selected
	if((!in_array('ADD',$VARS['FUNCTIONALITY'])) && empty($id)) {
		$hideElements = true;
	}
	
	// Echo The Page Title
	echo "<h1>";
	echo $VARS['PAGE-TITLE'];
	if(!empty($r[$VARS['LABEL-FIELD']])) { 
		echo " - ".$r[$VARS['LABEL-FIELD']];
	}	
	echo "</h1>\n";	
	echo "<div id=\"updateMsg\">".$updatedMsg."</div>\n";
	// Has included files. Add these to the display
	if(is_array($VARS['INCLUDE-FILES'])) {
		foreach($VARS['INCLUDE-FILES'] as $includesArray) {
			if($includesArray['BASE'] == 'CMS') { $baseURL = BASE_URL_CMS; } else { $baseURL = BASE_URL; }
			switch($includesArray['TYPE']) {
				case 'JS':
					echo "<script src=\"".$baseURL.$includesArray['LOCATION']."?".rand(1000,5000)."\"></script>\n";
				break;
				case 'CSS':
					echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$baseURL.$includesArray['LOCATION']."\" />\n";
				break;
			}
		}
	}
	
	// If theres more than 5 Form elements on the page, add an update/add up the top. User won't get lost this way. :)
	if(count($VARS['FORM-ELEMENTS']) > 5) {
		if((in_array('ADD',$VARS['FUNCTIONALITY'])) || ((in_array('UPDATE',$VARS['FUNCTIONALITY'])) && !empty($id))) {
			echo "<a href=\"javascript:;\" class=\"submitButton\">";
			if(!empty($r[$VARS['DB-KEY']])) { 
				echo "Update ".$VARS['LABELER'];
			} else { 
				echo "Add ".$VARS['LABELER'];
			}
			echo "</a>";
		}
		
		if(in_array('DELETE',$VARS['FUNCTIONALITY']) && (!empty($id))) {
			echo "&nbsp;&nbsp;<a href=\"javascript:;\" class=\"deleteButton\">Delete ".$VARS['LABELER']."</a>";
		}
	
	}
	
	echo "<br /><br />";
	
	// Do the Content Selection Page Reload Tool	
	echo "<label for=\"page-reload\">Select";
	
	if(in_array('ADD',$VARS['FUNCTIONALITY'])) {
		echo " or Add New";
	}
	
	echo " ".$VARS['LABELER'];
	echo "</label>";
	echo "<select class=\"pageReload\" name=\"page-reload\">\n";
	

	
	if(in_array('ADD',$VARS['FUNCTIONALITY'])) {
		echo "<option value=\"".BASE_URL_CMS."module.php?module=".$VARS['PAGE-FILE']."\" selected=\"selected\">Add New ".$VARS['LABELER']."...</option>\n";
	} else if((!in_array('ADD',$VARS['FUNCTIONALITY'])) && (!isset($_REQUEST[$VARS['DB-KEY']]))) {
		echo "<option value=\"\" selected=\"selected\" disabled=\"disabled\">Select ".$VARS['LABELER']."...</option>\n";
	}
	
	// Loop Pages
	$sql = "SELECT `".$VARS['DB-KEY']."`,`".$VARS['LABEL-FIELD']."` FROM `".$VARS['TABLE']."`";
	if(!empty($VARS['DB-ORDERBY'])) {
		$sql .= $VARS['DB-ORDERBY'];
	}
	if($res = mysql_query($sql,$conn)) {
		while($content = mysql_fetch_array($res)) {
			echo "<option value=\"".BASE_URL_CMS."module.php?module=".$VARS['PAGE-FILE']."&".$VARS['DB-KEY']."=".urlencode($content[$VARS['DB-KEY']])."\" ";
			if($content[$VARS['DB-KEY']] == $r[$VARS['DB-KEY']]) { echo " selected=\"selected\" "; }
			echo ">".$content[$VARS['LABEL-FIELD']];
			if($VARS['DISPLAY-KEY-IN-LABEL'] == true) {
				echo " (".$content[$VARS['DB-KEY']].")";
			}
			echo "</option>\n";
		}
	}
	echo "</select><br /><br /><br />";
	
	// Generate the Form
	
	if($hideElements != true) {
	
		echo "<div class=\"adminForm\">\n";
		echo "<form action=\"\" method=\"post\" class=\"adminForm\" enctype=\"multipart/form-data\" >\n";
		
		if(!empty($r[$VARS['DB-KEY']])) {
			echo "<input type=\"hidden\" name=\"".$VARS['DB-KEY']."\" value=\"".$r[$VARS['DB-KEY']]."\" />\n";
		}
		
		echo "<input type=\"hidden\" name=\"submittedFormTrigger\" value=\"true\" />\n";
	
		// Loop through all the Form Elements and Output to Page
		if(is_array($VARS['FORM-ELEMENTS'])) {
			foreach($VARS['FORM-ELEMENTS'] as $elementName => $formElements) {
				
				$additionalAttributes = "";
				$hiddenRow = '';
				if(!empty($formElements['REQUIRED'])) { $additionalAttributes .= " class=\"requiredElement\" "; }
				if(!empty($formElements['VALIDATION-MESSAGE'])) { $additionalAttributes .= " data-error=\"".$formElements['VALIDATION-MESSAGE']."\" "; }
				if(!empty($formElements['PLACEHOLDER'])) { $additionalAttributes .= " placeholder=\"".$formElements['PLACEHOLDER']."\" "; }
				if(!empty($formElements['INITIAL-HIDE'])) { $hiddenRow = " style=\"display:none;\" "; }
				
				// Check for Additional Styles
				$styleAttributes = '';
				if(is_array($formElements['STYLES'])) {
					$styleAttributes .= 'style="';
					foreach($formElements['STYLES'] as $styleName => $styleValue) {
						$styleAttributes .= $styleName.":".$styleValue.";";
					}
					$styleAttributes .= '"';
				}
				
				// Check for FileType Attributes
				$filetypeAttributes = '';
				if(is_array($formElements['FILE-TYPES'])) {
					$filetypeAttributes .= 'data-filetype="';
					foreach($formElements['FILE-TYPES'] as $fileTypes) {
						$filetypeAttributes .= "$fileTypes|";
					}
					$filetypeAttributes = substr($filetypeAttributes,0,-1);
					$filetypeAttributes .= '"';
				}

				switch($formElements['TYPE']) {
					case 'text':
						echo "<div class=\"lineHolder\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\">".$formElements['LABEL']."</label><input type=\"text\" name=\"".$formElements['DATABASE-FIELD']."\" id=\"".$formElements['DATABASE-FIELD']."\" $additionalAttributes $styleAttributes value=\"".htmlspecialchars($r[$formElements['DATABASE-FIELD']])."\" />";
						echo "</div>\n";
					break;
					case 'text-url':
						echo "<div class=\"lineHolder\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\">".$formElements['LABEL']."</label>".BASE_URL."<input type=\"text\" name=\"".$formElements['DATABASE-FIELD']."\" id=\"".$formElements['DATABASE-FIELD']."\" $additionalAttributes $styleAttributes value=\"".$r[$formElements['DATABASE-FIELD']]."\" />";
						echo "</div>\n";
					break;
					case 'textarea':
						echo "<div class=\"lineHolder\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\">".$formElements['LABEL']."</label>".BASE_URL."<textarea name=\"".$formElements['DATABASE-FIELD']."\" id=\"".$formElements['DATABASE-FIELD']."\" $additionalAttributes $styleAttributes >".$r[$formElements['DATABASE-FIELD']]."</textarea>";
						echo "</div>\n";
					break;
					case 'select':
						echo "<div class=\"lineHolder\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\">".$formElements['LABEL']."</label>";
						echo "<select name=\"".$formElements['DATABASE-FIELD']."\" id=\"".$formElements['DATABASE-FIELD']."\" $additionalAttributes $styleAttributes >\n";
						echo "<option value=\"\"  selected=\"selected\" >...</option>\n";
						if(!empty($formElements['DB-SELECT'])) {
							$sql = "SELECT * FROM `".$formElements['DB-SELECT']['TABLE']."` "; 
							if(!empty($formElements['DB-SELECT']['WHERE'])) {
								$sql .= "WHERE ".$formElements['DB-SELECT']['WHERE']; 
							}
							if($formElements['DB-SELECT']['ORDERBY']) {
								$sql .= " ORDER BY `".$formElements['DB-SELECT']['ORDERBY']."`";
							} else {
								$sql .= " ORDER BY `".$formElements['DB-SELECT']['LABEL']."`";
							}
							
							if($res = mysql_query($sql,$conn)) {
								while($s = mysql_fetch_array($res)) {
									$formElements['OPTIONS'][$s[$formElements['DB-SELECT']['LABEL']]] = $s[$formElements['DB-SELECT']['IDENTIFIER']];
								}
							}
						}
						if(is_array($formElements['OPTIONS'])) {
							foreach($formElements['OPTIONS'] as $optKey => $optVal) {
								echo "<option value=\"".$optVal."\" ";
								if($optVal == $r[$formElements['DATABASE-FIELD']]) {
									echo " selected=\"selected\" ";
								}
								echo ">".$optKey."</option>\n";
							}
						}
						echo "</select>\n";
						echo "</div>\n";
					break;
					case 'checkbox':
						echo "<div class=\"lineHolder\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\">".$formElements['LABEL']."</label><input type=\"checkbox\" id=\"".$formElements['DATABASE-FIELD']."\" value=\"1\" $styleAttributes name=\"".$formElements['DATABASE-FIELD']."\"";
						if(!empty($r[$formElements['DATABASE-FIELD']])) { echo " checked "; } 
						echo " />\n";
						echo "</div>\n";
					break;
					case 'password':
						echo "<div class=\"lineHolder\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<input type=\"hidden\" name=\"PASSWORD-SET[]\" value=\"".$formElements['DATABASE-FIELD']."\" />\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\">".$formElements['LABEL']."</label><input type=\"password\" name=\"".$formElements['DATABASE-FIELD']."\" id=\"".$formElements['DATABASE-FIELD']."\" $additionalAttributes $styleAttributes value=\"\" />&nbsp;<input type=\"checkbox\" name=\"".$formElements['DATABASE-FIELD']."-update\" value=\"1\" />&nbsp;Update&nbsp;".$formElements['LABEL']."?";
						echo "</div>\n";
					break;
					case 'wysiwyg':
						echo "<br />";
						echo "<div $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<strong>".$formElements['LABEL']."</strong><br />\n";
						echo "<textarea name=\"".$formElements['DATABASE-FIELD']."\" $styleAttributes>".htmlspecialchars($r[$formElements['DATABASE-FIELD']])."</textarea>\n";
						echo "</div>\n";
						echo "<script>\n";	
						
						// Get Settings if Exist
						if(!empty($formElements['SETTINGS']['WIDTH'])) {
							echo "CKEDITOR.config.width = ".$formElements['SETTINGS']['WIDTH']."; \n";
						}
						
						if(!empty($formElements['SETTINGS']['WIDTH'])) {
							echo "CKEDITOR.config.height = ".$formElements['SETTINGS']['HEIGHT']."; \n";
						}					

						if($formElements['SETTINGS']['DISPLAY'] == 'minimal') {
							echo "CKEDITOR.config.toolbar = [\n";
							echo "{ name: 'document', items : [ 'Source','-' ] },\n";
							echo "{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },\n";
							echo "{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','-','RemoveFormat' ] },\n";
							echo "{ name: 'colors', items : [ 'TextColor','BGColor','Image' ] }\n";
							echo "];\n";
						} else {
							echo "CKEDITOR.config.toolbar = [\n";
							echo "{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },";
							echo "{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },";
							echo "{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },";
							echo "{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
								'HiddenField' ] },";
							echo "'/',";
							echo "{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },";
							echo "{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',";
							echo "'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },";
							echo "{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },";
							echo "{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },";
							echo "'/',";
							echo "{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },";
							echo "{ name: 'colors', items : [ 'TextColor','BGColor' ] },";
							echo "{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }";
							echo "];\n";
						}
						

						
						echo "CKEDITOR.replace('".$formElements['DATABASE-FIELD']."');\n";
						echo "</script>";
					break;	
					case 'upload':
						echo "<div class=\"lineHolder\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<input type=\"hidden\" name=\"UPLOAD[]\" value=\"".$formElements['SAVE-DIRECTORY']."|".$formElements['DATABASE-FIELD']."|".$formElements['FILE-APPEND']."\" />\n";
						
						// Check if has an alternate upload 
						if(is_array($formElements['ALTERNATE-UPLOAD-SIZES'])) {
							foreach($formElements['ALTERNATE-UPLOAD-SIZES'] as $alternateUploads) {
								echo "<input type=\"hidden\" name=\"UPLOAD[]\" value=\"".$formElements['SAVE-DIRECTORY']."|".$formElements['DATABASE-FIELD']."|".$formElements['FILE-APPEND']."|".$alternateUploads."\" />\n";
							}
						}
						
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\">".$formElements['LABEL']."</label><input type=\"file\" name=\"".$formElements['DATABASE-FIELD']."\" class=\"uploadImg\" data-label=\"".$formElements['LABEL']."\" $filetypeAttributes $styleAttributes />\n";
						// Check if the current file exists
						$currentFile = BASE_PATH.$formElements['SAVE-DIRECTORY'].$r[$formElements['DATABASE-FIELD']];
						if(is_file($currentFile)) {
							echo "<a href=\"".BASE_URL.$formElements['SAVE-DIRECTORY'].$r[$formElements['DATABASE-FIELD']]."\" target=\"_blank\">View Current File</a>\n";
							echo "&nbsp;&nbsp;<a href=\"javascript:;\" data-remove=\"".BASE_URL.$formElements['SAVE-DIRECTORY'].$r[$formElements['DATABASE-FIELD']]."\" data-details=\"".$VARS['TABLE']."|".$formElements['DATABASE-FIELD']."|".$r[$VARS['DB-KEY']]."|".$VARS['DB-KEY']."\" class=\"removeItem\">Remove File</a>\n";
						}
						echo "</div>\n";
					break;
					case 'separator':
						echo "<div class=\"lineHolder\"></div>\n";
					break;
					case 'readonly':
						echo "<div class=\"lineHolder\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\">".$formElements['LABEL']."</label>";
						if(!empty($formElements['PRE-PEND-FIELD'])) { echo $formElements['PRE-PEND-FIELD']; }
						echo $r[$formElements['DATABASE-FIELD']];
						echo "</div>\n";
					break;			
				}
				echo "<br />\n";
			}
		}
		echo "</form>\n";
		echo "</div>\n";
	}
	
	if((in_array('ADD',$VARS['FUNCTIONALITY'])) || ((in_array('UPDATE',$VARS['FUNCTIONALITY'])) && !empty($id))) {
		echo "<br />";
		echo "<a href=\"javascript:;\" class=\"submitButton\">";
		if(!empty($r[$VARS['DB-KEY']])) { 
			echo "Update ".$VARS['LABELER'];
		} else { 
			echo "Add ".$VARS['LABELER'];
		}
		echo "</a>";
	}
	
	if(in_array('DELETE',$VARS['FUNCTIONALITY']) && (!empty($id))) {
		echo "&nbsp;&nbsp;<a href=\"javascript:;\" class=\"deleteButton\">Delete ".$VARS['LABELER']."</a>";
	}
	
	// Check if any custom Scripts for the Page. Scirpts are located in includes/custom-scripts/
	
	if(!empty($VARS['CUSTOM-SCRIPT-ON-LOAD'])) {
		if(is_file(BASE_PATH_CMS.'/includes/custom-scripts/'.$VARS['PAGE-FILE'].'.php')) {
			include(BASE_PATH_CMS.'/includes/custom-scripts/'.$VARS['PAGE-FILE'].'.php'); // Include Custom Script File
		}
	}
		
} else {
	echo "<p>The Requested Content cannot be found.</p>";	
}	
	
?>