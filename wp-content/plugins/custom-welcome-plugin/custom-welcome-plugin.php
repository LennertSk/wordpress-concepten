<?php
/**
 * Plugin Name: Custom Welcome Plugin
 * Plugin URI: https://www.the90sbutton.com/
 * Description: Custom welcome plugin
 * Version: 1.0
 * Author: Lennert Slabbinck
 * Author URI: https://www.the90sbutton.com/
 */


setcookie('count', isset($_COOKIE['count']) ? ++$_COOKIE['count'] : 1);



// Register the widget ----------------------------------------------

add_action( 'widgets_init', 'src_load_widgets' );

function src_load_widgets() {
    register_widget( 'My_Custom_Widget');
}

// Widget 01 ----------------------------------------------
class My_Custom_Widget extends WP_Widget {

    public function __construct() {
    // Define the constructor

	    $options = array(
	        'classname' => 'custom_hello_widget',
	        'description' => 'Custom hello widget',
	    );

	    parent::__construct(
	        'custom_hello_widget', 'Custom hello widget', $options
	    );
	}

    public function widget( $args, $instance ) {
    // Keep this line
	    echo $args['before_widget'];


    	if ($_COOKIE['count'] == 0): 
            echo "Welcome! This is your visit! So sit back and enjoy the ride!.";
        else:
            echo "Welcome back! You have viewed this site " .$_COOKIE['count']."  times."; 
        endif;

	    // Keep this line
	    echo $args['after_widget'];
	}

}




?> 
