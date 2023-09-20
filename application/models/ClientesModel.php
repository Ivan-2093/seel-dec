<?php
class ClientesModel extends CI_Model
{
    public function insertCliente($array_insert)
    {
        return $this->db->insert('clientes', $array_insert);
    }

    public function getClienteById($id_tercero)
    {
        $this->db->where('id_tercero', $id_tercero);
        return $this->db->get('clientes');
    }

    public function getClientes($where = "")
    {
        $this->db->select();
        $this->db->from('clientes as c');
        $this->db->join('terceros as t', 'c.id_tercero = t.id');
        $this->db->join('tipo_documentos as td', 't.id_tipo_doc = td.id');
        $this->db->join('generos as g', 't.id_genero = g.id');
        $this->db->join('municipios as m', 't.id_municipio = m.id');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id');
        $this->db->join('paises as p', 'd.id_pais = p.id');
        if ($where != "") {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function getClienteByIdCliente($id_cliente)
    {
        $this->db->where('id_cliente', $id_cliente);
        return $this->db->get('clientes');
    }

    public function getTercerosNotClientes($where)
    {
        $this->db->select('m.municipio, t.id as id_tercero, concat(t.primer_nombre," ",t.segundo_nombre," ", t.primer_apellido," ", t.segundo_apellido) as nombres, t.*');
        $this->db->from('terceros as t');
        $this->db->join('tipo_documentos as td', 't.id_tipo_doc = td.id');
        $this->db->join('generos as g', 't.id_genero = g.id');
        $this->db->join('municipios as m', 't.id_municipio = m.id');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id');
        $this->db->join('paises as p', 'd.id_pais = p.id');
        $this->db->join('clientes as c', 't.id = c.id_tercero','left');
        $this->db->where('c.id_cliente is null');
        $this->db->where($where);
        return $this->db->get();
    }
}
