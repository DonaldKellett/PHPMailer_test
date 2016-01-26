<?php
// Load PHPMailer
require 'PHPMailer/PHPMailerAutoload.php';

// Use my default script (simplifies a lot of the process)
require 'phpmailer_default.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
    if (empty($_POST['name'])) {
      $show_name_error = true;
    }
    if (empty($_POST['email'])) {
      $show_email_error = true;
    }
    if (empty($_POST['subject'])) {
      $show_subject_error = true;
    }
    if (empty($_POST['message'])) {
      $show_message_error = true;
    }
  } else {
    $name = htmlspecialchars(stripslashes(trim($_POST['name'])));
    $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
    $subject = htmlspecialchars(stripslashes(trim($_POST['subject'])));
    $message = htmlspecialchars(stripslashes(trim($_POST['message'])));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      // Set "from" and "reply-to" headers
      $mail->setFrom($email, $name);
      $mail->addReplyTo($email, $name);

      // Send to my email address
      $mail->addAddress("dleung@connect.kellettschool.com");

      // Append Subject
      $mail->Subject = $subject;

      // Append Body
      $mail->Body = $message;

      // Send Email
      if (!$mail->send()) {
        $mail_sent = "failure";
      } else {
        $mail_sent = true;
      }
    } else {
      $invalid_email = true;
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHPMailer Test - Learning How to Use PHPMailer with DonaldKellett</title>
  </head>
  <body>
    <h1>Contact Form Powered by PHPMailer</h1>
    <p>
      Use the contact form below to send an email!  Please fill in your name, email address, subject and message.  All fields are required.
    </p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <p>
        Name <br /> <input type="text" name="name" placeholder="Name" /> <span style="color:red;">* <?php if ($show_name_error === true) { ?>Name is required<?php } ?></span>
      </p>
      <p>
        Email <br /> <input type="email" name="email" placeholder="Email Address" /> <span style="color:red;">* <?php if ($show_email_error === true) { ?>Email is required<?php } ?><?php if ($invalid_email === true) { ?>Email must be valid<?php } ?></span>
      </p>
      <p>
        Subject <br /> <input type="text" name="subject" placeholder="Subject" /> <span style="color:red;">* <?php if ($show_subject_error === true) { ?>Subject is required<?php } ?></span>
      </p>
      <p>
        Message <br /> <textarea name="message" placeholder="Message"></textarea> <span style="color:red;">* <?php if ($show_message_error === true) { ?>Message is required<?php } ?></span>
      </p>
      <p>
        <input type="submit" value="Send Message" />
      </p>
    </form>
    <?php switch ($mail_sent) {
      case true:
      echo "<p style='color:green;'>Message Sent Successfully</p>";
      break;
      case "failure":
      echo "<p style='color:red;'>PHPMailer Error: " . $mail->ErrorInfo . "</p>";
      break;
    } ?>
  </body>
</html>
