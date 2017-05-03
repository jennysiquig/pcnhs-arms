<?php require_once "../resources/config.php"; ?>
<?php
$statement2_res = DB::query($statement2);
if (count($statement2_res) > 0) {
  foreach ($statement2_res as $row) {
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
else{
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
