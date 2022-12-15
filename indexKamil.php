<?php

function connectDB(){
	$db;
	try{
		$db = new PDO('mysql:host=localhost;dbname=database;port=3306','root','',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	catch(PDOException $e){
		$e->getMessage();
	}
	return $db;
}

printData("courseassigment");
printData("courses");
printData("grades");
printData("groupassigment");
printData("groups");
printData("parentassigment");
printData("persondata");
printData("user");

function printData($printData){

		$db = connectDB();
		$db -> beginTransaction();

		echo "<table border = 'solid black 1px dotted'>";

	switch($printData){
		case "courseassigment":
			$stmt = $db -> prepare('SELECT * FROM courseassigment');
			$stmt -> execute();

		echo "<tr><td> ID </td><td> UserID </td></tr>";

		while($row = $stmt -> fetch()){
		echo "<tr>
				<td>".$row['ID']."</td>
				<td>".$row['UserID']."</td>
			</tr>";
		}
		break;

		case "courses":

		$stmt = $db -> prepare('SELECT * FROM courses');
		$stmt -> execute();

		echo "<tr><td> ID </td><td> Name </td> <td> UserID </td> <td> Label </td></tr>";

		while($row = $stmt -> fetch()){
		echo "<tr>
				<td>".$row['ID']."</td>
				<td>".$row['Name']."</td>
				<td>".$row['UserID']."</td>
				<td>".$row['Label']."</td>
			</tr>";
		}
		break;

		case "grades":

		$stmt = $db -> prepare('SELECT * FROM grades');
		$stmt -> execute();

		echo "<tr><td> ID </td><td> Date </td> <td> CoursesID </td> <td> UserID </td> <td> Label </td> <td> Comment </td> <td> Type </td> </tr>";

		while($row = $stmt -> fetch()){
		echo "<tr>
				<td>".$row['ID']."</td>
				<td>".$row['Date']."</td>
				<td>".$row['CoursesID']."</td>
				<td>".$row['UserID']."</td>
				<td>".$row['Label']."</td>
				<td>".$row['Comment']."</td>
				<td>".$row['Type']."</td>
			</tr>";
		}
		break;

		case "groupassigment":

		$stmt = $db -> prepare('SELECT * FROM groupassigment');
		$stmt -> execute();

		echo "<tr><td> ID </td><td> UserID </td></tr>";

		while($row = $stmt -> fetch()){
		echo "<tr>
				<td>".$row['ID']."</td>
				<td>".$row['UserID']."</td>
			</tr>";
		}
		break;

		case "groups":

		$stmt = $db -> prepare('SELECT * FROM groups');
		$stmt -> execute();

		echo "<tr><td> ID </td><td> UserID </td></tr>";

		while($row = $stmt -> fetch()){
		echo "<tr>
				<td>".$row['ID']."</td>
				<td>".$row['UserID']."</td>
			</tr>";
		}
		break;

		case "parentassigment":

		$stmt = $db -> prepare('SELECT * FROM parentassigment');
		$stmt -> execute();

		echo "<tr><td> ID </td><td> UserIDParent </td><td> UserIDUser </td></tr>";

		while($row = $stmt -> fetch()){
		echo "<tr>
				<td>".$row['ID']."</td>
				<td>".$row['UserIDParent']."</td>
				<td>".$row['UserIDUser']."</td>
			</tr>";
		}
		break;

		case "persondata":

		$stmt = $db -> prepare('SELECT * FROM persondata');
		$stmt -> execute();

		echo "<tr><td> UserID </td><td> Name </td> <td> Surname </td><td> Phone </td><td> Postcode </td> <td> Street </td> <td> Apartment </td> <td> City </td></tr>";

		while($row = $stmt -> fetch()){
		echo "<tr>
				<td>".$row['UserID']."</td>
				<td>".$row['Name']."</td>
				<td>".$row['Surname']."</td>
				<td>".$row['Phone']."</td>
				<td>".$row['Postcode']."</td>
				<td>".$row['Street']."</td>
				<td>".$row['Apartment']."</td>
				<td>".$row['City']."</td>
			</tr>";
		}

		break;

		case "user":

		$stmt = $db -> prepare('SELECT * FROM user');
		$stmt -> execute();

		echo "<tr><td> ID </td><td> Login </td> <td> Password </td><td> Email </td><td> AccountType </td></tr>";

		while($row = $stmt -> fetch()){
		echo "<tr>
				<td>".$row['ID']."</td>
				<td>".$row['Login']."</td>
				<td>".$row['Password']."</td>
				<td>".$row['Email']."</td>
				<td>".$row['AccountType']."</td>
			</tr>";
		}
		break;
	}

		$stmt->closeCursor();
		$stmt = null;
		$db->commit();

	echo "</table>";
}

?>