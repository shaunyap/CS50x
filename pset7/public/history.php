<?php

    require("../includes/config.php");

    // lookup transactions
    $rows = CS50::query("SELECT * FROM history WHERE user_id = " . $_SESSION["id"]);
    
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $transactions[] = [
                "name" => $stock["name"],
                "price" => number_format($stock["price"], 2, ".", ","),
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total" => number_format($stock["price"] * $row["shares"], 2, ".", ","),
                "timestamp" => $row["timestamp"],
                "action" => $row["action"]
            ];
        }
        
        if ($row["action"] == "Deposit") {
            $deposits[] = [
                "timestamp" => $row["timestamp"],
                "amount" => $row["price"]
                ];
        }
    }
    
    // render history
    render("history_log.php", [   "title" => "Transaction History",
                                "transactions" => $transactions,
                                "deposits" => $deposits]);
                                

?>