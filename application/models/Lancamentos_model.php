<?php

class Lancamentos_model extends CI_Model {

    public function insert($dados) {
        $this->db->insert('lancamentos', $dados);
    }

    public function update($id, $dados) {
        $this->db->where('id', $id);
        $this->db->update('lancamentos', $dados);
    }

    public function get($id) {
        $this->db->where('id', $id);
        return $this->db->get('lancamentos')->row();
    }

    public function soft_delete($id) {
        $this->db->where('id', $id);
        $this->db->update('lancamentos', ['deletado' => 1]);
    }

    // Método para calcular o total de entradas
    public function get_total_entradas() {
        $this->db->select_sum('valor');
        $this->db->where('tipo', 'entrada');
        $this->db->where('deletado', 0);
        return $this->db->get('lancamentos')->row()->valor; // Retorna o total
    }

    // Método para calcular o total de saídas
    public function get_total_saidas() {
        $this->db->select_sum('valor');
        $this->db->where('tipo', 'saida');
        $this->db->where('deletado', 0);
        return $this->db->get('lancamentos')->row()->valor; // Retorna o total
    }

    // Método para calcular o total de entradas futuras
    public function get_total_entradas_futuras() {
        $this->db->select_sum('valor');
        $this->db->where('tipo', 'entrada');
        $this->db->where('deletado', 0);
        $this->db->where('data_vencimento >=', date('Y-m-d')); // Considera apenas entradas a vencer
        return $this->db->get('lancamentos')->row()->valor; // Retorna o total
    }

    // Método para calcular o total de saídas futuras
    public function get_total_saidas_futuras() {
        $this->db->select_sum('valor');
        $this->db->where('tipo', 'saida');
        $this->db->where('deletado', 0);
        $this->db->where('data_vencimento >=', date('Y-m-d')); // Considera apenas saídas a vencer
        return $this->db->get('lancamentos')->row()->valor; // Retorna o total
    }}
