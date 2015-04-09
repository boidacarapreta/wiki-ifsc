<?php
# This file was automatically generated by the MediaWiki 1.24.1
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "Wiki Institucional";
$wgMetaNamespace = "Wiki_Institucional";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "/wiki";
$wgArticlePath = "/wiki/$1";
$wgUsePathInfo = true;
$wgScriptExtension = ".php";

## The protocol and server name to use in fully-qualified URLs
$wgServer = "https://wiki.openstack.sj.ifsc.edu.br";

## The relative URL path to the skins directory
$wgStylePath = "$wgScriptPath/skins";

## The relative URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = "$wgScriptPath/resources/assets/wiki.png";

## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = false; # UPO

$wgEmergencyContact = "webmaster@openstack.sj.ifsc.edu.br";
$wgPasswordSender = "webmaster@openstack.sj.ifsc.edu.br";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = false;

## Database settings
$wgDBtype = "mysql";
$wgDBserver = "wiki0:13306";
$wgDBname = "mediawiki";
$wgDBuser = "mediawiki";
$wgDBpassword = "mediawiki";

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = true;

## Shared memory settings
$wgMainCacheType = CACHE_MEMCACHED;
$wgMemCachedServers = array( 'wiki0:11211\r\nwiki1:11211' );

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
#$wgUseImageMagick = true;
#$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from http://commons.wikimedia.org
$wgUseInstantCommons = true;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "C.UTF-8";

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
#$wgHashedUploadDirectory = false;

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/Names.php
$wgLanguageCode = "pt-br";

$wgSecretKey = "8a3eeb546c648fe23143da01ddb7f497ae462130b91ddc0eb75d531abcfaaf7b";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "e8e9c1bb1e551901";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "http://creativecommons.org/licenses/by-nc-sa/3.0/";
$wgRightsText = "Creative Commons - Atribuição - Uso Não Comercial - Partilha nos Mesmos Termos";
$wgRightsIcon = "{$wgScriptPath}/resources/assets/licenses/cc-by-nc-sa.png";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['*']['edit'] = false;

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
#$wgDefaultSkin = "";

# End of automatically generated settings.
# Add more configuration options below.

# Tema padrão: Vector.
require_once "$IP/skins/Vector/Vector.php";

# Armazenamento da sessão no banco de dados ao invés de arquivo.
#$wgSessionHandler = 'session_mysql';
#$wgSessionsInObjectCache = true;
#$wgSessionCacheType = CACHE_DB;

# Visual Editor
#require_once "$IP/extensions/VisualEditor/VisualEditor.php";
#$wgDefaultUserOptions['visualeditor-enable'] = 1;
#$wgHiddenPrefs[] = 'visualeditor-enable';
#$wgDefaultUserOptions['visualeditor-enable-experimental'] = 1;

require_once "$IP/extensions/SimpleSamlAuth/SimpleSamlAuth.php";
$wgSamlRequirement = SAML_LOGIN_ONLY;
$wgSamlCreateUser = false;
$wgSamlConfirmMail = false;
$wgSamlUsernameAttr = 'uid';
$wgSamlRealnameAttr = 'cn';
$wgSamlMailAttr = 'mail';
$wgSamlSspRoot = '/usr/share/simplesamlphp';
$wgSamlAuthSource = 'idpcafe.ifsc.edu.br';
$wgSamlPostLogoutRedirect = null;

$wgUseSquid = true;
$wgUsePrivateIPs = true;
