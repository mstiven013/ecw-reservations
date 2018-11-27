<?php 

   function page_tabs( $current = 'generals' ) {

      $tabs = array(
         'generals'  => __( 'Generales', ECWR_NS ),
         'form'  => __( 'Formulario', ECWR_NS ),
         'email'   => __( 'Correo electrónico', ECWR_NS ),
         'help'  => __( 'Ayuda', ECWR_NS )
      );
      $html = '<h2 class="nav-tab-wrapper">';

      foreach( $tabs as $tab => $name ){
         $class = ( $tab == $current ) ? 'nav-tab-active' : '';
         $html .= '<a class="nav-tab ' . $class . '" href="?page=ecwr_global_settings&tab=' . $tab . '">' . $name . '</a>';
      }

      $html .= '</h2>';

      echo $html;
   }

?>

<div class="wrap ecw_reservations">

   <h1><?php _e('Ajustes generales', ECWR_NS); ?></h1>

   <?php

      $tab = ( ! empty( $_GET['tab'] ) ) ? esc_attr( $_GET['tab'] ) : 'generals';
      page_tabs( $tab );

      switch ($tab) {
         case 'generals':
            include('settings/general.php');
         break;

         case 'form':
            include('settings/form.php');
         break;

         case 'email':
            include('settings/email.php');
         break;

         case 'help':
            include('settings/help.php');
         break;

         default:
            include('settings/general.php');
         break;
      }
   ?>

</div>