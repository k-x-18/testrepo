<?php
// Input validation function based on OWASP C5 and best practices
function isXssAttack($input) {
    // Check for common XSS patterns
    $patterns = [
        '/<script.*?>.*?<\/script>/is', // script tags
        '/on\w+\s*=\s*(["\"]).*?\1/is', // inline event handlers
        '/javascript:/is', // javascript: pseudo-protocol
        '/<.*?\s+src\s*=\s*(["\"]).*?\1/is', // src attribute
        '/<.*?\s+href\s*=\s*(["\"]).*?\1/is', // href attribute
        '/<iframe.*?>.*?<\/iframe>/is', // iframe tags
        '/<img.*?>/is', // img tags
        '/<.*?style\s*=\s*(["\"]).*?\1/is', // style attribute
        '/<object.*?>.*?<\/object>/is', // object tags
        '/<embed.*?>.*?<\/embed>/is', // embed tags
        '/<svg.*?>.*?<\/svg>/is', // svg tags
        '/<link.*?>/is', // link tags
        '/<base.*?>/is', // base tags
    ];
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true;
        }
    }
    return false;
}

function isSqlInjectionAttack($input) {
    // Check for common SQLi patterns
    $patterns = [
        '/\b(SELECT|INSERT|UPDATE|DELETE|DROP|UNION|OR|AND)\b/i', // SQL keywords
        '/(--|#|\/\*)/', // SQL comments
        '/[\"\"][\s]*=[\s]*[\"\"]/', // tautologies
        '/\b(\d+\s*=\s*\d+)\b/', // numeric tautologies
        '/(;|\|\||&&)/', // statement chaining
        '/\b(CHAR\(|NCHAR\(|VARCHAR\(|NVARCHAR\()\b/i', // SQL functions
        '/\b(ALTER|CREATE|CAST|EXEC|EXECUTE|TRUNCATE|REPLACE)\b/i', // more SQL keywords
    ];
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true;
        }
    }
    return false;
}

$searchTerm = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    if (isXssAttack($searchTerm)) {
        $error = 'Input detected as XSS attack. Please enter a valid search term.';
        $searchTerm = '';
    } elseif (isSqlInjectionAttack($searchTerm)) {
        $error = 'Input detected as SQL Injection attack. Please enter a valid search term.';
        $searchTerm = '';
    } else {
        // Input is valid, redirect to result page
        header('Location: result.php?search=' . urlencode($searchTerm));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Secure Search</title>
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
        .search-container {
            background: #fff;
            padding: 2rem 3rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .search-box {
            width: 250px;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-btn {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border: none;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 0.5rem;
        }
        .search-btn:hover {
            background: #0056b3;
        }
        .error {
            color: #d8000c;
            background: #ffd2d2;
            border: 1px solid #d8000c;
            padding: 0.5rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="search-container">
        <h2>Secure Search</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <input class="search-box" type="text" name="search" placeholder="Enter search term..." value="<?php echo htmlspecialchars($searchTerm); ?>" required />
            <button class="search-btn" type="submit">Search</button>
        </form>
    </div>
</body>
</html> 