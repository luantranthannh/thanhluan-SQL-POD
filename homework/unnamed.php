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
$stmt = $conn->prepare('INSERT INTO users (name, email, age) VALUES (?, ?, ?)');

// Gán giá trị và thực thi
$name = "Tran Thanh Luan";
$email = "luan@gmail.com";
$age = 19;
$stmt->execute([$name, $email, $age]);

// Gán giá trị và thực thi
$name = "Nguyen Van A";
$email = "nva@live.com";
$age = 23;
$stmt->execute([$name, $email, $age]);


$stmt = $conn->prepare('INSERT INTO users (name, email, age) values (?, ?, ?)');
$data = array('Nguyen Thi C', 'nguyen@gmail.com', 22);

//Phương thức execute() dưới đây sẽ gán lần lượt giá trị 
//trong mảng vào các Placeholder theo thứ tự
$stmt->execute($data);


// Lấy thông tin từ cơ sở dữ liệu
$query = "SELECT * FROM users";
$result = $conn->query($query);

// Hiển thị thông tin
if ($result->rowCount() > 0) {
    // rowCount() : Đếm số lượng hàng trả về 
    echo "<table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
            </tr>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //PDO::FETCH_ASSOC: Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)
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