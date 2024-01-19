<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_POST["reg"];
    $pwd = $_POST["pwd"];

    // Validate form data (you may want to add more validation)
    if (empty($email) || empty($pwd)) {
        echo "Both email and password are required.";
    } else {
        // Connect to your database (replace these credentials with your database details)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "recipe";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to check if the user exists
        $sql = "SELECT * FROM users WHERE email='$email' AND pwd='$pwd'";
        $result = $conn->query($sql);

        // Check if a matching user is found
        if ($result->num_rows > 0) {
            // User exists, redirect to main.html
            header("Location: main.html");
            exit();
        } else {
            // User not found, display an error message
            echo "Invalid email or password.";
        }

        // Close connection
        $conn->close();
    }
}
?>
