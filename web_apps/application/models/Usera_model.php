<?php
class Usera_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function get($params) {
		$sql = "SELECT * FROM tzchat.user ";
		if (! empty ( $params )) {
			$sql = $sql . " WHERE ";
		}
		if (array_key_exists ( 'userid', $params )) {
			$userid = $params ['userid'];
			$sql = $sql . " userid = '" . $userid . "'";
		}
		if (array_key_exists ( 'nickname', $params )) {
			$nickname = $params ['nickname'];
			$sql = $sql . " nickname = '" . $nickname . "'";
		}
		if (array_key_exists ( 'passwd', $params )) {
			$passwd = $params ['passwd'];
			$sql = $sql . " AND passwd = '" . $passwd . "'";
		}
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
	function userlist($userids) {
		$input = "";
		for($i = 0; $i < count ( $userids ); $i ++) {
			$input = $input . ",'" . $userids [$i] . "'";
		}
		$input = substr ( $input, 1, strlen ( $input ) );
		$sql = "SELECT * FROM tzchat.user WHERE userid in (" . $input . ")";
		$query = $this->db->query ( $sql );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		return $query->result_array ();
	}
	function getwaitlist() {
		$req_url = "http://192.168.82.1:3000/talklist";
		$ch = curl_init ();
		
		// Get request
		curl_setopt ( $ch, CURLOPT_URL, $req_url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		
		// // Post request
		// $req_url2 = substr ( $req_url, 0, strpos ( $req_url, '?' ) );
		// $post_params = substr ( $req_url, strpos ( $req_url, '?' ) + 1, strlen ( $req_url ) );
		// curl_setopt ( $ch, CURLOPT_URL, $req_url2 );
		// curl_setopt ( $ch, CURLOPT_POST, 1 );
		// curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_params );
		// curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		
		$raw_response = curl_exec ( $ch );
		curl_close ( $ch );
		return $raw_response;
	}
	function add($data) {
		if (! array_key_exists ( 'userid', $data ) || empty ( $data ['userid'] )) {
			throw new Exception ( "userid is a required field", 1001 );
		}
		
		if (array_key_exists ( 'gender', $data )) {
			$gender = $data ['gender'];
			if ($gender == 'man') {
				$data ['main'] = "images/user-men.png";
			} else {
				$data ['main'] = "images/user-women.png";
			}
		}
		
		$values = array (
				'userid' => $data ['userid'],
				'passwd' => $data ['passwd'],
				// 'passwd' => md5 ( $data ['passwd'] ),
				'nickname' => (array_key_exists ( 'nickname', $data ) && ! empty ( $data ['nickname'] )) ? $data ['nickname'] : NULL,
				'gender' => (array_key_exists ( 'gender', $data ) && ! empty ( $data ['gender'] )) ? $data ['gender'] : NULL,
				'age' => (array_key_exists ( 'age', $data ) && ! empty ( $data ['age'] )) ? ( int ) $data ['age'] : NULL,
				'email' => (array_key_exists ( 'email', $data ) && ! empty ( $data ['email'] )) ? $data ['email'] : NULL,
				'region1' => (array_key_exists ( 'region1', $data ) && ! empty ( $data ['region1'] )) ? $data ['region1'] : NULL,
				'region2' => (array_key_exists ( 'region2', $data ) && ! empty ( $data ['region2'] )) ? $data ['region2'] : NULL,
				'meeting_type' => (array_key_exists ( 'meeting_type', $data ) && ! empty ( $data ['meeting_type'] )) ? $data ['meeting_type'] : NULL,
				'talk_style' => (array_key_exists ( 'talk_style', $data ) && ! empty ( $data ['talk_style'] )) ? $data ['talk_style'] : NULL,
				'main' => (array_key_exists ( 'main', $data ) && ! empty ( $data ['main'] )) ? $data ['main'] : NULL,
				'created_at' => date ( 'Y-m-d H:i:s' ),
				'created_by' => $data ['userid'],
				'updated_at' => date ( 'Y-m-d H:i:s' ),
				'updated_by' => $data ['userid'] 
		);
		
		$query = $this->db->insert ( 'user', $values );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		
		$values ['id'] = $this->db->insert_id ();
		return $values;
	}
	function update($data) {
		if (! array_key_exists ( 'userid', $data ) || empty ( $data ['userid'] )) {
			throw new Exception ( "userid is a required field", 1001 );
		}
		
		$allcols = array (
				'id',
				'userid',
				'passwd',
				'nickname',
				'gender',
				'age',
				'email',
				'region1',
				'region2',
				'meeting_type',
				'talk_style',
				'parttime',
				'agreement',
				'privacy',
				'main',
				'sub1',
				'sub2',
				'sub3',
				'keyword',
				'height',
				'weight',
				'blood',
				'scholar',
				'job',
				'favorite',
				'ideal',
				'phone_no',
				'phone_confirm',
				'sms',
				'message',
				'point',
				'ticket_type',
				'ticket_expired',
				'partner_yn',
				'partner_id' 
		);
		
		$values = array (
				'userid' => $data ['userid'] 
		);
		
		$data_keys = array_keys ( $allcols );
		foreach ( array_keys ( $allcols ) as $i ) {
			$key = $allcols [$i];
			if (array_key_exists ( $key, $data ) || ! empty ( $data [$key] )) {
				$values [$key] = $data [$key];
			}
		}
		
		$values ['updated_at'] = date ( 'Y-m-d H:i:s' );
		$values ['updated_by'] = $data ['userid'];
		
		$this->db->where ( 'userid', $data ['userid'] );
		$query = $this->db->update ( 'user', $values );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		return $values;
	}
	function changePasswd($data) {
		if (! array_key_exists ( 'id', $data ) || empty ( $data ['id'] )) {
			throw new Exception ( "id is a required field", 1001 );
		}
		$data ['passwd'] = $data ['passwd1'];
		
		$values = array (
				'passwd' => $data ['passwd'] 
		);
		// 'passwd' => md5 ( $data ['passwd'] ),
		$this->db->where ( 'id', $data ['id'] );
		$query = $this->db->update ( 'user', $values );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		return $values;
	}
	function getData($params) {
		$from_at = '';
		$to_at = '';
		if (array_key_exists ( 'from_at', $params ) || ! empty ( $params ['from_at'] )) {
			$from_at = $params ['from_at'];
		}
		if (array_key_exists ( 'to_at', $params ) || ! empty ( $params ['to_at'] )) {
			$to_at = $params ['to_at'];
		}
		
		$sql = "SELECT * FROM tzchat.user A";
		if ($from_at != null) {
			$sql = $sql . " WHERE A.created_at BETWEEN '" . $from_at . " 00:00:00' AND '" . $to_at . " 23:59:59'";
		}
		// if ($limit) {
		// $sql .= " LIMIT $limit";
		// }
		$query = $this->db->query ( $sql );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		return $query->result_array ();
	}
	function updatePoint($data) {
		if (! array_key_exists ( 'userid', $data ) || empty ( $data ['userid'] )) {
			throw new Exception ( "userid is a required field", 1001 );
		}
		
		if (array_key_exists ( 'ticket_type', $data )) {
			$this->load->model ( 'ticket_model' );
			$result1 = $this->ticket_model->get ( array (
					'ticket_type' => $data ['ticket_type'] 
			) );
			$data ['point'] = $result1 ['point'];
			
			$user = $this->usera_model->get ( $data );
			$point = $user ['point'];
			$point = $data ['point'] + $point;
			$data ['point'] = $point;
			
			$period = $result1 ['period'];
			$date = new DateTime ();
			date_add ( $date, date_interval_create_from_date_string ( $period . ' days' ) );
			$data ['ticket_expired'] = date_format ( $date, 'Y-m-d H:i:s' );
		}
		unset ( $data ['charge'] );
		$this->db->where ( 'userid', $data ['userid'] );
		$query = $this->db->update ( 'user', $data );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		return $data;
	}
	function changePoint($data, $type) {
		if (! array_key_exists ( 'userid', $data ) || empty ( $data ['userid'] )) {
			throw new Exception ( "userid is a required field", 1001 );
		}
		
		$user = $this->get ( array (
				'userid' => $data ['userid'] 
		) );
		$ori_point = $user ['point'];
		if ($type == 'plus') {
			$point = $ori_point + $data ['point'];
		} else if ($type == 'minus') {
			$point = $ori_point - $data ['point'];
		}
		$data ['point'] = $point;
		
		$this->db->where ( 'userid', $data ['userid'] );
		$query = $this->db->update ( 'user', $data );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		return $data;
	}
}
?>