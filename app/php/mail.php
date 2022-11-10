<?php
  if(isset( $_POST['name']))
  $name = $_POST['name'];
  if(isset( $_POST['email']))
  $email = $_POST['email'];
  if(isset( $_POST['message']))
  $message = $_POST['message'];
  if(isset( $_POST['subject']))
  $subject = $_POST['subject'];

  $content="From: $name \n Email: $email \n Message: $message";
  $recipient = "mojemail121@onet.pl";
  $mailheader = "From: $email \r\n";
  $status =   mail($recipient, $subject, $content, $mailheader);
  echo $status ? 'Mail wysłany' : 'Error przy wysyłaniu maila !'
  // mail('blablauni94@gmail.com', $subject, $content, 'igor1xxxx21@onet.pl');
  // mail($recipient, $subject, $content, $mailheader) or die("Error!");
  // echo "Email wysłany!";
?>