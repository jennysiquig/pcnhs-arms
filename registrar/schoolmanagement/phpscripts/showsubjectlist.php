<?php
	require_once "../../../resources/config.php";

	$curriculum = $_GET['curr_id'];

	$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id where subjectcurriculum.curr_id = $curriculum";

	$result = $conn->query($statement);

	if($result->num_rows>0) {
		while ($row = $result->fetch_assoc()) {
			$subj_id = $row['subj_id'];
			$subj_name = $row['subj_name'];
			$subj_level = $row['subj_level'];
			$curr_name = $row['curr_name'];

			echo <<<SUBJ
				<tr>
					<td>$subj_id</td>
					<td>$subj_name</td>
					<td>$subj_level</td>
					<td>$curr_name</td>
					<td> </td>
				</tr>
SUBJ;
		}
	}


?>