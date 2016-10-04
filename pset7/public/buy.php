<?php

    require("../includes/config.php");

    // lookup positions/user
    $rows = CS50::query("SELECT * FROM portfolios WHERE user_id = " . $_SESSION["id"]);
    $user = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);


    // if page is reached via GET (by clicking link or redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("to_buy.php", ["title" => "Buy some stocks"]);
    }
    
    // if page is reached via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // lookup stock
        $stock = lookup($_POST["symbol"]);
        
        // Is the symbol valid?
        if ($stock == false) {
            apologize("Invalid Symbol");
        }
        
        // Is the number of shares a positive whole number?
        if(!preg_match("/^\d+$/", $_POST["shares"])) {
            // if not, apologize
            apologize("Please enter a positive whole number.");
        }

        // Does user have enough cash?
        $purchasePrice = $stock["price"] * $_POST["shares"];
        
        if ($user[0]["cash"] < $purchasePrice) {
            // if not, apologize
            apologize("not enough cash in account.");
        }
        
        // if so, deduct cash from account
        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $purchasePrice, $user[0]["id"]);
        
        // add stocks to the user (create new entry if stock doesn't exist for user, otherwise update current entry)
        CS50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + ?", $user[0]["id"], strtoupper($_POST["symbol"]), $_POST["shares"], $_POST["shares"]);

        // log purchase in history
        CS50::query("INSERT INTO history (user_id, action, symbol, shares, price) VALUES (?, 'Buy', ?, ?, ?)", $_SESSION["id"], strtoupper($_POST["symbol"]), $_POST["shares"], $stock["price"]);
     
      redirect("/");
    }
    
?>