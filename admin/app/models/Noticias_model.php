<?php

class Noticias_model extends CI_Model {

    function listarTodos() {
        unset($query);

        $query = $this->db->get('noticias')->result_array();

        return $query;
    }

    function listar($id) {
        unset($query);

        $this->db->where('id', $id);
        $query = $this->db->get('noticias')->row();

        return $query;
    }

    function adicionar($post) {
        unset($query);

         if (!isset($post['ativo'])) {
            $post['ativo'] = 0;
        }

        $dados = array(
            'titulo' => $post['titulo'],
            'sub' => $post['subtitulo'],
            'desc' => $post['texto'],
            'capa' => $post['img'],
            'ativo' => $post['ativo']
        );
        $query = $this->db->insert('noticias', $dados);

        return $query;
    }

    function editar($post) {
        unset($query);
        $id = $post['id'];
        
        if (!isset($post['ativo'])) {
            $post['ativo'] = 0;
        }
        if (isset($post['img'])) {
            $dados = array(
                'titulo' => $post['titulo'],
                'sub' => $post['subtitulo'],
                'desc' => $post['texto'],
                'capa' => $post['img'],
                'ativo' => $post['ativo']
            );
        }
        if (!isset($post['img'])) {
            $dados = array(
                'titulo' => $post['titulo'],
                'sub' => $post['subtitulo'],
                'desc' => $post['texto'],
                'ativo' => $post['ativo']
            );
        }




        $this->db->where('id', $id);
        $query = $this->db->update('noticias', $dados);

        return $query;
    }

    function desativar($id) {
        unset($query);

        $dados = array(
            'ativo' => '0'
        );

        $this->db->where('id', $id);
        $query = $this->db->update('noticias', $dados);

        return $query;
    }

    function ativar($id) {
        unset($query);

        $dados = array(
            'ativo' => '1'
        );

        $this->db->where('id', $id);
        $query = $this->db->update('noticias', $dados);

        return $query;
    }

    function excluir($id) {
        unset($query);

        $this->db->where('id', $id);
        $query = $this->db->delete('noticias');

        return $query;
    }

}

?>