<?php
require_once 'podio-php-master/PodioAPI.php';
Podio::setup( CLIENT_ID, CLIENT_SECRET);
Podio::authenticate_with_app(APP_ID, APP_SECRET);
if ( Podio::is_authenticated() ) {
	try {
		// There are two way to update an item
		// First method
		PodioItem::update(ITEM_ID, array('fields' => array(FIELD_EXTERNAL_ID => FIELD_VALUE), array('silent' => true, 'hook' => true)));

		// Second method (example: Text field)
		PodioItemField::update( ITEM_ID, FIELD_ID, array('value' => FIELD_VALUE), array('silent' => true, 'hook' => true) );
		// NOTE: The third parameter should be always options (hook, silent) for all item update/create calls

		// If you are doing a file upload to Podio
		// Step - 1
		// Upload file to Podio and get file ID
		// Returns file ID
		PodioFile::upload( FILE_PATH, FILE_NAME );

		// Step - 2
		// Attach the file to Podio entity (item, space etc..)
		PodioFile::attach( FILE_ID,  array('ref_type' => 'item', 'ref_id' => ITEM_ID), array('hook' => true, 'silent' => true) );
		// All variables in CAPS are dynamic and it need to be changed to actual value while coding
		
	} catch ( Exception $e ) {
		// Handle exception
	}
}
