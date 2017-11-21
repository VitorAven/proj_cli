<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Noticias extends CI_Controller {

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

        $this->load->model('noticias_model', 'noticias');



        $data['lista'] = $this->noticias->listarTodos();
        $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); 
                            Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';

        $this->layout->view('noticias/listar_view', $data);
    }

    public function adicionar() {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;
        $this->load->model('noticias_model', 'noticias');
        $post = $this->input->post();


        if ($post) {

            $config['upload_path'] = './assets/uploads/noticias';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '9999';
            $config['max_width'] = "9999";
            $config['max_height'] = "9999";

            $this->load->library('upload', $config);
            //$this->load->library('redimensiona');

            if (!$this->upload->do_upload()) {
                $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';
                $this->layout->view('noticias/adcionar_view', $data);
            } else {

                $imgdados = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/noticias/' . $imgdados['file_name'];
                $config['create_thumb'] = TRUE;
                $config['new_image'] = 'tumb_' . $imgdados['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['thumb_marker'] = false;
                $config['width'] = 360;
                $config['height'] = 360;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                    die();
                }

                $post['img'] = $imgdados['file_name'];
                $salvar = $this->noticias->adicionar($post);

                redirect('/noticia/list');
            }
        }//end if
        $this->layout->view('noticias/adicionar_view', $data);
    }

    public function editar($id) {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url("login"));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;
        $this->load->model('noticias_model', 'noticias');
        $post = $this->input->post();
        $data['item'] = $this->noticias->listar($id);

        if ($post) {
            $post['id'] = $id;
            $config['upload_path'] = './assets/uploads/noticias';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '9999';
            $config['max_width'] = "9999";
            $config['max_height'] = "9999";

            $this->load->library('upload', $config);
            //$this->load->library('redimensiona');

            if (!$this->upload->do_upload()) {
                $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';
                $salvar = $this->noticias->editar($post);
                redirect('/noticia/' . $id);
            } else {

                $this->load->helper('file');
                @unlink('./assets/uploads/noticias/' . $data['item']->capa);
                @unlink('./assets/uploads/noticias/tumb_' . $data['item']->capa);

                $imgdados = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/noticias/' . $imgdados['file_name'];
                $config['create_thumb'] = TRUE;
                $config['new_image'] = 'tumb_' . $imgdados['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['thumb_marker'] = false;
                $config['width'] = 360;
                $config['height'] = 360;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                    die();
                }

                $post['img'] = $imgdados['file_name'];
                $salvar = $this->noticias->editar($post);

                redirect('/noticia/' . $id);
            }
        }//end if

        $this->layout->view('noticias/editar_view', $data);
    }

    public function ativar($id = "") {
        if (!$this->ion_auth->logged_in()) :

            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/noticia/list');
        else :
            $this->load->model('noticias_model', 'noticias');

            $alterarOrdem = $this->noticias->ativar($id);
            redirect(site_url() . '/noticia/list');
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
            $this->load->model('noticias_model', 'noticias');

            $alterarOrdem = $this->noticias->desativar($id);
            redirect(site_url() . '/noticia/list');
        endif;
    }

    public function excluir($id = "") {
        if (!$this->ion_auth->logged_in()) :
            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/noticia/list');
        else :
            $this->load->model('noticias_model', 'noticias');

            $dadosBanner = $this->noticias->listar($id);
            $alterarOrdem = $this->noticias->excluir($id);

            $this->load->helper('file');
            @unlink('./assets/uploads/noticias/' . $dadosBanner->capa);
            @unlink('./assets/uploads/noticias/tumb_' . $dadosBanner->capa);

            redirect('/noticia/list');
        endif;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
