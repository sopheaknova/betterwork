<?php
/**
 * @package WordPress
 * @subpackage Betterwork
 */
/**
 * Template Name: Contact page
 */
?>

<?php 
	if ( of_get_option('recaptcha_enabled') ) {

		if ( !function_exists('_recaptcha_qsencode') ) {
			require_once( O2_FUN . '/recaptchalib.php');
		}
	
		$publickey = of_get_option('recaptcha_publickey'); // you got this from the signup page
		$privatekey = of_get_option('recaptcha_privatekey'); // you got this from the signup page
		$resp = null;
		$error = null;
		if( isset($_POST['submit']) ) {
		$resp = recaptcha_check_answer ($privatekey,
				$_SERVER["REMOTE_ADDR"],
				$_POST["recaptcha_challenge_field"],
				$_POST["recaptcha_response_field"]
			);
		if ( !$resp->is_valid ) {
			$rCaptcha_error = $resp->error;
		}
		}
	}
?>

<?php get_header(); ?>

<?php
	//$NA_phone_format = of_get_option('NA_phone_format') ? '_NA_format' : '';

	//If the form is submitted
	if( isset($_POST['submit']) ) {
		// Get form vars
		$contact_name = strip_tags(trim(stripslashes($_POST['contact_name'])));
		$contact_email = trim($_POST['contact_email']);
		$contact_message = strip_tags(trim(stripslashes($_POST['contact_message'])));
	
		// Error checking if JS is turned off
		if( $contact_name == '' ) { //Check to make sure that the name field is not empty
		$nameError = __('Please enter a name', 'betterwork');
		} else if( strlen($contact_name) < 2 ) {
		$nameError = __('Your name must consist of at least 2 characters', 'betterwork');
		}
	
		if( $contact_email == '' ) {
		$emailError = __('Please enter a valid email address', 'betterwork');
		} else if( !is_email( $contact_email ) ) {
		$emailError = __('Please enter a valid email address', 'betterwork');
		}
	
		if( $contact_message == '' ) {
		$messageError = __('Please enter your message', 'betterwork');
		}
	
		if( !isset($nameError) && !isset($emailError) && !isset($messageError) && !isset($rCaptcha_error) ) {
		/*$ext = ( $contact_ext != '' ) ? __('ext.', 'betterwork').$contact_ext : '';
		$phone = ( $contact_phone != '' ) ? __('Phone: ', 'betterwork').$contact_phone.' '.$ext."\r\n" : '';*/
		
		// Send email
		$email_address_to = of_get_option('email_receipients');
		$subject = sprintf(__('Contact Form submission from %s', 'betterwork'), get_option('blogname') );
		$message_contents = __("Sender's name: ", 'betterwork') . $contact_name . "\r\n" .
					__('E-mail: ', 'betterwork') . $contact_email . "\r\n" .
					__('Message: ', 'betterwork') . $contact_message . " \r\n";
	
		$header = "From: $contact_name <".$contact_email.">\r\n";
		$header .= "Reply-To: $contact_email\r\n";
		$header .= "Return-Path: $contact_email\r\n";
		$emailSent = ( @wp_mail( $email_address_to, $subject, $message_contents, $header ) ) ? true : false;
	
		$contact_name_thx = $contact_name;
	
		// Clear the form
		$contact_name = $contact_email = $contact_message = '';
		}
	}
?>

    <div class="container">
    <div class="main">
    <div class="wrap-box-shadow">
    <div class="box-outer">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article class="cat-article">
		<h1 class="pagetitle"><?php the_title(); ?></h1>
    <div class="single_article_content">
        <?php the_content(); ?>
       
    </div> <!--Single Article content-->
    </article> <!--End Single Article-->
     <?php 
	    endwhile; endif;
	?>
        <ul id="contactinfo">
          <li>
          <?php echo of_get_option('address1'); ?>
          </li>
          <li><strong><?php esc_html_e('Tel', 'betterwork'); ?></strong> : <?php echo of_get_option('tel_contact'); ?></li>
          <li><strong><?php esc_html_e('Fax', 'betterwork'); ?></strong> : <?php echo of_get_option('fax_contact'); ?></li>
          <li><strong><?php esc_html_e('Email', 'betterwork'); ?></strong> : <a href="mailto:<?php echo of_get_option('email_receipients'); ?>"><?php echo of_get_option('email_receipients'); ?></a></li>
        </ul>
    
    
    <?php if ( of_get_option('is_form_email_contact')) : ?>
    <div id="contact-wrapper">
    
    <?php	    // Message Area.  It shows a message upon successful email submission
	    if( isset( $emailSent ) && $emailSent == true ) : ?>
		<div class="success">
		    <div class="msg-box-icon">
			<strong><?php esc_html_e('Email Successfully Sent!', 'betterwork'); ?></strong><br />
			<?php printf(__('Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you shortly.', 'betterwork'), $contact_name_thx) ?>
		    </div>
		</div>
