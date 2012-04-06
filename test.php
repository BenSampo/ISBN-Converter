<?php

	require_once('ISBNConverter.class.php');
	
	$ic = new ISBNConverter;
	
	$example_isbn_10 = '0241003008'; 	// ISBN-13: 9780241003008
	$example_isbn_13 = '9780596157135';	// ISBN-10: 0596157134
	
	echo $ic->convert($example_isbn_10, '13');
	echo '<br />';
	echo $ic->convert($example_isbn_13, '10');
	
	echo '<br />';
	echo '<br />';
	
	echo $ic->convert($example_isbn_10, '13', false);
	echo '<br />';
	echo $ic->convert($example_isbn_13, '10', false);
	
	echo '<br />';
	echo '<br />';
	
	echo $ic->isValid('0241003008') ? 'true' : 'false'; // Valid
	echo '<br />';
	echo $ic->isValid('0241003118') ? 'true' : 'false'; // Invalid
	
	echo '<br />';
	echo '<br />';
	
	echo $ic->to10($example_isbn_10);
	echo '<br />';
	echo $ic->to10($example_isbn_13);
	
	echo '<br />';
	echo '<br />';
	
	echo $ic->to13($example_isbn_10);
	echo '<br />';
	echo $ic->to13($example_isbn_13);
	
	echo '<br />';
	echo '<br />';
	
	echo $ic->format($example_isbn_10);
	echo '<br />';
	echo $ic->format($example_isbn_13);
	
?>