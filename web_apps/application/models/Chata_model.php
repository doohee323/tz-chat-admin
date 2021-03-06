<?php
class Chata_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function chatlist($params) {
		$from_at = '';
		$to_at = '';
		if (array_key_exists ( 'from_at', $params ) || ! empty ( $params ['from_at'] )) {
			$from_at = $params ['from_at'];
		}
		if (array_key_exists ( 'to_at', $params ) || ! empty ( $params ['to_at'] )) {
			$to_at = $params ['to_at'];
		}
		if (array_key_exists ( 'status', $params ) || ! empty ( $params ['status'] )) {
			$status = $params ['status'];
		}
		
		$return = array ();
		
		$sql = "SELECT A.id, A.roomid, COALESCE(D.reserve,0) AS reserve, D.man_ip, D.woman_ip, A.detail, B.userid, CASE WHEN B.main != '' THEN B.main ELSE '../images/user-men.png' END AS main,";
		$sql = $sql . " B.nickname, B.meeting_type, B.talk_style, B.age, B.gender, B.region1, B.region2, A.status, A.reject, A.created_at,";
		$sql = $sql . " C.nickname AS nickname_t, C.age AS age_t, C.gender AS gender_t";
		$sql = $sql . " FROM (SELECT A.id, A.roomid, A.source, A.target, A.detail, A.status, A.reject, A.created_at";
		$sql = $sql . " FROM tzchat.chat A";
		$sql = $sql . " WHERE A.status LIKE '%" . $status . "%') A";
		$sql = $sql . " JOIN tzchat.user B";
		$sql = $sql . " ON A.source = B.userid";
		if ($from_at != null) {
			$sql = $sql . " AND A.created_at BETWEEN '" . $from_at . " 00:00:00' AND '" . $to_at . " 23:59:59'";
		}
		$sql = $sql . " JOIN tzchat.user C";
		$sql = $sql . " ON A.target = C.userid";
		$sql = $sql . " LEFT JOIN tzchat.history D";
		$sql = $sql . " ON A.id = D.id";
		$sql = $sql . " ORDER BY A.created_at";
		
