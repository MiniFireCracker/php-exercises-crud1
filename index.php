<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<H1> List all clients from DB </H1>


<?php

$username = "root";
$password = "root";
$dbname = "colyseum";
$servername = "localhost";

try{
	$pdo= new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password );
	var_dump($pdo);
}catch(PDOException $e){
	echo "Failed to establish connection" . $e->getMessage();
}


$stmt = $pdo->query('SELECT * FROM clients');
while($client = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo 

	"<table>
		<thead>
			<th>id</th>
			<th>lastname</th>
			<th>firstname</th>
			<th>birthday</th>
			<th>card</th>
			<th>cardnumber</th>
		</thead>
		<tbody>

			<td>" . $client['id'] . "</td>
			<td>" .  $client['lastName'] . "</td>
			<td>" . $client['firstName'] . "</td>
			<td>" . $client['birthDate'] ."</td>
			<td>" . $client['card'] . "</td>
			<td>" . $client['cardNumber'] . "</td>
		</tbody>
	</table> "
  ;} ?>

<H1>List all kind of shows possible</H1>

<?php

$stmt = $pdo->query('SELECT type FROM showTypes');
while($showTypes = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo $showTypes['type'] . "<br>";
}
?>

<h1>List only the first 20 clients</h1>

<?php

$stmt = $pdo->query('SELECT lastName FROM clients LIMIT 20 ;');
while($first20 = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo $first20['lastName'] . "<br>";
}
?>

<h1>List the owners of a fidelity card </h1>

<?php

$stmt = $pdo->query('SELECT lastName FROM clients WHERE card=1 ;');
while($card_owner = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo $card_owner['lastName'] . "<br>";
}
?>

<h1>List the clients whose name begin with an m </h1>

<?php

$searched_expression = 'M%';

$stmt = $pdo->prepare('SELECT lastName, firstName FROM clients WHERE lastName LIKE ? ORDER BY lastName ;');
$stmt->execute([$searched_expression]);
$m_named_guys= $stmt->fetchAll();
foreach($m_named_guys as $m_named_guy){
	echo "Nom: " . $m_named_guy['lastName'] . " " . "Prénom: " . $m_named_guy['firstName'];
}
?>

<h1>List all shows and its details</h1>

<?php

$searched_expression = 'M%';

$stmt = $pdo->query('SELECT title, performer, date, startTime FROM shows ;');

while($shows_details = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo $shows_details['title'] . " par " .  $shows_details['performer'] . ", le " . $shows_details['date'] . " à " . $shows_details['startTime'] . " <br>";
}
?>


<h1>List all clients with some special formatting </h1>

<?php

$searched_expression = 'M%';

$stmt = $pdo->query('SELECT * FROM clients ;');

while($clients = $stmt->fetch(PDO::FETCH_ASSOC)){
		$numericaltotext=null;
		if($clients['card']== 1)
		{
			return $numericaltotext == "Oui";
		}
		elseif($clients['card']==0)
		{
			return $numericaltotext == "Non";
		}
	echo "Nom: " .$clients['lastName'] . " Prénom: " .  $clients['firstName'] . " Date de naissance: " . $clients['birthDate'] . " Carte de fidélité: " . $numericaltotext . " Numéro de carte: " . $clients['cardNumber'] ." <br>";
}
?>
</body>
</html>