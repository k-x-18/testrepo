<?php
if (!isset($_GET['search']) || $_GET['search'] === '') {
    header('Location: index.php');
    exit;
}
$searchTerm = $_GET['search'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
    <style>
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .result-container {
            background: #fff;
            padding: 2rem 3rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .back-btn {
            margin-top: 1.5rem;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border: none;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h2>Search Result</h2>
        <div>
            You searched for: <strong><?php echo htmlspecialchars($searchTerm); ?></strong>
        </div>
        <form action="index.php" method="get">
            <button class="back-btn" type="submit">Return to Home</button>
        </form>
    </div>
</body>
</html> 