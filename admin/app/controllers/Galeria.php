<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galeria extends CI_Controller {

    /**
     * @author Vitor Hugo Bassetto <vitorhugobassetto@gmail.com>
     */
    public function index() {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        $this->load->model('galeria_model', 'galeria');



        $data['lista'] = $this->galeria->listarTodos();
        $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); 
                            Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';

        $this->layout->view('galeria/listar_view', $data);
    }

    public function adicionar() {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;
        $this->load->model('galeria_model', 'galeria');
        $post = $this->input->post();


        if ($post) {

            $config['upload_path'] = './assets/uploads/galeria';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '9999';
            $config['max_width'] = "9999";
            $config['max_height'] = "9999";

            $this->load->library('upload', $config);
            //$this->load->library('redimensiona');

            if (!$this->upload->do_upload()) {
                $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';
                $this->layout->view('galeria/adcionar_view', $data);
            } else {

                $imgdados = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/galeria/' . $imgdados['file_name'];
                $config['create_thumb'] = TRUE;
                $config['new_image'] = 'tumb_' . $imgdados['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['thumb_marker'] = false;
                $config['width'] = 263;
                $config['height'] = 189;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                    die();
                }

                $post['img'] = $imgdados['file_name'];
                $salvar = $this->galeria->adicionar($post);

                redirect('/galeria/list');
            }
        }//end if
        $this->layout->view('galeria/adicionar_view', $data);
    }

    public function editar($id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;
        $this->load->model('galeria_model', 'galeria');
        $post = $this->input->post();
        $data['item'] = $this->galeria->listar($id);

        if ($post) {
            $post['id'] = $id;
            $config['upload_path'] = './assets/uploads/galeria';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '9999';
            $config['max_width'] = "9999";
            $config['max_height'] = "9999";

            $this->load->library('upload', $config);
            //$this->load->library('redimensiona');

            if (!$this->upload->do_upload()) {
                $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';
                $salvar = $this->galeria->editar($post);
                redirect('/galeria/' . $id);
            } else {

                $this->load->helper('file');
                @unlink('./assets/uploads/galeria/' . $data['item']->capa);
                @unlink('./assets/uploads/galeria/tumb_' . $data['item']->capa);

                $imgdados = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/galeria/' . $imgdados['file_name'];
                $config['create_thumb'] = TRUE;
                $config['new_image'] = 'tumb_' . $imgdados['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['thumb_marker'] = false;
                $config['width'] = 263;
                $config['height'] = 189;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                    die();
                }

                $post['img'] = $imgdados['file_name'];
                $salvar = $this->galeria->editar($post);

                redirect('/galeria/' . $id);
            }
        }//end if

        $this->layout->view('galeria/editar_view', $data);
    }

    public function ativar($id = "") {
        if (!$this->ion_auth->logged_in()) :

            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/galeria/list');
        else :
            $this->load->model('galeria_model', 'galeria');

            $alterarOrdem = $this->galeria->ativar($id);
            redirect(site_url() . '/galeria/list');
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
            $this->load->model('galeria_model', 'galeria');

            $alterarOrdem = $this->galeria->desativar($id);
            redirect(site_url() . '/galeria/list');
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
            redirect(site_url() . '/galeria/list');
        else :
            $this->load->model('galeria_model', 'galeria');

            $dadosBanner = $this->galeria->listar($id);
            $alterarOrdem = $this->galeria->excluir($id);
           
                $this->load->helper('file');
                @unlink('./assets/uploads/galeria/' . $dadosBanner->capa);
                @unlink('./assets/uploads/galeria/tumb_' . $dadosBanner->capa);
           
            redirect('/galeria/list');
        endif;
    }

    //Imagem das galerias
    public function adicionarimagem($id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        $this->load->model('galeria_model', 'galeria');
        $post = $this->input->post();
        $data['id'] = $id;
        if ($post) {

            $config['upload_path'] = './assets/uploads/galeria';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '9999';
            $config['max_width'] = "9999";
            $config['max_height'] = "9999";

            $this->load->library('upload', $config);
            //$this->load->library('redimensiona');

            if (!$this->upload->do_upload()) {
                $data['lista'] = $this->galeria->listarTodasImg($id);
                $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';

                $this->layout->view('galeria/' . $id . '/imagens', $data);
            } else {

                $imgdados = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/galeria/' . $imgdados['file_name'];
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

                $data['lista'] = $this->galeria->listarTodasImg($id);

                $post['img'] = $imgdados['file_name'];
                $post['ativo'] = 1;
                $post['id_galeria'] = $id;
                $salvarImg = $this->galeria->adicionarImg($post);

                redirect('galeria/' . $id . '/imagens');
            }
        } else {

            $data['lista'] = $this->galeria->listarTodasImg($id);
            $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); 
                            Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';

            $this->layout->view('galeria/imagens/listar_view', $data);
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
            redirect(site_url() . '/galeria/' . $id_gal . '/imagens');
        else :
            $this->load->model('galeria_model', 'galeria');

            $alterarOrdem = $this->galeria->ativarImg($id);
            redirect(site_url() . '/galeria/' . $id_gal . '/imagens');
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
            redirect(site_url() . '/galeria/' . $id_gal . '/imagens');
        else :
            $this->load->model('galeria_model', 'galeria');

            $alterarOrdem = $this->galeria->desativarImg($id);
            redirect(site_url() . '/galeria/' . $id_gal . '/imagens');
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
            redirect(site_url() . '/galeria/' . $id_gal . '/imagens');
        else :
            $this->load->model('galeria_model', 'galeria');

            $dadosBanner = $this->galeria->listarImg($id);
            $alterarOrdem = $this->galeria->excluirImg($id);

            $this->load->helper('file');
            @unlink('./assets/uploads/galeria/' . $dadosBanner->url);
            @unlink('./assets/uploads/galeria/tumb_' . $dadosBanner->url);

            redirect(site_url() . '/galeria/' . $id_gal . '/imagens');
        endif;
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */
    