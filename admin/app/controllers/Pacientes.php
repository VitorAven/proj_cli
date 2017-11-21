<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pacientes extends CI_Controller {

    /**
     * @author Vitor Hugo Bassetto <vitorhugobassetto@gmail.com>
     * 
     */
    public function index() {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        $this->load->model('pessoa_model', 'pessoa');



        $data['lista'] = $this->pessoa->listarTodosPacientes();

        $this->layout->view('paciente/listar_view', $data);
    }

    public function adicionar() {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;
        $this->load->model('pessoa_model', 'pessoa');
        $post = $this->input->post();


        if ($post) {
            $salvar = $this->pessoa->adicionar_paciente($post);

            redirect('/paciente/list');
        }//end if
        $this->layout->view('paciente/adicionar_view', $data);
    }

    public function editar($id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;
        
        $this->load->model('pessoa_model', 'pessoa');
        $post = $this->input->post();
       
        $data['item'] = $this->pessoa->listar_paciente($id);
        //print_r($data['item']);die();
        
        if ($post) {
             $post['id']= $id;
            $salvar = $this->pessoa->editar($post);

            redirect('/paciente/' . $id);
        }//end if

        $this->layout->view('paciente/editar_view', $data);
    }

    public function ativar($id = "") {
        if (!$this->ion_auth->logged_in()) :

            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/paciente/list');
        else :
            $this->load->model('paciente_model', 'paciente');

            $alterarOrdem = $this->paciente->ativar($id);
            redirect(site_url() . '/paciente/list');
        endif;
    }

    public function desativar($id = "") {
        if (!$this->ion_auth->logged_in()) :

            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/noticia/list');
        else :
            $this->load->model('paciente_model', 'paciente');

            $alterarOrdem = $this->paciente->desativar($id);
            redirect(site_url() . '/paciente/list');
        endif;
    }

    public function excluir($id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/paciente/list');
        else :
            $this->load->model('pessoa_model', 'pessoa');

            $alterarOrdem = $this->pessoa->excluir($id);

            redirect('/paciente/list');
        endif;
    }

    //Imagem das pacientes
    public function adicionarimagem($id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        $this->load->model('paciente_model', 'paciente');
        $post = $this->input->post();
        $data['id'] = $id;
        if ($post) {

            $config['upload_path'] = './assets/uploads/paciente';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '9999';
            $config['max_width'] = "9999";
            $config['max_height'] = "9999";

            $this->load->library('upload', $config);
            //$this->load->library('redimensiona');

            if (!$this->upload->do_upload()) {
                $data['lista'] = $this->paciente->listarTodasImg($id);
                $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';

                $this->layout->view('paciente/' . $id . '/imagens', $data);
            } else {

                $imgdados = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/paciente/' . $imgdados['file_name'];
                $config['create_thumb'] = TRUE;
                $config['new_image'] = 'tumb_' . $imgdados['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['thumb_marker'] = false;
                $config['width'] = 500;
                $config['height'] = 500;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                    die();
                }

                $data['lista'] = $this->paciente->listarTodasImg($id);

                $post['img'] = $imgdados['file_name'];
                $post['ativo'] = 1;
                $post['id_paciente'] = $id;
                $salvarImg = $this->paciente->adicionarImg($post);

                redirect('paciente/' . $id . '/imagens');
            }
        } else {

            $data['lista'] = $this->paciente->listarTodasImg($id);
            $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); 
                            Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';

            $this->layout->view('paciente/imagens/listar_view', $data);
        }
    }

    public function ativarImagem($id_gal, $id) {
        if (!$this->ion_auth->logged_in()) :

            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/paciente/' . $id_gal . '/imagens');
        else :
            $this->load->model('paciente_model', 'paciente');

            $alterarOrdem = $this->paciente->ativarImg($id);
            redirect(site_url() . '/paciente/' . $id_gal . '/imagens');
        endif;
    }

    public function desativarImagem($id_gal, $id) {
        if (!$this->ion_auth->logged_in()) :

            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/paciente/' . $id_gal . '/imagens');
        else :
            $this->load->model('paciente_model', 'paciente');

            $alterarOrdem = $this->paciente->desativarImg($id);
            redirect(site_url() . '/paciente/' . $id_gal . '/imagens');
        endif;
    }

    public function excluirImagem($id_gal, $id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/paciente/' . $id_gal . '/imagens');
        else :
            $this->load->model('paciente_model', 'paciente');

            $dadosBanner = $this->paciente->listarImg($id);
            $alterarOrdem = $this->paciente->excluirImg($id);

            $this->load->helper('file');
            @unlink('./assets/uploads/paciente/' . $dadosBanner->url);
            @unlink('./assets/uploads/paciente/tumb_' . $dadosBanner->url);

            redirect(site_url() . '/paciente/' . $id_gal . '/imagens');
        endif;
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */
    