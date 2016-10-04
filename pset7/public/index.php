<?php

    // configuration
    require("../includes/config.php"); 

    // lookup positions
    $rows = CS50::query("SELECT * FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
    $user = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    
    $positions = [];
    $grandTotal = 0;
    
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
            
            $grandTotal += ($stock["price"] * $row["shares"]);
        }
    }
    
    // render portfolio
    render("portfolio.php", [   "title" => "Portfolio",
                                "positions" => $positions,
                                "grandTotal" => number_format($grandTotal, 2, ".", ","),
                                "balance" => number_format($user[0]["cash"], 2, ".", ",")]);

?>
