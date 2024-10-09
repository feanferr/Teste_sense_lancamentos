<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lancamentos extends CI_Controller {
    

    public function __construct() {
    parent::__construct();
    if (!$this->session->userdata('logged_in')) {
        redirect('auth/login');
    }
}
    public function index() {
    	$this->load->model('Lancamentos_model');
        
        // Filtros de busca
        $tipo = $this->input->get('tipo');
        $data_inicio = $this->input->get('data_inicio');
        $data_fim = $this->input->get('data_fim');

	 	// Carrega os lançamentos e os totais
	    $data['total_entradas'] = $this->Lancamentos_model->get_total_entradas();
	    $data['total_saidas'] = $this->Lancamentos_model->get_total_saidas();
	    $data['total_entradas_futuras'] = $this->Lancamentos_model->get_total_entradas_futuras();
	    $data['total_saidas_futuras'] = $this->Lancamentos_model->get_total_saidas_futuras();


        $this->db->select('lancamentos.*, categorias.nome AS categoria_nome');
        $this->db->from('lancamentos');
        $this->db->join('categorias', 'categorias.id = lancamentos.categoria_id', 'left');
        $this->db->where('deletado', 0);

        if ($tipo) {
            $this->db->where('tipo', $tipo);
        }

        if ($data_inicio && $data_fim) {
            $this->db->where('data_vencimento >=', $data_inicio);
            $this->db->where('data_vencimento <=', $data_fim);
        }

        $data['lancamentos'] = $this->db->get()->result();
        $this->load->view('lancamentos/index', $data);
    }

    public function create() {
        $this->load->model('Lancamentos_model');
        
        if ($this->input->post()) {
            $dados = $this->input->post();
            $dados['usuario_criacao'] = $this->session->userdata('user_id');
            $this->Lancamentos_model->insert($dados);

		    // Registrar a ação no log
		    $this->load->model('Log_model');
		    $user_id = $this->session->userdata('user_id');  // Obtém o ID do usuário logado
		    $this->Log_model->log_action('Criar Lançamento', $user_id, json_encode($dados));
            
            redirect('lancamentos');
        }


        $data['categorias'] = $this->db->get('categorias')->result();
        $this->load->view('lancamentos/editar', $data);
    }

    public function edit($id) {
        $this->load->model('Lancamentos_model');
        
        if ($this->input->post()) {
            $dados = $this->input->post();
            $dados['usuario_edicao'] = $this->session->userdata('user_id');
            $this->Lancamentos_model->update($id, $dados);

		    // Registrar a ação no log
		    $this->load->model('Log_model');
		    $user_id = $this->session->userdata('user_id');
		    $this->Log_model->log_action('Editar Lançamento', $user_id, json_encode($dados));


            redirect('lancamentos');
        }


        $data['lancamento'] = $this->Lancamentos_model->get($id);
        $data['categorias'] = $this->db->get('categorias')->result();
        $this->load->view('lancamentos/editar', $data);
    }

    public function delete($id) {
        $this->load->model('Lancamentos_model');
        $this->Lancamentos_model->soft_delete($id);

	    // Registrar a ação no log
	    $this->load->model('Log_model');
	    $user_id = $this->session->userdata('user_id');
	    $this->Log_model->log_action('Excluir Lançamento', $user_id, json_encode(['id' => $id]));

        redirect('lancamentos');
    }
}
