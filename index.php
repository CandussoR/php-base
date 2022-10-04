<?php
if (isset($_GET["page]"])) {
    $requested_page = $_GET["page"];
}
else {
    $requested_page = 'profile';
}

switch ($_GET["page"]) {
    case 'profile':
        include 'profile.php';
        break;
    case 'hobbies':
        include 'hobbies.php';
        break;
    default:
        include 'default.php';
        break;
}
?>