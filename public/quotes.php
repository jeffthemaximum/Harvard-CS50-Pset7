<?

//display form
    //get sock symbol
//retrieve stock quote
//display stock quotes

    //confirmation
    require("../includes/config.php");

    //check if user provides symbol
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a symbol, silly.");
        }
        else 
        {
            //if valid, lookup symbol
            $s = lookup($_POST["symbol"]);
            if ($s === false)
            {
                apologize("That is not a valid stock symbol, silly.");
            }
            else
            {
                render("quotes_show.php", ["title" => "Quotes"]);
            }
        }
    }
    
    else
    {
        // else render form
        render("quotes_in.php", ["title" => "Quotes"]);
    }
    
?>
