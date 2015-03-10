<?php

    // configuration
    require("../includes/config.php"); 
    
    // define array of associative arrays of positions (stocks owned)
    $rows = query("SELECT * FROM transactions WHERE id = ?", $_SESSION["id"]);
    $transactions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $transactions[] = [
                "Date/Time" => $row["Date/Time"],
                "price" => $row["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "type" => $row["type"]
            ];
        }
    }
    
    // render portfolio
    render("history_form.php", ["title" => "History", "transactions" => $transactions]);

?>
