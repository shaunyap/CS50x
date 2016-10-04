<?php

    require("../includes/config.php");

    // lookup user
    $user = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

    // if page is reached via GET (by clicking link or redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("deposit_cash.php", ["title" => "Deposit More Cash"]);
    }
    
    // if page is reached via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(!preg_match("/^\d+$/", $_POST["amount"])) {
                // if not, apologize
                apologize("Please enter a positive whole number.");
            }
            
        // if so, add cash to account
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $_POST["amount"], $user[0]["id"]);            
            
        // log deposit in history
        CS50::query("INSERT INTO history (user_id, action, price) VALUES (?, 'Deposit', ?)", $_SESSION["id"], $_POST["amount"]);
       
       redirect("/");

    }
    
?>