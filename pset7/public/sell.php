<?php

    require("../includes/config.php");

    // lookup positions
    $rows = CS50::query("SELECT * FROM portfolios WHERE user_id = " . $_SESSION["id"]);

    // if page is reached via GET (by clicking link or redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        $positions = [];
        foreach ($rows as $row)
        {
            $stock = lookup($row["symbol"]);
            if ($stock !== false)
            {
                $positions[] = [
                    "name" => $stock["name"],
                    "price" => number_format($stock["price"], 2, ".", ","),
                    "shares" => $row["shares"],
                    "symbol" => $row["symbol"],
                    "total" => number_format($stock["price"] * $row["shares"], 2, ".", ",")
                ];
            } 
        }
            
         // render to_sell
        render("to_sell.php", ["title" => "Sell your stocks", "positions" => $positions]);

    }
    
    // if page is reached via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($rows as $row)
        {
            $stock = lookup($row["symbol"]);

             if(isset($_POST[$row["symbol"]]) == true) {
                //  calculate sale amount
                $saleAmt = $row["shares"] * $stock["price"];
                
                //  clear the stocks
                CS50::query("DELETE FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $row["symbol"]);

                //  credit money to user
                CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $saleAmt, $_SESSION['id']);
                
                // log sale in history
                CS50::query("INSERT INTO history (user_id, action, symbol, shares, price) VALUES (?, 'Sell', ?, ?, ?)", $_SESSION["id"], strtoupper($row["symbol"]), $row["shares"], $stock["price"]);
             }
        }
        
        redirect("/");
    }