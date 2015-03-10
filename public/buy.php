<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a symbol!");
        }
        else if (empty($_POST["shares"]))
        {
            apologize("You must provide a number of shares!");
        }
        
        // ensure stock symbol is uppercase
        $_POST["symbol"] = strtoupper($_POST["symbol"]);
        
        //lookup stock
        $stock = lookup($_POST["symbol"]);
        $price = $stock["price"];
        $cost = $price *$_POST["shares"];
        
        // can user afford stock?
        $rows = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $cash = $rows[0]["cash"];
        
        if ($cash < $cost)
        {
            apologize("You can't afford that. Please try a lesser amount of shares.");
        }
        else
        {
        //buying more of the same stock
        query("INSERT INTO portfolio (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"]);
        
        //update cash
        query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);
        
        // record purchase
        logBuy($_POST["symbol"], $_POST["shares"], $price);
        
        //return to index
        redirect("index.php");
        }

    }
    else
    {
        // else render form
        render("buy_form.php", ["title" => "Buy"]);
    }

?>
