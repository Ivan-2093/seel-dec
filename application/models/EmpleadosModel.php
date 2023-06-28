<?php
class EmpleadosModel extends CI_Model
{

    public function getEmpleados()
    {
        $this->db->select();
        $this->db->select('e.id as id_empleado, e.email as correo');
        $this->db->from('empleados as e');
        $this->db->join('terceros as t', 'e.id_tercero = t.id');
        $this->db->join('cargo_empleados as c', 'e.id_cargo = c.id');
        $this->db->join('sedes as s', 'e.id_sede = s.id');

        return $this->db->get();


        /* print_r($this->db->last_query()); */
    }

    public function getEmpleadosByIdTercero($id_tercero)
    {
        $this->db->where('id_tercero', $id_tercero);
        return $this->db->get('empleados');
    }


    public function getCargoEmpleados()
    {
        return $this->db->get('cargo_empleados');
    }

    public function createEmpleado($data_insert)
    {
        return $this->db->insert('empleados', $data_insert);
    }
}
