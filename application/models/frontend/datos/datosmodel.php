<?php

class datosmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getData($cedula) {
        $query = $this->db->query('SELECT 
                                re.*,
                                est.estado,
                                mun.municipio,
                                parq.parroquia,
                                sector.codigo_sector,
				sector.sector,
                                stc.estado_civil AS stcv
                                FROM vbrdb_registro AS re 
				LEFT JOIN vbrdb_sectores AS sector ON sector.codigo_sector = re.sector_id
                                LEFT JOIN vbrdb_parroquias AS parq ON parq.codigo_parroquia = re.parroquia_id
                                LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = parq.codigo_municipio
                                LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = mun.codigo_estado
                                LEFT JOIN vbrdb_estadocivil AS stc ON stc.id_estado_civil = re.estado_civil
                                WHERE re.cedula = "' . $cedula . '"');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        } else
        {
            return $data = 'vacio';
        }
        $query->free_result();
    }

    public function getDataCoSolicitante($cedula) {
        $query = $this->db->query('SELECT 
                                re.*,
                                est.estado,
                                mun.municipio,
                                parq.parroquia,
                                sector.codigo_sector,
				sector.sector,
                                stc.estado_civil AS stcv
                                FROM db_cosolicitante AS re 
                                LEFT JOIN vbrdb_sectores AS sector ON sector.codigo_sector = re.sector_id
                                LEFT JOIN vbrdb_parroquias AS parq ON parq.codigo_parroquia = re.parroquia_id
                                LEFT JOIN vbrdb_municipios AS mun ON mun.codigo_municipio = parq.codigo_municipio
                                LEFT JOIN vbrdb_estados AS est ON est.codigo_estado = mun.codigo_estado
                                LEFT JOIN vbrdb_estadocivil AS stc ON stc.id_estado_civil = re.estado_civil
                                WHERE re.fk_cedula_ben = "' . $cedula . '"');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        } else
        {
            return $data = 'vacio';
        }
        $query->free_result();
    }

    public function getOrganiacionBen($cedula) {
        $query = $this->db->query("SELECT org_ben.cedula,
                                    org.id,
                                    org.organizacion,
                                    org.direccion,
                                    org.responzable,
                                    org.descripcion
                                    FROM db_organizacion_ben AS org_ben
                                    LEFT JOIN db_organizaciones AS org ON org.id = org_ben.organizacion
                                    WHERE org_ben.cedula = '" . $cedula . "'");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        } else
        {
            return FALSE;
        }
    }

    public function getInfoAcademico($cedula) {
        $query = $this->db->query("SELECT 
                                info.fin,
                                info.inicio,
                                info.indice,
                                info.institucion,
                                info.titulo_obtenido,
                                grd.grado_instruccion,
                                grd.id_grado 
                                FROM db_infoestudios AS info
                                LEFT JOIN vbrdb_gradoinstruccion AS grd ON grd.id_grado = info.grado_instruccion
                                WHERE info.cedula = '" . $cedula . "'");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        } else
        {
            return FALSE;
        }
    }

    public function updateData($correo, $cedula, $pn, $sn, $pa, $sa, $t_id, $cel, $tel, $estado, $municipio, $parroquia, $dir_1, $dir_2, $dir_sector, $stscv) {
        $data = array(
            'cedula' => $cedula,
            'email' => $correo,
            'nacionalidad' => 'V',
            'nombre_primario' => strtoupper($pn),
            'nombre_secundario' => strtoupper($sn),
            'apellido_primario' => strtoupper($pa),
            'apellido_secundario' => strtoupper($sa),
            'telefono_residencia' => $tel,
            'telefono_celular' => $t_id . '-' . $cel,
            'estado_id' => $estado,
            'municipio_id' => $municipio,
            'parroquia_id' => $parroquia,
            'direccion_1' => strtoupper($dir_1),
            'direccion_2' => strtoupper($dir_2),
            'sector_id' => $dir_sector,
            'estado_civil' => $stscv,
            'status' => '2'
        );
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $this->db->where('cedula', $cedula)->update('vbrdb_registro', $data);
        return TRUE;
    }

    public function putGrupo($nombres, $cedula, $sexo, $parentesco, $pensionado, $fecha, $edad, $grado, $oficio, $ingreso_mensual) {
        $data = array(
            'nombres' => $nombres,
            'cedula' => $cedula,
            'sexo' => $sexo,
            'parentesco' => $parentesco,
            'pensionado' => $pensionado,
            'fecha_n' => $fecha,
            'edad' => $edad,
            'grado' => $grado,
            'profesion' => $oficio,
            'ingreso' => $ingreso_mensual,
            'serial' => $this->session->userdata('serial'),
            'status' => '1'
        );
        $this->db->set('date_create', 'NOW()', FALSE);
        $this->db->insert('db_grupo', $data);
        return TRUE;
    }

    public function validaCedula($cedula) {
        $query = $this->db->query('SELECT * FROM vbrdb_registro WHERE cedula = "' . $cedula . '"');
        if ($query->num_rows() > 0)
        {
            return TRUE;
        } else
        {
            return FALSE;
        }
    }

    public function validaCedulaGrupo($cedula) {
        $query = $this->db->query('SELECT * FROM db_grupo WHERE cedula = "' . $cedula . '"');
        if ($query->num_rows() > 0)
        {
            return TRUE;
        } else
        {
            return FALSE;
        }
    }

    public function getOrganizacion($cedula) {
        $query = $this->db->query("SELECT org_ben.cedula,
                                    org.id,
                                    org.organizacion,
                                    org.direccion,
                                    org.responzable,
                                    org.descripcion
                                    FROM db_organizacion_ben AS org_ben
                                    LEFT JOIN db_organizaciones AS org ON org.id = org_ben.organizacion
                                    WHERE org_ben.cedula = '" . $cedula . "'");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data = $value->organizacion;
            }
            return $data;
        } else
        {
            return FALSE;
        }
    }
    
    public function getListOrganizacion() {
        $query = $this->db->get("db_organizaciones");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        } else
        {
            return FALSE;
        }
    }

    public function getImgProfile() {
        $query = $this->db->get_where('db_img_profile', array("fk_cedula_ben" => $this->session->userdata("cedula")));
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data = $value->ruta_absoluta;
            }
            return $data;
        } else
        {
            return FALSE;
        }
    }

    public function getOrganizacionCed($cedula) {
        $query = $this->db->get_where('db_organizaciones', array(""));
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        } else
        {
            return FALSE;
        }
    }

    public function getGrupoNombre($cedula) {
        $query = $this->db->query('SELECT 
                            grp.cedula,
                            r.apellido_primario,
                            r.nombre_primario,
                            b.organizacion
                            FROM db_grupo AS grp
                            LEFT JOIN vbrdb_registro AS r ON r.serial = grp.serial
                            LEFT JOIN db_organizacion_ben AS d ON d.cedula = r.cedula
                            LEFT JOIN db_organizaciones AS b ON b.id = d.organizacion
                            WHERE grp.cedula = "' . $cedula . '"');
        foreach ($query->result() as $value)
        {
            $data = $value->nombre_primario." ".$value->apellido_primario." perteneciente  a la organización  ".$value->organizacion;
        }
        return $data;
    }

    public function getGrupo() {
        $query = $this->db->query('SELECT 
                                grp.*,
                                sex.sexo AS sex,
                                paren.parentesco AS par,
                                grd.grado_instruccion
                                FROM db_grupo AS grp
                                LEFT JOIN db_sexo AS sex ON sex.id_sexo = grp.sexo
                                LEFT JOIN db_parentesco AS paren ON paren.id_parentesco = grp.parentesco
                                LEFT JOIN vbrdb_gradoinstruccion AS grd ON grd.id_grado = grp.grado
                                WHERE grp.serial = "' . $this->session->userdata('serial') . '"');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        } else
        {
            return $data = 'vacio';
        }
        $query->free_result();
    }

    public function getInfoAProfesion($cedula) {
        $query = $this->db->query('SELECT 
                            bene.empresa,
                            bene.direccion_trabj,
                            bene.ingreso,
                            bene.oficio,
                            bene.telf_trabajo,
                            ing.ingreso_familiar,
                            ing.id_ingreso_familiar
                            FROM db_profesion_ben AS bene
                            LEFT JOIN vbrdb_ingreso_familiar AS ing ON ing.id_ingreso_familiar = bene.forma_ingreso
                            WHERE bene.fk_cedula_ben = "' . $cedula . '"');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        } else
        {
            return $data = 'vacio';
        }
        $query->free_result();
    }

    public function getInfoVivienda($cedula) {
        $query = $this->db->query('SELECT
                                    viv.otra_Actividad,
                                    tpv.*,
                                    frm.*,
                                    c.*
                                    FROM db_vivienda AS viv
                                    LEFT JOIN db_viv_tipo AS tpv ON tpv.id_tipo_vivienda = viv.fk_tipo_vivienda
                                    LEFT JOIN db_viv_forma_tenencias AS frm ON frm.id_tipo_forma_ten = viv.fk_forma_tenencia
                                    LEFT JOIN db_viv_condicion_terreno AS c ON c.id_viv_condicion_terreno = viv.fk_condicion
                                    WHERE viv.fk_cedula_ben = "' . $cedula . '"');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $value)
            {
                $data[] = $value;
            }
            return $data;
        } else
        {
            return $data = 'vacio';
        }
        $query->free_result();
    }

    public function updateOrganoBen($organo) {
        $data = array(
            "organizacion" => $organo,
            "cedula" => $this->session->userdata("cedula")
        );
        $this->db->insert("db_organizacion_ben", $data);
        return TRUE;
    }

    public function updateInfoAcademico($ins, $tit, $gra, $ind, $fin, $ini) {
        $data = array(
            "grado_instruccion" => strtoupper($gra),
            "institucion" => strtoupper($ins),
            "inicio" => $ini,
            "fin" => $fin,
            "titulo_obtenido" => strtoupper($tit),
            "indice" => $ind,
            "cedula" => $this->session->userdata("cedula")
        );
        $this->db->insert("db_infoestudios", $data);
        return TRUE;
    }

    public function updateInfoAcademicoSet($ins, $tit, $gra, $ind, $fin, $ini) {
        $data = array(
            "grado_instruccion" => strtoupper($gra),
            "institucion" => strtoupper($ins),
            "inicio" => $ini,
            "fin" => $fin,
            "titulo_obtenido" => strtoupper($tit),
            "indice" => $ind
        );
        $this->db->where('cedula', $this->session->userdata("cedula"));
        $this->db->update("db_infoestudios", $data);
        return TRUE;
    }

    public function updateInfoOficio($emp, $dir, $telf, $of, $ing, $frming) {
        $data = array(
            "empresa" => strtoupper($emp),
            "direccion_trabj" => strtoupper($dir),
            "telf_trabajo" => $telf,
            "oficio" => strtoupper($of),
            "ingreso" => $ing,
            "forma_ingreso" => $frming,
            "status_empleo" => "1",
            "fk_cedula_ben" => $this->session->userdata("cedula")
        );
        $this->db->insert("db_profesion_ben", $data);
        return TRUE;
    }

    public function updateInfoOficioSet($emp, $dir, $telf, $of, $ing, $frming) {
        $data = array(
            "empresa" => strtoupper($emp),
            "direccion_trabj" => strtoupper($dir),
            "telf_trabajo" => $telf,
            "oficio" => strtoupper($of),
            "ingreso" => $ing,
            "forma_ingreso" => $frming,
            "status_empleo" => "1",
        );
        $this->db->where('fk_cedula_ben', $this->session->userdata("cedula"));
        $this->db->update("db_profesion_ben", $data);
        return TRUE;
    }

    public function updateInfoVivienda($for_tenencia, $tip_viv, $viv_cond, $other) {
        $data = array(
            "fk_tipo_vivienda" => strtoupper($tip_viv),
            "fk_condicion" => strtoupper($viv_cond),
            "fk_forma_tenencia" => $for_tenencia,
            "otra_Actividad" => strtoupper($other),
            "fk_cedula_ben" => $this->session->userdata("cedula")
        );
        $this->db->insert("db_vivienda", $data);
        return TRUE;
    }

    public function updateInfoViviendaSet($for_tenencia, $tip_viv, $viv_cond, $other) {
        $data = array(
            "fk_tipo_vivienda" => strtoupper($tip_viv),
            "fk_condicion" => strtoupper($viv_cond),
            "fk_forma_tenencia" => $for_tenencia,
            "otra_Actividad" => strtoupper($other)
        );
        $this->db->where('fk_cedula_ben', $this->session->userdata("cedula"));
        $this->db->update("db_vivienda", $data);
        return TRUE;
    }

    public function insertCosolicitante($correo, $cedula, $pn, $sn, $pa, $sa, $t_id, $cel, $tel, $estado, $municipio, $parroquia, $dir_1, $dir_2, $dir_sector, $stscv, $fecha, $ing) {
        $data = array(
            'cedula' => $cedula,
            'email' => $correo,
            'nacionalidad' => 'V',
            'nombre_primario' => strtoupper($pn),
            'nombre_secundario' => strtoupper($sn),
            'apellido_primario' => strtoupper($pa),
            'apellido_secundario' => strtoupper($sa),
            'telefono_residencia' => $tel,
            'telefono_celular' => $t_id . '-' . $cel,
            'estado_id' => $estado,
            'municipio_id' => $municipio,
            'parroquia_id' => $parroquia,
            'direccion_1' => strtoupper($dir_1),
            'direccion_2' => strtoupper($dir_2),
            'sector_id' => $dir_sector,
            'estado_civil' => $stscv,
            'fecha_nacimiento' => $fecha,
            'ingreso' => $ing,
            'fk_cedula_ben' => $this->session->userdata("cedula"),
            'status' => '2'
        );

        $this->db->insert('db_cosolicitante', $data);
        return TRUE;
    }

    public function updateCosolicitante($correo, $cedula, $pn, $sn, $pa, $sa, $t_id, $cel, $tel, $estado, $municipio, $parroquia, $dir_1, $dir_2, $dir_sector, $stscv, $fecha, $ing) {
        $data = array(
            'cedula' => $cedula,
            'email' => $correo,
            'nacionalidad' => 'V',
            'nombre_primario' => strtoupper($pn),
            'nombre_secundario' => strtoupper($sn),
            'apellido_primario' => strtoupper($pa),
            'apellido_secundario' => strtoupper($sa),
            'telefono_residencia' => $tel,
            'telefono_celular' => $t_id . '-' . $cel,
            'estado_id' => $estado,
            'municipio_id' => $municipio,
            'parroquia_id' => $parroquia,
            'direccion_1' => strtoupper($dir_1),
            'direccion_2' => strtoupper($dir_2),
            'sector_id' => $dir_sector,
            'estado_civil' => $stscv,
            'ingreso' => $ing,
            'fecha_nacimiento' => $fecha,
            'status' => '2'
        );
        $this->db->where('fk_cedula_ben', $this->session->userdata("cedula"));
        $this->db->update('db_cosolicitante', $data);
        return TRUE;
    }

}
