<?php

 if(isset($_POST['submit']))
    {
    	//The form has been submitted, prep a nice thank you message
    	$output = '<h1>Thanks for your file and message!</h1>';
    	//Set the form flag to no display (cheap way!)
    	$flags = 'style="display:none;"';

    	//Deal with the email
    	$to = 'e_czekner@hotmail.com';
    	$subject = 'a file for you';

    	$message = strip_tags($_POST['summary']);
		$pharmaName = strip_tags($_POST['pharmaName']);
		$pharmaWebsite = strip_tags($_POST['pharmaWebsite']);
		$bullet1 = strip_tags($_POST['bullet1']);
		$bullet2 = strip_tags($_POST['bullet2']);
		$bullet3 = strip_tags($_POST['bullet3']);
		$bullet4 = strip_tags($_POST['bullet4']);
		$bullet5 = strip_tags($_POST['bullet5']);
		$quote = strip_tags($_POST['quote']);
    	$attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'])));
    	$filename = $_FILES['file']['name'];
    	$boundary =md5(date('r', time())); 

    	$headers = "From: eczekner@amerisourcebergen.com\r\nReply-To: eczekner@amerisourcebergen.com";
    	$headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";

    	$message="This is a multi-part message in MIME format.

--_1_$boundary
Content-Type: multipart/alternative; boundary=\"_2_$boundary\"

--_2_$boundary
Content-Type: text/plain; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

$message
$pharmaName
$pharmaWebsite
$bullet1
$bullet2
$bullet3
$bullet4
$bullet5
$quote

--_2_$boundary--
--_1_$boundary
Content-Type: application/octet-stream; name=\"$filename\" 
Content-Transfer-Encoding: base64 
Content-Disposition: attachment 

$attachment
--_1_$boundary--";

    	mail($to, $subject, $message, $headers);
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Customer Spotlight Form</title>
</head>

<body>

<h1>Customer Spotlight Form</h1>

<?php echo $output; ?>

<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" <?php echo $flags;?>>

<p><label for="email">Email:</label> <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email);?>" required></input><?php echo $emailErr;?></p>

<p><label for="pharmaName">Pharmacy Name:</label> <input type="text" name="pharmaName" id="pharmaName" value="<?php echo htmlspecialchars($pharmaName);?>" required></input><?php echo $pharmaNameErr;?></p>

<p><label for="summary">Summary of Pharmacy:</label> <textarea name="summary" id="summary" cols="20" rows="10" value="<?php echo htmlspecialchars($summary);?>" required></textarea><?php echo $summaryErr;?></p>

<p><label for="pharmaWebsite">Pharmacy Website:</label> <input type="text" name="pharmaWebsite" id="pharmaWebsite" value="<?php echo htmlspecialchars($pharmaWebsite);?>" required></input><?php echo $websiteErr;?></p>


<p>
5 less obvious bullet points
<ol>
<li><input type="text" name="bullet1" id="bullet1" value="<?php echo htmlspecialchars($bullet1);?>" required></input><?php echo $bullet1Err;?></li>
<li><input type="text" name="bullet2" id="bullet2" value="<?php echo htmlspecialchars($bullet2);?>" required></input><?php echo $bullet2Err;?></li>
<li><input type="text" name="bullet3" id="bullet3" value="<?php echo htmlspecialchars($bullet3);?>" required></input><?php echo $bullet3Err;?></li>
<li><input type="text" name="bullet4" id="bullet4" value="<?php echo htmlspecialchars($bullet4);?>" required></input><?php echo $bullet4Err;?></li>
<li><input type="text" name="bullet5" id="bullet5" value="<?php echo htmlspecialchars($bullet5);?>" required></input><?php echo $bullet5Err;?></li>
</ol>

</p>

<p><label for="quote">Quote from Pharmacy Owner:</label> <input type="text" name="quote" id="quote" value="<?php echo htmlspecialchars($quote);?>" required></input><?php echo $quoteErr;?></p>

<p><label for="file">Photo:</label> <input type="file" name="file" id="file"></p>


<p><input type="submit" name="submit" id="submit" value="Submit"></p>


</form>
</body>
</html>
