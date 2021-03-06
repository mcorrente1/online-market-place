<?php
/**
 * Class Name: none
 * Date: 07/27/17
 * Programmer: Saqib Shahabuddin
 * Description: This module displays the company’s contact information and allows the user to send the company an
 * email
 * Explanation of important functions: none
 * Important data structures: None.
 * Algorithm choice: this module contains very basic functionality, so no specific algorithms were required.
 */

require_once("layout.php");
require_once("Customer.php");
require_once("mailer.php");
if(!isset($_SESSION)) {
    session_start();
}
outputHeader("Contact Us", $_SESSION['user']->getUserId());
?>

<h3> Send us a message, we would love to here from you! </h3>
<form id="ajax-contact" method="post">
    <div class="field">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="field">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="field">
        <label for="message">Message:</label>
        <br><br>
        <textarea id="message" name="message" required></textarea>
    </div>

    <div class="field">
        <button type="submit">Send</button>
    </div>

</form>


<div id='content2'>
    <br><br><br>
    <b>Phone</b>: (949) 555-3324 <br>
    <b>Fax:</b> (949) 111-9383 <br>
    <b>Email:</b> ceo@rougesoda.com <br>
    <b>Address:</b> 3042 Lost Way, Grand City, CA 91234
    <br>
    <br>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }
        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = 'sts.shahabuddin@@gmail.com';
        // Set the email subject.
        $subject = "New contact from $name";
        // Build the email content.
        $email_content  = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";
        // Send the email.
        sendEmail($recipient,$subject, $email_content);
    }
    outputFooter(); ?>