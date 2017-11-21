<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends CI_Controller {

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

        $this->load->model('banner_model', 'banner');
        $post = $this->input->post();
        $ordem = $this->input->post('ordem');

        if ($post) {

            $config['upload_path'] = './assets/uploads/banners';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '9999';
            $config['max_width'] = "9999";
            $config['max_height'] = "9999";

            $this->load->library('upload', $config);
            //$this->load->library('redimensiona');

            if (!$this->upload->do_upload()) {



                $data['banners'] = $this->banner->listarTodos();
                $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';

                $this->layout->view('banner/listar_viewlistar_view', $data);
            } else {

                $imgdados = $this->upload->data();
                //print_r($imgdados);die();
                //Array ( [file_name] => prod41.png [file_type] => image/png [file_path] => /home/statusmotel/public_html/sas/uploads/ [full_path] => /home/statusmotel/public_html/sas/uploads/prod41.png [raw_name] => prod41 [orig_name] => prod4.png [client_name] => prod4.png [file_ext] => .png [file_size] => 27.2 [is_image] => 1 [image_width] => 137 [image_height] => 109 [image_type] => png [image_size_str] => width="137" height="109" )
                //$this->redimensiona->resizeImage(base_url().'sas/uploads/'.$imgdados['file_name'], 1920, 500, $imgdados['file_ext'], false, false, false);
                //$this->redimensiona->teste2(base_url().'sas/uploads/'.$imgdados['file_name'], 1920, 500);

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/banners/' . $imgdados['file_name'];
                $config['create_thumb'] = TRUE;
                $config['new_image'] = 'tumb_' . $imgdados['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['thumb_marker'] = false;
                $config['width'] = 1920;
                $config['height'] = 500;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                    die();
                }

                $data['banners'] = $this->banner->listarTodos();

                $post['img'] = $imgdados['file_name'];
                $salvarBanner = $this->banner->adicionar($post);

                redirect('/banner');
            } 
        }
        else {
            $data['banners'] = $this->banner->listarTodos();
            $data['scripts'] = 'Metronic.init(); Layout.init();Demo.init(); Index.init(); Index.initDashboardDaterange(); Index.initJQVMAP(); 
                            Index.initCalendar(); Index.initCharts(); Index.initChat(); Index.initMiniCharts(); Tasks.initDashboardWidget();';

            $this->layout->view('banner/listar_view', $data);
        }
    }

    public function ativar($id = "") {
        if (!$this->ion_auth->logged_in()) :

            redirect(site_url('login'));
        else :
            $data['usuario'] = $this->ion_auth->user()->row();
            $data['grupo'] = $this->ion_auth->get_users_groups($data['usuario']->id)->result();
        endif;

        if ($id == "") :
            redirect(site_url() . '/banner/list');
        else :
            $this->load->model('banner_model', 'banner');

            $alterarOrdem = $this->banner->ativar($id);
            redirect(site_url() . '/banner/list');
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
            redirect(site_url() . '/banner/list');
        else :
            $this->load->model('banner_model', 'banner');

            $alterarOrdem = $this->banner->desativar($id);
            redirect(site_url() . '/banner/list');
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
            redirect(site_url() . '/banner/list');
        else :
            $this->load->model('banner_model', 'banner');

            $dadosBanner = $this->banner->listar($id);
            $alterarOrdem = $this->banner->excluir($id);
            if ($alterarOrdem) :
                $this->load->helper('file');
                @unlink('./assets/uploads/banners/' . $dadosBanner->imagem);
                @unlink('./assets/uploads/banners/tumb_' . $dadosBanner->imagem);
            endif;
            redirect('/banner/list');
        endif;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
