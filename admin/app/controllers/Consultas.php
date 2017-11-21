<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consultas extends CI_Controller {

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

        $this->load->model('consulta_model', 'consulta');



        $data['lista'] = $this->consulta->listarTodosConsultas();

        $this->layout->view('consulta/listar_view', $data);
    }

    public function adicionar() {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        $this->load->model('consulta_model', 'consulta');
        $this->load->model('pessoa_model', 'pessoa');


        $data["paciente"] = $this->pessoa->listarTodosPacientes();
        $data["medico"] = $this->pessoa->listarTodosMedicos();

        $post = $this->input->post();
        if ($post) {
            



            $salvar = $this->consulta->adicionar_consulta($post);


            redirect('/consulta/list');
        }//end if
        $this->layout->view('consulta/adicionar_view', $data);
    }

    public function editar($id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        $this->load->model('consulta_model', 'consulta');
        $post = $this->input->post();

        $data['item'] = $this->consulta->listar_consulta($id);
        //print_r($data['item']);die();

        if ($post) {
            $post['id'] = $id;
            $salvar = $this->consulta->editar($post);

            redirect('/consulta/' . $id);
        }//end if

        $this->layout->view('consulta/editar_view', $data);
    }

    public function ativar($id = "") {
        if (!$this->ion_auth->logged_in()) :

            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/consulta/list');
        else :
            $this->load->model('consulta_model', 'consulta');

            $alterarOrdem = $this->consulta->ativar($id);
            redirect(site_url() . '/consulta/list');
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
            $this->load->model('consulta_model', 'consulta');

            $alterarOrdem = $this->consulta->desativar($id);
            redirect(site_url() . '/consulta/list');
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
            redirect(site_url() . '/consulta/list');
        else :
            $this->load->model('consulta_model', 'consulta');

            $alterarOrdem = $this->consulta->excluir($id);

            redirect('/consulta/list');
        endif;
    }

    //Imagem das consultas
    public function adicionarimagem($id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        $this->load->model('consulta_model', 'consulta');
        $post = $this->input->post();
        $data['id'] = $id;
        if ($post) {

            $config['upload_path'] = './assets/uploads/consulta';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '9999';
            $config['max_width'] = "9999";
            $config['max_height'] = "9999";

            $this->load->library('upload', $config);
            //$this->load->library('redimensiona');

            if (!$this->upload->do_upload()) {
                $data['lista'] = $this->consulta->listarTodasImg($id);
                $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';

                $this->layout->view('consulta/' . $id . '/imagens', $data);
            } else {

                $imgdados = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/consulta/' . $imgdados['file_name'];
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

                $data['lista'] = $this->consulta->listarTodasImg($id);

                $post['img'] = $imgdados['file_name'];
                $post['ativo'] = 1;
                $post['id_consulta'] = $id;
                $salvarImg = $this->consulta->adicionarImg($post);

                redirect('consulta/' . $id . '/imagens');
            }
        } else {

            $data['lista'] = $this->consulta->listarTodasImg($id);
            $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); 
                            Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';

            $this->layout->view('consulta/imagens/listar_view', $data);
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
            redirect(site_url() . '/consulta/' . $id_gal . '/imagens');
        else :
            $this->load->model('consulta_model', 'consulta');

            $alterarOrdem = $this->consulta->ativarImg($id);
            redirect(site_url() . '/consulta/' . $id_gal . '/imagens');
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
            redirect(site_url() . '/consulta/' . $id_gal . '/imagens');
        else :
            $this->load->model('consulta_model', 'consulta');

            $alterarOrdem = $this->consulta->desativarImg($id);
            redirect(site_url() . '/consulta/' . $id_gal . '/imagens');
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
            redirect(site_url() . '/consulta/' . $id_gal . '/imagens');
        else :
            $this->load->model('consulta_model', 'consulta');

            $dadosBanner = $this->consulta->listarImg($id);
            $alterarOrdem = $this->consulta->excluirImg($id);

            $this->load->helper('file');
            @unlink('./assets/uploads/consulta/' . $dadosBanner->url);
            @unlink('./assets/uploads/consulta/tumb_' . $dadosBanner->url);

            redirect(site_url() . '/consulta/' . $id_gal . '/imagens');
        endif;
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */
    