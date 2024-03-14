<?php
session_start(); // Start the session

if (!empty($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Clear the session variable after displaying
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My second Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
 <body>
 
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href="/myshop/create.php" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
                <tbody>
                 
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                </tr>
            </thead>
        <tbody>
       
        <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "myshop";

                    //create connection
                    $connection = new mysqli($servername, $username, $password, $database);

                    //checking for connection
                    if ($connection->connect_error){
                        die("Connection failed:" . $connection->connect_error);
                    }
                    // read all row from database table
                    $sql = "SELECT * FROM clients";
                    $result = $connection->query($sql);
                    if(!$result){
                        die("Invalid query: " . $connection->error);
                    }
                    // read data of each row
                    while ($row = $result->fetch_assoc()){
                        echo"
                        <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>$row[created_at]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/myshop/edit.php?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='/myshop/delete.php?id=$row[id]'>Delete</a>
                </td>
        
            </tr>
                        ";
                    }
              ?>
            </tbody>
        </table>             
    </div>
   

    <?php
        if (!empty($successMessage)) {
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
 </body>
 </html>