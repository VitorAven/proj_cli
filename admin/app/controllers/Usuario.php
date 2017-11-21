<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function index() {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;
        if (!$this->ion_auth->is_admin()) :
            redirect(site_url());
        endif;
        $idgrupo = 2;
        $data['transacoes'] = $this->ion_auth->users('corretor')->result();
        $this->layout->view('usuario/listar', $data);
    }

    function logout() {
        if ($this->ion_auth->logged_in()) :
            $logout = $this->ion_auth->logout();
        endif;
        redirect(site_url('login'));
    }

    function adicionar() {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;
        if (!$this->ion_auth->is_admin()) :
            redirect(site_url());
        endif;
        $username = $this->input->post('username');
        $nome = $this->input->post('first_name');
        $sobrenome = $this->input->post('last_name');
        $email = $this->input->post('email');
        $fone = $this->input->post('phone');
        $senha = $this->input->post('password');
        $senha2 = $this->input->post('password_confirm');

        if ($username && $email && $senha) :
            if ($senha != $senha2) :
                $data['mensagem'] = "As senhas não coincidem, tente novamente";
                $this->layout->view('usuario/adicionar', $data);
            else :
                $additional_data = array(
                    'first_name' => $nome,
                    'last_name' => $sobrenome,
                    'phone' => $fone
                );
                $novocorretor = $this->ion_auth->register($username, $senha, $email, $additional_data);
                if ($novocorretor) :
                    $data['mensagem'] = "Cadastro realizado com sucesso.";
                else :
                    $data['mensagem'] = "Não foi possível cadastrar. Tente novamente.";
                endif;
                $this->layout->view('usuario/adicionar', $data);
            endif;
        else :
            $this->layout->view('usuario/adicionar', $data);
        endif;
    }

    function editar($id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;
        if (!$this->ion_auth->is_admin()) :
            redirect(site_url());
        endif;
        $username = $this->input->post('username');
        $nome = $this->input->post('first_name');
        $sobrenome = $this->input->post('last_name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $fone = $this->input->post('phone');

        $data['corretor'] = $this->ion_auth->user($id)->row();
        if ($username || $email || $nome || $sobrenome || $fone) :
            $dados = array(
                'username' => $username,
                'email' => $email,
                'first_name' => $nome,
                'password' => $password,
                'last_name' => $sobrenome,
                'phone' => $fone
            );
            $novocorretor = $this->ion_auth->update($id, $dados);
            if ($novocorretor) :
                $data['mensagem'] = "Cadastro alterado com sucesso.";
            else :
                $data['mensagem'] = "Não foi possível alterar. Tente novamente.";
            endif;
            $this->layout->view('usuario/editar', $data);
        else :
            $this->layout->view('usuario/editar', $data);
        endif;
    }

    function login() {
        if ($this->ion_auth->logged_in()) :
            redirect(site_url());
        else :
            $this->title = 'FaÃ§a o Login';
            $login = $this->input->post('identity');
            $senha = $this->input->post('password');
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) :
                $this->ion_auth->clear_login_attempts($this->input->post('identity'));
                redirect(site_url());
            else :
                $this->ion_auth->increase_login_attempts($this->input->post('identity'));
                $this->layout->definirTitulo('Efetue o Login');
                $this->layout->definirLayout('layouts/login');
                $this->layout->view('login');
            endif;
        endif;
    }

    function excluir($id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;
        if (!$this->ion_auth->is_admin()) :
            redirect(site_url());
        endif;
        $this->ion_auth->delete_user($id);
        redirect(base_url() . 'usuario');
    }

}
