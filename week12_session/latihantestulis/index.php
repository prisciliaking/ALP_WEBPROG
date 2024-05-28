<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="result.php" method="post">
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="age">Usia:</label>
        <input type="number" name="age" id="age" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
 -->
<?php
    echo "<form action='result.php' method='post'>";
    echo "<label for='name'>Nama:</label>";
    echo "<input type='text' name='name' id='name' required><br>";
    echo "<label for='age'>Usia:</label>";
    echo "<input type='number' name='age' id='age' required><br>";
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
?>