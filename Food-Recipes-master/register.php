<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fname = $_POST["fname"];
    $email = $_POST["email"];
    $reg = $_POST["reg"];
    $pwd = $_POST["pwd"];
    $repwd = $_POST["repwd"];

    // Validate form data (you may want to add more validation)
    if (empty($fname) || empty($email) || empty($reg) || empty($pwd) || empty($repwd)) {
        echo "All fields are required.";
    } elseif ($pwd != $repwd) {
        echo "Passwords do not match.";
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

        // Insert user data into the database
        $sql = "INSERT INTO users (fname, email, reg, pwd) VALUES ('$fname', '$email', '$reg', '$pwd')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
}
?>
