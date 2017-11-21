<?php

class Banner_model extends CI_Model {

    function listarTodos() {
        unset($query);

        $query = $this->db->get('banners')->result_array();

        return $query;
    }

    function listar($usuario) {
        unset($query);

        $this->db->where('id', $usuario);
        $query = $this->db->get('banners')->row();

        return $query;
    }

    function adicionar($dados) {
        unset($query);

        $info = array(
            'nome' => $dados['nome'],
            'url' => $dados['url'],
            'img' => $dados['img'],
            'desc' => $dados['desc'],
            'ativo' => '1'
        );
        $query = $this->db->insert('banners', $dados);

        return $query;
    }

    function alterar($id, $ordem) {
        unset($query);

        $dados = array(
            'ordem' => $ordem
        );
        $this->db->where('id', $id);
        $query = $this->db->update('banners', $dados);

        return $query;
    }

    function desativar($id) {
        unset($query);

        $dados = array(
            'ativo' => '0'
        );

        $this->db->where('id', $id);
        $query = $this->db->update('banners', $dados);

        return $query;
    }

    function ativar($id) {
        unset($query);

        $dados = array(
            'ativo' => '1'
        );

        $this->db->where('id', $id);
        $query = $this->db->update('banners', $dados);

        return $query;
    }

    function excluir($id) {
        unset($query);

        $this->db->where('id', $id);
        $query = $this->db->delete('banners');

        return $query;
    }

}

?>