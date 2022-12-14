<?php

/*
|--------------------------------------------------------------------------
| GVIP specific settings
|--------------------------------------------------------------------------
*/
$config['ga_tracking_id'] = env('GOOGLE_ANALYTICS_ID');
$config['sa_tracking_id'] = env('SEGMENT_ID');
$config['intercom_secure_key'] = env('INTERCOM_KEY');
$config['linkedin'] = array(
    'api_key'    => env('LINKEDIN_API_KEY'),
    'secret_key' => env('LINKEDIN_SECRET_KEY')
);
$config['algolia'] = [
	'application_id' => env('ALGOLIA_APPLICATION_ID'),
	'admin_api_key'  => env('ALGOLIA_ADMIN_API_KEY'),
	'index_members'  => env('ALGOLIA_INDEX_MEMBERS'),
	'index_projects' => env('ALGOLIA_INDEX_PROJECTS')
];
$config['segment_write_key'] = env('SEGMENT_WRITE_KEY');
$config['mapbox'] = [
	'access_token' => env('MAPBOX_ACCESS_TOKEN')
];
$config['glide_image_signature'] = env('GLIDE_IMAGE_SIGNATURE');
$config['google_cloud_key'] = env('GOOGLE_CLOUD_API_KEY');

$config['stripe_publishable_key'] = env('STRIPE_API_KEY');
$config['stripe_api_key'] = env('STRIPE_SECRET_KEY');
$config['stripe_currency']        = 'usd';



//$config['queue_host'] = env('QUEUE_HOST');
