<?php
class CotizacionModel extends CI_Model
{
    public function insert_cotizacion($array_insert)
    {
        return $this->db->insert('cotizacion', $array_insert);
    }

    public function insert_cotizacion_detalle($array_insert)
    {
        return $this->db->insert('cotizacion_detalle', $array_insert);
    }

    public function insert_correo_noti_cotizacion($array_insert)
    {
        return $this->db->insert('correo_notificacion_cotizacion', $array_insert);
    }

    public function get_cotizacion_by_where($array_where)
    {
        $this->db->select('*');
        $this->db->select('e.email as email_emp, e.telefono as telefono_emp, t_cli.telefono_1 as telefono_cli, t_cli.email as correo_cli, CONCAT(t_cli.primer_nombre," ",t_cli.segundo_nombre," ",t_cli.primer_apellido," ",t_cli.segundo_apellido) as nombre_cliente');
        $this->db->from('cotizacion as c');
        $this->db->join('negocios as n', 'c.negocio_id = n.id_negocio');
        $this->db->join('usuarios as u', 'c.usuario_id = u.id_user');
        $this->db->join('empleados as e', 'u.empleado_id = e.id');
        $this->db->join('terceros as t', 'e.id_tercero = t.id');
        $this->db->join('clientes as cli', 'n.cliente_id = cli.id_cliente');
        $this->db->join('terceros as t_cli', 'cli.id_tercero = t_cli.id');
        $this->db->where($array_where);
        return $this->db->get();
    }

    public function get_cotizacion_detalle_by_where($array_where)
    {
        $this->db->select('*');
        $this->db->from('cotizacion_detalle as dc');
        $this->db->join('productos as p', 'dc.producto_id = p.id_producto');
        $this->db->where($array_where);
        return $this->db->get();
    }

    public function get_cotizaciones($where)
    {
        $this->db->where($where);
        $this->db->order_by("id_cotizacion", "desc");
        return $this->db->get('cotizacion');
    }
}
