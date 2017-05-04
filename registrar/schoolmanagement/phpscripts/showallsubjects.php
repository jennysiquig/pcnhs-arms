<?php
	require_once "../../../resources/config.php";


	$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id";

	$result = DB::query($statement);

	if (count($result) > 0) {
		foreach ($result as $row) {
			# code...
			$subj_id = $row['subj_id'];
			$subj_name = $row['subj_name'];
			$subj_level = $row['subj_level'];
			$curr_name = $row['curr_name'];
			$prog_name = $row['prog_name'];
			echo <<<SUBJ
				<tr>
					<td>$subj_id</td>
					<td>$subj_name</td>
					<td>$subj_level</td>
					<td>$curr_name</td>
					<td>$prog_name</td>
				</tr>
SUBJ;
		}
	}


?>
