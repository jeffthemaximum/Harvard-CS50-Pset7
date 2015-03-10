<?

if (empty($_POST["symbol"]))
    {
        apologize("You must provide a symbol, silly.");
    }
else
    {
        $s = lookup($_POST["symbol"]);
        {
            print("A share of " . $s["name"] . " " . $s["symbol"] . " costs " . $s["price"]);
        }
    }
?>
