<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<ul>
	<?php 

	$user = wp_get_current_user();
	if ( in_array( 'candidate', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ) ) :
		$candidate_dashboard_page_id = get_option( 'resume_manager_candidate_dashboard_page_id' ); 
		printf( __( '<li><a href="%s"> Candidate Dashboard </a></li>', 'workscout' ),
		get_permalink($candidate_dashboard_page_id)
		);	
	endif;
	if ( in_array( 'employer', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ) ) : 
		$employer_dashboard_page_id = get_option( 'job_manager_job_dashboard_page_id' );
		printf( __( '<li><a href="%s"> Employer Dashboard </a></li>', 'workscout' ),
		get_permalink($employer_dashboard_page_id)
		);
	endif;
	 $alerts_page_id = get_option( 'job_manager_alerts_page_id' ); 
            if(class_exists('WP_Job_Manager_Alerts')) {
                if ( in_array( 'candidate', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ) || !empty($$alerts_page_id) ) :
                    printf( __( '<li><a href="%s"> Job Alerts </a></li>', 'workscout' ),
                    get_permalink($alerts_page_id)
                    );  
                endif;
            }
	$bookmarks_page_id = ot_get_option('pp_bookmarks_page');	
	if ( in_array( 'candidate', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ) || !empty($bookmarks_page_id) ) :
		
		printf( __( '<li><a href="%s"> My Bookmarks </a></li>', 'workscout' ),
		get_permalink($bookmarks_page_id)
		);	
	endif;

	?>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
