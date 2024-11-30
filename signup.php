<?php
$signupError = ""; // Initialize error message
$signupSuccess = ""; // Initialize success message

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
     if (!$conn) { // Corrected condition
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];
    $cp = $_POST['cp'];

    // Validate input
    if (empty($user) || empty($pwd) || empty($cp)) {
        $signupError = "All fields are required.";
    } elseif ($pwd !== $cp) {
        $signupError = "Passwords do not match.";
    } else {
	      // Escape user input to prevent SQL Injection
	     $user = mysqli_real_escape_string($conn, $user);
        $pwd = mysqli_real_escape_string($conn, $pwd);
         $cp= mysqli_real_escape_string($conn, $cp);
        // Check if username already exists
        $checkQuery = "SELECT * FROM login WHERE user='$user'";
        $result = mysqli_query($conn,$checkQuery);

        if ($result && mysqli_num_rows($result) >0) {
            $signupError = "Username already exists. Please choose a different one.";
        } else {
            // Insert the user into the database
            $insertQuery = "INSERT INTO login (user, password) VALUES ('$user', '$pwd')";
            if (mysqli_query($conn,$insertQuery) === TRUE) {
                $signupSuccess = "Sign-up successful! You can now log in.";
		        header("Location: login2.php");
            } else {
                $signupError = "Error: " . mysqli_error();
            }
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <style>
        /* Body styling */
        body {
            height: 100vh;
            margin: 0;
            background-image: url("loginbg2.jpg"); /* Correct path to the image */
            background-size: cover; /* Ensures the image covers the entire background */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Prevent image from repeating */
            position: relative;
        }

        /* Fieldset styling */
        fieldset {
            width: 500px;
            height: auto;
            background-color: rgba(128, 0, 128, 0.3); /* Purple background with transparency */
            backdrop-filter: blur(10px); /* Adds a blur effect */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10%; /* Rounded corners */
        }

        /* Legend styling */
        legend {
            font-style: italic;
            font-size: 30px;
            text-align: center;
        }

        /* Form layout styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Adds spacing between elements */
        }

        /* Label styling */
        label {
            font-family: cursive;
            font-size: 20px;
            display: block;
            margin-bottom: 5px; /* Spacing between label and input */
            font-weight: bold;
        }

        /* Input fields styling */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Button styling */
        input[type="submit"],
        input[type="reset"] {
            font-weight: bold;
            padding: 10px 15px;
            margin-right: 10px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: purple;
            color: white;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: darkviolet; /* Hover effect */
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <fieldset>
        <legend><h2>Sign Up</h2></legend>
        <!-- PHP messages -->
        <?php if (!empty($signupError)) : ?>
            <script>
                alert("<?php echo $signupError; ?>");
            </script>
        <?php elseif (!empty($signupSuccess)) : ?>
            <script>
                alert("<?php echo $signupSuccess; ?>");
            </script>
        <?php endif; ?>
        <form id="f1" name="signup" method="POST" action="">
            <label id="l1" for="t1">Username</label>
            <input type="text" id="t1" name="user">

            <label id="l2" for="t2">Password</label>
            <input type="password" id="t2" name="pwd" minlength="3" maxlength="6" required >

            <label id="l3" for="t3">Confirm Password</label>
            <input type="password" id="t3" name="cp" minlength="3" maxlength="6" required>

            <div class="button-container">
                <input type="submit" id="b1" value="Sign Up">
                <input type="reset" id="b2" value="Clear">
            </div>
        </form>
    </fieldset>
</body>
</html>
