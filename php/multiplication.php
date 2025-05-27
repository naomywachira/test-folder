<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multiply Two Numbers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="images/1"alt="my picture">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 50px;
        }

        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            text-align: left;
            margin-top: 10px;
            color: #555;
        }

        input[type="number"] {
            padding: 10px;
            font-size: 16px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .result, .error {
            margin-top: 20px;
            padding: 15px;
            font-size: 1.2em;
            border-radius: 5px;
        }

        .result {
            background-color: #e7f9e7;
            color: #2c662d;
        }

        .error {
            background-color: #fde8e8;
            color: #a94442;
        }
</style>
    <div class="container">
        <h1>Multiply Two Numbers</h1>
        
        <form method="post" action="">
            <label for="num1">First Number:</label>
            <input type="number" name="num1" id="num1" required>

            <label for="num2">Second Number:</label>
            <input type="number" name="num2" id="num2" required>

            <button type="submit" name="multiply">Multiply</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $num1 = $_POST['num1'] ?? 0;
            $num2 = $_POST['num2'] ?? 0;

            if (is_numeric($num1) && is_numeric($num2)) {
                $result = $num1 * $num2;
                echo "<div class='result'>Result: <strong>$num1 × $num2 = $result</strong></div>";
            } else {
                echo "<div class='error'>Please enter valid numbers.</div>";
            }
        }
        ?>
    </div>
</body>
</html>
