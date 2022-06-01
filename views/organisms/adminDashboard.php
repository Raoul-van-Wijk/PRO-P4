<?php 

    $role = $_SESSION['userrole'];
    if(!$role == 'admin' || !$role == 'root') {
        header("location: ".URLROOT."page/main/home");
    }

    if (isset($_GET['timeout'])) {
        if($_GET['timeout'] == true) {
            $test = '
            <form action="/" method="GET">
                <input type="hidden" name="page" value="main/adminDashboard">
                <label for="">Hoeveel uur time-outen?</label>
                <input type="text" name="time">
                <input type="hidden" name="timeout" value="true">
                <input type="hidden" name="id" value="' . $_GET['id'] . '">
                <input type="submit">
            </form>';
            if (isset($_GET['time'])) {
                if (isset($_GET['id'])) {
                    $timeout = new Users;
                    $timeout->timeoutUser($_GET['id'], $_GET['time']);
                }
            }
        }
    }

    if (isset($_GET['ban'])) {
        if($_GET['ban'] == true) {     
            $ban = new Users;
            $ban->banUser($_GET['id']);
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
        . $row["timeoutTime"] . "</td><td>"   
        . "<a href='" . URLROOT . "page/main/adminDashboard&timeout=true&id=". $row["userID"] ."'><img src='../../assets/img/b_events.png'></a> "
        . "<a href='" . URLROOT . "page/main/adminDashboard&ban=true&id=". $row["userID"] ."'><img src='../../assets/img/b_drop.png'></a>"
        ."</td></tr>";
    }
?>

<div class="dashboard">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Age</th>
            <th>Role</th>
            <th>Status</th>
            <th>Timeout Time</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php echo $records; ?>
    </tbody>
</table>

<?php ?>

<?php echo (isset($test)) ? $test : '';?>
</div>
