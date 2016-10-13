<?php
class Pay_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function get($params) {
		$sql = "SELECT * FROM tzchat.pay ";
		if (! empty ( $params )) {
			$sql = $sql . " WHERE ";
		}
		if (array_key_exists ( 'id', $params )) {
			$id = $params ['id'];
			$sql = $sql . " id = '" . $id . "'";
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
	function paylist($params) {
		$from_at = $params ['from_at'];
		$to_at = $params ['to_at'];
		
		$sql = "SELECT A.id, B.userid, B.nickname, B.gender, A.pay_type, A.item_type, A.ticket_type, A.status,";
		$sql = $sql . " A.point, A.partner_yn, A.partner_id, A.created_at, A.created_by, A.created_ip AS paid_ip, B.created_ip";
		$sql = $sql . " FROM tzchat.pay A, tzchat.user B";
		$sql = $sql . " WHERE A.created_by = B.userid";
		$sql = $sql . " AND A.created_at BETWEEN '" . $from_at . " 00:00:00' AND '" . $to_at . " 23:59:59'";
		
		$query = $this->db->query ( $sql );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		return $query->result_array ();
	}
	function paystats($params) {
		$from_at = $params ['from_at'];
		$to_at = $params ['to_at'];
		$where = " AND created_at BETWEEN '" . $from_at . " 00:00:00' AND '" . $to_at . " 23:59:59'";
		
		$sql = "SELECT A.created_at, SUM(A.card) AS card, SUM(A.phone) AS phone, SUM(A.bank) AS bank, 0 AS partner_proceeds, 0 AS partner_missing, 0 AS total_payment, 0 AS net_income";
		$sql = $sql . " FROM (";
		$sql = $sql . " SELECT DATE(created_at) AS created_at, point AS card, 0 AS phone, 0 AS bank";
		$sql = $sql . " FROM tzchat.pay";
		$sql = $sql . " WHERE pay_type = 'Credit Card'";
		$sql = $sql . $where;
		$sql = $sql . " UNION ALL";
		$sql = $sql . " SELECT DATE(created_at) AS created_at, 0 AS card, point AS phone, 0 AS bank";
		$sql = $sql . " FROM tzchat.pay";
		$sql = $sql . " WHERE pay_type = 'Phone Pay'";
		$sql = $sql . $where;
		$sql = $sql . " UNION ALL";
		$sql = $sql . " SELECT DATE(created_at) AS created_at, 0 AS card, 0 AS phone, point AS bank";
		$sql = $sql . " FROM tzchat.pay";
		$sql = $sql . " WHERE pay_type = 'Transfer Money'";
		$sql = $sql . $where;
		$sql = $sql . " ) A";
		$sql = $sql . " GROUP BY A.created_at";
		
		$query = $this->db->query ( $sql );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		$result = $query->result_array ();
		return $result;
	}
	function add($data) {
		$result1 = array ();
		
		if (array_key_exists ( 'item_type', $data ) && strrpos ( $data ['item_type'], "정기권" ) > - 1) {
			if (array_key_exists ( 'ticket_type', $data )) {
				$this->load->model ( 'ticket_model' );
				$result1 = $this->ticket_model->get ( array (
						'ticket_type' => $data ['ticket_type'] 
				) );
				$data ['point'] = $result1 ['point'];
			}
		}
		
		if (array_key_exists ( 'point', $data )) {
			$this->load->model ( 'user_model' );
			$user = $this->user_model->get ( $data );
			$point = $user ['point'];
			$point = $data ['point'] + $point;
			$data ['point'] = $point;
			
			if (array_key_exists ( 'period', $result1 )) {
				$period = $result1 ['period'];
				$date = new DateTime ();
				date_add ( $date, date_interval_create_from_date_string ( $period . ' days' ) );
				$data ['ticket_expired'] = date_format ( $date, 'Y-m-d H:i:s' );
			}
			
			$query = $this->user_model->updatePoint ( $data );
			if (false === $query) {
				$error = $this->db->error ();
				throw new Exception ( $error ['message'], 500 );
			}
			$data ['point'] = $query ['point'];
		}
		
		$values = array (
				'pay_type' => (array_key_exists ( 'pay_type', $data ) && ! empty ( $data ['pay_type'] )) ? $data ['pay_type'] : NULL,
				'item_type' => (array_key_exists ( 'item_type', $data ) && ! empty ( $data ['item_type'] )) ? $data ['item_type'] : NULL,
				'ticket_type' => (array_key_exists ( 'ticket_type', $data ) && ! empty ( $data ['ticket_type'] )) ? $data ['ticket_type'] : NULL,
				'ticket_expired' => (array_key_exists ( 'ticket_expired', $data ) && ! empty ( $data ['ticket_expired'] )) ? $data ['ticket_expired'] : NULL,
				'point' => (array_key_exists ( 'point', $data ) && ! empty ( $data ['point'] )) ? ( int ) $data ['point'] : NULL,
				'status' => (array_key_exists ( 'status', $data ) && ! empty ( $data ['status'] )) ? $data ['status'] : NULL,
				'partner_yn' => (array_key_exists ( 'partner_yn', $data ) && ! empty ( $data ['partner_yn'] )) ? $data ['partner_yn'] : NULL,
				'partner_id' => (array_key_exists ( 'partner_id', $data ) && ! empty ( $data ['partner_id'] )) ? $data ['partner_id'] : NULL,
				'created_at' => date ( 'Y-m-d H:i:s' ),
				'created_ip' => $_SERVER ['REMOTE_ADDR'],
				'created_by' => $data ['userid'] 
		);
		
		$query = $this->db->insert ( 'pay', $values );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		$values ['id'] = $this->db->insert_id ();
		return $values;
	}
	function update($data) {
		if (! array_key_exists ( 'id', $data ) || empty ( $data ['id'] )) {
			throw new Exception ( "id is a required field", 1001 );
		}
		
		$allcols = array (
				'pay_type',
				'item_type',
				'ticket_type',
				'point',
				'status',
				'ticket_expired',
				'partner_yn',
				'partner_id'
		);
		
		$values = array (
				'id' => $data ['id'] 
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
		
		$this->db->where ( 'id', $data ['id'] );
		$query = $this->db->update ( 'pay', $values );
		if (false === $query) {
			$error = $this->db->error ();
			throw new Exception ( $error ['message'], 500 );
		}
		return $values;
	}
}
?>