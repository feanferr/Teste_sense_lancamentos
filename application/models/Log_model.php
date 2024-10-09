<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {

    public function __construct() {
        $this->load->database();  // Carrega a biblioteca de banco de dados
    }

    // Método para registrar uma ação no log
    public function log_action($action, $user_id, $details = null) {
        $data = [
            'action' => $action,
            'user_id' => $user_id,
            'details' => $details
        ];
        return $this->db->insert('logs', $data);  // Insere o log no banco de dados
    }

    // Método para obter logs (opcional)
    public function get_logs() {
        $this->db->order_by('timestamp', 'DESC');  // Ordena os logs pela data
        return $this->db->get('logs')->result();  // Retorna os logs como um array de objetos
    }
}