		$query = $this->db->query ( $sql );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		return $query->result_array ();
	}
	function chat($id) {
		$sql = "SELECT * FROM tzchat.chat WHERE id = '" . $id;
		$query = $this->db->query ( $sql );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		$return = array ();
		foreach ( $query->result_array () as $row ) {
			$return = $row;
		}
		return $return;
	}
	function add($data) {
		if (! array_key_exists ( 'source', $data ) || empty ( $data ['source'] )) {
			throw new Exception ( "source is a required field", 1001 );
		}
		
		$sql = "SELECT A.id, A.roomid, B.userid, CASE WHEN B.main != '' THEN B.main ELSE '../images/user-men.png' END AS main,";
		$sql = $sql . " B.nickname, B.meeting_type, B.talk_style, B.age, B.gender, B.region1, B.region2, A.status, A.reject, A.created_at, A.count";
		$sql = $sql . " FROM (SELECT A.id, A.roomid, A.source, A.status, A.reject, A.created_at, COUNT(1) AS count";
		$sql = $sql . " FROM tzchat.chat A";
		$sql = $sql . " WHERE A.status = 'request' AND (A.target = '" . $data ['target'] . "' OR A.source = '" . $data ['source'] . "')";
		$sql = $sql . " GROUP BY A.source) A, tzchat.user B";
		$sql = $sql . " WHERE A.source = B.userid";
		$sql = $sql . " ORDER BY A.created_at";
		
		$query = $this->db->query ( $sql );
		if (false === $query) {
			$error = $this->db->error ();
			log_message ( 'error', $error ['message'] );
			throw new Exception ( $error ['message'], 500 );
		}
		$data0 = $query->result_array ();
		if (count ( $data0 ) > 0) {
			$values = array (
					'message' => 'Data exists' 
			);
		} else {
			$this->load->model ( 'usera_model' );
			// $input = array (
			// 'userid' => $data ['source']
			// );
			$user = $this->usera_model->get ( array (
					'userid' => $data ['source'] 
			) );
			$point = 0;
			if ($user ['gender'] == 'man') {
				$point = $user ['point'];
				$point = $point - 500;
				if ($point < 0) {
					$values = array (
							'message' => 'Not enough' 
					);
				}
			}
			$values = array (
					'roomid' => (array_key_exists ( 'roomid', $data ) && ! empty ( $data ['roomid'] )) ? $data ['roomid'] : NULL,
					'source' => (array_key_exists ( 'source', $data ) && ! empty ( $data ['source'] )) ? $data ['source'] : NULL,
					'target' => (array_key_exists ( 'target', $data ) && ! empty ( $data ['target'] )) ? $data ['target'] : NULL,
					'status' => (array_key_exists ( 'status', $data ) && ! empty ( $data ['status'] )) ? $data ['status'] : NULL,
					'detail' => (array_key_exists ( 'detail', $data ) && ! empty ( $data ['detail'] )) ? $data ['detail'] : NULL,
					'created_at' => date ( 'Y-m-d H:i:s' ),
					'created_by' => $data ['source'],
					'updated_at' => date ( 'Y-m-d H:i:s' ),
					'updated_by' => $data ['source'] 
			);
			
			$query = $this->db->insert ( 'chat', $values );
			if (false === $query) {
				$error = $this->db->error ();
				throw new Exception ( $error ['message'], 500 );
			}
			
			$values ['id'] = $this->db->insert_id ();
			$values0 = array (
					'userid' => $data ['source'],
					'point' => $point,
					'updated_at' => date ( 'Y-m-d H:i:s' ),
					'updated_by' => $data ['source'] 
			);
			$result1 = $this->usera_model->updatePoint ( $values0 );
			
			$this->load->model ( 'account_model' );
			$values1 = array (
					'userid' => (array_key_exists ( 'source', $data ) && ! empty ( $data ['source'] )) ? $data ['source'] : NULL,
					'source' => (array_key_exists ( 'source', $data ) && ! empty ( $data ['source'] )) ? $data ['source'] : NULL,
					'action' => (array_key_exists ( 'action', $data ) && ! empty ( $data ['action'] )) ? $data ['action'] : NULL,
					'point' => 500,
					'created_at' => date ( 'Y-m-d H:i:s' ),
					'created_by' => $data ['source'],
					'updated_at' => date ( 'Y-m-d H:i:s' ),
					'updated_by' => $data ['source'] 
			);
			$result2 = $this->account_model->add ( $values1 );
		}
		return $values;
	}
	function update($data) {
		$values = array (
				// 'source' => (array_key_exists ( 'source', $data ) && ! empty ( $data ['source'] )) ? $data ['source'] : NULL,
				// 'target' => (array_key_exists ( 'target', $data ) && ! empty ( $data ['target'] )) ? $data ['target'] : NULL,
				'status' => (array_key_exists ( 'status', $data ) && ! empty ( $data ['status'] )) ? $data ['status'] : NULL,
				// 'detail' => (array_key_exists ( 'detail', $data ) && ! empty ( $data ['detail'] )) ? $data ['detail'] : NULL,
				'reject' => (array_key_exists ( 'reject', $data ) && ! empty ( $data ['reject'] )) ? $data ['reject'] : NULL,
				'updated_at' => date ( 'Y-m-d H:i:s' ),
				'updated_by' => $data ['userid'] 
		);
		
		$this->db->where ( 'id', $data ['id'] );
		$query = $this->db->update ( 'chat', $values );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		$values ['id'] = $data ['id'];
		return $values;
	}
	function backup($input) {
		if (! array_key_exists ( 'id', $input ) || empty ( $input ['id'] )) {
			throw new Exception ( "id is a required field", 1001 );
		}
		
		$this->db->where ( 'id', $input ['id'] );
		$query = $this->db->get ( 'history' );
		$data = $query->result_array ();
		
		$content = '';
		if ((array_key_exists ( 'content', $input ) && ! empty ( $input ['content'] ))) {
			$content = json_encode ( $input ['content'] );
		}
		
		$values = array (
				'id' => (array_key_exists ( 'id', $input ) && ! empty ( $input ['id'] )) ? ( int ) $input ['id'] : NULL,
				'roomid' => (array_key_exists ( 'roomid', $input ) && ! empty ( $input ['roomid'] )) ? $input ['roomid'] : NULL,
				'content' => $content,
				'created_at' => date ( 'Y-m-d H:i:s' ),
				'created_by' => $input ['userid'],
				'updated_at' => date ( 'Y-m-d H:i:s' ),
				'updated_by' => $input ['userid'] 
		);
		
		if ($input ['gender'] == 'woman') {
			$values ['reserve'] = (array_key_exists ( 'reserve', $input ) && ! empty ( $input ['reserve'] )) ? ( int ) $input ['reserve'] : NULL;
		}
		
		if (count ( $data ) > 0) {
			$this->db->where ( 'id', $input ['id'] );
			$query = $this->db->update ( 'history', $values );
		} else {
			$query = $this->db->insert ( 'history', $values );
			$this->db->insert_id ();
		}
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		
		if ((array_key_exists ( 'send', $input ) && ! empty ( $input ['send'] ))) {
			$values0 = array (
					'userid' => $input ['userid'],
					'point' => $input ['send'],
					'updated_at' => date ( 'Y-m-d H:i:s' ),
					'updated_by' => $input ['userid'] 
			);
			$this->load->model ( 'usera_model' );
			$result1 = $this->usera_model->changePoint ( $values0, 'minus' );
			$values ['point'] = $result1 ['point'];
		}
		
		if ($input ['gender'] == 'man') {
			$values1 = array (
					'userid' => $input ['target'],
					'point' => $input ['send'],
					'updated_at' => date ( 'Y-m-d H:i:s' ),
					'updated_by' => $input ['userid'] 
			);
			$this->load->model ( 'usera_model' );
			$result2 = $this->usera_model->changePoint ( $values1, 'plus' );
		}
		return $values;
	}
	function restore($roomid) {
		$sql = "SELECT A.id, A.roomid, A.content, A.created_at, A.created_by";
		$sql = $sql . " FROM tzchat.history A, tzchat.chat B";
		$sql = $sql . " WHERE A.roomid = '" . $roomid . "'";
		$sql = $sql . " AND B.status != 'closed' AND B.status != 'reject'";
		$sql = $sql . " AND A.id = B.id";
		$sql = $sql . " ORDER BY A.created_at DESC limit 1";
		$query = $this->db->query ( $sql );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		$return = array ();
		foreach ( $query->result_array () as $row ) {
			$return = $row;
		}
		return $return;
	}
}
?>