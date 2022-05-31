<?php 

    $role = $_SESSION['userrole'];
    if(!($role == 'admin') || !($role == 'root')) {
        header("location: ".URLROOT."page/main/home");
    }


    if (isset($_GET['timeout'])) {
        if($_GET['timeout'] == true) {
            $timeout = new Users;
            $timeout->timeoutUser($_GET['id']);
        }
    }
    

    $users = new Users();
    $rows = $users->getUsers();

    $records = "";

    foreach($rows as $row) {
        $records .= "<tr><td>"
        . $row["userID"] . "</td><td>"
        . $row["username"] . "</td><td>"
        . $row["age"] . "</td><td>"
        . $row["userrole"] . "</td><td>"
        . $row["firstLogin"] . "</td><td>"  
        . "<a href='" . URLROOT . "page/main/dashboard&timeout=true&id=". $row["userID"] ."'><img src='../../assets/img/b_drop.png'></a>"
        ."</td></tr>";
    }
?>

<div class="dashboard">
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>age</th>
            <th>role</th>
            <th>status</th>
            <th>ban</th>
        </tr>
    </thead>
    <tbody>
    <?php echo $records; ?>
    </tbody>
</table>
</div>
