<?php
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');  // Carrega o modelo para interagir com a tabela users
    }

    // Exibe a tela de login
    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('lancamentos');  // Se já estiver logado, redireciona para o lancamentos
        }

        $this->load->view('auth/login');
    }

    // Processa o login
    public function do_login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Busca o usuário pelo email
        $user = $this->User_model->get_user_by_email($email);

        if ($user && password_verify($password, $user->password)) {
            // Se as credenciais forem corretas, cria a sessão do usuário
            $session_data = array(
                'user_id'   => $user->id,
                'username'  => $user->username,
                'email'     => $user->email,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);

            redirect('lancamentos');
        } else {
            // Login falhou
            $this->session->set_flashdata('error', 'Email ou senha inválidos.');
            redirect('auth/login');
        }
    }

    // Tela de registro de novo usuário (exemplo)
    public function register() {
        $this->load->view('auth/register');
    }

    // Processa o registro de novo usuário
    public function do_register() {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Criptografa a senha usando password_hash()
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Dados a serem salvos no banco
        $data = array(
            'username' => $username,
            'email'    => $email,
            'password' => $hashed_password  // Armazena a senha criptografada
        );

        // Salva o novo usuário no banco
        $this->User_model->insert_user($data);

        // Redireciona para a página de login após o registro
        $this->session->set_flashdata('success', 'Usuário registrado com sucesso! Faça o login.');
        redirect('auth/login');
    }

    // Processa o logout do usuário
    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        
        $this->session->set_flashdata('success', 'Você saiu do sistema.');
        redirect('auth/login');
    }
}
