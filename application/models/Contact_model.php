<?phpclass Contact_model extends CI_Model {	protected $table = 'contacts';		public function get_contact_data($id = NULL)	{			$result = NULL;				$query = $this				->db				->where('contact_id', $id)				->limit(1)				->get($this->table);				if($query->num_rows() > 0)		{			$result = $query->row_array();  		}				$query->free_result();				return $result;	}		public function update_contact($id = NULL)	{			$DBdata = array(			'im_value' => $this->input->post('im_value', TRUE),			'active' => (($this->input->post('active', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),			'updated_by' => $this->session->userdata('username'),			'updated_date' => time()		);				$this->db->where('contact_id', $id);		$this->db->limit(1);		$this->db->update($this->table, $DBdata);				$DBdata['contact_id'] = $id;				return $DBdata;	}}