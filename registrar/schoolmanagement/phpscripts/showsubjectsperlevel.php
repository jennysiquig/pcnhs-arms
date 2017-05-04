<?php

		require_once "../../../resources/config.php";
		$curriculum = $_GET['curr_id'];
		$yr_level_needed = $_GET['yr_level_needed'];
		$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id where subjectcurriculum.curr_id = $curriculum and yr_level_needed = $yr_level_needed";
		$result = DB::query($statement);
		if (count($result) > 0) {
			foreach ($result as $row) {
				//$subj_id = $row['subj_id'];
				$subj_id = $row['subj_id'];
				$subj_name = $row['subj_name'];
				$subj_level = $row['subj_level'];
				//$curr_name = $row['curr_name'];
				echo <<<SUBJ

					<tr>
							<td><input value="$subj_id" name="subj_id[]" style="width: 50px;" disabled></td>
							<td>$subj_name</td>
							<td>$subj_level</td>
							<td><input style="width: 60px;" name="fin_grade[]"></td>
							<td><input style="width: 60px;" name="unit[]"></td>
							<td><input style="width: 100px;" name="comment[]"></td>
					</tr>

SUBJ;
			}
		}

?>
