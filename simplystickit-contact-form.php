<?php
    /**
     * Plugin name: Simplystickit Contact Form
     * Description: The form submits the content to the owner of the site
     * 
     */

     function simplystickit_contact_form(){

            //  wp_register_script( 'simplystickit_recaptchajs', 'https://www.google.com/recaptcha/api.js', 2, false );
            //  wp_enqueue_script( 'simplystickit_recaptchajs' );

             $content = '';
             $content .= '<h2>Contact Us</h2>';

             $content .= '<form method="post" action="https://simplytest.questweb.co.za/thank-you" > ';

             $content .= '<div class="form-group" >';
             $content .= '<label for="your_email">Name</label>';
             $content .= '<input type="text" name="your_name" placeholder="Enter your name" class="form-control" required />';
             $content .= '</div>';

             $content .= '<div class="form-group" >';
             $content .= '<label for="your_email">Email</label>';
             $content .= '<input type="email" name="your_email" placeholder="Enter your email" class="form-control" required />';
             $content .= '</div>';

             $content .= '<div class="form-group" >';
             $content .= '<label for="your_comments">Questions or Comments</label>';
             $content .= '<textarea name="your_comments" placeholder="Enter your questions or comments" class="form-control" required></textarea>';
             $content .= '</div>';

             $content .= '<div class="mb-3 g-recaptcha" data-sitekey="6LeQupkcAAAAAOkrKUyEVFmi013vitsl49iplvgw" >';
             $content .= '</div>';

             $content .= '<input type="submit" name="simplystickit_form_submit" value="Send Your Information" class="btn btn-md btn-block"  style="  background-color: #f287b4; color: #fff;" />' ;
             
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
            $email = sanitize_email($_POST['your_email']);
            $comments = sanitize_textarea_field($_POST['your_comments']);

            $to = 'wandumi@questcom.co.za';
            $subject = 'Contact Form Submission';
            $message = $comments."<br /> ".$name." <br /> ".$email;

    
            wp_mail($to, $subject, $message);

            // echo "<pre>";
            //     print_r($message);
            // echo "</pre>";

            // $url        = "https://www.google.com/recaptcha/siteverify";
            // $privatekey = "6LeQupkcAAAAALPQhfmNAx9R_yQzLbluYcQPlTaa";
            // $response   = file_get_contents($url."?secret-".$privatekey."&response-".$_POST['g-recaptcha-response']."&remoteip".$_SERVER['REMOTE_ADDR'] );
            // $data       = json_decode($response);

            // if(isset($data->success) AND $data->success==true){
            //     // put the code of php to send the email here

            // } else {
            //     $CaptureFail = '<div class="alert alert-danger" role="alert">Capture Failed, Please try again</div>';
            // }

        }
     };

     add_action('wp_head','simplystickit_form_capture');


?>