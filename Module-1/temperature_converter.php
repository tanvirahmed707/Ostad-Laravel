<!DOCTYPE html>
<html>
<head>
    <title>Temperature Converter</title>
</head>
<body>

<h2>Temperature Converter</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Temperature: <input type="text" name="temperature" required><br><br>
    From:
    <select name="from_unit">
        <option value="celsius">Celsius</option>
        <option value="fahrenheit">Fahrenheit</option>
    </select><br><br>
    To:
    <select name="to_unit">
        <option value="celsius">Celsius</option>
        <option value="fahrenheit">Fahrenheit</option>
    </select><br><br>
    <input type="submit" name="convert" value="Convert">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $temperature = floatval($_POST["temperature"]);
    $from_unit = $_POST["from_unit"];
    $to_unit = $_POST["to_unit"];

    function convert($temp, $from, $to) {
        if ($from == "celsius" && $to == "fahrenheit") {
            return ($temp * 9/5) + 32;
        } elseif ($from == "fahrenheit" && $to == "celsius") {
            return ($temp - 32) * 5/9;
        }
        return $temp; 
    }

    $result = convert($temperature, $from_unit, $to_unit);
    echo "<br><strong>Result:</strong> $result $to_unit";
}
?>

</body>
</html>
