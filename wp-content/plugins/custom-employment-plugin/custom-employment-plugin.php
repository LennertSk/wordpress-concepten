<?php
/**
 * Plugin Name: Custom Employment Plugin
 * Plugin URI: https://www.the90sbutton.com/
 * Description: Custom Employment plugin
 * Version: 1.0
 * Author: Lennert Slabbinck
 * Author URI: https://www.the90sbutton.com/
 */



// Widget 01 ----------------------------------------------

class Custom_Employment_Widget extends WP_Widget {
    // Initialize Widget with Options
    public function __construct() {
        parent::__construct(
            'custom_employment_widget',
            'Custom Emplyment Widget',
            array(
                'classname'   => 'custom_employment_widget',
                'description' => 'Custom Emplyment Widget'
            )
        );
    }

    // Widget Front End
    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        echo $before_widget;
        /* Widget Content Below */
            echo "Right now I'm [$job] "; 
        /* Widget Content Above */
        echo $after_widget;
    }

    // Widget Admin Form
    public function form( $instance ) { ?>
        <?php extract( $instance ); ?>
        <p>
            <label>
                <input type="radio" value="studying hard for my exams" name="<?php echo $this->get_field_name( 'job' ); ?>" <?php checked( $job, 'student' ); ?> id="<?php echo $this->get_field_id( 'job' ); ?>" />
                <?php esc_attr_e( 'student', 'text_domain' ); ?>

            </label>
        </p>
        <p>
            <label>
                <input type="radio" value="working my ass off 24/7" name="<?php echo $this->get_field_name( 'job' ); ?>" <?php checked( $job, 'working' ); ?> id="<?php echo $this->get_field_id( 'jos' ); ?>" />
                <?php esc_attr_e( 'working', 'text_domain' ); ?>
            </label>
        </p>
        <p>
            <label>
                <input type="radio" value="not really doing anything, just enjoying life" name="<?php echo $this->get_field_name( 'job' ); ?>" <?php checked( $job, 'jobless' ); ?> id="<?php echo $this->get_field_id( 'jos' ); ?>" />
                <?php esc_attr_e( 'jobless', 'text_domain' ); ?>
            </label>
        </p>
    <?php }

    // Sanitize and Save Options
    public function update( $new_instance, $old_instance ) {
        extract( $new_instance );
        $instance = array();

        $instance['job'] = ( !empty( $job ) ) ? sanitize_text_field( $job ) : null;

        return $instance;
    }
}

function custom_employment_widget() {
    register_widget( 'Custom_Employment_Widget' );
}
add_action( 'widgets_init', 'custom_employment_widget' );



?> 


