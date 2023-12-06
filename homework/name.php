<?php
// Kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root";
$password = "Tluantt34@";
$dbname = "POD";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Khởi tạo Prepared Statement
$stmt = $conn->prepare('INSERT INTO users (name, email, age) values (:name, :mail, :age)');

//Gán các biến (lúc này chưa mang giá trị) vào các placeholder theo tên của chúng
$stmt->bindParam(':name', $name);
$stmt->bindParam(':mail', $mail);
$stmt->bindParam(':age', $age);

//Gán giá trị và thực thi
$name = "Tran Thanh Luan";
$mail = "luan@live.com";
$age = 19;
$stmt->execute();

// Lấy thông tin từ cơ sở dữ liệu
$query = "SELECT * FROM users";
$result = $conn->query($query);

// Hiển thị thông tin
if ($result->rowCount() > 0) {
    echo "<table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
            </tr>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['age'] . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Không có thông tin để hiển thị";
}

// Đóng kết nối
$conn = null;
?>