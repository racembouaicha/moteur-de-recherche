<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recherche</title>
</head>
<body>
    <form action="" method="POST">
        <label for="recherche">Recherche:</label>
    <input type="search" name="search" id="search" placeholder="Search..."/>
    <input type="submit" name="submit" value="recherche" />
    </form>
    <?php

        $cnx =  new PDO("mysql:host=localhost;dbname=indexation",'root','root');
        
        if (isset($_POST["submit"]))
 {
	$str = $_POST["search"];
	
	$sth = $cnx->prepare("SELECT * FROM indexation WHERE 	first_name = '$str' OR last_name = '$str' OR email= '$str'");

	$sth->setFetchMode(PDO:: FETCH_OBJ);
	$sth -> execute();

	if($row = $sth->fetch())
	{
		?>
		<br><br><br>
		<table border=2 align=center >
			<tr>
                <th>id</th>
				<th>first Name</th>
				<th>last Name</th>
				<th>Email</th>

			</tr>
			<tr>
                <td><?php echo $row->id; ?></td>
				<td><?php echo $row->first_name; ?></td>
				<td><?php echo $row->last_name; ?></td>
                <td><?php echo $row->email; ?></td>
			</tr>

		</table>
<?php 
	}
		
		
		else{
			echo " Does not exist";
		}


}
       /* $text = $_POST['recherche'];

        if (isset($_POST['submit'])){
        $sql = "SELECT * FROM indexation WHERE first_name LIKE '%$text%'";
        $exec = $cnx->query($sql);
      
        }*/
    ?>
</body>
</html>