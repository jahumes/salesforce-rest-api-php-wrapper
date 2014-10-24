<?php

require_once 'SalesforceAPI.php';

$salesforce = new SalesforceAPI('https://na17.salesforce.com','32.0','<Consumer Key>', '<Consumer Secret>');

$salesforce->login('<Salesforce Login>','<Salesforce Password>','<Salesforce Security Token>');

$api_versions = $salesforce->getAPIVersions();
$limits = $salesforce->getOrgLimits();
$resource = $salesforce->getAvailableResources();
$objects = $salesforce->getAllObjects();

$date = new DateTime();

$good_metadata = $salesforce->getObjectMetadata('Account');
$good_metadata_all = $salesforce->getObjectMetadata('Account', true);
$good_metadata_since = $salesforce->getObjectMetadata('Account', true, $date);
$bad_metadata = $salesforce->getObjectMetadata('SomeOtherObject');

$create_account = $salesforce->create( 'Account', ['name' => 'New Account'] );
$update_project = $salesforce->update( 'Account', $create_account->id, ['name' => 'Changed'] );
$project = $salesforce->get( 'Account', $create_account->id );
$project_with_fields = $salesforce->get( 'Account', $create_account->id, ['Name', 'OwnerId'] );
$delete_project = $salesforce->delete( 'Account', $create_account->id );

$response = $salesforce->searchSOQL('SELECT name from Position__c',true);