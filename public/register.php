<?

    //confirmation
    require("../includes/config.php");
    
    // if form was submitted
    // valid password?
    // add user to database
    // log them in
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // valid passwords?
        /*
        make sure $_POST["password"] and $_POST["confirmation"] aren't blank
            else, apologize
            example --> apologize("passwords do not match") --> this displays a message
        make sure $_POST["password"] and $_POST["confirmation"] are the same
            else, apologize
        */
        
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("you must confirm your password, silly.");
        }
        else if ($_POST["confirmation"] != $_POST["password"])
        {
            apologize("passwords do not match, silly.");
        }
        
        // add user to database
        /*
        make sure $_POST["username"] isn't blank
            else, apologize
        make sure there's no duplicate usernames
            to check, query to see if username is already in database
            if query returns false on failure
                $result = query(...)
                if ($result === false)
                then an error occured (e.g. duplicate username)
        insert into SQL database
            INSERT INTO users (username, hash, cash) VALUES ("zamyla", '$1$50%Suq.MOtQj51maavfKvFsW1', 10000.00)
            however, you must use query to nteract with SQL database while in php
            ? is a placeholder
            query("INERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
        */
        $result = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
        if ($result === false)
        {
            apologize("username already exists in database. please try a different username.");
        }
        else
        {
            query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
        
        
        // log them in automatically
        /*
        find of their userID
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id'];
        store their id in session
            $_SESSION["id"]
        */
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            
            $_SESSION["id"] = $rows[0]["id"];
            
            // redirect to portfolio
            redirect("/");
        }
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
    
?>
