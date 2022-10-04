<?php
$title = 'Contact';
$description = 'A simple contact page';
include 'header.php';

$title = "";
$firstname = "";
$lastname = "";
$email = "";
$reason = "";
$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")

    // name validation
    $raw_firstname = trim(htmlspecialchars($_POST["firstname"]));
    if (!$raw_firstname) {
        $error = "First name cannot be empty.";
    } else {
        $firstname = $raw_firstname;
    }
    $raw_lastname = trim(htmlspecialchars($_POST["lastname"]));
    if (!$raw_lastname) {
        $error = "Last name cannot be empty.";
    } else {
        $lastname = $raw_lastname;
    }

    // email validation
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid email";
    } else {
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    }

    // radio button validation
    $raw_reason = $_POST["reason"];
    if (!$raw_reason) {
        $error = "Reason cannot be empty";
    } elseif(filter_has_var(INPUT_POST, $_POST["reason"])) {
        if (array_in($_POST["reason"], ['angry', 'furious'])) {
            $error = "Reason isn't valid. Choose between angry or furious, or leave me alone.";
        } else {
            $reason = $raw_reason;
        }

     // validate message length
    $raw_message = $_POST["message"];
    if (strlen($raw_message) < 5 or (!$raw_message)) {
        $error = "Message isn't long enough";
    } else {
        $message = htmlspecialchars($raw_message);
    }
    }
?>

<form method="post" action="">
    <fieldset>
        <legend>Personal information</legend>
            <label for="title-select" >Title</label>
                <select id="civility-select" name="title" value="<?php echo $title; ?>">
                    <option value="">Please select an option</option>
                    <option value="mr">Mr</option>
                    <option value="madam">Madam</option>
                    <option value="complicated">It's complicated</option>
                </select>
            <br>
            <label for="firstname" >First name</label>
                <input type="text" name="firstname" value="<?php echo $firstname;?>">
            <label for="lastname">Last Name</label>
                <input type="text" name="lastname" value="<?php echo $lastname;?>">
            <br>
            <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $email;?>">
            <br>
            <label for="reason">How can I help</label>
            <input type="radio" name="reason" value="angry" <?php echo ($reason=='angry')?'checked':'' ?>>I'm angry
            <input type="radio" name="reason" value="furious" <?php echo ($reason=='furious')?'checked':'' ?>>I'm furious
            <br>
            <textarea name="message" col="50" rows="7" <?php echo $message;?> placeholder="Write your text here"></textarea>
    </fieldset>
    <p>
        <span style="color:red;"><?= $error ;?></span>
    </p>
    <input type="submit" value="Submit">
</form>


<?php
echo $message;
include 'footer.php';
?>