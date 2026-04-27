<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- David Eckhart - April 27, 2026 -->
<meta charset="UTF-8">
<title>Search Results</title>
<link rel="stylesheet" href="styles/main.css">
</head>
<body>

<h1>Search Results</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $conn = mysqli_connect("localhost", "root", "", "taus_data");

    if (!$conn) {
        echo "<div class='message'>Connection Failed.</div>";
    } else {
        // ✅ fixed column names
        $sql = "SELECT firstName, lastName, email FROM tbl_student WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("<div class='message'>Query failed: " . mysqli_error($conn) . "</div>");
        }

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<div class='message'>Student Located: " . $row["firstName"] . " " . $row["lastName"] . "<br>Email: " . $row["email"] . "</div>";
        } else {
            echo "<div class='message'>Email not in the system.</div>";
        }

        mysqli_close($conn);
    }
} else {
    echo "<div class='message'>Try Again Bud.</div>";
}
?>

<p><a href="index.php">Back to Search</a></p>

</body>
</html>
