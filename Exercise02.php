<!DOCTYPE html>
<html>

<body>
    <?php

    session_start();

    if (!isset($_SESSION['productQuantity']) || !isset($_SESSION['worker']) || !isset($_SESSION['product']) || !isset($_SESSION['quantity'])) {
        $_SESSION['productQuantity'] = array("milk" => 0, "soft drink" => 0);
        $_SESSION['worker'] = "";
        $productQuantity["milk"] = $_SESSION['productQuantity']["milk"];
        $productQuantity["soft drink"] = $_SESSION['productQuantity']["soft drink"];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $productQuantity = $_SESSION['productQuantity'];

        $_SESSION['worker'] = $_POST['worker'];
        $_SESSION['product'] = $_POST['product'];
        $_SESSION['quantity'] = $_POST['quantity'];

        if (isset($_POST['add'])) {

            switch ($_SESSION['product']) {
                case "milk":
                    $productQuantity["milk"] += $_SESSION['quantity'];
                    break;
                case "soft drink":
                    $productQuantity["soft drink"] += $_SESSION['quantity'];
                    break;
            }

            $_SESSION['productQuantity'] = $productQuantity;
        }

        if (isset($_POST["remove"])) {

            if ($_SESSION['productQuantity'][$_SESSION['product']] >= $_SESSION['quantity']) {

                switch ($_SESSION['product']) {
                    case "milk":
                        $productQuantity["milk"] -= $_SESSION['quantity'];
                        break;
                    case "soft drink":
                        $productQuantity["soft drink"] -= $_SESSION['quantity'];
                        break;
                }

                $_SESSION['productQuantity'] = $productQuantity;
            } else { {
                    echo "<p>Error: la cantidad que quieres retirar supera el límite permitido.</p>";
                }
            }
        }
    }


    ?>

    <h1>Supermarket management</h1>
    <form action="" method="post">
        <label for="name">Worker name:</label>
        <input type="text" name="worker" value=<?php echo $_SESSION['worker']; ?>><br><br>
        <h2>Choose product:</h2>
        <select name="product">
            <option value="milk">Milk</option>
            <option value="soft drink">Soft Drink</option>
        </select><br><br>
        <h2>Product quantity:</h2>
        <input type="number" name="quantity"><br><br>
        <input type="submit" value="add" name="add">
        <input type="submit" value="remove" name="remove">
        <input type="reset" value="reset">
    </form>

    <p>worker: <?php echo $_SESSION['worker'] ?></p>
    <p>units milk: <?php echo $_SESSION['productQuantity']["milk"] ?></p>
    <p>units soft drink: <?php echo $_SESSION['productQuantity']["soft drink"] ?></p>

</body>

</html>