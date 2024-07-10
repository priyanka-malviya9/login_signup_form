<?php
$conn = mysqli_connect('localhost', 'root', '', 'login&signup');
// Check connection     

if (mysqli_connect_errno()) {
    echo "Failed to connect MySQL: " . mysqli_connect_error();
}
?>