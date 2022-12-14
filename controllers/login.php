<?php
/*
if (isset($_POST['username']) && isset($_POST['password'])) {
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); //Hashing password with bcrypt
*/
$found = false;
$errors = false;
$conn = new PDO('mysql:host=127.0.0.1;dbname=projekt_si;port=3306', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
// Check connection


if(count($_POST) > 0) {
    $stmt = $conn->query('SELECT Login, Password FROM user');
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['Login'] == $_POST['username']) {
            $found = true;
            break;
        }
    }
    if ($found) {
        // Login validation
        $stmt = $conn->query('SELECT * FROM user WHERE Login="'.$_POST['username'].'"');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['Password'] != $_POST['password']) {
            $errors = true;
        } else {
            $_SESSION['user'] = $row;
            $_SESSION['page'] = 'home';
            $_SESSION['loggedIn'] = true;
            header("Refresh:0");
        }

    } else {
        $errors = true;
    }
}
/*
$sql = 'SELECT * FROM user WHERE password=$password and username=$username';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
}
} else {
header('Location: login.php?loginError="Incorrect username or password!"');
}

$conn->close();
header('Location: home.php');
} 
*/
?>