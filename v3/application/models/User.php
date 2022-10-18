<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model{
    function __construct() {
        $this->tblName = 'users';
    }
	
	/*
     * Returns rows from the database based on the conditions
     * @param array filter data based on the passed parameters
     */
    public function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->tblName);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
			$query = $this->db->get();
            $result = $query->row_array();
		}else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('created', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
	/*
     * Insert user data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            if(!array_key_exists("created", $data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Insert member data
            $insert = $this->db->insert($this->tblName, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update user data into the database
     * @param $data array to be update based on the passed parameters
     * @param $id num filter data
     */
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            // Add modified date if not included
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
			
			if(is_array($id)){
				$con = $id;
			}else{
				$con = array('id' => $id);
			}
            
            // Update member data
            $update = $this->db->update($this->tblName, $data, $con);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
    
    /*
     * Delete user data from the database
     * @param num filter data based on the passed parameter
     */
    public function delete($id){
        // Delete member data
        $delete = $this->db->delete($this->tblName, array('id' => $id));
        
        // Return the status
        return $delete?true:false;
    }
}