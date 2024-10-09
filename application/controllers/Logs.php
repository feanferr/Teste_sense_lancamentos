<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

    public function index() {
        $this->load->model('Log_model');
        $data['logs'] = $this->Log_model->get_logs();  // Obtém todos os logs
        $this->load->view('logs/index', $data);  // Carrega a view com os logs
    }
}
