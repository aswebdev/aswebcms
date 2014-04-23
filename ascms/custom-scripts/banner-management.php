<script>
// Banner Management Custom 
$(document).ready(function(){
	$('#TYPE').change(function() {
		var currentVal = $(this).val();
		
		$('#HTML-CONTENT-HOLDER').fadeOut(500);
		$('#CLICK-THROUGH-URL-HOLDER').fadeOut(500);
		$('#IMAGE-FILENAME-HOLDER').fadeOut(500);
		
		switch(currentVal) {
			case 'HTML':
				$('#HTML-CONTENT-HOLDER').fadeIn(500);
			break;
			case 'IMAGE':
				$('#CLICK-THROUGH-URL-HOLDER').fadeIn(500);
				$('#IMAGE-FILENAME-HOLDER').fadeIn(500);
			break;
		}
		
	});
	
	$('#TYPE').trigger('change');
	
});

</script>