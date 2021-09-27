<?php

use function PHPSTORM_META\type;

/**
     * Plugin name: Simplystickit Contact Form
     * Description: The form submits the content to the owner of the site
     * 
     */

     function simplystickit_contact_form(){

             $content = '';
             $content .= '<h2>Contact Us</h2>';

             $content .= '<form method="post" action="http://simplystick.localtest.me/thank-you" > ';

             $content .= '<div class="form-group" >';
             $content .= '<label for="your_email">Name</label>';
             $content .= '<input type="text" name="your_name" placeholder="Enter your name" class="form-control" />';
             $content .= '</div>';

             $content .= '<div class="form-group" >';
             $content .= '<label for="your_email">Email</label>';
             $content .= '<input type="email" name="your_email" placeholder="Enter your email" class="form-control" />';
             $content .= '</div>';

             $content .= '<div class="form-group" >';
             $content .= '<label for="your_comments">Questions or Comments</label>';
             $content .= '<textarea name="your_comments" placeholder="Enter your questions or comments" class="form-control"></textarea>';
             $content .= '</div>';

             $content .= '<input type="submit" name="simplystickit_form_submit" value="Send Your Information" class="btn btn-md btn-info btn-block" />' ;
             
             $content .= '</form>';

             return $content;
     };

     add_shortcode('simplystickit-contact','simplystickit_contact_form');

    /**
     *  Capture the form submission
     */

     function simplystickit_form_capture(){
        if(isset($_POST['simplystickit_form_submit'])){
            //echo "<pre>"; print_r($_POST); echo "</pre>";
            $name = sanitize_text_field($_POST['your_name']);
            $email = sanitize_text_field($_POST['your_email']);
            $comments = sanitize_textarea_field($_POST['your_comments']);

            $to = 'wandumi@questcom.co.za';
            $subject = 'Contact Form Submission';
            $message = $comments.' - '.$name.' - '.$email;

            wp_mail($to, $subject, $message);


        }
     };

     add_action('wp_head','simplystickit_form_capture');


?>