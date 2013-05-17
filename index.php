<?php
// Set configurations based on environment
if( isset( $_SERVER['APPLICATION_ENV'] ) )
{
  // Set framework path
  $yii=dirname(__FILE__).'/../__yii/common/lib/yii/framework/yii.php';
 
  // Enable debug mode for development environment
  defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', true );
 
  // Specify how many levels of call stack should be shown in each log message
  defined( 'YII_TRACE_LEVEL' ) or define( 'YII_TRACE_LEVEL', 3 );
 
  // Set environment variable
  $environment = '-development';
  // $environment = $_SERVER['APPLICATION_ENV']; // Uncomment for dynamic config files
}else{
  // Set framework path
  //$yii = dirname( __FILE__ ) . '/../../yii/common/lib/yii/framework/yii.php';
   $yii=dirname(__FILE__).'/../__yii/common/lib/yii/framework/yii.php';
 
  // Set environment variable
  $environment = '';
}
 
// Include config files
$base=dirname(__FILE__).'/../__yii/frontend/config/main'. $environment . '.php';

// Include Yii framework
require_once( $yii );
 
// Run application
Yii::createWebApplication($base )->run();