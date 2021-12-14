<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package  Amaz Store
 * @since 1.0.0
 */ 
?>
<footer>
         <?php 
          // top-footer 
          do_action( 'amaz_store_top_footer' ); 
          // widget-footer
		      do_action( 'amaz_store_widget_footer' );
		      // below-footer
          do_action( 'amaz_store_below_footer' );  
          do_action( 'amaz_store_woo_cart' ); 
        ?>
     </footer> <!-- end footer -->
    </div> <!-- end amazstore-site -->
<?php wp_footer(); ?>
</body>
</html>