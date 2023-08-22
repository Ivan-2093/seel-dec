<?php
class ClientesModel extends CI_Model
{
    public function insertCliente($array_insert)
    {
        return $this->db->insert('clientes',$array_insert);
    }

    public function getClienteById($id_tercero){
        $this->db->where('id_tercero',$id_tercero);
        return $this->db->get('clientes');
    }

    public function getClientes(){
        $this->db->select();
        $this->db->from('clientes as c');
        $this->db->join('terceros as t', 'c.id_tercero = t.id');
        $this->db->join('tipo_documentos as td', 't.id_tipo_doc = td.id');
        $this->db->join('generos as g', 't.id_genero = g.id');
        $this->db->join('municipios as m', 't.id_municipio = m.id');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id');
        $this->db->join('paises as p', 'd.id_pais = p.id');
        return $this->db->get();
    }

}