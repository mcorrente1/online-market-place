<?php
function sendEmail($recipient, $subject, $msg)
{
    if (mail($recipient, $subject, $msg))
    {
        // Set a 200 (okay) response code.
        http_response_code(200);
        //if(strcmp($recipient, 'sts.shahabuddin@gmail.com') == 0)
        //{
            echo "<h3>Thank you! Your message has been sent.</h3>";
        //}
//        else
//        {
//            echo "Thank you for your purchase! A confirmation of this purchase has been sent to your email";
//        }
    }
    else
    {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
}
?>
