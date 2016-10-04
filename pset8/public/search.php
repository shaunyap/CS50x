<?php

    require(__DIR__ . "/../includes/config.php");

    // numerically indexed array of places
    $places = [];

    // if user searches exactly for a place or postal code
    $places =  CS50::query("SELECT * FROM places WHERE MATCH(place_name, admin_code1, admin_name1, postal_code) AGAINST (?) ORDER BY admin_name1", $_GET["geo"]);

    
    // if after this, there are still 0  results
    if (count($places < 1 )) {
        $places = CS50::query("SELECT * FROM places WHERE place_name LIKE ?", "%" . $_GET["geo"] . "%");
    }
    

    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>