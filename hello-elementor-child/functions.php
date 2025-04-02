
<?php
function enqueue_style(){

    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css/');
    wp_enqueue_style('clild-style', get_template_directory_uri() . '/style.css/');
}
add_action( 'wp_enqueue_scripts', 'enqueue_style');


// contact form send in this query
function ajax_form_server() {
 // Form data Received hua ya nhi check karege
    if (isset($_POST['username']) && isset($_POST['email']) ){
        $username = sanitize_text_field($_POST['username']);
        $email = sanitize_email($_POST['email']);

        // email validation
        if(!is_email ($email)){
            echo "Invalid Email Address";
            wp_die(); // Email invalid hone par wordpress ka wp_die() function execute hoga.
        }
    }

    // Preparing Email Details
    $to = get_option('admin_email'); // function ka use email WordPress ke admin ko send hogi
    $subject = "New custom Email Submission" . $username;
    $message = "Name: " . $username . "\n";
    $message .= "Email: " . $email;

    // Email Headers Set kar sakte hay 
    $headers = [
        "From: Pranshu Site <mysite@pranshu.com>", // website name aur mail set karege jisme reply ayega
        "Content-Type: Text/Html; charset=UTF-8" // mail Template me content kis form me show hoga vo set karte hay
    ];

    // wp_mail() is WordPress's built-in email function hay
    // Sending the Email
    $mail_send = wp_mail($to, $subject, $message, $headers);

    // Response Based on Email Success/Failure
    if($mail_send){
        echo "Thank you, " . esc_html($username) . " mail successfully send"; }
        else { echo "Please try again";  }

        wp_die(); // End all execution
}

// [wp_ajax] Agar koi logged in hai aur form submit karega, to WordPress handle_ajax_form function ko run karega
// [wp_ajax_nopriv] Agar koi guest (jo login nahi hai) form submit karega, to ye function tab bhi chalega
add_action('wp_ajax_ajax_form_server', 'ajax_form_server');
add_action('wp_ajax_nopriv_ajax_form_server', 'ajax_form_server');

