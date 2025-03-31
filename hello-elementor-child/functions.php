
<?php
function enqueue_style(){

    wp_enqueue_style('parent-theme', get_template_directory_uri() . '/style.css/');
}
add_action( 'wp_enqueue_scripts', 'enqueue_style');


// contact form send in this query
function handle_ajax_form() {
    // Check if form data is received
    if (isset($_POST['username']) && isset($_POST['email'])) {
        $username = sanitize_text_field($_POST['username']); 
        $email = sanitize_email($_POST['email']);

        // Validate Email
        if (!is_email($email)) {
            echo "Invalid email address!";
            wp_die();
        }

// Set the recipient email (WordPress admin email)
$to = get_option('admin_email');

// Email subject
$subject = "New Form Submission from " . $username;

// Email message
$message = "Name: " . $username . "\n";
$message .= "Email: " . $email;

// Email headers (Sender & Content Type)
$headers = [
    'From: Your Website <no-reply@yourwebsite.com>', 
    'Content-Type: text/html; charset=UTF-8'
];
        // Send Email wp_mail this is a wordpress custom mail sending function
        $mail_sent = wp_mail($to, $subject, nl2br($message), $headers);

        if ($mail_sent) {
            echo "Thank you, " . esc_html($username) . "! Your email has been sent.";
        } else {
            echo "Error sending email. Please try again.";
        }
    } else {
        echo "Please fill out all fields.";
    }
    wp_die(); // Stop further execution
}

// Register AJAX Actions
add_action('wp_ajax_handle_ajax_form', 'handle_ajax_form'); // Logged-in users
add_action('wp_ajax_nopriv_handle_ajax_form', 'handle_ajax_form'); // Guests

