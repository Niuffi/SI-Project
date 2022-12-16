<?php

$db;

function connectDB()
{
    try {
        $db = new PDO('mysql:host=127.0.0.1;dbname=projekt_si;port=3306', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOException $e) {
        $e->getMessage();
    }
    return $db;
}

function printUserDataById($id)
{
    $db = connectDB();
    $db->beginTransaction();
    $stmt = $db->prepare('SELECT * FROM user WHERE ID=' . $id);
    $stmt->execute();
    $headerInfo = "<table><tr><th> ID </th><th> Login </th><th> Email </th><th> AccountType </th></tr>";


    while ($row = $stmt->fetch()) {
        $info = "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['Login'] . "</td>
				<td>" . $row['Password'] . "</td>
				<td>" . $row['Email'] . "</td>
				<td>" . $row['AccountType'] . "</td>
			</tr>
            </table>
            <br>";
    }
    $stmt->closeCursor();
    $stmt = null;
    $db->commit();
    return $headerInfo . $info;
}

function showUsers()
{
    $db = connectDB();
    $db->beginTransaction();
    $stmt = $db->prepare('SELECT * FROM user');
    $stmt->execute();

    $headerInfo = "<table><tr><th> ID </th><th> Login </th> <th> Password </th><th> Email </th><th> AccountType </th></tr>";
    $Info = '';
    while ($row = $stmt->fetch()) {
        $Info .= "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['Login'] . "</td>
				<td>" . $row['Password'] . "</td>
				<td>" . $row['Email'] . "</td>
				<td>" . $row['AccountType'] . "</td>
			</tr>";
    }
    $endInfo = "</table>";
    $stmt->closeCursor();
    $stmt = null;
    $db->commit();
    return $headerInfo . $Info . $endInfo;
}

function printData($printData,$options='all')
{
    
    $db = connectDB();
    $db->beginTransaction();
    $return = '';
    $return .= "<table border = 'solid black 1px dotted'>";

    switch ($printData) {
        case "courseassigment":
            $stmt = $db->prepare('SELECT * FROM courseassigment');
            $stmt->execute();

            $return .= "<tr><th> ID </th><th> UserID </th></tr>";

            while ($row = $stmt->fetch()) {
                $return .= "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['UserID'] . "</td>
			</tr>";
            }
            break;

        case "courses":

            $stmt = $db->prepare('SELECT * FROM courses');
            $stmt->execute();

            $return .= "<tr><th> ID </th><th> Name </th> <th> UserID </th> <th> Label </th></tr>";

            while ($row = $stmt->fetch()) {
                $return .= "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['Name'] . "</td>
				<td>" . $row['UserID'] . "</td>
				<td>" . $row['Label'] . "</td>
			</tr>";
            }
            break;

        case "grades":

            $stmt = $db->prepare('SELECT * FROM grades');
            $stmt->execute();

            $return .= "<tr><th> ID </th><th> Date </th> <th> CoursesID </th> <th> UserID </th> <th> Label </th> <th> Comment </th> <th> Type </th> </tr>";

            while ($row = $stmt->fetch()) {
                $return .= "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['Date'] . "</td>
				<td>" . $row['CoursesID'] . "</td>
				<td>" . $row['UserID'] . "</td>
				<td>" . $row['Label'] . "</td>
				<td>" . $row['Comment'] . "</td>
				<td>" . $row['Type'] . "</td>
			</tr>";
            }
            break;

        case "groupassigment":

            $stmt = $db->prepare('SELECT * FROM groupassigment');
            $stmt->execute();

            $return .= "<tr><th> ID </th><th> UserID </th></tr>";

            while ($row = $stmt->fetch()) {
                $return .= "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['UserID'] . "</td>
			</tr>";
            }
            break;

        case "groups":

            $stmt = $db->prepare('SELECT * FROM groups');
            $stmt->execute();

            $return .= "<tr><th> ID </th><th> UserID </th></tr>";

            while ($row = $stmt->fetch()) {
                $return .= "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['UserID'] . "</td>
			</tr>";
            }
            break;

        case "parentassigment":

            $stmt = $db->prepare('SELECT * FROM parentassigment');
            $stmt->execute();

            $return .= "<tr><th> ID </th><th> UserIDParent </th><th> UserIDUser </th></tr>";

            while ($row = $stmt->fetch()) {
                $return .= "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['UserIDParent'] . "</td>
				<td>" . $row['UserIDUser'] . "</td>
			</tr>";
            }
            break;

        case "persondata":

            $stmt = $db->prepare('SELECT * FROM persondata');
            $stmt->execute();

            $return .= "<tr><th> UserID </th><th> Name </th> <th> Surname </th><th> Phone </th><th> Postcode </th> <th> Street </th> <th> Apartment </th> <th> City </th></tr>";

            while ($row = $stmt->fetch()) {
                $return .= "<tr>
				<td>" . $row['UserID'] . "</td>
				<td>" . $row['Name'] . "</td>
				<td>" . $row['Surname'] . "</td>
				<td>" . $row['Phone'] . "</td>
				<td>" . $row['Postcode'] . "</td>
				<td>" . $row['Street'] . "</td>
				<td>" . $row['Apartment'] . "</td>
				<td>" . $row['City'] . "</td>
			</tr>";
            }

            break;

        case "user":

            if($options == "all"){
                $stmt = $db->prepare('SELECT * FROM user');
            } else {
                $stmt = $db->prepare('SELECT * FROM user WHERE ID='.$options);
            }
           
            $stmt->execute();

            $return .= "<tr><th> ID </th><th> Login </th> <th> Password </th><th> Email </th><th> AccountType </th></tr>";

            while ($row = $stmt->fetch()) {
                $return .= "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['Login'] . "</td>
				<td>" . $row['Password'] . "</td>
				<td>" . $row['Email'] . "</td>
				<td>" . $row['AccountType'] . "</td>
			</tr><br>";
            }
    }

    $stmt->closeCursor();
    $stmt = null;
    $db->commit();

    $return .= "</table>";
    return $return;
}
/*
function printData($printData)
{
    
    $db = connectDB();
    $db->beginTransaction();

    echo "<table border = 'solid black 1px dotted'>";

    switch ($printData) {
        case "courseassigment":
            $stmt = $db->prepare('SELECT * FROM courseassigment');
            $stmt->execute();

            echo "<tr><td> ID </td><td> UserID </td></tr>";

            while ($row = $stmt->fetch()) {
                echo "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['UserID'] . "</td>
			</tr>";
            }
            break;

        case "courses":

            $stmt = $db->prepare('SELECT * FROM courses');
            $stmt->execute();

            echo "<tr><td> ID </td><td> Name </td> <td> UserID </td> <td> Label </td></tr>";

            while ($row = $stmt->fetch()) {
                echo "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['Name'] . "</td>
				<td>" . $row['UserID'] . "</td>
				<td>" . $row['Label'] . "</td>
			</tr>";
            }
            break;

        case "grades":

            $stmt = $db->prepare('SELECT * FROM grades');
            $stmt->execute();

            echo "<tr><td> ID </td><td> Date </td> <td> CoursesID </td> <td> UserID </td> <td> Label </td> <td> Comment </td> <td> Type </td> </tr>";

            while ($row = $stmt->fetch()) {
                echo "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['Date'] . "</td>
				<td>" . $row['CoursesID'] . "</td>
				<td>" . $row['UserID'] . "</td>
				<td>" . $row['Label'] . "</td>
				<td>" . $row['Comment'] . "</td>
				<td>" . $row['Type'] . "</td>
			</tr>";
            }
            break;

        case "groupassigment":

            $stmt = $db->prepare('SELECT * FROM groupassigment');
            $stmt->execute();

            echo "<tr><td> ID </td><td> UserID </td></tr>";

            while ($row = $stmt->fetch()) {
                echo "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['UserID'] . "</td>
			</tr>";
            }
            break;

        case "groups":

            $stmt = $db->prepare('SELECT * FROM groups');
            $stmt->execute();

            echo "<tr><td> ID </td><td> UserID </td></tr>";

            while ($row = $stmt->fetch()) {
                echo "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['UserID'] . "</td>
			</tr>";
            }
            break;

        case "parentassigment":

            $stmt = $db->prepare('SELECT * FROM parentassigment');
            $stmt->execute();

            echo "<tr><td> ID </td><td> UserIDParent </td><td> UserIDUser </td></tr>";

            while ($row = $stmt->fetch()) {
                echo "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['UserIDParent'] . "</td>
				<td>" . $row['UserIDUser'] . "</td>
			</tr>";
            }
            break;

        case "persondata":

            $stmt = $db->prepare('SELECT * FROM persondata');
            $stmt->execute();

            echo "<tr><td> UserID </td><td> Name </td> <td> Surname </td><td> Phone </td><td> Postcode </td> <td> Street </td> <td> Apartment </td> <td> City </td></tr>";

            while ($row = $stmt->fetch()) {
                echo "<tr>
				<td>" . $row['UserID'] . "</td>
				<td>" . $row['Name'] . "</td>
				<td>" . $row['Surname'] . "</td>
				<td>" . $row['Phone'] . "</td>
				<td>" . $row['Postcode'] . "</td>
				<td>" . $row['Street'] . "</td>
				<td>" . $row['Apartment'] . "</td>
				<td>" . $row['City'] . "</td>
			</tr>";
            }

            break;

        case "user":

            $stmt = $db->prepare('SELECT * FROM user');
            $stmt->execute();

            $headerInfo = "<tr><th> ID </th><th> Login </th> <th> Password </th><th> Email </th><th> AccountType </th></tr>";

            while ($row = $stmt->fetch()) {
                $Info .= "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['Login'] . "</td>
				<td>" . $row['Password'] . "</td>
				<td>" . $row['Email'] . "</td>
				<td>" . $row['AccountType'] . "</td>
			</tr><br>";
            }
            return $headerInfo . $Info;
    }

    $stmt->closeCursor();
    $stmt = null;
    $db->commit();

    echo "</table>";
}
*/
?>