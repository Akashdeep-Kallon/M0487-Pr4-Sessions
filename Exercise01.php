<!DOCTYPE html>
<html>

<body>
    <?php

    session_start();
    if (isset($_SESSION['valores']) == null) {
        $_SESSION['valores'] = array(10, 20, 40);
    }

    $valores = $_SESSION['valores'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['position'] = $_POST['position'];
        $_SESSION['value'] = $_POST['value'];

        if (isset($_POST['modify'])) {
            $valores[$_SESSION['position']] = $_SESSION['value'];
            $_SESSION['valores'] = $valores;
        }
        if (isset($_POST["average"])) {
            $average = array_sum($_SESSION['valores']) / count($_SESSION['valores']);
        }
    }

    ?>

    <h1>Modify array saved in session</h1>
    <form action="" method="post">
        <label for="name">Position to modify:</label>
        <select name="position">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select><br><br>
        <label for="name">New value:</label>
        <input type="number" name="value"><br><br>
        <input type="submit" value="Modify" name="modify">
        <input type="submit" value="Average" name="average">
        <input type="reset" value="Reset">
    </form>

    <p>Current array: <?php echo implode(", ", $_SESSION['valores']); ?></p>

    <?php
    if (isset($average)) {
        echo "<p>Average: " . number_format($average, 2) . "</p>";
    }
    ?>
</body>

</html>