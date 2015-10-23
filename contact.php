<?php
	//Clean variables function
	function clean($value) {

       // If magic quotes not turned on add slashes.
       if(!get_magic_quotes_gpc())

       // Adds the slashes.
       { $value = addslashes($value); }

       // Strip any tags from the value.
       $value = strip_tags($value);

       // Return the value out of the function.
       return $value;
	}
	
	$name= '';
	$email= '';
	$message= '';
	$errName = '';
	$errEmail = '';
	$errMessage = '';
	$result = '';
	
	if (isset($_POST["submit"])) {
		$name= clean($_POST['name']);
		$email= clean($_POST['email']);
		$message= clean($_POST['message']);
		$from = 'Altro Contact Form'; 
		$to = 'davidj28827@gmail.com'; 
		$subject = 'Message from Altro Contact Form ';
		
		
		$body ="From: $name\n E-Mail: $email\n Message:\n $message";
		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'Please enter your message';
		}
		// If there are no errors, send the email
		if (!$errName && !$errEmail && !$errMessage) {
			if (mail ($to, $subject, $body, $from)) {
				$result='<div class="alert alert-success">Thank You! I will be in touch</div>';
			} else {
				$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Altro Pizza and Caffe, 68 Stevedore Street, Williamstown VIC 3016">
    <meta name="author" content="David James">
	
    <title>altro | pizza + caffe</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/structure.css" rel="stylesheet"> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// test with localhost!-->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   	<?php require 'header.php';?>
  
    <div id="content" class="container fade-in">
	<form class="form-horizontal" role="form" method="post" action="contact.php">
			<div class="form-group">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-10">
					<h2>about &amp; contact</h2>
					<p>
				        At Altro, we pride ourselves on being true to the artisan style of italian pizza making.
			      	</p>
				      <ul id="trading-hours">
				        <li><strong>Mon</strong> closed</li>
				        <li><strong>Tue, Wed, Thur</strong> 4 pm - 9 pm</li>
				        <li><strong>Fri, Sat, Sun</strong> 12 noon - 3 pm, 5 pm - 9:30 pm</li>
				        <li id="address">68 Stevedore Street, Williamstown VIC 3016</li>
				        <li>(03) 9397 6601</li>
				      </ul>
				</div>
			</div>
			<div class="form-group visible-xs">
				<div class="col-sm-10 col-sm-offset-2">
					<?php echo $result; ?>	
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="name" name="name" placeholder="First + Last Name" value="<?php echo $name; ?>">
					<?php echo "<p class='text-danger'>$errName</p>";?>
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo $email; ?>">
					<?php echo "<p class='text-danger'>$errEmail</p>";?>
				</div>
			</div>
			<div class="form-group">
				<label for="message" class="col-sm-2 control-label">Message</label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="4" name="message"><?php echo $message;?></textarea>
					<?php echo "<p class='text-danger'>$errMessage</p>";?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
				</div>
			</div>
			<div class="form-group hidden-xs">
				<div class="col-sm-10 col-sm-offset-2">
					<?php echo $result; ?>	
				</div>
			</div>
		</form> 
	</div>
	
	<?php require 'footer.php';?>
  </body>
</html>
