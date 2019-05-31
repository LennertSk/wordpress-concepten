<?php
/**
 * Plugin Name: Custom Employment Plugin
 * Plugin URI: https://www.the90sbutton.com/
 * Description: Custom Employment plugin
 * Version: 1.0
 * Author: Lennert Slabbinck
 * Author URI: https://www.the90sbutton.com/
 */



// widgetz

class My_Employment_Widget extends WP_Widget {
    // Create widget
    public function __construct() {
        parent::__construct(
            'My_Employment_Widget', // Base ID
            'My Employment Widget', // Name
            array( 'description' => 'This is My Employment Widget.') // Arguments
        );
    }
    // Front-End Display of the Widget
    public function widget( $args, $instance ) {
        // Saved widget options
        
        
        $workType  = $instance['work_type'];
       
        
        // Display information
        echo '<div class="my-widget block">';
            if ( !empty( $workType ) ) {
                echo '<strong>Age:</strong> ' . $workType . '<br />';
            }
        echo '</div>';
    }
    // Back-end form of the Widget
    public function form( $instance ) {
        // Check for values
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
    // Sanitize and return the safe form values
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['work_type']     = ( !empty( $new_instance['work_type'] ) ) ? strip_tags( $new_instance['work_type'] ) : '';
        return $instance;
    }
}
// Register widget
add_action( 'widgets_init', function(){
     register_widget( 'My_Employment_Widget' );
});




?> 







