<?php
/**
 * functions to access data
 * Model data format
 */
class ElectionData extends DbConx {
	
	// to get all states for election
	public function getStates() {
		$conx = $this->connect();
		$query = mysqli_query($conx, "SELECT * FROM states");
		$check = mysqli_num_rows($query);
		$result = null;
		if ($check > 0) {
			$sn = 1;
			while ($row = mysqli_fetch_assoc($query)) {
				$stateId = $row['state_id'];
				$stateName = $row['state_name'];
				echo "<li class='states'>
							<input type='radio' name='state' id='state$sn' value='$stateId'>
							<label for='state$sn'>$stateName</label>
						</li>";

				++$sn;
			}
		} else {
			$result = false;
		}
		return $result;
	}

	// get LGA for these state
	public function getLGA($stateId, $inputType) {
		usleep(100000);
		$conx = $this->connect();
		if (!empty($stateId)) {
			$query = mysqli_query($conx, "SELECT lga_id, lga_name from lga WHERE state_id='$stateId' ");
			$name = "lga";
		} else {
			$query = mysqli_query($conx, "SELECT lga_id, lga_name from lga ");
			$name = "lgas[]";
		}
		$check = mysqli_num_rows($query);
		$result = null;
		if ($check > 0) {
			$sn = 1;
			while ($row = mysqli_fetch_assoc($query)) {
				$lgaId = $row['lga_id'];
				$lgaName = $row['lga_name'];
				$result .= "<li class='lgas'>
							<input type='$inputType' name='$name' id='lga$sn' value='$lgaId'>
							<label for='lga$sn'>$lgaName</label>
						</li>";

				++$sn;
			}
		} else {
			$result = "0";
		}
		return $result;
	}

	public function getWards($lgaId) {
		usleep(100000);
		$conx = $this->connect();
		$query = mysqli_query($conx, "SELECT ward_id, ward_name from ward WHERE lga_id='$lgaId' ");
		$check = mysqli_num_rows($query);
		$result = null;
		if ($check > 0) {
			$sn = 1;
			while ($row = mysqli_fetch_assoc($query)) {
				$wardId = $row['ward_id'];
				$wardName = $row['ward_name'];
				$result .= "<li class='wards'>
							<input type='radio' name='ward' id='ward$sn' value='$wardId'>
							<label for='ward$sn'>$wardName</label>
						</li>";

				++$sn;
			}
		} else {
			$result = "0";
		}
		return $result;
	}

	public function getPolls($wardId) {
		usleep(100000);
		$conx = $this->connect();
		$query = mysqli_query($conx, "SELECT uniqueid, polling_unit_name from polling_unit WHERE ward_id='$wardId' ");
		$check = mysqli_num_rows($query);
		$result = null;
		if ($check > 0) {
			$sn = 1;
			while ($row = mysqli_fetch_assoc($query)) {
				$pollId = $row['uniqueid'];
				$pollName = $row['polling_unit_name'];
				if (!empty($pollName)) {
					$result .= "<li class='polls'>
							<input type='radio' name='polls' id='poll$sn' value='$pollId'>
							<label for='poll$sn'>$pollName</label>
						</li>";

					++$sn;
				}
			}
		} else {
			$result = "0";
		}
		return $result;
	}

	public function getResults($pollId) {
		usleep(100000);
		$conx = $this->connect();
		$query = mysqli_query($conx, "SELECT result_id, party_abbreviation, party_score from announced_pu_results WHERE polling_unit_uniqueid='$pollId' ");
		$check = mysqli_num_rows($query);
		$result = null;
		if ($check > 0) {
			$sn = 1;
			while ($row = mysqli_fetch_assoc($query)) {
				$resultId = $row['result_id'];
				$party = $row['party_abbreviation'];
				$score = $row['party_score'];
				if (!empty($resultId)) {
					$result .= "<tr class='each_result'>
												<th>$sn</th>
												<td>$party</td>
												<td>$score</td>

											</tr>";

					++$sn;
				}
			}
		} else {
			$result = "0";
		}
		return $result;
	}

	public function getPollIds($selectedLgas) {
		$conx = $this->connect();
		$query = mysqli_query($conx, "SELECT uniqueid from polling_unit WHERE lga_id IN ($selectedLgas) ");
		$check = mysqli_num_rows($query);
		$result = null;
		if ($check > 0) {
			$result = array();
			while ($row = mysqli_fetch_assoc($query)) {
				$pollsId = $row['uniqueid'];
				array_push($result, $pollsId);
			}
			$result = implode(",", $result);
		} else {
			$result = "0";
		}
		return $result;
	}

	public function getLgasResult($pollsId) {
		$conx = $this->connect();
		$query = mysqli_query($conx, "SELECT party_score from announced_pu_results WHERE polling_unit_uniqueid IN ($pollsId) ");
		$check = mysqli_num_rows($query);
		$result = null;
		if ($check > 0) {
			$result = 0;
			while ($row = mysqli_fetch_assoc($query)) {
				$eachScore = $row['party_score'];
				$score = (int) $eachScore;
				$result += $score;
			}
		} else {
			$result = "0";
		}
		return $result;
	}

	public function addNewPollUnit($wardId, $lagId, $pollNum, $pollName, $pollDesc, $user) {
		$conx = $this->connect();
		$pollUnitId = rand(1, 35);
		$result = null;
		$query = "INSERT INTO polling_unit (uniqueid, polling_unit_id, ward_id, lga_id, uniquewardid, polling_unit_number, polling_unit_name, polling_unit_description, lat, lng, entered_by_user, date_entered, user_ip_address) VALUES (NULL, '$pollUnitId', '$wardId', '$lagId', '$wardId', '$pollNum', '$pollName', '$pollDesc', '5.593718', '6.0016111', '$user', NOW(), '192.168.1.101')";
		$queryResu = mysqli_query($conx, $query);
		if ($queryResu) {
			$result = mysqli_insert_id($conx);
		} else {
			$result = false;
		}
		return $result;
	}

	public function addNewResult($pollId, $scores, $user) {
		$conx = $this->connect();
		$pollUnitId = rand(1, 35);
		$result = null;
		$parties = array("PDP", "DPP", "ACN", "PPA", "CDC", "JP");
		$allScores = explode(",", $scores);
		for ($i=0; $i < count($parties); $i++) { 
			$query = mysqli_query($conx, "INSERT INTO announced_pu_results (result_id, polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user, date_entered, user_ip_address) VALUES (NULL, '$pollId', '$parties[$i]', '$allScores[$i]', '$user', NOW(), '192.168.1.101')");
		}
		if ($query) {
			$result = true;
		} else {
			$result = false;
		}
		return $result;
	}
}