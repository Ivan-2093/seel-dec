<?php
class TercerosModel extends CI_Model
{
    public function getTipoDocumentos()
    {
        return $this->db->get('tipo_documentos');
    }

    public function getGeneros()
    {
        return $this->db->get('generos');
    }

    public function getTerceros($where = "")
    {
        $this->db->select();
        $this->db->select('t.id as id_tercero');
        $this->db->from('terceros as t');
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

    public function getTerceroByNumeroDoc($numero_documento)
    {
        $this->db->where('nit', $numero_documento);
        return $this->db->get('terceros');
    }

    public function getTerceroById($id_tercero)
    {
        $this->db->where('id', $id_tercero);
        return $this->db->get('terceros');
    }

    public function createTercero($data_insert)
    {
        return $this->db->insert('terceros', $data_insert);
    }

    public function editTercero($data_update, $data_where)
    {
        return $this->db->update('terceros', $data_update, $data_where);
    }

    public function getTerceroBy($array_where)
    {
        $this->db->select();
        $this->db->select('t.id as id_tercero');
        $this->db->from('terceros as t');
        $this->db->or_like($array_where);
        return $this->db->get();
    }

    public function getTercerosNotClientes($where = "")
    {
        $this->db->select();
        $this->db->select('t.id as id_tercero');
        $this->db->from('terceros as t');
        $this->db->join('tipo_documentos as td', 't.id_tipo_doc = td.id');
        $this->db->join('generos as g', 't.id_genero = g.id');
        $this->db->join('municipios as m', 't.id_municipio = m.id');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id');
        $this->db->join('paises as p', 'd.id_pais = p.id');
        $this->db->join('clientes as c', 't.id = c.id_tercero', 'left');
        $this->db->where('c.id_cliente is null');
        if ($where != "") {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function getTercerosNotEmpleados($where = "")
    {
        $this->db->select();
        $this->db->select('t.id as id_tercero');
        $this->db->from('terceros as t');
        $this->db->join('tipo_documentos as td', 't.id_tipo_doc = td.id');
        $this->db->join('generos as g', 't.id_genero = g.id');
        $this->db->join('municipios as m', 't.id_municipio = m.id');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id');
        $this->db->join('paises as p', 'd.id_pais = p.id');
        $this->db->join('empleados as e', 't.id = e.id_tercero','left');
        $this->db->where('e.id_tercero is null');
        if ($where != "") {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function getTercerosNotProveedores($where = "")
    {
        $this->db->select();
        $this->db->select('t.id as id_tercero');
        $this->db->from('terceros as t');
        $this->db->join('tipo_documentos as td', 't.id_tipo_doc = td.id');
        $this->db->join('generos as g', 't.id_genero = g.id');
        $this->db->join('municipios as m', 't.id_municipio = m.id');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id');
        $this->db->join('paises as p', 'd.id_pais = p.id');
        $this->db->join('proveedores as pro', 't.id = pro.id_tercero','left');
        $this->db->where('pro.id_tercero is null');
        if ($where != "") {
            $this->db->where($where);
        }
        return $this->db->get();
    }

}
