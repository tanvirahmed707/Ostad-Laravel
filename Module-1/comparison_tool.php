<!DOCTYPE html>
<html>
<head>
    <title>Comparison Tool</title>
</head>
<body>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $number1 = $_POST['number1'] ?? null;
        $number2 = $_POST['number2'] ?? null;

        $result = ($number1 !== null && $number2 !== null) ? ($number1 > $number2 ? $number1 : $number2) : 'Please enter two numbers';

        echo "<p>The larger number is: $result</p>";
    }
?>

<form action="" method="post">
    Number 1: <input type="text" name="number1"><br>
    Number 2: <input type="text" name="number2"><br>
    <input type="submit" value="Compare">
</form>

</body>
</html>
