<?php
// starting a session to keep informations if mistakes are made
session_start();

$title = 'Contact';
$description = 'A simple contact page';
include 'header.php';

$title = "";
$firstname = "";
$lastname = "";
$email = "";
$reason = "";
$message = "";
$titleError = "Your title is empty or incorrect.";
$firstnameError = "First name cannot be empty.";
$lastnameError = "Last name cannot be empty.";
$emailError = "Enter a valid email";
$reasonError = "Reason isn't valid. Choose between angry or furious, or leave me alone.";
$messageError = "Message must be at least 5 characters. Say \"Bravo\" !";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // title validation
    if ($_POST['title'] && in_array($_POST['title'], ['mr', 'madam', 'complicated'])) {
        $title = $_POST['title'];
    }

    // name validation
    $rawFirstname = trim(htmlspecialchars($_POST["firstname"]));
    if ($rawFirstname) {
        $firstname = $rawFirstname;
    }
    $rawLastname = trim(htmlspecialchars($_POST["lastname"]));
    if ($rawLastname) {
        $lastname = $rawLastname;
    }

    // email validation
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    }

    // radio button validation
    $raw_reason = $_POST["reason"];
    if ($_POST["reason"] && in_array($_POST["reason"], ['angry', 'furious'])) {
        $reason = $_POST["reason"];
    }

    // validate message length
    $raw_message = $_POST["message"];
    if (strlen($raw_message) > 5) {
        $message = htmlspecialchars($raw_message);
    }

    $sessionData = array(
        'title' => $title,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'reason' => $reason,
        'message' => $message
    );

    $_SESSION['sessionData'] = $sessionData;

    file_put_contents('session.txt', $_SESSION['sessionData']);

    header('Location : contact.php');
}
?>

<form method="post" action="">
    <fieldset>
        <legend>Personal information</legend>

            <label for="title-select" >Title</label>
                <select id="title-select" name="title">
                    <option value="" >Please select an option</option>
                    <option value="mr" <?= ($_SESSION['sessionData']['title'] && $_SESSION['sessionData']['title']=="mr") ? "selected" : ""?>>Mr</option>
                    <option value="madam" <?= ($_SESSION['sessionData']['title'] && $_SESSION['sessionData']['title']=="madam") ? "selected" : ""?>>Madam</option>
                    <option value="complicated" <?= ($_SESSION['sessionData']['title'] && $_SESSION['sessionData']['title']=="complicated") ? "selected" : ""?>>It's complicated</option>
                </select>
                <span style="color:red;"><?php if(!$_SESSION['sessionData']['title']) { echo $titleError; } ?></span>
            <br>

            <label for="firstname" >First name</label>
                <input id="firstname" type="text" name="firstname" value="<?= $_SESSION["sessionData"]["firstname"];?>">
            <span style="color:red;"><?php if(!$_SESSION['sessionData']['firstname']) { echo $firstnameError; } ?></span>
            <label for="lastname">Last Name</label>
                <input id="lastname" type="text" name="lastname" value="<?= $_SESSION["sessionData"]["lastname"];?>">
                <span style="color:red;"><?php if(!$_SESSION['sessionData']['lastname']) { echo $lastnameError; } ?></span>
            <br>

            <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?= $_SESSION["sessionData"]["email"];?>">
                <span style="color:red;"><?php if(!$_SESSION['sessionData']['email']) { echo $emailError; } ?></span>
            <br>

            <label for="reason">How can I help</label>
            <label><input type="radio" name="reason" value="angry" <?php if ($_SESSION["sessionData"]["reason"] && $reason=='angry') {
                echo 'checked'; } else {
                echo ''; } ?>>I'm angry</label>
            <label><input type="radio" name="reason" value="furious" <?php if ($_SESSION["sessionData"]["reason"] && $reason=='furious') {
                    echo 'checked'; } else {
                    echo ''; } ?>>I'm furious</label>
            <span style="color:red;"><?php if(!$_SESSION['sessionData']['reason']) { echo $reasonError; } ?></span>
            <br>
            <textarea name="message" cols="50" rows="7" <?php echo $_SESSION["sessionData"]["message"];?> placeholder="Write your text here"></textarea>
        <span style="color:red;"><?php if(!$_SESSION['sessionData']['message']) { echo $messageError; } ?></span>
    </fieldset>

    <input type="submit" value="Submit">

</form>


<?php
include 'footer.php';
?>