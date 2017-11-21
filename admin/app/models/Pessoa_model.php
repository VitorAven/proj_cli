<?php

class Pessoa_model extends CI_Model {

    function listarTodosPacientes() {
        unset($query);
        $this->db->select("pessoa.*, paciente.registro");
        $this->db->from("pessoa");
        $this->db->join("paciente", "paciente.id_pessoa = pessoa.id");
        $query = $this->db->get()->result_array();
        /* print_r($this->db->last_query());
          die(); */
        return $query;
    }

    function listarTodosMedicos() {
        unset($query);
        $this->db->select("pessoa.*, medico.crm");
        $this->db->from("pessoa");
        $this->db->join("medico", "medico.id_pessoa = pessoa.id");
        $query = $this->db->get()->result_array();
        /* print_r($this->db->last_query());
          die(); */
        return $query;
    }
    function listar_paciente($id) {
        unset($query);
        $this->db->select("pessoa.*, paciente.registro");
        $this->db->from("pessoa");
        $this->db->join("paciente", "paciente.id_pessoa = pessoa.id");

        $this->db->where('pessoa.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }
function listar_medico($id) {
        unset($query);
        $this->db->select("pessoa.*, medico.crm");
        $this->db->from("pessoa");
        $this->db->join("medico", "medico.id_pessoa = pessoa.id");

        $this->db->where('pessoa.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }
    private function listarUltimo() {
        unset($query);
        $this->db->select("pessoa.id");
        $this->db->from("pessoa");
        $this->db->order_by('pessoa.id', 'DESC');
        $query = $this->db->get()->row();

        return $query->id;
    }

    function adicionar_paciente($post) {
        unset($query);

       
        $dados = array(
            'nome' => $post['nome'],
            'sobre_nome' => $post['sobre_nome'],
            'dt_nasc' => $post['dt_nasc'],
            'cpf' => $post['cpf'],
            'rg' => $post['rg']
        );
        $query = $this->db->insert('pessoa', $dados);
        $this->adicionarPaciente($post);
        return $query;
    }
 function adicionar_Medico($post) {
        unset($query);

       
        $dados = array(
            'nome' => $post['nome'],
            'sobre_nome' => $post['sobre_nome'],
            'dt_nasc' => $post['dt_nasc'],
            'cpf' => $post['cpf'],
            'rg' => $post['rg']
        );
        $query = $this->db->insert('pessoa', $dados);
        $this->adicionarMedico($post);
        return $query;
    }
    function adicionarPaciente($post) {
        unset($query);
        $id = $this->listarUltimo();
        $registro = md5($post['sobre_nome']);
        $dados = array(
            'id_pessoa' => $id,
            'registro' => $registro
        );
        $query = $this->db->insert('paciente', $dados);
        ;
        return $query;
    }

    function adicionarMedico($post) {
        unset($query);
        $id = $this->listarUltimo();
        $crm = $post['crm'];
        $dados = array(
            'id_pessoa' => $id,
            'crm' => $crm
        );
        $query = $this->db->insert('medico', $dados);
        ;
        return $query;
    }

    function editar($post) {
        unset($query);
        $id = $post['id'];
        $dados = array(
            'nome' => $post['nome'],
            'sobre_nome' => $post['sobre_nome'],
            'dt_nasc' => $post['dt_nasc'],
            'cpf' => $post['cpf'],
            'rg' => $post['rg']
        );

        $this->db->where('id', $id);
        $query = $this->db->update('pessoa', $dados);

        return $query;
    }

    function excluir($id) {
        unset($query);

        $this->db->where('id', $id);
        $query = $this->db->delete('pessoa');

        return $query;
    }

}

?>