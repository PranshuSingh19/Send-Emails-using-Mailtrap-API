<?php
/**
 * Template Name: Contact Page
 */
get_header(); 
?>
<form id="ajax-form">
    <input type="text" name="username" id="username" placeholder="Enter your name" required>
    <input type="email" name="email" id="email" placeholder="Enter your email" required>
    <button type="submit">Submit</button>
</form>

<div id="response"></div>

<script>
jQuery(document).ready(function($) {
    $('#ajax-form').submit(function(e) {
        e.preventDefault();
        
        var formData = {
            action: 'ajax_form_server',
            username: $('#username').val(),
            email: $('#email').val(),
        };

        $.post('<?php echo admin_url("admin-ajax.php"); ?>', formData, function(response) {
            $('#response').html(response);
        });
    });
});
</script>



<?php get_footer(); ?>
