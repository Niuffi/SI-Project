<?php
require_once('functions.php');

connectDB();
if(isset($_SESSION['user']['ID'])){
    $options = $_SESSION['user']['ID'];
} else {
    $options = "all";
}

$Info = printBasicData($options);

if(checkIfParent($options)){
    $ParentAssigmentData = "<h3>Posiadane dzieci:</h3>" . printData('parentassigment', $options);
} else {
    $ParentAssigmentData = "";
    $gradesInfo = getGradesFromStudent($options);
    $courseGrades = array();
    foreach ($gradesInfo as $element) {
        $courseGrades[$element[3]][] = $element;
    }
    console_log($courseGrades);
};

?>