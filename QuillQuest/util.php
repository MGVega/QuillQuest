<?php

/**
 * Web Controller
 *
 * @author Wilowi - Sandra Campos
 * @since 06/07/2020
 *
 */
$no_cache = rand();

// --- Directories
define('_CONFIG', 'config/');
define('_CONTROLLERS', 'controllers/');
define('_CSS', 'css/');
define('_CSSPANEL', 'css/panel/');
define('_CSSWEB', 'css/web/');
define('_JS', 'js/');
define('_JSPANEL', 'js/panel/');
define('_JSWEB', 'js/web/');
define('_LIB', 'vendor/');
define('_MODELS', 'models/');
define('_VIEWS', 'views/');
define('_TEST', 'test/');
define('_IMAGES', 'images/');
define('_LOG', 'var/logs/');
define('_EXTRA', 'lib/');
define('_DOCUMENTS', 'documents/');
define('_DB','/../../dataDB/');
define('_TITLE','Mirandilla - Pueblos Inteligentes');
define('_JSP', 'panel.js?t='.$no_cache);
define('_JSW', 'web.js?t='.$no_cache);
define('_JSR', 'rutas.js?t='.$no_cache);
define('_JCONFIG', 'config.js?t='.$no_cache);
define('_JCOMUN', 'common.js?t='.$no_cache);
define('_FILECSS', 'common.css?t='.$no_cache);
define('_FILECSSSTYLE', 'style.css?t='.$no_cache);
define('_FILECSSPANEL', 'panel.css?t='.$no_cache);
define('_FILECSSSIMPLEBAR', 'simplebar.css?t='.$no_cache);
define('_FILECSSSIMPLEBARVENDOR', 'simplebar_vendor.css?t='.$no_cache);
define('_FILECSSWEB', 'web.css?t='.$no_cache);



?>