<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Error checking
        if (empty($_POST["username"])) {
            apologize("Please provide a username.");
        } else if (empty($_POST["password"])) {
            apologize("Please provide a password.");
        } else if($_POST["password"] != $_POST["confirmation"]) {
            apologize("Passwords do not match.");
        }
        
        $results = CS50::query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
        $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");

        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // remember that user's now logged in by storing user's ID in session
            $_SESSION["id"] = $row["id"];

            // redirect to portfolio
            redirect("index.php");
        } else {
            apologize("Couldn't register your account.");
        }
    }

?>