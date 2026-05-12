<?php
/**
 * Perform all main WooCommerce configurations for this theme
 *
 * @package Amaze Store WordPress theme
 */
// If plugin - 'WooCommerce' not exist then return.
if ( ! class_exists( 'WooCommerce' ) ){
	return;
}
if ( ! function_exists( 'is_plugin_active' ) ) {
         require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
/**
 * Amaze Store WooCommerce Compatibility
 */
if ( ! class_exists( 'amaz_store_Pro_Woocommerce_Ext' ) ) :
	/**
	 * amaz_store_Pro_Woocommerce_Ext Compatibility
	 *
	 * @since 1.0.0
	 */
	class amaz_store_Pro_Woocommerce_Ext{

        /**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
        /**
		 * Constructor
		 */
		public function __construct(){
		    add_action( 'wp_enqueue_scripts',array( $this, 'amaz_store_add_scripts' ));	
		    add_action( 'wp_enqueue_scripts',array( $this, 'amaz_store_add_style' ));	

		    add_filter( 'post_class', array( $this, 'amaz_store_post_class' ) );
		   
		    add_action( 'after_setup_theme', array( $this, 'amaz_store_common_actions' ), 999 );
		    add_filter( 'open_theme_js_localize', array( $this, 'amaz_store_js_localize' ) );
		    add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'amaz_store_product_flip_image' ), 10 );
		    // Register Store Sidebars.
			add_action( 'widgets_init', array( $this, 'amaz_store_store_widgets_init' ), 15 );
			add_action( 'after_setup_theme', array( $this, 'amaz_store_setup_theme' ) );
			// Replace Store Sidebars.
			add_filter( 'amaz_store_get_sidebar', array( $this, 'amaz_store_replace_store_sidebar' ) );
		    // quick view ajax.
			add_action( 'wp_ajax_thnk_load_product_quick_view', array( $this, 'amaz_store_load_product_quick_view_ajax' ) );
			add_action( 'wp_ajax_nopriv_thnk_load_product_quick_view', array( $this, 'amaz_store_load_product_quick_view_ajax' ) );
			add_action('amaz_store_woo_quick_view_product_summary', array( $this, 'amaz_store_woo_single_product_content_structure' ), 10, 1 );
			//shop
			 add_action('woocommerce_before_shop_loop', array($this, 'amaz_store_before_shop_loop'), 35);
			 add_action('woocommerce_after_shop_loop_item', array($this, 'amaz_store_list_after_shop_loop_item'),5);
			 // pagination
            add_action( 'amaz_store_pagination_infinite', array( $this, 'shop_page_styles' ) );
            add_action( 'amaz_store_pagination_infinite', array( $this, 'amaz_store_common_actions' ), 999 );

            add_action( 'wp_ajax_amaz_store_pagination_infinite', array( $this, 'amaz_store_pagination_infinite' ) );
            
			add_action( 'wp_ajax_nopriv_amaz_store_pagination_infinite', array( $this, 'amaz_store_pagination_infinite' ) );
			// Custom Template Quick View.
			$this->amaz_store_quick_view_content_actions();
			
		    add_action( 'wp', array( $this, 'amaz_store_single_product_customization' ) );
           
            // Alter cross-sells display
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			if ( '0' != get_theme_mod( 'amaz_store_cross_num_col_shw', '2' ) ) {
				add_action( 'woocommerce_cart_collaterals', array( $this, 'amaz_store_cross_sell_display' ) );
			}


		 }
		 // woocommerce sidebar
		/**
		 * Store widgets init.
		 */
		function amaz_store_store_widgets_init(){
			register_sidebar(array(
		              'name'          => esc_html__( 'WooCommerce Sidebar', 'amaz-store' ),
		              'id'            => 'open-woo-shop-sidebar',
		              'description'   => esc_html__( 'Add widgets here to appear in your WooCommerce Sidebar.', 'amaz-store' ),
		              'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="amaz-store-widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	        ) );
			register_sidebar(array(
		              'name'          => esc_html__( 'Product Sidebar', 'amaz-store' ),
		              'id'            => 'open-woo-product-sidebar',
		              'description'   => esc_html__( 'This sidebar will be used on Single Product page.', 'amaz-store' ),
		              'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="amaz-store-widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	        ) );
	        
		}
		/**
		 * Assign shop sidebar for store page.
		 *
		 * @param String $sidebar Sidebar.
		 *
		 * @return String $sidebar Sidebar.
		 */
		function amaz_store_replace_store_sidebar( $sidebar ){

			if ( is_shop() || is_product_taxonomy() || is_checkout() || is_cart() || is_account_page() ){
				$sidebar = 'open-woo-shop-sidebar';
			}elseif ( is_product() ){
				$sidebar = 'open-woo-product-sidebar';
			}
			return $sidebar;
		}
       /**
		 * Setup theme
		 *
		 * @since 1.0.3
		 */
		function amaz_store_setup_theme(){
			// WooCommerce.
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}

		/**
 * Safely get current WC_Product instance (or null).
 *
 * @return WC_Product|null
 */
private function amaz_store_get_current_product() {
    global $product;

    // If global $product exists and is a WC_Product, use it.
    if ( ! empty( $product ) && ( $product instanceof WC_Product ) ) {
        return $product;
    }

    // Fallback: try to get product for current post ID.
    $post_id = get_the_ID();
    if ( $post_id && function_exists( 'wc_get_product' ) ) {
        $p = wc_get_product( $post_id );
        if ( $p instanceof WC_Product ) {
            return $p;
        }
    }

    // Nothing found.
    return null;
}


		/**
		 * Product Flip Image
		 */

		function amaz_store_product_flip_image(){
    $hover_style = get_theme_mod( 'amaz_store_woo_product_animation' );

    // only proceed for configured hover styles
    if ( ! in_array( $hover_style, array( 'swap', 'slide' ), true ) ) {
        return;
    }

    // get product safely
    $product = $this->amaz_store_get_current_product();
    if ( ! ( $product instanceof WC_Product ) ) {
        return;
    }

    $attachment_ids = $product->get_gallery_image_ids();
    if ( empty( $attachment_ids ) || ! is_array( $attachment_ids ) ) {
        return;
    }

    $image_size = apply_filters( 'single_product_archive_thumbnail_size', 'shop_catalog' );

    if ( 'swap' === $hover_style ) {
        $image_html = apply_filters( 'open_woocommerce_amaz_store_product_flip_image', wp_get_attachment_image( reset( $attachment_ids ), $image_size, false, array( 'class' => 'show-on-hover' ) ) );
        echo wp_kses_post( $image_html );
    } elseif ( 'slide' === $hover_style ) {
        $image_html = apply_filters( 'amaz_store_woocommerce_product_flip_image', wp_get_attachment_image( reset( $attachment_ids ), $image_size, false, array( 'class' => 'show-on-slide' ) ) );
        echo wp_kses_post( $image_html );
    }
}

		
		/**
		 * Post Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @return array;
		 */
		function amaz_store_post_class( $classes ){

    // Only run inside WooCommerce product loops (shop, archive, related, upsell, cross-sell)
    if ( !( is_product() && function_exists( 'wc_get_loop_prop' ) && ! wc_get_loop_prop( 'name' ) ) ) {

        if ( ! amaz_store_is_blog() || is_shop() || is_product_taxonomy() || post_type_exists( 'product' ) ) {
            $classes[] = 'thunk-woo-product-list';
            $qv_enable = get_theme_mod( 'amaz_store_woo_quickview_enable', true );
            if ( true == $qv_enable ) {
                $classes[] = 'opn-qv-enable';
            }
        }

        // Hover / style classes
        $hover_style = get_theme_mod( 'amaz_store_woo_product_animation' );
        if ( '' !== $hover_style ) {
            $classes[] = 'amaz-store-woo-hover-' . esc_attr( $hover_style );
        }

        $single_product_tab_style = get_theme_mod( 'amaz_store_single_product_tab_layout','horizontal' );
        if ( '' !== $single_product_tab_style ) {
            $classes[] = 'open-single-product-tab-' . esc_attr( $single_product_tab_style );
        }

        $shadow_style = get_theme_mod( 'amaz_store_product_box_shadow' );
        if ( '' !== $shadow_style ) {
            $classes[] = 'open-shadow-' . esc_attr( $shadow_style );
        }
        $shadow_hvr_style = get_theme_mod( 'amaz_store_product_box_shadow_on_hover' );
        if ( '' !== $shadow_hvr_style ) {
            $classes[] = 'open-shadow-hover-' . esc_attr( $shadow_hvr_style );
        }

        // Hover effects only when gallery images exist
        if ( in_array( $hover_style, array( 'swap', 'slide' ), true ) && ! is_page_template( 'frontpage.php' ) && ! is_admin() && ! amaz_store_is_blog() ) {
            $product = $this->amaz_store_get_current_product();
            if ( $product instanceof WC_Product ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ( is_array( $attachment_ids ) && count( $attachment_ids ) > 0 ) {
                    $classes[] = ( 'swap' === $hover_style ) ? 'amaz-store-swap-item-hover' : 'amaz-store-slide-item-hover';
                }
            }
        }
    }
    return $classes;
}

		/**
		 * Infinite Products Show on scroll
		 *
		 * @since 1.1.0
		 * @param array $localize   JS localize variables.
		 * @return array
		 */
		function amaz_store_js_localize( $localize ){
			global $wp_query;
			$amaz_store_pagination                   = get_theme_mod( 'amaz_store_pagination' );
			$localize['ajax_url']                   = admin_url( 'admin-ajax.php' );
			$localize['is_cart']                    = is_cart();
			$localize['is_single_product']          = is_product();
			$localize['query_vars']                 = json_encode( $wp_query->query );
			$localize['shop_quick_view_enable']     = get_theme_mod('amaz_store_woo_quickview_enable','true' );
			$localize['shop_infinite_nonce']        = wp_create_nonce( 'opn-shop-load-more-nonce' );
			$localize['shop_infinite_count']        = 2;
			$localize['shop_infinite_total']        = $wp_query->max_num_pages;
			$localize['shop_pagination']            = $amaz_store_pagination;
			$localize['shop_infinite_scroll_event'] = $amaz_store_pagination;
			$localize['query_vars']                 = json_encode( $wp_query->query );
			$localize['shop_no_more_post_message']  = apply_filters( 'amaz_store_no_more_product_text', __( 'No more products to show.', 'amaz-store' ) );
			return $localize;
			
		}
       /**
		 * Common Actions.
		 *
		 * @since 1.1.0
		 * @return void
		 */
		function amaz_store_common_actions(){
			// Shop Pagination.
			$this->shop_pagination();
			// Quick View.
			$this->amaz_store_shop_init_quick_view();

		}
		/**
		 * Init Quick View
		 */
		function amaz_store_shop_init_quick_view(){
			$qv_enable = get_theme_mod( 'amaz_store_woo_quickview_enable','true' );
			if ( true == $qv_enable ){
				add_filter( 'open_theme_js_localize', array( $this, 'amaz_store_amaz_store_qv_js_localize' ) );
				add_action( 'quickview', array( $this,'amaz_store_add_quick_view_on_img' ),15);
				// load modal template.
				add_action( 'wp_footer', array( $this, 'amaz_store_quick_view_html' ) );
			}
		}
		/**
		 * Add Scripts
		 */
		function amaz_store_add_scripts(){
		   wp_enqueue_script( 'amaz-store-woocommerce-js', AMAZ_STORE_THEME_URI .'/inc/woocommerce/js/woocommerce.js', array( 'jquery' ), '2.0.0', true );
           $localize = array(
				'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
				//cat-tab-filter
				'amaz_store_single_row_slide_cat' => get_theme_mod('amaz_store_single_row_slide_cat',false),
				'amaz_store_cat_slider_optn' => get_theme_mod('amaz_store_cat_slider_optn',false),
				
				//product-slider
				'amaz_store_single_row_prdct_slide' => get_theme_mod('amaz_store_single_row_prdct_slide',false),
				'amaz_store_product_slider_optn' => get_theme_mod('amaz_store_product_slider_optn',false),
				//cat-slider
				'amaz_store_category_slider_optn' => get_theme_mod('amaz_store_category_slider_optn',false),
				//product-list
				'amaz_store_single_row_prdct_list' => get_theme_mod('amaz_store_single_row_prdct_list',false),
				'amaz_store_product_list_slide_optn' => get_theme_mod('amaz_store_product_list_slide_optn',false),
				//category slider coloum
				'amaz_store_cat_item_no' => get_theme_mod('amaz_store_cat_item_no','5'),
				'amaz_store_rtl' => (bool)get_theme_mod('amaz_store_rtl'),
				// 'amaz_store_frontpage_sidebar' => get_post_meta( get_option( 'page_on_front' ), 'amaz_store_sidebar_dyn', true ),
				'amaz_store_frontpage_sidebar' =>amaz_store_sidebar_layout(get_post_meta( get_option( 'page_on_front' ), 'amaz_store_sidebar_dyn', true ),''),
				
				
				
			);
           wp_localize_script( 'amaz-store-woocommerce-js', 'amazstore',  $localize );	
           wp_enqueue_script('open-quick-view', AMAZ_STORE_THEME_URI.'inc/woocommerce/quick-view/js/quick-view.js', array( 'jquery' ), '', true );
           wp_localize_script('open-quick-view', 'amazstoreqv', array(
           	'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' )),
           	'nonce'   => wp_create_nonce( 'th_quickview_nonce' ), 
           ));
          
		   }
		/**
		 * Add Style
		 */
		function amaz_store_add_style(){
        wp_enqueue_style( 'open-quick-view', AMAZ_STORE_THEME_URI. 'inc/woocommerce/quick-view/css/quick-view.css', null, '');
		}
        /**
		 * Quick view localize.
		 *
		 * @since 1.0
		 * @param array $localize   JS localize variables.
		 * @return array
		 */
		function amaz_store_amaz_store_qv_js_localize( $localize ){
			global $wp_query;
			$loader = '';
			if ( ! isset( $localize['ajax_url'] ) ){
				$localize['ajax_url'] = admin_url( 'admin-ajax.php', 'relative' );
			}
			$localize['qv_loader'] = $loader;
			return $localize;
		}
		/**
		 * Quick view on image
		 */
		function amaz_store_add_quick_view_on_img(){
		$product = $this->amaz_store_get_current_product();

    // If no product available, bail early.
    if ( ! ( $product instanceof WC_Product ) ) {
        return;
    }
    $product_id = $product->get_id();

			// Get label.
			$label = __( 'Quick View', 'amaz-store' );
			$button = '';

			$button.='<div class="thunk-quik">
			             <div class="thunk-quickview">
                               <span class="quik-view">
                                   <a href="#" class="opn-quick-view-text" data-product_id="' . esc_attr($product_id). '">
                                      <span>'.esc_html($label).'</span>
                                    
                                   </a>
                            </span>
                          </div>';
            $button.= '</div>';
			$button = apply_filters( 'open_woo_add_quick_view_text_html', $button, $label, $product );
			echo $button;
		}
		/**
		 * Quick view html
		 */
		function amaz_store_quick_view_html(){
			$this->amaz_store_quick_view_dependent_data();
			require_once AMAZ_STORE_THEME_DIR . 'inc/woocommerce/quick-view/quick-view-modal.php';
		}
		/**
		 * Quick view dependent data
		 */
		function amaz_store_quick_view_dependent_data(){
			wp_enqueue_script( 'wc-add-to-cart-variation' );
			wp_enqueue_script( 'flexslider' );
		}
        /**
		 * Quick view ajax
		 */
		function amaz_store_load_product_quick_view_ajax(){


			 // Verify nonce.
			    check_ajax_referer( 'th_quickview_nonce', 'nonce' );

			    // Validate product ID.
			    $product_id = isset( $_POST['product_id'] )
			        ? absint( wp_unslash( $_POST['product_id'] ) )
			        : 0;

			    // Invalid ID.
			    if ( empty( $product_id ) ) {

			        wp_send_json_error(
			            array(
			                'message' => esc_html__( 'Invalid product ID.', 'amaz-store' ),
			            ),
			            400
			        );
			    }

			    // Get product.
			    $product = wc_get_product( $product_id );

			    // Validate product.
			    if (
			        ! $product ||
			        'product' !== get_post_type( $product_id ) ||
			        'publish' !== get_post_status( $product_id )
			    ) {

			        wp_send_json_error(
			            array(
			                'message' => esc_html__( 'Product not found.', 'amaz-store' ),
			            ),
			            404
			        );
			    }

			// set the main wp query for the product.
			wp( 'p=' . $product_id . '&post_type=product' );
			// remove product thumbnails gallery.
			remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
			ob_start();
			// load content template.
			require_once AMAZ_STORE_THEME_DIR . 'inc/woocommerce/quick-view/quick-view-product.php';
			echo ob_get_clean();
			die();
		}

		/**
		 * Quick view actions
		 */
		public function amaz_store_quick_view_content_actions(){
			// Image.
			add_action('amaz_store_woo_qv_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action('amaz_store_woo_qv_product_image', array( $this, 'amaz_store_qv_product_images_markup' ), 20 );
		} 
			
		/**
		 * Footer markup.
		 */
		function amaz_store_qv_product_images_markup(){
           require_once AMAZ_STORE_THEME_DIR . 'inc/woocommerce/quick-view/quick-view-product-image.php';
		}
        function amaz_store_woo_single_product_content_structure(){
							/**
							 * Add Product Title on single product page for all products.
							 */
							do_action( 'amaz_store_woo_single_title_before' );
							woocommerce_template_single_title();
							do_action( 'amaz_store_woo_single_title_after' );
							/**
							 * Add Product Price on single product page for all products.
							 */
							do_action( 'amaz_store_woo_single_price_before' );
							woocommerce_template_single_price();
							do_action( 'amaz_store_woo_single_price_after' );
							/**
							 * Add rating on single product page for all products.
							 */
							do_action( 'amaz_store_woo_single_rating_before' );
							woocommerce_template_single_rating();
							do_action( 'amaz_store_woo_single_rating_after' );
							
							do_action( 'amaz_store_woo_single_short_description_before' );
							woocommerce_template_single_excerpt();
							do_action( 'amaz_store_woo_single_short_description_after' );
							
							do_action( 'amaz_store_woo_single_add_to_cart_before' );
							woocommerce_template_single_add_to_cart();
							do_action( 'amaz_store_woo_single_add_to_cart_after' );
							
							do_action( 'amaz_store_woo_single_category_before' );
							woocommerce_template_single_meta();
							do_action( 'amaz_store_woo_single_category_after' );
			
		}

        /**
		 * Single Product customization.
		 *
		 * @return void
		 */
		function amaz_store_single_product_customization(){
			if ( ! is_product() ){
				return;
			}
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
            add_filter('woocommerce_product_description_heading', '__return_empty_string');
            add_filter('woocommerce_product_reviews_heading', '__return_empty_string');
            add_filter('woocommerce_product_additional_information_heading', '__return_empty_string');
        
			/* Display Related Products */
			if ( ! get_theme_mod( 'amaz_store_related_product_display',true ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}
			/* Display upsell Products */
			if ( ! get_theme_mod( 'amaz_store_upsell_product_display',true ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 20 );
			}

			if(get_theme_mod( 'amaz_store_upsell_product_display',true )==true){
			  add_action( 'woocommerce_after_single_product_summary',array( $this, 'amaz_store_woocommerce_output_upsells' ),15);
             }else{
             remove_action( 'woocommerce_after_single_product_summary',array( $this, 'amaz_store_woocommerce_output_upsells' ));	
             }
             add_filter( 'woocommerce_output_related_products_args', array( $this, 'amaz_store_related_no_col_product_show' ) );

		}
	    /*****************/
		// upsale product
       /*****************/
		function amaz_store_woocommerce_output_upsells(){
		$upsell_columns = get_theme_mod('amaz_store_upsale_num_col_shw','4');
		$upsell_no_product = get_theme_mod( 'amaz_store_upsale_num_product_shw','4');	
        woocommerce_upsell_display($upsell_no_product,$upsell_columns); // Display max 3 products, 3 per row
         }
        /*****************************/ 
        // realted product argument pass
        /*****************************/ 
        function amaz_store_related_no_col_product_show( $args){
		$rel_columns = get_theme_mod('amaz_store_related_num_col_shw','5');
		$rel_no_product = get_theme_mod( 'amaz_store_related_num_product_shw','5');
		$args['posts_per_page'] = $rel_no_product; // related products
	    $args['columns'] = $rel_columns; // arranged in columns
	    return $args;
		}   
		
        /**
		 * Shop page view list and grid view.
		 */
        function amaz_store_before_shop_loop(){
        $viewshow = get_theme_mod('amaz_store_prd_view','grid-view');
        
        echo '<div class="thunk-list-grid-switcher">';
        if($viewshow == 'grid-view'){
             echo '<a title="' . esc_attr__('Grid View', 'amaz-store') . '" href="#" data-type="grid" class="thunk-grid-view selected"><i class="fa fa-th"></i></a>';

             echo '<a title="' . esc_attr__('List View', 'amaz-store') . '" href="#" data-type="list" class="thunk-list-view"><i class="fa fa-bars"></i></a>';
        }else{
        	  echo '<a title="' . esc_attr__('Grid View', 'amaz-store') . '" href="#" data-type="grid" class="thunk-grid-view"><i class="fa fa-th"></i></a>';

             echo '<a title="' . esc_attr__('List View', 'amaz-store') . '" href="#" data-type="list" class="thunk-list-view selected"><i class="fa fa-bars"></i></a>';
        }
        echo '</div>';
        }
        // shop page content
        function amaz_store_list_after_shop_loop_item(){
        ?>
           <div class="os-product-excerpt"><?php the_excerpt(); ?></div>
        <?php   
        }

		/**
		 * Change products per row for crossells.
		 */
		 function amaz_store_cross_sell_display(){
			// Get count
			$count = get_theme_mod( 'amaz_store_cross_num_product_shw', '4' );
			$count = $count ? $count : '4';
			// Get columns
			$columns = get_theme_mod( 'amaz_store_cross_num_col_shw', '2' );
			$columns = $columns ? $columns : '2';
			// Alter cross-sell display
			woocommerce_cross_sell_display( $count, $columns );
		} 

        /**************************
		 * Shop Pagination.
		 **************************/
		function amaz_store_pagination_infinite(){
         	check_ajax_referer( 'opn-shop-load-more-nonce', 'nonce' );
			do_action( 'amaz_store_pagination_infinite' );
			$query_vars                   = json_decode( stripslashes( $_POST['query_vars'] ), true );
			$query_vars['paged']          = isset( $_POST['page_no'] ) ? absint( $_POST['page_no'] ) : 1;
			$query_vars['post_status']    = 'publish';
			$query_vars['posts_per_page'] = wc_get_default_products_per_row() * wc_get_default_product_rows_per_page();
			$query_vars                   = array_merge( $query_vars, wc()->query->get_catalog_ordering_args() );
			$posts = new WP_Query( $query_vars );

			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					$posts->the_post();

					/**
					 * Woocommerce: woocommerce_shop_loop hook.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );

					
					wc_get_template_part( 'content', 'product' );
				}
			}
			wp_reset_query();

			wp_die();
        }

        function shop_pagination(){
			$pagination = get_theme_mod( 'amaz_store_pagination' );
			if ( 'click' == $pagination || 'scroll' == $pagination){
				remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
				add_action( 'woocommerce_after_shop_loop', array( $this, 'amaz_store_pagination' ), 10 );
			}
		}
       function amaz_store_pagination( $output ){
			global $wp_query;
			$infinite_event = get_theme_mod( 'amaz_store_pagination' );
			$load_more_text = get_theme_mod( 'amaz_store_pagination_loadmore_btn_text',__( 'Load More','amaz-store'));
			if ( '' === $load_more_text ){
				$load_more_text = __( 'Load More', 'amaz-store' );
			}
			if ( $wp_query->max_num_pages > 1 ){
				?>
				<nav class="opn-shop-pagination-infinite">
					<span class="inifiniteLoader"><div class="loader"></div></span>
					<?php if ( 'click' == $infinite_event ){ ?>
						
							<div class="amaz-store-load-more">
								<button id="load-more-product" class="load-more-product-button thunk-button opn-shop-load-more active" >
									<?php echo apply_filters( 'open_load_more_text', esc_html( $load_more_text ) ); ?>
								</button>
							</div>
							
					<?php } ?>
				</nav>
				<?php
			}
		}
        /**
		 * Shop page template.
		 *
		 * @since 1.0.0
		 * @return void if not a shop page.
		 */
		function shop_page_styles(){
			$is_ajax_pagination = $this->is_ajax_pagination();
			if ( ! ( is_shop() || is_product_taxonomy() ) && ! $is_ajax_pagination ) {
				return;
			}
		}

		/**
		 * Check if ajax pagination is calling.
		 *
		 * @return boolean classes
		 */
		function is_ajax_pagination(){
			$pagination = false;
			if ( isset( $_POST['open_infinite'] ) && wp_doing_ajax() && check_ajax_referer( 'opn-shop-load-more-nonce', 'nonce', false ) ){
				$pagination = true;
			}
			return $pagination;
		}


	}
endif;
amaz_store_Pro_Woocommerce_Ext::get_instance();
