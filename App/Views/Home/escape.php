<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home Output Escaping </title>
</head>
<body>
    <h1>Output Escaping</h1>
    <?php 
        // Display the results of submitting the form
        if ($_SERVER["REQUEST_METHOD"]==="POST") {
            // This is wrong!
            // echo "Hello, " . $_POST["name"];
            // This is correct
            echo "Hello, " . htmlspecialchars($_POST["name"]);
        }
    ?>
    <form method="post">
        <div>
            <label for="name">Your name</label>
            <input id="name" name="name" autofocus/>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>