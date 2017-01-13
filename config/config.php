<?php

/*
 * Application directories
 */
define ('_DB_SERVER_', 'inight.club');
define ('APP_DIR', 'application/core/');                // model-view-controller directory
define ('LIB_DIR', 'application/lib/');                 // application library directory
define ('CLASS_DIR', 'application/classes/');           // classes directory
define ('GENER_DIR', 'application/lib/generators/');    // generators library directory
define ('ABSTR_DIR', 'application/classes/abstract/');  // abstract classes directory
define ('TEMPL_DIR', 'templates/');                     // page templates directory
define ('GALLERY_DIR', 'gallery/');                     // gallery directory
define ('IMG_DIR', 'images/');                             // images directory
define ('DOC_DIR', 'docs/');                            // documents directory
define ('SND_DIR', 'sounds/');                          // sounds directory
define ('INSTALL_DIR', 'install/');                     // install directory
define ('INSTALL_FILE', 'script.php');                  // script file name
define ('INSTALL_SCRIPT', INSTALL_DIR . INSTALL_FILE);  // path to install script
define ('INSTALL_IDX', 'index.php');                    // install index file name
define ('INSTALL_INDEX', INSTALL_DIR . INSTALL_IDX);    // path to install index

/*
 * Database connection
 */
 
define ('DB_HOST', 'localhost');  // db hostname
define ('DB_NAME', 'inight');  // db name
define ('DB_USER', 'Daniel');  // db username
define ('DB_PASS', 'Daniel');  // db password  

/*
 * User groups to resource access levels
 */
 
define ('GUEST', 0); 
define ('ADMIN', 1); 
define ('OPERATOR', 2); 
define ('USER', 3); 
define ('FREE', 4); 

/*
 * Message and dialog types
 */
 
define ('MSG_INFORMATION', 1); 
define ('MSG_QUESTION', 2); 
define ('MSG_WARNING', 3); 
define ('MSG_ERROR', 4); 

/*
 * Menu types
 */

define ('NAVIGATOR', 1);   // Main Menu
define ('CATEGORIES', 2);  // Sidebar Menu

/*
 * Others
 */
 
/* Before database starts: */
define ('PAGE_LOGO', IMG_DIR.'logo/logo.png');      // main logo
define ('PAGE_TITLE', 'inight.club');                     // main title
define ('PAGE_SUBTITLE', 'Nightclubs Database');             // main subtitle

/* Categories: */
define ('DEFAULT_LINK', '{_default_category_link_}');   // new category link

?>
