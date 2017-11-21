<?php  
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Layout
    {

        var $obj;
        var $layout;

        function __construct()
        {
            $this->obj =& get_instance();
            $this->layout = 'layouts/layout';
            $this->title = 'Painel Administrativo';
            $this->css = array();
            $this->js = array();
        }

        function definirLayout($layout)
        {
          $this->layout = $layout;
        }
        
        function definirTitulo($title)
        {
            $this->title = $title;
            return $title;
        }
        
        function adicionarCSS($css)
        {
            foreach($css AS $item){
                $this->css[] =  base_url() . 'assets/' . $item;
            }
        }

        function adicionarJS($js)
        {
            foreach($js AS $item){
                $this->js[] =  base_url() . 'assets/' . $item;
            }
        }
        function view($view, $data=null, $return=false)
        {
            $loadedData = array();
            
            $loadedData['conteudo'] = $this->obj->load->view($view,$data,true);
            $loadedData['titulo'] = $this->title;
            $loadedData['js'] = $this->js;
            $loadedData['css'] = $this->css;

            if($return)
            {
                $output = $this->obj->load->view($this->layout, $loadedData, true);
                return $output;
            }
            else
            {
                $this->obj->load->view($this->layout, $loadedData, false);
            }
        }
    }
?>