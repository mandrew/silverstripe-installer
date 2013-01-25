<?php

global $project;
$project = 'mysite';

require_once('conf/ConfigureFromEnv.php');

Email::setAdminEmail('Better Brief <betterbrief@gmail.com>');

global $databaseConfig;
//live details here as dev details will be in a _ss_environment file
if (empty($databaseConfig)) {
	$databaseConfig = array(
		"type" => "MySQLDatabase",
		"server" => "localhost",
		"username" => "",
		"password" => "",
		"database" => ""
	);
	$emailWriter = new SS_LogEmailWriter('betterbrief@gmail.com');
	$emailWriter->setFormatter(new BB_LogErrorEmailFormatter());
	SS_Log::add_writer($emailWriter);
	GoogleSitemap::enable_google_notification();
}

// stop the user being able to select h1 in the editor!
HtmlEditorConfig::get('cms')->setOption('theme_advanced_blockformats', 'p,h2,h3,h4,h5,h6,address,pre');

//set admin user var for analytics for admin users
LeftAndMain::require_javascript('mysite/javascript/admin-analytics.js');

MySQLDatabase::set_connection_charset('utf8');

// Set the current theme. More themes can be downloaded from
// http://www.silverstripe.org/themes/
SSViewer::set_theme('default');

// Enable nested URLs for this site (e.g. page/sub-page/)
if(class_exists('SiteTree')) SiteTree::enable_nested_urls();
