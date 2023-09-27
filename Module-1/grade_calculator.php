<!DOCTYPE html>
<html>
<head>
    <title>Grade Calculator</title>
</head>
<body>

<h2>Grade Calculator</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $test1 = floatval($_POST["test1"]);
    $test2 = floatval($_POST["test2"]);
    $test3 = floatval($_POST["test3"]);

    $average = ($test1 + $test2 + $test3) / 3;

    if ($average >= 80) {
        $grade = 'A';
    } elseif ($average >= 70) {
        $grade = 'B';
    } elseif ($average >= 60) {
        $grade = 'C';
    } elseif ($average >= 50) {
        $grade = 'D';
    } else {
        $grade = 'F';
    }
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Test 1: <input type="text" name="test1" required><br><br>
    Test 2: <input type="text" name="test2" required><br><br>
    Test 3: <input type="text" name="test3" required><br><br>
    <input type="submit" name="calculate" value="Calculate Grade">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<br><strong>Test Scores:</strong><br>";
    echo "Test 1: $test1<br>";
    echo "Test 2: $test2<br>";
    echo "Test 3: $test3<br><br>";
    echo "<strong>Average:</strong> $average<br>";
    echo "<strong>Grade:</strong> $grade";
}
?>

</body>
</html>
