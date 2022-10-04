<?php
if (isset($_GET["page]"])) {
    switch ($_GET["page"]) {
        case 'profile':
            include 'profile.php';
            break;
        case 'hobbies':
            include 'hobbies.php';
            break;
        case 'contact':
            include 'contact.php';
            break;
        default:
            include 'default.php';
            break;
    }
} else {
    include 'default.php';
}
?>