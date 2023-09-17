<?php
class NegociosModel extends CI_Model
{
    public function get_etapas_negocio()
    {
        return $this->db->get('etapas_negocio');
    }

    public function create_negocios($data_insert)
    {
        $this->db->insert('negocios', $data_insert);
        return $this->db->insert_id();
    }

    public function getNegocio($where)
    {
        $this->db->where($where);
        return $this->db->get('negocios');
    }

    public function checkEtapa($where)
    {
        $this->db->where($where);
        return $this->db->get('negocios_historial_etapas ');
    }

    public function updateNegocio($data_update, $data_where)
    {
        $this->db->update('negocios', $data_update, $data_where);
        return $this->db->affected_rows();
    }

    public function insertHistorialEtapa($data)
    {
        return $this->db->insert('negocios_historial_etapas', $data);
    }

    public function insertSolicitudCliente($data)
    {
        return $this->db->insert('negocios_solicitud_cliente', $data);
    }

    public function get_negocios_solicitud_cliente($where)
    {
        $this->db->where($where);
        return $this->db->get('negocios_solicitud_cliente');
    }

    function get_tecnicos()
    {
        $response = array(
            "status" => false,
            "message" => 'Error al ejecutar la consulta',
            "data" => null
        );
        try {
            $sql = "SELECT 
            t.primer_nombre, 
            t.segundo_nombre, 
            t.primer_apellido, 
            t.segundo_apellido,
            t.nit 
            FROM terceros t 
            INNER JOIN empleados e ON e.id_tercero = t.id
            INNER JOIN perfiles p ON p.id_perfil = e.id_cargo
            INNER JOIN usuarios u ON u.empleado_id = e.id
            WHERE p.id_perfil = 3 AND u.estado_id = 1";

            if ($query = $this->db->query($sql)) {
                if ($query->num_rows() > 0) {
                    $response["data"] = $query->result();
                    $response["message"] = "query executed successfully";
                    $response["status"] = true;
                } else {
                    $response["data"] = array();
                    $response["message"] = "query executed successfully";
                    $response["status"] = true;
                }
            } else {
                throw new Exception("error getting information from database");
            }

        } catch (Exception $e) {
            $response["message"] = $e->getMessage();
        }

        return $response;
    }

    public function insert_cita($data)
    {
        return $this->db->insert('agenda_citas', $data);
    }

    function get_citas($id_cita = "")
    {
        $response = array(
            "status" => false,
            "message" => 'Error al ejecutar la consulta',
            "data" => null
        );
        try {
            $where = "";
            if(!empty($id_cita)){
                $where = "AND ac.id_cita = {$id_cita}";
            }
            $sql = "SELECT 
            ac.id_cita,
            t.primer_nombre as 'primer_nombre_cliente', 
            t.segundo_nombre as 'segundo_nombre_cliente', 
            t.primer_apellido as 'primer_apellido_cliente', 
            t.segundo_apellido as 'segundo_apellido_cliente',
            t.nit as 'nit_cliente',
            tt.primer_nombre as 'primer_nombre_tecnico', 
            tt.segundo_nombre as 'segundo_nombre_tecnico', 
            tt.primer_apellido as 'primer_apellido_tecnico', 
            tt.segundo_apellido as 'segundo_apellido_tecnico',
            tt.nit as 'nit_tecnico',
            ac.fecha_cita,
            ac.tecnico,
            ac.estado,
            ac.detalles_cita
            FROM agenda_citas ac
            INNER JOIN negocios n ON n.id_negocio = ac.negocio_id
            INNER JOIN clientes c ON c.id_cliente = n.cliente_id
            INNER JOIN terceros t ON t.id = c.id_tercero
            INNER JOIN terceros tt ON tt.nit = ac.tecnico
            WHERE ac.estado NOT IN (2,4) {$where}";

            if ($query = $this->db->query($sql)) {
                if ($query->num_rows() > 0) {
                    $response["data"] = $query->result();
                    $response["message"] = "query executed successfully";
                    $response["status"] = true;
                } else {
                    $response["data"] = array();
                    $response["message"] = "query executed successfully";
                    $response["status"] = true;
                }
            } else {
                throw new Exception("error getting information from database");
            }

        } catch (Exception $e) {
            $response["message"] = $e->getMessage();
        }

        return $response;
    }

}