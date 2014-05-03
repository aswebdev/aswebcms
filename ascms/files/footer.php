	</div>
    </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo BASE_URL_CMS_ASSETS; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_CMS_ASSETS; ?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_CMS_ASSETS; ?>js/main.js"></script>
<?php

// Add in any extra jQuery or JavaScript includes

// Has included files. Add these to the display

if(!isset($VARS['INCLUDE-FILES'])) { $VARS['INCLUDE-FILES'] = ''; }

if(is_array($VARS['INCLUDE-FILES'])) {
	
	foreach($VARS['INCLUDE-FILES'] as $includesArray) {
        
        
        
        if( !isset( $includesArray['BASE'] ) ) { $includesArray['BASE'] = ''; }
		
        if( $includesArray['BASE'] == 'CMS' ) { $baseURL = BASE_URL_CMS; } else { $baseURL = BASE_URL; }
		
        switch( $includesArray['TYPE'] ) {
		
            case 'JS':
            
				echo "<script src=\"" . $baseURL . $includesArray['LOCATION'] . "?" . rand(1000,5000) . "\"></script>\n";
			
            break;
		
        }
	
    }

}

if( isset( $wysiwygCode ) ) { echo "<script>\n" . $wysiwygCode . "</script>"; } // Print out the editor JavaScript code if it exists

?>
<script type="text/javascript" src="<?php echo BASE_URL_CMS_ASSETS; ?>js/scripts.js"></script>