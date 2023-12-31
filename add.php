<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавление записи в базу данных</title>
</head>
<body>
    
    <h1>Добавление записи в базу данных</h1>
    <!-- Форма для добавления записи -->
    <form method="post" action="index14.php">
        <label for="title">Название продукта:</label>
        <input type="text" name="title" id="title" required>
        <br>

        <label for="firstName">Имя производителя:</label>
        <input type="text" name="firstName" id="firstName">
        <br>

        <label for="mainName">Фамилия производителя:</label>
        <input type="text" name="mainName" id="mainName">
        <br>

        <label for="price">Цена:</label>
        <input type="number" name="price" id="price" step="0.01" required>
        <br>

        <label for="playLength">Длительность воспроизведения (только для CD):</label>
        <input type="number" name="playLength" id="playLength">
        <br>

        <label for="numPages">Количество страниц (только для книги):</label>
        <input type="number" name="numPages" id="numPages">
        <br>

        <input type="submit" value="Добавить запись">
    </form>

    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require 'index14.php';

        $dsn = "mysql:host=localhost;dbname=akhfvmxt_m4;charset=UTF8";
        $pdo = new PDO($dsn, 'akhfvmx', 'Tp83F6');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $title = $_POST['title'];
        $firstName = $_POST['firstName']; 
        $mainName = $_POST['mainName'];
        $price = $_POST['price'];
        $playLength = $_POST['playLength'];
        $numPages = $_POST['numPages'];

        // Создание экземпляра класса в зависимости от типа продукта
        if (!empty($playLength)) {
            $product = new CDProduct($title, $firstName, $mainName, $price, $playLength);
        } elseif (!empty($numPages)) {
            $product = new BookProduct($title, $firstName, $mainName, $price, $numPages);
        }

        // Вызов метода для добавления в базу данных
        if (isset($product)) {
            $product->actionCreate($pdo);
            echo "Запись успешно добавлена в базу данных.";
        }
    }
    ?>
</body>
</html>