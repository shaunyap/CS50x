<?php

    // configuration
    require("../includes/config.php"); 
    
    // if page is reached via GET (by clicking link or redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        // render get quote form
        render("quote_form.php", ["title" => "Get stock quotes"]);

    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // lookup stock
        $stock = lookup($_POST["symbol"]);
        
        // error checking
        if ($stock == false) {
            apologize("Invalid Symbol");
        }
        
        // render formaetted price page
        $price = number_format($stock["price"], 2, ".", ",");
        
        render("quote_price.php", ["name" => $stock["name"], "price" => $price]);
    }

?>
