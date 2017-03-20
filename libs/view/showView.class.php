<?php
/**
 * showView
 */
class showView {
	
	function showjson($data) {
		$data = json_encode($data);
		echo $data;
	}
}

?>