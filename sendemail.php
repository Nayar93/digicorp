<?php if (isset($_POST["name"])) {
	// Read the form values
	$success = false;
	$name = isset($_POST['name']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['name']) : "";
	// $lName = isset( $_POST['lname'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['lname'] ) : "";
	// $phone = isset( $_POST['phone'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['phone'] ) : "";
	$senderEmail = isset($_POST['email']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email']) : "";
	$message = isset($_POST['contact_message']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['contact_message']) : "";
	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";

	//Headers
	$to = "digicorpmail@gmail.com";
	$subject = 'Contact Us';
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

	//body message
	$message = "First Name: " . $name . "<br> Last Name: " . $lName . "<br> Email: " . $senderEmail . "<br> phone: " . $phone . "<br> Message: " . $message . "";

	//Email Send Function
	$send_email = mail($to, $subject, $message, $headers);

	$servername = "localhost:3306";
	$username = "boba6866_Nico";
	$password = "x2BVosqYGqSOCCajqW";
	$database = "boba6866_digicorp";

	$conn = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
		echo ("Connection failed:" . $conn->connect_error);
	} else {
		// echo "Connected successfully";
		$name_sql = $_POST["name"];
		$mail_sql = $_POST["email"];
		$message_sql = $_POST["message"];
		$need = $_POST["need"];
		$request = "INSERT INTO quote_requests (name, mail, phone, message, need) VALUES ('$name_sql', '$mail_sql', '$phone', '$message_sql', '$need')";

		$sql_result = $conn->query($request);
	}
	echo $sql_result && $send_email ? "Merci de ta confiance!" : "Une erreur a eu lieu";
} else {
	echo '<div class="failed">Failed: Email not Sent.</div>';
}
