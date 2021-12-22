<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * This file stores all functions that return default content.
 *
 * @package  Amaz Store
 */
/**
 * Class amaz_store_Defaults_Models
 *
 * @package  Amaz Store
 */
class amaz_store_Defaults_Models extends amaz_store_Singleton{
/**
	 * Get default values for features section.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	/**
	 * Get default values for Brands section.

	 * @access public
	 */
public function get_brand_default() {
		return apply_filters(
			'amaz_store_brand_default_content', json_encode(
				array(
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
				)
			)
		);
	}

/**
	 * Get default values for Brands section.

	 * @access public
	 */
public function get_frontpage_slider_default() {
		return apply_filters(
			'amaz_store_frontpage_slider_default_content', json_encode(
				array(
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
				)
			)
		);
	}
	/**
	 * Get default values for Brands section.

	 * @access public
	 */
public function get_innerpage_slider_default() {
		return apply_filters(
			'amaz_store_innerpage_slider_default_content', json_encode(
				array(
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '',
					),
				)
			)
		);
	}

	/**
	 * Get default values for features section.

	 * @access public
	 */
	public function get_feature_default() {
		return apply_filters(
			'amaz_store_highlight_default_content', json_encode(
				array(
					array(
						'icon_value' => 'fa-cog',
						'title'      => esc_html__( 'Free Shiping', 'amaz-store' ),
						'subtitle'   => esc_html__( 'On all order over ', 'amaz-store' ),
						
					),
					array(
						'icon_value' => 'fa-cog',
						'title'      => esc_html__( 'Free Shiping', 'amaz-store' ),
						'subtitle'   => esc_html__( 'On all order over ', 'amaz-store' ),
						
					),
					array(
						'icon_value' => 'fa-cog',
						'title'      => esc_html__( 'Free Shiping', 'amaz-store' ),
						'subtitle'   => esc_html__( 'On all order over ', 'amaz-store' ),
						
					),
					array(
						'icon_value' => 'fa-cog',
						'title'      => esc_html__( 'Free Shiping', 'amaz-store' ),
						'subtitle'   => esc_html__( 'On all order over ', 'amaz-store' ),
						
					),
				)
			)
		);
	}	


	public function get_faq_default() {
		return apply_filters(
			'amazstore_faq_default_content', json_encode(
				array( 
					array(
						'title'     => esc_html__( 'What do you want to know', 'amaz-store' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'amaz-store' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'amaz-store' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'amaz-store' ),
					),
					
					array(
						'title'     => esc_html__( 'What do you want to know', 'amaz-store' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'amaz-store' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'amaz-store' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'amaz-store' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'amaz-store' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'amaz-store' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'amaz-store' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'amaz-store' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'amaz-store' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'amaz-store' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'amaz-store' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'amaz-store' ),
					),

				)
			)
		);	
	}

	/**
	 * Get default values for features section.

	 * @access public
	 */
	public function get_service_default() {
		return apply_filters(
			'amaz_store_service_default_content', json_encode(
				array(
					array(
						'icon_value' => 'fa-diamond',
						'title'      => esc_html__( 'Development', 'amaz-store' ),
						'text'       => esc_html__( 'Nam varius mauris eget sodales tempus. Quisque sollicitudin consectetur accumsan. Ut imperdiet mi velit, ut congue justo sagittis eget',
							'amaz-store' ),
						'link'       => '#',
						'color'      => '#ff214f',
					),
					array(
						'icon_value' => 'fa-heart',
						'title'      => esc_html__( 'Design', 'amaz-store' ),
						'text'       => esc_html__( 'Nam varius mauris eget sodales tempus. Quisque sollicitudin consectetur accumsan. Ut imperdiet mi velit, ut congue justo sagittis eget',
							'amaz-store' ),
						'link'       => '#',
						'color'      => '#00bcd4',
					),
					array(
						'icon_value' => 'fa-globe',
						'title'      => esc_html__( 'Seo', 'amaz-store' ),
						'text'       => esc_html__( 'Nam varius mauris eget sodales tempus. Quisque sollicitudin consectetur accumsan. Ut imperdiet mi velit, ut congue justo sagittis eget',
							'amaz-store' ),
						'link'       => '#',
						'color'      => '#4caf50',
					),
				)
			)
		);
	}	

	/**
	 * Get default values for Testimonials section.

	 * @access public
	 */
