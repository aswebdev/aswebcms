$(document).ready(function(){

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
	
	// Get height of main content section. Expand if needed
	setTimeout(function() { 
		var currentHeight  = parseFloat(($('.colright').css('height')));
		
		if(currentHeight < window.innerHeight) {
			$('.colright').css('min-height',window.innerHeight+'px');
		}
	},200);
	
	// If select box changes load the new URL from the 'value' field
	$('.pageReload').change(function() {
		pageReload = $(this).val();
		document.location = pageReload;
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
				msg += "<p>"+$(this).data('error')+"</p>\n";
				$(this).css('backgroundColor','rgb(255,0,0)');
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
				jQuery.each(filesArray, function() {
					filesSupportedLabel += this+', ';
					if(this.indexOf(fileExtension) !== -1) {
						hasFileMatch = true;
					}
				});
				
				filesSupportedLabel = filesSupportedLabel.substring(0, filesSupportedLabel.length - 2);		
				if(hasFileMatch == false) {
					msg += "<p>File Upload for <strong>"+$(this).data('label')+"</strong> is not a supported file type. The file must be "+filesSupportedLabel+"</p>\n";
				}
				
			}
		});
		

		if(msg != '') {
			msg = '<span class="searchHeading">Please fix the following errors!</span>'+msg;
		}
		
		checkPopUp(msg);		
	});

	// If User Hits Delete
	$('.deleteButton').click(function() {
		if (confirm('Are you sure you want to Delete?')) {
			$('<input>').attr({ type: 'hidden', name: 'deleteEntry', value:'true' }).appendTo('form');
			$('.adminForm').submit(); // Safe to submit form	
		} else {
		    // Do nothing!
		}
		

	});
	
	$("#searchPages").change(function() { $('.searchTerm').trigger('keyup'); });
	$("#searchProducts").change(function() { $('.searchTerm').trigger('keyup'); });
	$("#searchCustomers").change(function() { $('.searchTerm').trigger('keyup'); });
	$("#searchOrders").change(function() { $('.searchOrders').trigger('keyup'); });
	
	$('.searchTerm').keyup(function() {
		
		var searchFile = 'includes/js/search-results.php';
		var searchVal = $(this).val();
		var searchProducts = '';
		var searchPages = '';
		var searchOrders = '';
		var searchCustomers = '';
		
		if(searchVal.length > 3) {
			$('#searchResults').html('<img src="includes/img/ajax-loader-blue.gif" border="0" />');
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
			$.getJSON('includes/js/remove-item.php',dataString, function(data) {
				if(data.RETURN == 'VALID') {
					alert('Item Removed!');
					thisItem.hide(500);
				}
			});
		} else {
			
		}
	});
	
	// Check if Popup Needs to loadup
	function checkPopUp(msg) {
		if(msg != '') {
			$('#popupContent').html(msg);
			setTimeout(function(){ loadPopup(); }, 500); // .5 second
		} else {
			$('.adminForm').submit(); // Safe to submit form	
		}
	}
	
	// Loads up Popup Div
	function loadPopup() { 
		if(popupStatus == 0) { // if value is 0, show popup
			$("#toPopup").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001); 
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
	
});