<?php

    class Slidermodel extends CI_Model {

        function listarTodos()
        {
            unset($query);
            
            $query = $this->db->get('w0_banner')->result_array();
            
            return $query;
        }
        
        function listar($usuario)
        {
            unset($query);
            
            $this->db->where('id',$usuario);
            $query = $this->db->get('w0_banner')->row();
            
            return $query;
        }
        
        function adicionar($nome,$url,$imagem)
        {
            unset($query);
            
            $dados = array(
              'nome' => $nome,
              'url' => $url,
              'imagem' => $imagem,
              'status' => '1'
            );
            $query = $this->db->insert('w0_banner', $dados);
            
            return $query;
        }
        
        function alterar($id,$ordem)
        {
            unset($query);
            
            $dados = array(
              'ordem' => $ordem
            );
            $this->db->where('id',$id);
            $query = $this->db->update('w0_banner', $dados);
            
            return $query;
        }
        
        function desativar($id)
        {
            unset($query);
            
            $dados = array(
              'status' => '0'
            );
            
            $this->db->where('id',$id);
            $query = $this->db->update('w0_banner', $dados);
            
            return $query;
        }
        
        function ativar($id)
        {
            unset($query);
            
            $dados = array(
              'status' => '1'
            );
            
            $this->db->where('id',$id);
            $query = $this->db->update('w0_banner', $dados);
            
            return $query;
        }
        function excluir($id)
        {
            unset($query);
            
            $this->db->where('id',$id);
            $query = $this->db->delete('w0_banner');
            
            return $query;
        }
        
    }

?>