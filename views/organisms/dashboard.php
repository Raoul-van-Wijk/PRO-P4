<?php 
    $users = new Users();
    $rows = $users->getUsers();

    $records = "";

    foreach($rows as $row) {
        $records .= "<tr><td>"
        . $row["userID"] . "</td><td>"
        . $row["username"] . "</td><td>"
        . $row["age"] . "</td><td>"
        . $row["userrole"] . "</td><td>"
        . $row["firstLogin"] . "</td></tr>";
    }
?>

<div class="dashboard">
<table>
    <tbody>
    <?php echo $records; ?>
    </tbody>
</table>
</div>
