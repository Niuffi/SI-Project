<?php

$db;

function connectDB()
{
    try {
        $db = new PDO("mysql:host=127.0.0.1;dbname=projekt_si;", 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
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
            ";
    }
    $stmt->closeCursor();
    $stmt = null;
    $db->commit();
    return $headerInfo . $info;
}


function printBasicData($id) {
    $db = connectDB();
    $db->beginTransaction();
    $return = '';
    $return .= '<table>';
    $stmt = $db->prepare('SELECT * FROM persondata WHERE UserID=' . $id);
    $stmt->execute();
        while ($row = $stmt->fetch()) {
            $return .= "
            <tr><th> Imię: </th> <td>" . $row['Name'] . "</td></tr>
            <tr><th> Nazwisko: </th> <td>" . $row['Surname'] . "</td></tr>";
        }
    $return .= "</table>";
    return $return;
}
function getGradesFromStudent($id) {
    $grades = array();
    $db = connectDB();
    $db->beginTransaction();
    $stmt = $db->prepare('SELECT g.Label, g.Comment, g.Type, c.Name FROM `grades` AS g INNER JOIN `courses` AS c ON c.ID=g.CoursesID WHERE UserID='.$id);
    $stmt->execute();
    
    while ($row = $stmt->fetch()) {
        $grades[] = [$row['Label'], $row['Comment'], $row['Type'],$row['Name']];
    }
    $stmt->closeCursor();
    $stmt = null;
    $db->commit();
    return $grades;
}
function checkIfParent($id)
{
    $db = connectDB();
    $db->beginTransaction();
    $stmt = $db->prepare('SELECT COUNT(*) FROM parentassigment WHERE UserIDParent=' . $id);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        $return = $row['0'];
    }
    if ($return > 0) {
        return true;
    } else {
        return false;
    }
     

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

function printData($printData, $options = 'all')
{

    $db = connectDB();
    $db->beginTransaction();
    $return = '';
    $return .= '<table>';
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

            $stmt = $db->prepare('SELECT pd.Name, pd.Surname FROM persondata AS pd INNER JOIN parentassigment AS pa ON pd.UserID=pa.UserIDUser  WHERE UserIDParent='.$options);
            $stmt->execute(); 
            
            while ($row = $stmt->fetch()) {
                $return .= "
                <tr><td>" . $row['Name'] ." ". $row['Surname'] . "</td></tr>";
            }
            
            break;

        case "persondata":
            if ($options == "all") {
                $stmt = $db->prepare('SELECT * FROM persondata');
                $stmt->execute();
                $return .= "<tr><th> ID: </th><th> Imię: </th><th> Nazwisko: </th><th> Telefon: </th><th> Kod pocztowy: </th><th> Ulica: </th><th> Nr domu: </th><th> Miasto </th></tr>";
                while ($row = $stmt->fetch()) {
                    $return .= "
                    <tr>
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
            } else {
                $stmt = $db->prepare('SELECT * FROM persondata WHERE UserID=' . $options);
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    $return .= "
                    <tr><th> Imię: </th> <td>" . $row['Name'] . "</td></tr>
                    <tr><th> Nazwisko: </th> <td>" . $row['Surname'] . "</td></tr>
                    <tr><th> Telefon: </th><td>" . $row['Phone'] . "</td></tr>
                    <tr><th> Kod pocztowy: </th><td>" . $row['Postcode'] . "</td></tr>
                    <tr><th> Ulica: </th><td>" . $row['Street'] . "</td></tr>
                    <tr><th> Nr domu: </th><td>" . $row['Apartment'] . "</td></tr>
                    <tr><th> Miasto </th><td>" . $row['City'] . "</td></tr>
                ";
                }
            }
            break;

        case "user":

            if ($options == "all") {
                $stmt = $db->prepare('SELECT * FROM user');
                $stmt->execute();
                $return .= "<tr><th> ID </th><th> Login </th> <th> Password </th><th> Email </th><th> AccountType </th></tr>";

                while ($row = $stmt->fetch()) {
                    $return .= "<tr>
				<td>" . $row['ID'] . "</td>
				<td>" . $row['Login'] . "</td>
				<td>" . $row['Password'] . "</td>
				<td>" . $row['Email'] . "</td>
				<td>" . $row['AccountType'] . "</td>
			</tr>";
                }
            } else {
                $stmt = $db->prepare('SELECT * FROM user WHERE ID=' . $options);
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    $return .= "
                    <tr><th> Login: </th><td>" . $row['Login'] . "</td></tr>
                    <tr><th> Hasło: </th><td>" . $row['Password'] . "</td></tr>
                    <tr><th> Email: </th><td>" . $row['Email'] . "</td></tr>
                    <tr><th> Typ Konta: </th><td>" . $row['AccountType'] . "</td></tr>
                ";
                }
            }
            
            break;

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