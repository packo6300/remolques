<?php
/*
$view = new Smarty( FFROOT.'/setup' );
      $view->assign( 'app', $ini['application'] );
      $view->assign( 'message', $message );
      foreach( (array)$param as $k=>$v ) $view->assign( $k, $v );
      echo $view->fetch( 'login.tpl' );
      exit(0);
*/
define('SROOT', $_SERVER['DOCUMENT_ROOT']);
echo 'LA RUTA ES: '.SROOT;