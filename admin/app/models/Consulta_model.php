<?php

class Consulta_model extends CI_Model {

    function listarTodosConsultas() {
        unset($query);
        $fim = date("Y-m-d", strtotime('+30 day'));
        $inicio = date("Y-m-d");

        $data = getdate();

        $this->db->select("consulta.*, medico.nome AS medico_nome, paciente.nome AS paciente_nome");
        $this->db->from("consulta");

        $this->db->join("pessoa AS medico", "medico.id = consulta.id_medico");
        $this->db->join("pessoa AS paciente", "paciente.id = consulta.id_paciente");
        $this->db->where('consulta.data <= ', $fim);
        $this->db->where('consulta.data >= ', $inicio);
        $this->db->order_by('consulta.data');
        $query = $this->db->get()->result_array();
        return $query;
    }

    function valida_consulta($post) {
        unset($query);
        $horario = strtotime("H:i:s", $post['hora']);
        print_r($horario);
        die;

        $inicio = date("Y-m-d");

        $data = getdate();

        $this->db->select("consulta.*, medico.nome AS medico_nome, paciente.nome AS paciente_nome");
        $this->db->from("consulta");

        $this->db->join("pessoa AS medico", "medico.id = consulta.id_medico");
        $this->db->join("pessoa AS paciente", "paciente.id = consulta.id_paciente");
        $this->db->where('consulta.data <= ', $fim);
        $this->db->where('consulta.data >= ', $inicio);
        $this->db->order_by('consulta.data');
        
        $query = $this->db->get()->result_array();

        return $query;
    }

    function listarTodasImg($id) {
        unset($query);

        $this->db->where('id_consulta', $id);
        $query = $this->db->get('imagens')->result_array();

        return $query;
    }

    function listarImg($id) {
        unset($query);

        $this->db->where('id', $id);
        $query = $this->db->get('imagens')->row();

        return $query;
    }

    function listar($id) {
        unset($query);

        $this->db->where('id', $id);
        $query = $this->db->get('consulta')->row();

        return $query;
    }

    function adicionar_consulta($post) {
        unset($query);

        //[paciente] => 1 [medico] => 11 [data] => 1992-10-31 [hora] => 12:12 
        $dados = array(
            'id_medico' => $post['medico'],
            'id_paciente' => $post['paciente'],
            'data' => $post['data'],
            'hora' => $post['hora']
        );
        $query = $this->db->insert('consulta', $dados);

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
            'id_consulta' => $post['id_consulta'],
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
        $query = $this->db->update('consulta', $dados);

        return $query;
    }

    function desativar($id) {
        unset($query);

        $dados = array(
            'ativo' => '0'
        );

        $this->db->where('id', $id);
        $query = $this->db->update('consulta', $dados);

        return $query;
    }

    function ativar($id) {
        unset($query);

        $dados = array(
            'ativo' => '1'
        );

        $this->db->where('id', $id);
        $query = $this->db->update('consulta', $dados);

        return $query;
    }

    function excluir($id) {
        unset($query);

        $this->db->where('id', $id);
        $query = $this->db->delete('consulta');

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