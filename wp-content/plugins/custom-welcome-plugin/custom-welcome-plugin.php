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
    register_widget( 'My_Employment_Widget');
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

// Widget 02
class My_Employment_Widget extends WP_Widget {

    public function __construct() {
    // Define the constructor

        $options = array(
            'classname' => 'My_Employment_Widget',
            'description' => 'My Employment Widget',
        );

        parent::__construct(
            'My_Employment_Widget', 'My Employment Widget', $options
        );
    }

    public function widget( $args, $instance ) {
    // Keep this line
        echo $args['before_widget'];

        $workType  = $instance['work_type'];
        echo "Current state of employment: " . $workType;

        // Keep this line
        echo $args['after_widget'];        
    }

    // Back-end form of the Widget
    public function form( $instance ) {

        if ( isset( $instance[ 'work_type' ] ) ) {
            $workType = $instance[ 'work_type' ];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'work_type' ); ?>">Age:</label> 
            <select class="widefat" id="<?php echo $this->get_field_id('work_type'); ?>" name="<?php echo $this->get_field_name('work_type'); ?>">
                <?php
                    $options = array( 'Working', 'Student', 'Out of Work' );
                    foreach ( $options as $option ) {
                        echo '<option value="' . $option . '" id="' . $option . '"', $workType == $option ? ' selected="selected"' : '', '>' . $option . '</option>';
                    }
                ?>
            </select>
        </p>
       
    <?php 
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['work_type']     = ( !empty( $new_instance['work_type'] ) ) ? strip_tags( $new_instance['work_type'] ) : '';
        return $instance;
    }
}




?> 
