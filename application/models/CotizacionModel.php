<?php
class CotizacionModel extends CI_Model
{
    public function insert_cotizacion($array_insert)
    {
        return $this->db->insert('cotizacion',$array_insert);
    }

    public function insert_cotizacion_detalle($array_insert)
    {
        return $this->db->insert('cotizacion_detalle',$array_insert);
    }

    public function insert_correo_noti_cotizacion($array_insert)
    {
        return $this->db->insert('correo_notificacion_cotizacion',$array_insert);
    }

}