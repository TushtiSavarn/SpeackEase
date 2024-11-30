<?php
$loginError = ""; // Initialize error message

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection details
    $servername = "localhost";
    $username = "root"; // Default for WAMP
    $password = ""; // Default for WAMP
    $dbname = "login"; // Database name

    // Connect to the database
    $conn =  mysqli_connect($servername, $username, $password, $dbname);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " .mysqli_connect_error());
    }

    // Retrieve form data
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];

    // Validate input
    if (empty($user) || empty($pwd)) {
        $loginError = "Both fields are required.";
    } else {
	       // Escape user input to prevent SQL Injection
	     $user = mysqli_real_escape_string($conn, $user);
        $pwd = mysqli_real_escape_string($conn, $pwd);
        // Query to check credentials
        $query = "SELECT * FROM login WHERE user='$user' AND password='$pwd'";
        $result = mysqli_query($conn,$query);

        if ($result && mysqli_num_rows($result) === 1) {
            // Redirect to home.html upon successful login
            header("Location: home.htm");
            exit();
        } else {
            // Set login error message for incorrect credentials
            $loginError = "Incorrect username or password.";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html >
<head>
    
    <title>Login</title>
    <style>
        body {
            height: 100vh;
            margin: 0;
            background-image: url("loginbg2.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }
        fieldset {
            width: 300px;
            height: 250px;
            background-color: rgba(128, 0, 128, 0.3);
            backdrop-filter: blur(10px);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10%;
        }
        h2 {
            font-style: italic;
            font-size: 30px;
        }
        label {
            font-family: cursive;
            font-size: 20px;
        }
        input[type="submit"], input[type="reset"], input[type="button"] {
            font-weight: bold;
            padding: 5px 15px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <fieldset>
        <legend><h2>Login Form</h2></legend>
        <!-- JavaScript for displaying popup if loginError is set -->
        <?php if (!empty($loginError)) : ?>
            <script>
                alert("<?php echo $loginError; ?>");
            </script>
        <?php endif; ?>
        <form id="f1" name="login" method="POST" action="">
            <label id="l1">User</label>
            <input type="text" id="t1" name="user" required>
            <br><br>
            <label id="l2">Password</label>
            <input type="password" id="t2" name="pwd" required>
            <br><br>
            <input type="submit" id="b1" value="Login">
            <input type="reset" id="b2" value="Clear">
            <input type="button" id="b3" value="Cancel" onClick="history.back();"><br>
            <a href="signup.php">New User?Sign Up here</a>

        </form>
    </fieldset>
</body>
</html>
