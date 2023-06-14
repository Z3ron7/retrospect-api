<?php

$conn = mysqli_connect("localhost","root","","retrospect",3306,"C:/xampp/mysql/mysql.sock");
$database = mysqli_select_db($conn,'retrospect');

$EndodedData= file_get_contents('php://input');
$DecodeData=json_decode($EndodedData, true);

/**Decoding the Username typed in front end to JSON type and passing to $FindUser variable */
$FindUser=$DecodeData["FindUser"];

/**SELECT QUERY */
$sql = "SELECT * FROM registeredusers WHERE FirstName='$FindUser'";

/**Acessing the data from database */
$Table = mysqli_query($conn, $sql);

/**Checking id there are data to GET/SELECT in DB */
if(mysqli_num_rows($Table)>0)
{
    /**Initializing Data from DB to parameters */
    $Row=mysqli_fetch_assoc($Table);
    $ID = $Row["ID"];
    $FirstName=$Row["FirstName"];
    $LastName=$Row["LastName"];
    $Username=$Row["Username"];
    $Password=$Row["Password"];

    /**Passing the parameters to FRONT END  */
    $Response[] = array("ID"=>$ID,"FirstName"=>$FirstName, "LastName"=>$LastName, "Username"=>$Username, "Password"=>$Password);
    /**Encoding to JSON */
    echo json_encode($Response);

}else{

    $Message = "No results found";
    $JSONMessage = json_encode($Message);
    echo $JSONMessage;
   
}


?>