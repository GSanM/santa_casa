<?php

Class LoginDatabaseMedico_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Read data using username and password
    public function login($data) {
        $condition = "usuario =" . "'" . $data['usuario'] . "' AND " . "senha =" . "'" . $data['senha'] . "'";
        $this->db->select('*');
        $this->db->from('medico');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    // Read data from database to show data in admin page
    public function read_user_information($username) {

        $condition = "usuario =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}

?>