<?php require_once "../resources/config.php"; ?>
<?php
$statement_res = $conn->query($statement);

if ($statement_res->num_rows > 0) {
    while ($row = $statement_res->fetch_assoc()) {
        $log_id = $row['log_id'];
        $log_date = $row['log_date'];
        $user_name = $row['user_name'];
        $account_type = $row['account_type'];
        $log_date = $row['log_date'];
        $log_in_time = $row['log_in_time'];
        $log_out_time = $row['log_out_time'];
        $user_act = $row['user_act'];
        echo <<<LOGLIST
                                            <tr class="odd pointer">
                                                        <td class=" ">$log_id</td>
                                                        <td class=" ">$log_date</td>
                                                        <td class=" ">$user_name</td>
                                                        <td class=" ">$account_type</td>
                                                        <td class=" ">$log_in_time</td>
                                                        <td class=" ">$user_act</td>
                                                        <td class=" ">$log_out_time</td>                                                    
                                            </tr>
LOGLIST;
    }
}
else if ($statement_res->num_rows == 0) {
    echo <<<NORES
                                    <tr class="odd pointer">
                                    <span class="badge badge-danger">NO RESULT</span>
                                    <br><br>        
                                    </tr>
NORES;
}
echo "</tbody>";
echo "</table>";
?>
