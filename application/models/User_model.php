<?php
class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Busca o usuário pelo email
    public function get_user_by_email($email) {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row();  // Retorna uma única linha (usuário)
    }

    // Insere um novo usuário no banco de dados
    public function insert_user($data) {
        return $this->db->insert('users', $data);  // Insere os dados do usuário
    }
}