public function get_testimonials_default() {
		return apply_filters(
			'amaz_store_testimonials_default_content', json_encode(
				array(
					array(
						'image_url' =>	AMAZ_STORE_THEME_URI . 'image/testimonial1.png',
						'title'     => esc_html__( 'Surbhi', 'amaz-store' ),
						'subtitle'  => esc_html__( 'Business Owner', 'amaz-store' ),
						'text'      => esc_html__( '"Nunc eu elementum libero. Etiam egestas leo eget urna ultrices, in finibus eros gravida. Donec scelerisque pulvinar dapibus. Nam pretium risus sed metus ultrices blandit. Pellentesque rhoncus est non nunc ultricies accumsan. Nullam gravida turpis et lacinia cursus. Fusce iaculis mattis consectetur."', 'amaz-store' ),
						'link'		=>	'#',
						'id'        => 'customizer_repeater_56d7ea7f40d56',
					),
					array(
						'image_url' =>	AMAZ_STORE_THEME_URI . 'image/testimonial2.png',
						'title'     => esc_html__( 'Nataliya', 'amaz-store' ),
						'subtitle'  => esc_html__( 'Artist', 'amaz-store' ),
						'text'      => esc_html__( '"Nunc eu elementum libero. Etiam egestas leo eget urna ultrices, in finibus eros gravida. Donec scelerisque pulvinar dapibus. Nam pretium risus sed metus ultrices blandit. Pellentesque rhoncus est non nunc ultricies accumsan. Nullam gravida turpis et lacinia cursus. Fusce iaculis mattis consectetur."', 'amaz-store' ),
						'link'		=>	'#',
						'id'        => 'customizer_repeater_56d7ea7f40d66',
					),

					array(
						'image_url' =>	AMAZ_STORE_THEME_URI . 'image/testimonial1.png',
						'title'     => esc_html__( 'Ramedrin', 'amaz-store' ),
						'subtitle'  => esc_html__( 'Business Owner', 'amaz-store' ),
						'text'      => esc_html__( '"Nunc eu elementum libero. Etiam egestas leo eget urna ultrices, in finibus eros gravida. Donec scelerisque pulvinar dapibus. Nam pretium risus sed metus ultrices blandit. Pellentesque rhoncus est non nunc ultricies accumsan. Nullam gravida turpis et lacinia cursus. Fusce iaculis mattis consectetur."', 'amaz-store' ),
						'link'		=>	'#',
						'id'        => 'customizer_repeater_56d7ea7f40d56',
					),
				)
			)
		);
	}


public function get_team_default() {
		return apply_filters(
			'amaz_store_team_default_content', json_encode(
				array( 
					array(
						'title'     => esc_html__( 'Gabriel', 'amaz-store' ),					
						'subtitle'  => esc_html__( 'Developer', 'amaz-store' ),
						'text'      => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'amaz-store' ),
						'image_url' => AMAZ_STORE_THEME_URI . 'image/team2.jpg',
						'link'       => '#',
						'social_repeater' => json_encode(
							array(
									array(
									
									'link' => 'youtube.com',
									'icon' => 'fa-youtube',
									),
									array(
									
									'link' => 'twitter.com',
									'icon' => 'fa-twitter',
									),
								array(
									
									'link' => 'linkedin.com',
									'icon' => 'fa-linkedin',
								),
							)
						),
					),

					array(
						'title'     => esc_html__( 'Maurics', 'amaz-store' ),					
						'subtitle'  => esc_html__( 'Marketer', 'amaz-store' ),
						'text'      => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'amaz-store' ),
						'image_url' => AMAZ_STORE_THEME_URI . 'image/team2.jpg',
						'link'       => '#',
						'social_repeater' => json_encode(
							array(
									array(
									
									'link' => 'youtube.com',
									'icon' => 'fa-youtube',
									),
									array(
									
									'link' => 'twitter.com',
									'icon' => 'fa-twitter',
									),
								array(
									
									'link' => 'linkedin.com',
									'icon' => 'fa-linkedin',
								),
							)
						),
					),

					array(
						'title'     => esc_html__( 'Ramedrin', 'amaz-store' ),					
						'subtitle'  => esc_html__( 'Designer', 'amaz-store' ),
						'text'      => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'amaz-store' ),
						'image_url' => AMAZ_STORE_THEME_URI . 'image/team2.jpg',
						'link'       => '#',
						'social_repeater' => json_encode(
							array(
									array(
									
									'link' => 'youtube.com',
									'icon' => 'fa-youtube',
									),
									array(
									
									'link' => 'twitter.com',
									'icon' => 'fa-twitter',
									),
								array(
									
									'link' => 'linkedin.com',
									'icon' => 'fa-linkedin',
								),
							)
						),
					),	
					array(
						'title'     => esc_html__( 'Ramedrin', 'amaz-store' ),					
						'subtitle'  => esc_html__( 'Designer', 'amaz-store' ),
						'text'      => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'amaz-store' ),
						'image_url' => AMAZ_STORE_THEME_URI . 'image/team2.jpg',
						'link'       => '#',
						'social_repeater' => json_encode(
							array(
									array(
									
									'link' => 'youtube.com',
									'icon' => 'fa-youtube',
									),
									array(
									
									'link' => 'twitter.com',
									'icon' => 'fa-twitter',
									),
								array(
									
									'link' => 'linkedin.com',
									'icon' => 'fa-linkedin',
								),
							)
						),
					),	

				)///	
			)	
		);
	}
}
