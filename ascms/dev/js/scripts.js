$(document).ready(function(){
    
    // Check for Fancybox
    
	if( $( '.fancybox' ).length > 0 ) {
        
		$( '.fancybox' ).fancybox();
	
    }
    
	// Set Global Variables
	var popupStatus = 0; // set value
	var searchPopupStatus = 0; // set value
	
	// Check if update message has content, if so show it!
	if($('#updateMsg').html() != '') {
		$('#updateMsg').css('display','block');
		setTimeout(function() { 
			$('#updateMsg').animate({opacity: 1},500,function() { 
				setTimeout(function() { 
					$('#updateMsg').animate({opacity: 0},500,function() { 
						$('#updateMsg').css('display','none');
					});
				},2000);
			});			
		},200);
	}
	
	// If select box changes load the new URL from the 'value' field
	$('.pageReload').change(function() {
		pageReload = $(this).val();
		document.location = pageReload;
	});
    
    var upload_default = '';
    
    var upload_filled = false;
    
    // Upload Area Functionality
    
	$( '.upload-area' ).on( "dragover" , function( e ) {
    
		e.preventDefault();
        
        if ( upload_default == '' ) {
            
            upload_default = $( this ).html();
            
        }
		
        $( this ).children("span").html('<strong class="drop-file"><i class=\"fa fa-check\"></i>&nbsp;&nbsp;Drop Now!</strong>');
    
    }).on( "drop" , function( e ) {
		
        e.preventDefault();
          
        var m = $( this ).children( "span" );
        
        var d = $( this );
        
        var fn = random_string( 32 ) + '.' + get_extension( e.originalEvent.dataTransfer.files[0].type );
        
        set_upload( m , d, e.originalEvent.dataTransfer.files[0] , fn );
	   
        $( this ).children( "span" ).html( this.dropMsg );	
        
    }).on("dragleave", function(e) {
        
		e.preventDefault();
		
        $( this ).css('background','#fff');
        
        $( this ).html( upload_default );
	
    });
	
    $( document ).on( 'click' , '.upload-area-filled a' , function( ) {
       
        // Reset the Upload Tool
        
        var upload_area = $( this ).parents( '.upload-area' );
        
        var hidden_input = upload_area.data( 'field' );
        
        upload_area.html( upload_default );
        
        // Remove the hidden vars
        
        hidden_input = document.getElementsByName( hidden_input )[0];
        
        hidden_input.parentNode.removeChild( hidden_input );
        
        upload_filled = false;
        
    });

    
    $( '.upload-area' ).on( "click" , function( ) {
       
        var m = $( this ).children( "span" );
        
        var d = $( this );
        
        var fn = random_string( 32 );
        
        if ( upload_default == '' ) {
            
            upload_default = $( this ).html();
            
        }
        
        if( upload_filled == false ) { // Upload Only if has not been previously filled
            
            var input = document.createElement( 'input' );
        
            input.type = 'file';
        
            input.name = 'file-upload';
            
            input.setAttribute( 'class' , 'upload-hidden' );
            
            input.id = 'file-upload';
            
            document.getElementsByClassName('admin-form')[0].appendChild( input );
            
            input.addEventListener( 'change' , function inputevent( e ) {
                
                var ext = get_extension( e.target.files[0].type );
                
                fn =  fn + '.' + ext;
                
                set_upload( m , d , e.target.files[0] , fn );
                
            });
        
            input.click();          
            
        }
        
    });
    
	$('.searchButton').click(function() {
		// Bring up Search Popup
		searchPopup();
		return false;
	});
	
	$('.searchButton').mouseover(function() { $('#searchText').fadeIn('500'); });
	$('.searchButton').mouseout(function() { $('#searchText').fadeOut('500'); });	

	$('.logoutButton').mouseover(function() { $('#logoutText').fadeIn('500'); });
	$('.logoutButton').mouseout(function() { $('#logoutText').fadeOut('500'); });	
	
	// If user selects a required element, animate it from red to white again if error
	$('.requiredElement').focus(function() {
		if($(this).css('backgroundColor') != 'rgb(255,255,255)') {
			$(this).css('backgroundColor','rgb(255,255,255)'); 
		}
	});
	
	// If user clicks on the submit button we validate the page
	$('.submitButton').click(function() {
		var msg = ''; // Set Variables
		// Check the required Elements
		$('.requiredElement').each(function() {
			if($(this).val() == '') {
				msg += $(this).data('error')+"<br />\n";
			}
		});	
		
		$(".uploadImg").each(function(){
			if($(this).val() != '') {
				
				// Filename extension
				var fileName = $(this).val().toLowerCase();
				var fileNameArray = fileName.split('.');
				var fileExtension = fileNameArray[1];
				var hasFileMatch = false;
				
				// Get File Types
				var fileTypes = $(this).data('filetype');
				var filesArray = fileTypes.split('|');
				var filesSupportedLabel = '';
				
				// Check if has a file extension match
				$.each(filesArray, function() {
					filesSupportedLabel += this+', ';
					if(this.indexOf(fileExtension) !== -1) {
						hasFileMatch = true;
					}
				});
				
				filesSupportedLabel = filesSupportedLabel.substring(0, filesSupportedLabel.length - 2);		
				if(hasFileMatch == false) {
					msg += "File Upload for <strong>"+$(this).data('label')+"</strong> is not a supported file type. The file must be "+filesSupportedLabel+"<br />\n";
				}
				
			}
		});
		

		if(msg != '') {
			msg = '<strong>Please fix the following errors!</strong><br />'+msg;
		}
        
		checkPopUp(msg);		
	});

	// If User Hits Delete
	$('.deleteButton').click(function() {
		if (confirm('Are you sure you want to Delete?')) {
			$('<input>').attr({ type: 'hidden', name: 'deleteEntry', value:'true' }).appendTo('form');
			$('.admin-form').submit(); // Safe to submit form	
		} else {
		    // Do nothing!
		}
	});
	
	$("#searchPages").change(function() { $('.searchTerm').trigger('keyup'); });
	$("#searchProducts").change(function() { $('.searchTerm').trigger('keyup'); });
	$("#searchCustomers").change(function() { $('.searchTerm').trigger('keyup'); });
	$("#searchOrders").change(function() { $('.searchOrders').trigger('keyup'); });
	
	$('.searchTerm').keyup(function() {
		
		var searchFile = 'ajax/search-results.php';
		var searchVal = $(this).val();
		var searchProducts = '';
		var searchPages = '';
		var searchOrders = '';
		var searchCustomers = '';
		
		if(searchVal.length > 3) {
			$('#searchResults').html('<img src="includes/img/dest/ajax-loader-blue.gif" border="0" />');
			if($("#searchProducts").prop('checked') == true) { searchProducts = '1'; }
			if($("#searchPages").prop('checked') == true) { searchPages = '1'; }
			if($("#searchCustomers").prop('checked') == true) { searchCustomers = '1'; }
			if($("#searchOrders").prop('checked') == true) { searchOrders = '1'; }
			dataString = {'searchTerm':searchVal, 'searchProducts':searchProducts, 'searchPages':searchPages, 'searchCustomers':searchCustomers, 'searchOrders':searchOrders  }; // Create the Json Data String
			$('#searchResults').load(searchFile,dataString);
		} else {		
			$('#searchResults').html('');
		}
		
	});
	
	$('.removeItem').click(function() {
		var thisItem = $(this);
		var removeConfirmation = confirm("Are you Sure you want to Remove this item?");
		var fileItem = $(this).data('remove');
		var fileDetails = $(this).data('details');
		if (removeConfirmation == true) {
			dataString = {'fileItem':fileItem, 'fileDetails':fileDetails}; // Create the Json Data String	
			$.getJSON('ajax/remove-item.php',dataString, function(data) {
				if(data.RETURN == 'VALID') {
					alert('Item Removed!');
					thisItem.hide(500);
				}
			});
		} else {
			
		}
	});
	
	// Check if Popup Needs to loadup
	
    function checkPopUp( msg ) {
        
        if(msg != '') {
			$(".popup-msg").html("<div class=\"alert alert-danger\" style=\"margin-top:10px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>"+msg+"</div>");
			setTimeout(function(){ loadPopup(); }, 500); // .5 second
		} else {
			$('.admin-form').submit(); // Safe to submit form	
		}
	}
	
	// Loads up Popup Div
	function loadPopup() { 
		if(popupStatus == 0) { // if value is 0, show popup
			$(".popup-msg").fadeIn(0500); // fadein popup div
			popupStatus = 1; // and set value to 1
		}	
	}
	
	// Loads up Search Popup
	function searchPopup() {
		if(searchPopupStatus == 0) { // if value is 0, show popup
			$("#searchPopup").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001); 
			searchPopupStatus = 1; // and set value to 1
		}	
	}
	
	// Hides Popup Div
	function disablePopup() {
		if((popupStatus == 1) || (searchPopupStatus == 1)) { // if value is 1, close popup
			$("#toPopup").fadeOut("normal");  
			$("#searchPopup").fadeOut("normal");  
			$("#backgroundPopup").fadeOut("normal");  
			popupStatus = 0;  // and set value to 0
			searchPopupStatus = 0; // and set value to 1
		}
	}

	$("#backgroundPopup").click(function() {
		disablePopup();  // function close pop up
	});
	
    // Functions
    function escapeHtml(text) {
        return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }   

    // Sets the Image Upload into the thumbnail display

    function set_upload( m , d , f , fn ) {
        
        // Check if the file is an image

        if ( !f.name.match(/\.(jpg|jpeg|png|gif)$/) ) {

            m.html( '<strong>Error:</strong> Use jpeg, png or gif format!' );

            setTimeout( function dragerror() {

                d.trigger( 'dragleave' );   

            } , 2000 );

            return false;

        }

        d.css('background','#fff');

        var reader = new FileReader();

        reader.readAsDataURL( f );

        // Closure to capture the file information.

        reader.onprogress = ( function( f ) {

            m.html( '<img src="dist/img/loader.gif">' );

        });

        reader.onload = ( function( f ) {

            m.html('');

            d.append( '<div class="uploaded-img"><img src="' + f.target.result + '" style="max-height:148px;max-width:148px;" ><div class="upload-area-filled"><a href="javascript:;" title="remove">x</a></div></div>' );

            // Lets save the image temporarily to the server for future use
            
            var send_data = 'data=' + f.target.result + '&filename=' + fn;
            
            var form_data = new FormData();
            
            form_data.append( "data" , f.target.result );
            
            form_data.append( "filename" , fn );
            
            ajax_request( 'ajax/save-file.php' , form_data , function saved_upload() {
             
                // create a hidden form element for save reference during POST
                
                var field = d.data( 'field' );
                
                var submit_form = document.getElementsByClassName( 'admin-form' )[0];
                
                var form_ele = document.createElement('input');
                
                form_ele.setAttribute( 'type' , 'hidden' );
                
                form_ele.setAttribute( 'name' , field );
                
                form_ele.setAttribute( 'value' , fn );
                
                submit_form.appendChild( form_ele );
                
            });
            
            upload_filled = true;

        } );

    }
    
    // ajax_request ( [ file ] , [ data ] , [ callback function ] )
    
    function ajax_request( f , d , callbk ) {
        
        var my_request = new XMLHttpRequest();
        
        my_request.onload = function ajaxload( r ) {
            
            if( callbk !== false ) {
                
                    callbk( r );
                    
            }
            
        }
        
        my_request.open( 'POST' , f , true );  
        
        my_request.send( d );
        
    }
    
    function get_extension( mime ) {
        
        var mime_to_ext = { 'image/jpeg':'jpeg' , 'image/png':'png' };
        
        if( mime_to_ext[ mime ] ) {
            
            return mime_to_ext[ mime ];
            
        }
        
        return false;
        
    }
    
    function random_string( length ) {
        
        var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        var result = '';
    
        for ( var i = length ; i > 0 ; --i ) result += chars[ Math.round( Math.random() * ( chars.length - 1 ) ) ];
    
        return result;

    }
    
});