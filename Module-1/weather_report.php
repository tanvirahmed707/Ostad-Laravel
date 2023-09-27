<!DOCTYPE html>
<html>
<head>
    <title>Weather Report</title>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $temperature = $_POST['temperature'] ?? null;

    if ($temperature !== null) {
        if ($temperature < 10) {
            $condition = "Cool";
        } elseif ($temperature >= 10 && $temperature < 30) {
            $condition = "Warm";
        } else {
            $condition = "Hot";
        }

        echo "<p>The weather condition is: $condition</p>";
    } else {
        echo "<p>Please enter a temperature.</p>";
    }
}
?>

<form action="" method="post">
    Enter the temperature: <input type="text" name="temperature"><br>
    <input type="submit" value="Check Weather">
</form>

</body>
</html>
