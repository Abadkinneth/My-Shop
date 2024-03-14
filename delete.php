<?php
session_start(); // Start the session

if(isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";

    $errorMessage = "";
    $successMessage = "";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM clients WHERE id=$id";
    if ($connection->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Data successfully deleted";
    } else {
        $_SESSION['error_message'] = "Error deleting data: " . $connection->error;
    }
    
    $connection->close();

    header("location: /myshop/index.php");
    exit;
} else {
    $_SESSION['error_message'] = "No ID provided for deletion";
    header("location: /myshop/index.php");
    exit;
}
?>
