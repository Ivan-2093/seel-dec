<?php
class ProductosModel extends CI_Model
{
    public function insertCliente($array_insert)
    {
        return $this->db->insert('clientes',$array_insert);
    }

    public function getClienteById($id_tercero){
        $this->db->where('id_tercero',$id_tercero);
        return $this->db->get('clientes');
    }

    public function getProductos(){
        $this->db->select();
        $this->db->from('productos as p');
        $this->db->join('tipos_productos as tp', 'p.id_tipo_p = tp.id_tipo');
        $this->db->join('categorias as c', 'tp.id_categoria_c = c.id_categoria');
        $this->db->join('proveedores as pr', 'p.proveedor_id = pr.id_proveedor');
        $this->db->join('terceros as t', 'pr.id_tercero = t.id');
        return $this->db->get();
    }

    public function getTipoProducto()
    {
        return $this->db->get('tipos_productos');
    }
    public function getTipoCategoria()
    {
        return $this->db->get('categorias');
    }

    public function getTipoProductoWhere($array_where)
    {
        return $this->db->get_where('tipos_productos',$array_where);
    }

    public function getTipoMedida()
    {
        return $this->db->get('tela_tipo_medida');
    }

    public function getProductoById($array_where)
    {
        $this->db->where($array_where);
        return $this->db->get('productos');
    }

    public function getProductosByWhere($where){
        $this->db->select();
        $this->db->from('productos as p');
        $this->db->join('tipos_productos as tp', 'p.id_tipo_p = tp.id_tipo');
        $this->db->join('categorias as c', 'tp.id_categoria_c = c.id_categoria');
        $this->db->join('proveedores as pr', 'p.proveedor_id = pr.id_proveedor');
        $this->db->join('terceros as t', 'pr.id_tercero = t.id');
        $this->db->where($where);
        return $this->db->get();
    }

    public function insertProducto($array_insert)
    {
        return $this->db->insert('productos',$array_insert);
    }

    public function updateProducto($array_update,$array_where)
    {
        return $this->db->update('productos',$array_update,$array_where);
    }

}