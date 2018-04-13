<?php

class Paciente_model extends CI_Model {

      
    function adicionar($post) {
        unset($query);

        if (!$post['ativo']) {
            $post['ativo'] = 0;
        }
       

        $dados = array(
            'nome' => $post['nome'],
            'capa' => $post['img'],
            'ativo' => $post['ativo']
        );
        $query = $this->db->insert('galeria', $dados);

        return $query;
    }
    function adicionarImg($post) {
        unset($query);

        if (!$post['ativo']) {
            $post['ativo'] = 0;
        }

        $dados = array(
            'nome' => $post['nome'],
            'url' => $post['img'],
            'id_galeria' => $post['id_galeria'],
            'ativo' => $post['ativo']
        );
        $query = $this->db->insert('imagens', $dados);

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
                'nome' => $post['nome'],
                'capa' => $post['img'],
                'ativo' => $post['ativo']
            );
        }
        if (!isset($post['img'])) {
            $dados = array(
                'nome' => $post['nome'],
                'ativo' => $post['ativo']
            );
        }




        $this->db->where('id', $id);
        $query = $this->db->update('galeria', $dados);

        return $query;
    }

    function desativar($id) {
        unset($query);

        $dados = array(
            'ativo' => '0'
        );

        $this->db->where('id', $id);
        $query = $this->db->update('galeria', $dados);

        return $query;
    }

    function ativar($id) {
        unset($query);

        $dados = array(
            'ativo' => '1'
        );

        $this->db->where('id', $id);
        $query = $this->db->update('galeria', $dados);

        return $query;
    }

    function excluir($id) {
        unset($query);

        $this->db->where('id', $id);
        $query = $this->db->delete('galeria');

        return $query;
    }
    
    
    function desativarImg($id) {
        unset($query);

        $dados = array(
            'ativo' => '0'
        );

        $this->db->where('id', $id);
        $query = $this->db->update('imagens', $dados);

        return $query;
    }

    function ativarImg($id) {
        unset($query);

        $dados = array(
            'ativo' => '1'
        );

        $this->db->where('id', $id);
        $query = $this->db->update('imagens', $dados);

        return $query;
    }

    function excluirImg($id) {
        unset($query);

        $this->db->where('id', $id);
        $query = $this->db->delete('imagens');

        return $query;
    }

}

?>