<?php	    elseif ( isset( $emailSent ) && $emailSent == false ) : ?>
		<div class="erroneous">
		    <div class="msg-box-icon">
			<?php esc_html_e('Failed to connect to mailserver!', 'betterwork'); ?>
		    </div>
		</div>
<?php	    endif; ?>
    
    <form id="contactForm" class="cmxform" method="post" action="<?php echo the_permalink(); ?>#contact-wrapper">
		<strong><?php esc_html_e('Please use the form below to send us an email:', 'betterwork'); ?></strong>
		<div>
		    <label for="contact_name"><?php esc_html_e('Name', 'betterwork'); ?> </label><em><?php esc_html_e('(required, at least 2 characters)', 'betterwork'); ?></em><br />
		    <input id="contact_name" name="contact_name" size="30" class="required<?php if(isset($nameError)) echo ' error'; ?>" minlength="2" value="<?php echo esc_attr($contact_name); ?>" />
		    <input type="hidden" id="rules_contact_message" value="<?php esc_html_e( 'required', 'betterwork' ); ?>" />
		    <input type="hidden" id="contact_name_required" value="<?php esc_html_e( 'Please enter a name', 'betterwork' ); ?>" />
		    <input type="hidden" id="contact_name_min_length" value="<?php esc_html_e( 'Your name must consist of at least 2 characters', 'betterwork' ); ?>" />
<?php		    if(isset($nameError)) echo '<label class="error" for="contact_name" generated="true">'.$nameError.'</label>'; ?>
		</div>
		<div>
		    <label for="contact_email"><?php esc_html_e('E-Mail', 'betterwork'); ?> </label><em><?php esc_html_e('(required)', 'betterwork'); ?></em><br />
		    <input id="contact_email" name="contact_email" size="30"  class="required email<?php if(isset($emailError)) echo ' error'; ?>" value="<?php echo esc_attr($contact_email); ?>" />
		    <input type="hidden" id="messages_contact_email" value="<?php esc_html_e( 'Please enter a valid email address', 'betterwork' ); ?>" />
<?php		    if(isset($emailError)) echo '<label class="error" for="contact_email" generated="true">'.$emailError.'</label>'; ?>
		</div>
		<div>
		    <label for="contact_message"><?php esc_html_e('Your comment', 'betterwork'); ?> </label><em><?php esc_html_e('(required)', 'betterwork'); ?></em><br />
		    <textarea id="contact_message" name="contact_message" cols="70" rows="7" class="required<?php if(isset($messageError)) echo ' error'; ?>"><?php echo esc_attr($contact_message); ?></textarea>
		    <input type="hidden" id="messages_contact_message" value="<?php esc_html_e( '<br />Please enter your message', 'betterwork' ); ?>" />
<?php		    if(isset($messageError)) echo '<br /><label class="error" for="contact_message" generated="true">'.$messageError.'</label>'; ?>
		</div>

<?php		if ( of_get_option('recaptcha_enabled') ) : ?>
		    <script type="text/javascript">var RecaptchaOptions = {theme : '<?php echo of_get_option('recaptcha_theme'); ?>', lang : '<?php echo of_get_option('recaptcha_lang'); ?>'};</script>
		    <div>
<?php			echo recaptcha_get_html( $publickey, $rCaptcha_error ); ?>
		    </div>
<?php		endif; ?>

		<div>
		    <input name="submit" class="submit" type="submit" value="<?php esc_attr_e('Submit', 'betterwork'); ?>"/>
		</div>
	    </form>

	</div><!-- end contact-wrapper -->
    <?php endif; ?>
    </div> <!--Box Outer-->
    </div> <!--End Wrap box shadow-->
    </div> <!--End Main-->
    
    <?php get_sidebar(); ?>
    
    </div> <!--End Container-->
<?php get_footer(); ?>