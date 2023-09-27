<!DOCTYPE html>
<html>
<head>
    <title>Even or Odd Checker</title>
</head>
<body>

<h2>Even or Odd Checker</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = intval($_POST["number"]);

    if ($number % 2 == 0) {
        $result = " This Number is Even";
    } else {
        $result = "This Number is Odd";
    }
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Number: <input type="text" name="number" required><br><br>
    <input type="submit" name="check" value="Check">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<br><strong>Result:</strong> $result";
}
?>

</body>
</html>
