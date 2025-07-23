
<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set the logged status 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $logged = true;
} else {
    $logged = false;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+CZ:wght@100..400&family=Playwrite+NZ:wght@100..400&display=swap" rel="stylesheet">
    <title>Homepage</title>
    <style type="text/css">
        *{
            padding: 0; margin: 0; box-sizing: border-box;
        }
        
        header{
            width: 100%;
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.8),rgba(0,0,0,0.2)), url('Images/JIIT-Noida.webp');
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        nav{
            width: 100%;
            height: 100px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }
        
        .logo{
            font-family: "Playwrite NZ", sans-serif;
            font-size: 2em;
            letter-spacing: 2px;
            margin-left: 0px;
        }


        .register a{
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            font-size: 20px;
            background: indianred;
            border-radius: 8px;
            transition: 0.3s linear;
        }

        .register a:hover{
            background: transparent;
            border: 1px solid indianred;
        }

        .h-text{
            max-width: 650px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }
        
        .h-text span{
            letter-spacing: 5px;
        }

        .h-text h1{
            font-size: 3.5em;
            margin-bottom: 10px;
        }

        .h-text h4{
            font-size: 20px;
            font-weight: 350;
            font-style: italic;
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .h-text a{
            text-decoration: none;
            background: indianred;
            color: white;
            padding: 10px 20px;
            letter-spacing: 5px;
            transition: 0.3s linear;
        }

        .h-text a:hover{
            background: transparent;
            border: 1px solid indianred;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                Campus-Connect
            </div>
           
            <div class="register">
                <a href="Register Page.html">Register</a>
            </div>
        </nav>
        <section class="h-text">
            <span>Welcome to</span>
            <h1>Campus Connect</h1>
            <h4>Simplify Your Academic Life. 
                Our platform is your one-stop solution for all your college needs. 
                Stay organized with personalized timetables, track assignments with ease, and access your student profile. 
                Faculty, streamline your tasks and manage student information efficiently.</h4>
            <br>
            <?php
            if ($logged) {
                    echo '<a href="logout.php">Logout</a>';
                    echo ' <a href="Menu.html">Menu</a>';
              }
                else{
                    echo '<a href="Login Page.html">Login</a>';
                }
                
                    ?>
        </section>
    </header>
</body>
</html>