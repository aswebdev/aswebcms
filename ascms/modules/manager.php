<?php

if($isValidPage) {

	// Check the existing submitted forms
	$submittedForm = false; // Check if has been submitted
	$updatedMsg = false; // Update message may be populated later for display
	$hideElements = false; // Don't Hide Elements
	$alertType = '';
	
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
		
		if( $id = updateDatabaseEntry( $VARS['TABLE'] , $VARS['DB-FIELDS'] , $updateType , $VARS['DB-KEY'] ) ) {
			
            $updatedMsg .= $VARS['LABELER']." update has been successful!<br />\n";
			
            // Loop the form element for an upload
            
            foreach( $VARS['FORM-ELEMENTS'] as $k => $v ) {
                
                if( $v['TYPE'] == 'upload' ) {
                    
                    require_once( BASE_PATH . 'includes/packages/upload.class/upload.class.php' ); // Include the Upload Class
                    
                    // Is an Upload. Check if we have uploaded anything 
                    
                    if( !empty( $_POST[$k] ) ) {
                        
                        $temp_file = BASE_PATH . $v['SAVE-DIRECTORY'] . $_POST[$k];
                        
                        $ext = pathinfo( $_POST[$k] , PATHINFO_EXTENSION );
                        
                        $saved_file_name = $id . $v['FILE-APPEND'] . '.' . $ext;
                        
                        $saved_file = BASE_PATH . $v['SAVE-DIRECTORY'] . $saved_file_name;
                        
                        if( is_file( $temp_file ) ) {
                            
                            // We have a file, lets save it to a proper id first
                            
                            if( @copy( $temp_file , $saved_file ) ) {
                                
                                // Save it to the database
                                
                                $sql = "UPDATE `" . $VARS['TABLE'] . "` SET `" . $k . "` = '" . mysql_real_escape_string( $saved_file_name ) . "' ";
                                
                                mysql_query( $sql , $conn );
                                
                                // Copy a success, we can remove the temp file now
                                
                                unlink( $temp_file );
                                
                                if( is_array( $v['ALTERNATE-UPLOAD-SIZES'] ) ) {
                                    
                                    foreach( $v['ALTERNATE-UPLOAD-SIZES'] as $a ) {
                                        
                                        $alt_file_path = BASE_PATH . $v['SAVE-DIRECTORY'];
                                        
                                        $alt_file_safe = $id . $v['FILE-APPEND'] . '-' . $a;
                                        
                                        $alt_file_name = $alt_file_safe . '.' . $ext;
                                        
                                        $alt_file = $alt_file_path . $alt_file_name;
                                        
                                        $dimensions_arr = explode( 'x' , $a );

                                        $handle = new upload( $saved_file );							
									   
                                        $handle->file_auto_rename = false;
									   
                                        $handle->file_overwrite = true;
									   
                                        $handle->file_safe_name = false;
									
                                        $handle->image_resize = true;
									
                                        $handle->image_ratio_no_zoom_in = true;
									
                                        $handle->file_new_name_body = $alt_file_safe;
									
                                        $handle->image_ratio = true;
									
                                        $handle->image_x = $dimensions_arr[0];
									
                                        $handle->image_y = $dimensions_arr[1];
									
                                        $handle->Process( $alt_file_path );
									
                                        if ( !$handle->processed ) {
										  
                                            $alertType = 'error';
								            
                                            $updatedMsg .= "The file ($alt_file_name) has <span style=\"color:red;\">NOT</span> been uploaded! Please contact Technical Support for a resolution. (".BASE_PATH.$uploadDirectory.$filename.")<br />";
									   
                                        } else {
										  
                                            $alertType = 'success';
										
                                            $updatedMsg .= "The file ($alt_file_name) has been successfully resized and uploaded!<br />";	
									
                                        }
                                        
                                    }
                                    
                                }
                                
                            }
                            
                        } else {
                            
                            // File was in the POST but does not exist. Error has occured
                            
                        }
                        
                    }
                    
                }
                
            }
			
			// Update the Password Field
			if(!isset($_POST['PASSWORD-SET'])) { $_POST['PASSWORD-SET'] = ''; }
			if(is_array($_POST['PASSWORD-SET'])) {
				foreach($_POST['PASSWORD-SET'] as $pw) {
					if(!empty($_POST[$pw.'-update'])) {
						// Has checked to reset password
						if(!empty($_POST[$pw])) {
							// Make Sure Password has contents
							$sql = "UPDATE `".$VARS['TABLE']."` SET  `$pw` = '".md5($_POST[$pw])."' WHERE `".$VARS['DB-KEY']."` = '".mysql_real_escape_string($id)."' ";
							if(mysql_query($sql,$conn)) {
								$alertType = 'success';
								$updatedMsg .= "Your password has been updated!<br />";	
							}
						}
					}
				}
			}
						
		} else {
			$alertType = 'error';
			$updatedMsg .= "Error has occured when updating your ".$VARS['LABELER'].". Please contact Technical Support for a resolution. (TABLE:".$VARS['TABLE'].", KEY: ".$VARS['DB-KEY'].")";	
		}
	}

	// So the Content Selection
	if(isset($_REQUEST[$VARS['DB-KEY']])) { $id = urldecode($_REQUEST[$VARS['DB-KEY']]); }
	$r = ''; // Set the db return
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
	echo "<div class=\"col-lg-12\">";
	echo "<div class=\"box dark\">";
	echo "<header>";
	echo "<h5>";
	echo $VARS['PAGE-TITLE'];
	if(!empty($r[$VARS['LABEL-FIELD']])) { 
		echo " - ".$r[$VARS['LABEL-FIELD']];
	}	
	echo "</h5>\n";	
	
	// If theres more than 5 Form elements on the page, add an update/add up the top. User won't get lost this way. :)
	if(count($VARS['FORM-ELEMENTS']) > 5) {
		echo "<div class=\"toolbar\"><ul class=\"nav\">";
		if((in_array('ADD',$VARS['FUNCTIONALITY'])) || ((in_array('UPDATE',$VARS['FUNCTIONALITY'])) && !empty($id))) {
			if(!empty($r[$VARS['DB-KEY']])) { 
				echo "<li><a href=\"javascript:;\" class=\"submitButton\">Update ".$VARS['LABELER']."</a></li>";
			} else { 
				echo "<li><a href=\"javascript:;\" class=\"submitButton\">Add ".$VARS['LABELER']."</a></li>";
			}
		}
		
		if(in_array('DELETE',$VARS['FUNCTIONALITY']) && (!empty($id))) {
			echo "<li><a href=\"javascript:;\" class=\"deleteButton\">Delete ".$VARS['LABELER']."</a></li>";
		}
		echo "</ul></div>";
	}
	
	echo "</header>";
	
	echo "<div class=\"accordion-body collapse in body\">";
	
	if(!empty($updatedMsg)) {
		
		if($alertType == 'error') { $popupClass = 'danger'; } else { $popupClass = 'success'; }
		
		echo "<div class=\"alert alert-$popupClass\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>".$updatedMsg."</div>\n";
	}
	
	// Has included files. Add these to the display
	if(!isset($VARS['INCLUDE-FILES'])) { $VARS['INCLUDE-FILES'] = ''; }
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

	echo "<form action=\"\" method=\"post\" enctype=\"multipart/form-data\" class=\"form-horizontal admin-form\" >\n";
	
	echo "<div class=\"popup-msg\"></div>";
	
	// Do the Content Selection Page Reload Tool	
	echo "<div class=\"form-group\" for=\"page-reload\" class=\"control-label col-lg-4\">";
	echo "<label for=\"page-reload\" class=\"control-label col-lg-4\">Select";
	
	if(in_array('ADD',$VARS['FUNCTIONALITY'])) {
		echo " or Add New";
	}
	
	echo " ".$VARS['LABELER'];
	echo "</label>";
	echo "<div class=\"col-lg-8\"><select class=\"pageReload form-control\" name=\"page-reload\">\n";
	
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
	$content = '';
	if($res = mysql_query($sql,$conn)) {		
		while($content = mysql_fetch_array($res)) {
			echo "<option value=\"".BASE_URL_CMS."module.php?module=".$VARS['PAGE-FILE']."&".$VARS['DB-KEY']."=".urlencode($content[$VARS['DB-KEY']])."\" ";
			if(!isset($VARS['DB-KEY'])) { $VARS['DB-KEY'] = ''; }
			if(!isset($r[$VARS['DB-KEY']])) { $r[$VARS['DB-KEY']] = ''; }
			if($content[$VARS['DB-KEY']] == $r[$VARS['DB-KEY']]) { echo " selected=\"selected\" "; }
			echo ">".$content[$VARS['LABEL-FIELD']];
			if(!isset($VARS['DISPLAY-KEY-IN-LABEL'])) { $VARS['DISPLAY-KEY-IN-LABEL'] = ''; }
			if($VARS['DISPLAY-KEY-IN-LABEL'] == true) {
				echo " (".$content[$VARS['DB-KEY']].")";
			}
			echo "</option>\n";
		}
	}
	echo "</select>";
	echo "<span class=\"help-block\">Create a New ".$VARS['LABELER']." or Select a Current ".$VARS['LABELER']." to Modify</span>";
	echo "</div>";
	echo "</div>";
	
	// Generate the Form
	
	if($hideElements != true) {
	
		if(!empty($r[$VARS['DB-KEY']])) {
			echo "<input type=\"hidden\" name=\"".$VARS['DB-KEY']."\" value=\"".$r[$VARS['DB-KEY']]."\" />\n";
		}
		
		echo "<input type=\"hidden\" name=\"submittedFormTrigger\" value=\"true\" />\n";
	
		// Loop through all the Form Elements and Output to Page
		if(is_array($VARS['FORM-ELEMENTS'])) {
			foreach($VARS['FORM-ELEMENTS'] as $elementName => $formElements) {
				
				$additionalAttributes = "";
				$hiddenRow = '';
				if(!empty($formElements['REQUIRED'])) { $additionalAttributes .= " class=\"form-control requiredElement\" "; } else { $additionalAttributes .= " class=\"form-control\" "; }
				if(!empty($formElements['VALIDATION-MESSAGE'])) { $additionalAttributes .= " data-error=\"".$formElements['VALIDATION-MESSAGE']."\" "; }
				if(!empty($formElements['PLACEHOLDER'])) { $additionalAttributes .= " placeholder=\"".$formElements['PLACEHOLDER']."\" "; }
				if(!empty($formElements['INITIAL-HIDE'])) { $hiddenRow = " style=\"display:none;\" "; }
				
				// Check for Additional Styles
				$styleAttributes = '';
				if(!isset($formElements['STYLES'])) { $formElements['STYLES'] = ''; } 
				if(is_array($formElements['STYLES'])) {
					$styleAttributes .= 'style="';
					foreach($formElements['STYLES'] as $styleName => $styleValue) {
						$styleAttributes .= $styleName.":".$styleValue.";";
					}
					$styleAttributes .= '"';
				}
				
				// Check for FileType Attributes
				$filetypeAttributes = '';
				if(!isset($formElements['FILE-TYPES'])) { $formElements['FILE-TYPES'] = ''; }
				if(is_array($formElements['FILE-TYPES'])) {
					$filetypeAttributes .= 'data-filetype="';
					foreach($formElements['FILE-TYPES'] as $fileTypes) {
						$filetypeAttributes .= "$fileTypes|";
					}
					$filetypeAttributes = substr($filetypeAttributes,0,-1);
					$filetypeAttributes .= '"';
				}

				// Reset the Index
				if(!isset($r[$formElements['DATABASE-FIELD']])) { $r[$formElements['DATABASE-FIELD']] = ''; }
                
				switch($formElements['TYPE']) {
					case 'text':
						echo "<div class=\"form-group\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\" class=\"control-label col-lg-4\">".$formElements['LABEL']."</label>";
						echo "<div class=\"col-lg-8\">\n";
						echo "<input type=\"text\" name=\"".$formElements['DATABASE-FIELD']."\" id=\"".$formElements['DATABASE-FIELD']."\" $additionalAttributes $styleAttributes value=\"".htmlspecialchars($r[$formElements['DATABASE-FIELD']])."\" autocomplete=\"off\" />";
						
						if(!empty($formElements['DESCRIPTION'])) { echo "<span class=\"help-block\">".$formElements['DESCRIPTION']."</span>"; }
						
						echo "</div>\n";
						echo "</div>\n";
					break;
					case 'text-url':
						echo "<div class=\"form-group\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\" class=\"control-label col-lg-4\">".$formElements['LABEL']."</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input type=\"text\" name=\"".$formElements['DATABASE-FIELD']."\" id=\"".$formElements['DATABASE-FIELD']."\" $additionalAttributes $styleAttributes value=\"".$r[$formElements['DATABASE-FIELD']]."\" autocomplete=\"off\" />";
						
						if(!empty($formElements['DESCRIPTION'])) { echo "<span class=\"help-block\">".$formElements['DESCRIPTION']."</span>"; }
						
						echo "</div>\n";
						echo "</div>\n";
					break;
					case 'textarea':
						echo "<div class=\"form-group\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\" class=\"control-label col-lg-4\">".$formElements['LABEL']."</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<textarea name=\"".$formElements['DATABASE-FIELD']."\" id=\"".$formElements['DATABASE-FIELD']."\" $additionalAttributes $styleAttributes >".$r[$formElements['DATABASE-FIELD']]."</textarea>";
						
						if(!empty($formElements['DESCRIPTION'])) { echo "<span class=\"help-block\">".$formElements['DESCRIPTION']."</span>"; }
						
						echo "</div>\n";
						echo "</div>\n";
					break;
					case 'select':
						echo "<div class=\"form-group\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\" class=\"control-label col-lg-4\">".$formElements['LABEL']."</label>";
						echo "<div class=\"col-lg-8\"><select name=\"".$formElements['DATABASE-FIELD']."\" id=\"".$formElements['DATABASE-FIELD']."\" $additionalAttributes $styleAttributes >\n";
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
						echo "</select>";
						if(!empty($formElements['DESCRIPTION'])) { echo "<span class=\"help-block\">".$formElements['DESCRIPTION']."</span>"; }
						echo "</div>\n";
						echo "</div>\n";
					break;
					case 'checkbox':
						echo "<div class=\"form-group\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\" class=\"control-label col-lg-4\">".$formElements['LABEL']."</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input type=\"checkbox\" id=\"".$formElements['DATABASE-FIELD']."\" value=\"1\" $styleAttributes name=\"".$formElements['DATABASE-FIELD']."\"";
						if(!empty($r[$formElements['DATABASE-FIELD']])) { echo " checked "; } 
						echo " />\n";
						if(!empty($formElements['DESCRIPTION'])) { echo "<span class=\"help-block\">".$formElements['DESCRIPTION']."</span>"; }
						echo "</div>\n";
						echo "</div>\n";
					break;
					case 'password':
						echo "<div class=\"form-group\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<input type=\"hidden\" name=\"PASSWORD-SET[]\" value=\"".$formElements['DATABASE-FIELD']."\" />\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\"  class=\"control-label col-lg-4\">".$formElements['LABEL']."</label>";						
						echo "<div class=\"col-lg-8\">";
						echo "<input type=\"password\" name=\"".$formElements['DATABASE-FIELD']."\" id=\"".$formElements['DATABASE-FIELD']."\" $additionalAttributes $styleAttributes value=\"\" autocomplete=\"off\" />&nbsp;<input type=\"checkbox\" name=\"".$formElements['DATABASE-FIELD']."-update\" value=\"1\" />&nbsp;Update&nbsp;".$formElements['LABEL']."?";
						if(!empty($formElements['DESCRIPTION'])) { echo "<span class=\"help-block\">".$formElements['DESCRIPTION']."</span>"; }
						echo "</div>\n";
						echo "</div>\n";
					break;
					case 'wysiwyg':
						echo "<div class=\"form-group\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\" class=\"control-label col-lg-4\">".$formElements['LABEL']."</label>\n";;
						echo "<div class=\"col-lg-8\">";
						echo "<textarea name=\"".$formElements['DATABASE-FIELD']."\" $styleAttributes>".htmlspecialchars($r[$formElements['DATABASE-FIELD']])."</textarea>\n";
						if(!empty($formElements['DESCRIPTION'])) { echo "<span class=\"help-block\">".$formElements['DESCRIPTION']."</span>"; }
						echo "</div>";
						echo "<script>\n";	
						
						// Get Settings if Exist
						if(!empty($formElements['SETTINGS']['WIDTH'])) {
							echo "CKEDITOR.config.width = '100%'; \n";
						}
						
						if(!empty($formElements['SETTINGS']['WIDTH'])) {
							echo "CKEDITOR.config.height = '300px'; \n";
						}					
						
						if(!isset($formElements['SETTINGS']['DISPLAY'])) { $formElements['SETTINGS']['DISPLAY'] = ''; }
						
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
						

						
						echo "var editor = CKEDITOR.replace('".$formElements['DATABASE-FIELD']."' );\n";
                        echo "CKFinder.setupCKEditor( editor ,  '" . $_SESSION['BASE_URL_CMS'] . "packages/ckfinder/' );\n";
						echo "</script>";
						echo "</div>";
					break;	
                    
					case 'upload':
                    
                        echo "<div class=\"form-group\" $hiddenRow id=\"" . $elementName . "-HOLDER\">\n";
                        
                        if( !isset( $formElements['FILE-APPEND'] ) ) { $formElements['FILE-APPEND'] = ''; }
                        
                        echo "<label for=\"" . $formElements['DATABASE-FIELD'] . "\" class=\"control-label col-lg-4\">" . $formElements['LABEL'] . "</label>";
                        
                        echo "<div class=\"col-lg-8\">";
						
						echo "<div class=\"upload-area\" data-field=\"" . $formElements['DATABASE-FIELD'] . "\">";
                    
                        echo "<span><i class=\"fa fa-upload\"></i>&nbsp;Drag File Here or Click to Upload</span>";
                    
                        echo "</div>";
                    
                        echo "</div>\n"; 
                    
                        echo "</div>\n";
                        
                        // Check if the current file exists
                    
                        if( !empty( $r[$formElements['DATABASE-FIELD']] ) ) {
							
                            echo "<div class=\"form-group\">";
                            
                            echo "<div class=\"col-lg-8 col-lg-offset-4\">";
                            
							echo "<div class=\"upload-current\">";
							
                            echo "<a href=\"" . BASE_URL . $formElements['SAVE-DIRECTORY'] . $r[$formElements['DATABASE-FIELD']] . "\" class=\"btn btn-primary btn-xs fancybox\" target=\"_blank\" >View Current File</a>\n";
							
                            echo "&nbsp;&nbsp;<a href=\"javascript:;\" data-details=\"" . $formElements['DATABASE-FIELD'] . "|" . $r[$VARS['DB-KEY']] . "|" . $moduleRequest . "\" class=\"removeItem btn btn-primary btn-xs\">Remove Current File</a>\n";
							
                            echo "</div>";
                            
                            echo "</div>";
						  
                            echo "</div>";
                            
                        }
                        
                        /*
						echo "<div class=\"form-group\" $hiddenRow id=\"".$elementName."-HOLDER\">\n";
						if(!isset($formElements['FILE-APPEND'])) { $formElements['FILE-APPEND'] = ''; }
						echo "<input type=\"hidden\" name=\"UPLOAD[]\" value=\"".$formElements['SAVE-DIRECTORY']."|".$formElements['DATABASE-FIELD']."|".$formElements['FILE-APPEND']."\" />\n";
						
						// Check if has an alternate upload 
						if(!isset($formElements['ALTERNATE-UPLOAD-SIZES'])) { $formElements['ALTERNATE-UPLOAD-SIZES'] = ''; }
						if(is_array($formElements['ALTERNATE-UPLOAD-SIZES'])) {
							foreach($formElements['ALTERNATE-UPLOAD-SIZES'] as $alternateUploads) {
								echo "<input type=\"hidden\" name=\"UPLOAD[]\" value=\"".$formElements['SAVE-DIRECTORY']."|".$formElements['DATABASE-FIELD']."|".$formElements['FILE-APPEND']."|".$alternateUploads."\" />\n";
							}
						}
						
						echo "<label for=\"".$formElements['DATABASE-FIELD']."\" class=\"control-label col-lg-4\">".$formElements['LABEL']."</label>";
						echo "<div class=\"col-lg-4\">";
						
						echo "<div class=\"upload-area\"><span><i class=\"fa fa-folder-open\"></i>&nbsp;Drag Your File Here</span><input type=\"file\" name=\"".$formElements['DATABASE-FIELD']."\" class=\"uploadImg\" data-label=\"".$formElements['LABEL']."\" $filetypeAttributes></div>";

						// Check if the current file exists
						$currentFile = BASE_PATH.$formElements['SAVE-DIRECTORY'].$r[$formElements['DATABASE-FIELD']];
						if(is_file($currentFile)) {
							
							// Check if image, if so do fancybox
							$currentFileExt = strtolower(pathinfo($currentFile, PATHINFO_EXTENSION));
							$fileTypes = array('png','jpg','jpeg','gif');
							$imageClass = '';
							$fileTarget = '';
							if(in_array($currentFileExt,$fileTypes)) { 
								$imageClass = 'fancybox';
							} else {
								$fileTarget = "target=\"_blank\"";
							}
							
							
							echo "<div class=\"upload-current\">";
							echo "<a href=\"".BASE_URL.$formElements['SAVE-DIRECTORY'].$r[$formElements['DATABASE-FIELD']]."\" class=\"btn btn-primary btn-xs ".$imageClass."\" $fileTarget>View Current File</a>\n";
							echo "&nbsp;&nbsp;<a href=\"javascript:;\" data-remove=\"".BASE_URL.$formElements['SAVE-DIRECTORY'].$r[$formElements['DATABASE-FIELD']]."\" data-details=\"".$VARS['TABLE']."|".$formElements['DATABASE-FIELD']."|".$r[$VARS['DB-KEY']]."|".$VARS['DB-KEY']."\" class=\"removeItem btn btn-primary btn-xs\">Remove Current File</a>\n";
							echo "</div>";
						}
						echo "</div>\n";
						echo "</div>\n";
                        */
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
			}
		}
		
		echo "<div class=\"form-group\">\n";
		echo "<label class=\"control-label col-lg-4\">&nbsp;</label>";
		echo "<div class=\"col-lg-8\">";
		if((in_array('ADD',$VARS['FUNCTIONALITY'])) || ((in_array('UPDATE',$VARS['FUNCTIONALITY'])) && !empty($id))) {
			echo "<a href=\"javascript:;\" class=\"btn btn-primary btn-rect submitButton\">";
			if(!empty($r[$VARS['DB-KEY']])) { 
				echo "Update ".$VARS['LABELER'];
			} else { 
				echo "Add ".$VARS['LABELER'];
			}
			echo "</a>";
		}
		
		if(in_array('DELETE',$VARS['FUNCTIONALITY']) && (!empty($id))) {
			echo "&nbsp;&nbsp;<a href=\"javascript:;\" class=\"btn btn-primary btn-rect deleteButton\">Delete ".$VARS['LABELER']."</a>";
		}
		echo "</div>";
		echo "</div>";
		
		echo "</form>\n";
	
	}


	
	// Check if any custom Scripts for the Page. Scirpts are located in includes/custom-scripts/
	
	if( !empty( $VARS['CUSTOM-SCRIPT-ON-LOAD'] ) ) {
		
        if( is_file( BASE_PATH_CMS . 'custom-scripts/' . $VARS['PAGE-FILE'] . '.php' ) ) {
            
			include( BASE_PATH_CMS . 'custom-scripts/' . $VARS['PAGE-FILE'] . '.php' );
		
        }
	
    }

	echo "</div>";
    
	echo "</div>";
	
	echo "</div>";
	
} else {
	
    echo "<p>The Requested Content cannot be found.</p>";	
}