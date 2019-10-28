$username = "root";
$password = "root";
$dbname = "colyseum";
$servername = "localhost";

try{
	$pdo= "mysql:host=" . $servername . ";dbname=" . $dbname ";" . $username . "," . $password ;
	$pdo->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Failed to establish connection" . $e->getMessage();
}


$stmt = pdo->query('SELECT * FROM clients');
while($row = $stmt->fetchall()){
	return $row;
}