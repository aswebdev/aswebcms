<?php
// Set the Scripts
$scripts = new Headers('script'); // Include the sets of scripts
// Add Headers from attributes.json file
$metaHeader->addHeaders($scripts); // Output the Headers to the page
?>
</body>
</html>