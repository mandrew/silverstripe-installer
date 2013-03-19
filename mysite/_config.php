<?php

global $project;
$project = 'mysite';

require_once(FRAMEWORK_PATH . '/conf/ConfigureFromEnv.php');

//if no _ss_environment file was found, fall back to here
if (!defined('SS_ENVIRONMENT_FILE')) {
	global $databaseConfig;
	$databaseConfig = array(
		"type" => "MySQLDatabase",
		"server" => "localhost",
		"username" => "",
		"password" => "",
		"database" => ""
	);
}

Email::setAdminEmail('Better Brief <betterbrief+[user]@gmail.com>');

if (Director::isLive()) {
	$emailWriter = new SS_LogEmailWriter('betterbrief+[user]@gmail.com');
	$emailWriter->setFormatter(new BB_LogErrorEmailFormatter());
	SS_Log::add_writer($emailWriter);
	Config::inst()->update('GoogleSitemap', 'google_notification_enabled', true);
	//Email::setAdminEmail('Better Brief <betterbrief+[user]@gmail.com>');
}

// stop the user being able to select h1 in the editor!
HtmlEditorConfig::get('cms')->setOption('theme_advanced_blockformats', 'p,h2,h3,h4,h5,h6,address,pre');

//set admin user var for analytics for admin users
LeftAndMain::require_javascript('mysite/javascript/admin-analytics.js');

// Set mysql connections to use utf8 encoding
MySQLDatabase::set_connection_charset('utf8');

// Set the current theme. More themes can be downloaded from
// http://www.silverstripe.org/themes/
SSViewer::set_theme('default');

// Set image quality
//GD::set_default_quality(85);

// Set the correct default language, this is used for Users
// and for the content-language meta tag
i18n::set_locale('en_GB');

// Enable nested URLs for this site (e.g. page/sub-page/)
if(class_exists('SiteTree')) SiteTree::enable_nested_urls();

//allow full search of the site
//FulltextSearchable::enable();
