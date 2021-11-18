<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';

/* ===================================================
   * PROTOCOLO DE ALISTAMIENTO
===================================================*/
class ModeloAlistamiento
{
    /* ===================================================
       LISTA ALISTAMIENTOS
    ===================================================*/
    static public function mdlListaAlistamientos()
    {
        $stmt = Conexion::conectar()->prepare("SELECT v.placa, v.numinterno, p.Nombre AS conductor, p.Documento AS cedulaConductor, a.*
                                                FROM o_alistamiento a
                                                INNER JOIN v_vehiculos v ON v.idvehiculo = a.idvehiculo
                                                LEFT JOIN gh_personal p ON p.idPersonal = a.idconductor
                                                ORDER BY a.fechaalista DESC");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       DATOS DE UN SOLO ALISTAMIENTO
    ===================================================*/
    static public function mdlDatosAlistamiento($datos, $parametro = "")
    {
        if ($parametro == "fecha") {
            $parametro = "AND DATE_FORMAT(fechaalista, '%Y-%m-%d') = CURDATE()";
        }

        $stmt = Conexion::conectar()->prepare("SELECT v.placa, v.numinterno, a.*, DATE_FORMAT(a.fechaalista, '%Y-%m-%d') as Ffechaalista FROM o_alistamiento a
                                                INNER JOIN v_vehiculos v ON v.idvehiculo = a.idvehiculo
                                                LEFT JOIN gh_personal p ON p.idPersonal = a.idconductor
                                                WHERE a.{$datos['item']} = :{$datos['item']} $parametro;");
        $stmt->bindParam(":{$datos['item']}", $datos['valor']);
        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       INSERTAR ALISTAMIENTO
    ===================================================*/
    static public function mdlAgregarAlistamiento($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO `o_alistamiento`(
                                    `idvehiculo`,
                                    `idconductor`,
                                    `fechaalista`,
                                    `lucesbajas`,
                                    `lucesaltas`,
                                    `lucesreversa`,
                                    `direccionales_delanteras`,
                                    `direccionales_traseras`,
                                    `iluminacioncabina`,
                                    `lucesinternas`,
                                    `lucesmedias`,
                                    `lucesdestop`,
                                    `lucesdeparqueo`,
                                    `luzescala`,
                                    `baliza_licuadora`,
                                    `retrovisor_izquierdo`,
                                    `retrovisor_derecho`,
                                    `apoyacabeza_conductor`,
                                    `apoyacabeza_pasajero`,
                                    `equipoaudio`,
                                    `claraboya`,
                                    `espejointerno`,
                                    `parabrisas`,
                                    `placas`,
                                    `limpiaparabrisas_derecho`,
                                    `limpiaparabrisas_izquierdo`,
                                    `piso`,
                                    `bomper_delantero`,
                                    `bomper_trasero`,
                                    `alarmareversa`,
                                    `sillas`,
                                    `antideslizante_escaleras`,
                                    `puertas`,
                                    `claxon`,
                                    `cinturones_pasajero`,
                                    `cinturones_conductor`,
                                    `pasamanos_interno`,
                                    `indicador_velocidad`,
                                    `ventaneria`,
                                    `nivel_refrigerante`,
                                    `nivel_combustible`,
                                    `baterias`,
                                    `freno_principal`,
                                    `liquido_hidraulico`,
                                    `estado_correas`,
                                    `nivel_liquido_frenos`,
                                    `caja_cambios`,
                                    `direccion`,
                                    `nivel_aceite`,
                                    `freno_emergencia`,
                                    `velocimetro`,
                                    `carga_bateria`,
                                    `presion_aceite`,
                                    `temperatura`,
                                    `combustible`,
                                    `presion_aire`,
                                    `llantas_delanteras`,
                                    `llantas_traseras`,
                                    `cortes`,
                                    `esparragos`,
                                    `profundidad_huella`,
                                    `llanta_repuesto`,
                                    `presion_inflado`,
                                    `abultamientos`,
                                    `reloj_braza`,
                                    `boca_llanta`,
                                    `rines`,
                                    `chalecoreflectivo`,
                                    `linterna`,
                                    `conos_triangulos`,
                                    `tacos_bloques`,
                                    `gato`,
                                    `cruceta_copa`,
                                    `alicate`,
                                    `destornilladores`,
                                    `llavesfijas`,
                                    `botiquin`,
                                    `llave_expansion`,
                                    `extintor`,
                                    `kilometraje_total`,
                                    `observaciones`,
                                    `sistema_hidraulico`) 
                                    VALUES (
                                    :idvehiculo,
                                    :idconductor,
                                    :fechaalista,
                                    :lucesbajas,
                                    :lucesaltas,
                                    :lucesreversa,
                                    :direccionales_delanteras,
                                    :direccionales_traseras,
                                    :iluminacioncabina,
                                    :lucesinternas,
                                    :lucesmedias,
                                    :lucesdestop,
                                    :lucesdeparqueo,
                                    :luzescala,
                                    :baliza_licuadora,
                                    :retrovisor_izquierdo,
                                    :retrovisor_derecho,
                                    :apoyacabeza_conductor,
                                    :apoyacabeza_pasajero,
                                    :equipoaudio,
                                    :claraboya,
                                    :espejointerno,
                                    :parabrisas,
                                    :placas,
                                    :limpiaparabrisas_derecho,
                                    :limpiaparabrisas_izquierdo,
                                    :piso,
                                    :bomper_delantero,
                                    :bomper_trasero,
                                    :alarmareversa,
                                    :sillas,
                                    :antideslizante_escaleras,
                                    :puertas,
                                    :claxon,
                                    :cinturones_pasajero,
                                    :cinturones_conductor,
                                    :pasamanos_interno,
                                    :indicador_velocidad,
                                    :ventaneria,
                                    :nivel_refrigerante,
                                    :nivel_combustible,
                                    :baterias,
                                    :freno_principal,
                                    :liquido_hidraulico,
                                    :estado_correas,
                                    :nivel_liquido_frenos,
                                    :caja_cambios,
                                    :direccion,
                                    :nivel_aceite,
                                    :freno_emergencia,
                                    :velocimetro,
                                    :carga_bateria,
                                    :presion_aceite,
                                    :temperatura,
                                    :combustible,
                                    :presion_aire,
                                    :llantas_delanteras,
                                    :llantas_traseras,
                                    :cortes,
                                    :esparragos,
                                    :profundidad_huella,
                                    :llanta_repuesto,
                                    :presion_inflado,
                                    :abultamientos,
                                    :reloj_braza,
                                    :boca_llanta,
                                    :rines,
                                    :chalecoreflectivo,
                                    :linterna,
                                    :conos_triangulos,
                                    :tacos_bloques,
                                    :gato,
                                    :cruceta_copa,
                                    :alicate,
                                    :destornilladores,
                                    :llavesfijas,
                                    :botiquin,
                                    :llave_expansion,
                                    :extintor,
                                    :kilometraje_total,
                                    :observaciones,
                                    :sistema_hidraulico)
        ");

        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor", $datos['idconductor'], PDO::PARAM_INT);
        $stmt->bindParam(":fechaalista", $datos['fechaAlistamiento'], PDO::PARAM_STR);
        $stmt->bindParam(":lucesbajas", $datos['lucesbajas'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesaltas", $datos['lucesaltas'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesreversa", $datos['lucesreversa'], PDO::PARAM_INT);
        $stmt->bindParam(":direccionales_delanteras", $datos['direccionales_delanteras'], PDO::PARAM_INT);
        $stmt->bindParam(":direccionales_traseras", $datos['direccionales_traseras'], PDO::PARAM_INT);
        $stmt->bindParam(":iluminacioncabina", $datos['iluminacioncabina'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesinternas", $datos['lucesinternas'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesmedias", $datos['lucesmedias'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesdestop", $datos['lucesdestop'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesdeparqueo", $datos['lucesdeparqueo'], PDO::PARAM_INT);
        $stmt->bindParam(":luzescala", $datos['luzescala'], PDO::PARAM_INT);
        $stmt->bindParam(":baliza_licuadora", $datos['baliza_licuadora'], PDO::PARAM_INT);
        $stmt->bindParam(":retrovisor_izquierdo", $datos['retrovisor_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":retrovisor_derecho", $datos['retrovisor_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":apoyacabeza_conductor", $datos['apoyacabeza_conductor'], PDO::PARAM_INT);
        $stmt->bindParam(":apoyacabeza_pasajero", $datos['apoyacabeza_pasajero'], PDO::PARAM_INT);
        $stmt->bindParam(":equipoaudio", $datos['equipoaudio'], PDO::PARAM_INT);
        $stmt->bindParam(":claraboya", $datos['claraboya'], PDO::PARAM_INT);
        $stmt->bindParam(":espejointerno", $datos['espejointerno'], PDO::PARAM_INT);
        $stmt->bindParam(":parabrisas", $datos['parabrisas'], PDO::PARAM_INT);
        $stmt->bindParam(":placas", $datos['placas'], PDO::PARAM_INT);
        $stmt->bindParam(":limpiaparabrisas_derecho", $datos['limpiaparabrisas_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":limpiaparabrisas_izquierdo", $datos['limpiaparabrisas_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":piso", $datos['piso'], PDO::PARAM_INT);
        $stmt->bindParam(":bomper_delantero", $datos['bomper_delantero'], PDO::PARAM_INT);
        $stmt->bindParam(":bomper_trasero", $datos['bomper_trasero'], PDO::PARAM_INT);
        $stmt->bindParam(":alarmareversa", $datos['alarmareversa'], PDO::PARAM_INT);
        $stmt->bindParam(":sillas", $datos['sillas'], PDO::PARAM_INT);
        $stmt->bindParam(":antideslizante_escaleras", $datos['antideslizante_escaleras'], PDO::PARAM_INT);
        $stmt->bindParam(":puertas", $datos['puertas'], PDO::PARAM_INT);
        $stmt->bindParam(":claxon", $datos['claxon'], PDO::PARAM_INT);
        $stmt->bindParam(":cinturones_pasajero", $datos['cinturones_pasajero'], PDO::PARAM_INT);
        $stmt->bindParam(":cinturones_conductor", $datos['cinturones_conductor'], PDO::PARAM_INT);
        $stmt->bindParam(":pasamanos_interno", $datos['pasamanos_interno'], PDO::PARAM_INT);
        $stmt->bindParam(":indicador_velocidad", $datos['indicador_velocidad'], PDO::PARAM_INT);
        $stmt->bindParam(":ventaneria", $datos['ventaneria'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_refrigerante", $datos['nivel_refrigerante'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_combustible", $datos['nivel_combustible'], PDO::PARAM_INT);
        $stmt->bindParam(":baterias", $datos['baterias'], PDO::PARAM_INT);
        $stmt->bindParam(":freno_principal", $datos['freno_principal'], PDO::PARAM_INT);
        $stmt->bindParam(":liquido_hidraulico", $datos['liquido_hidraulico'], PDO::PARAM_INT);
        $stmt->bindParam(":estado_correas", $datos['estado_correas'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_liquido_frenos", $datos['nivel_liquido_frenos'], PDO::PARAM_INT);
        $stmt->bindParam(":caja_cambios", $datos['caja_cambios'], PDO::PARAM_INT);
        $stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_aceite", $datos['nivel_aceite'], PDO::PARAM_INT);
        $stmt->bindParam(":freno_emergencia", $datos['freno_emergencia'], PDO::PARAM_INT);
        $stmt->bindParam(":velocimetro", $datos['velocimetro'], PDO::PARAM_INT);
        $stmt->bindParam(":carga_bateria", $datos['carga_bateria'], PDO::PARAM_INT);
        $stmt->bindParam(":presion_aceite", $datos['presion_aceite'], PDO::PARAM_INT);
        $stmt->bindParam(":temperatura", $datos['temperatura'], PDO::PARAM_INT);
        $stmt->bindParam(":combustible", $datos['combustible'], PDO::PARAM_INT);
        $stmt->bindParam(":presion_aire", $datos['presion_aire'], PDO::PARAM_INT);
        $stmt->bindParam(":llantas_delanteras", $datos['llantas_delanteras'], PDO::PARAM_INT);
        $stmt->bindParam(":llantas_traseras", $datos['llantas_traseras'], PDO::PARAM_INT);
        $stmt->bindParam(":cortes", $datos['cortes'], PDO::PARAM_INT);
        $stmt->bindParam(":esparragos", $datos['esparragos'], PDO::PARAM_INT);
        $stmt->bindParam(":profundidad_huella", $datos['profundidad_huella'], PDO::PARAM_INT);
        $stmt->bindParam(":llanta_repuesto", $datos['llanta_repuesto'], PDO::PARAM_INT);
        $stmt->bindParam(":presion_inflado", $datos['presion_inflado'], PDO::PARAM_INT);
        $stmt->bindParam(":abultamientos", $datos['abultamientos'], PDO::PARAM_INT);
        $stmt->bindParam(":reloj_braza", $datos['reloj_braza'], PDO::PARAM_INT);
        $stmt->bindParam(":boca_llanta", $datos['boca_llanta'], PDO::PARAM_INT);
        $stmt->bindParam(":rines", $datos['rines'], PDO::PARAM_INT);
        $stmt->bindParam(":chalecoreflectivo", $datos['chalecoreflectivo'], PDO::PARAM_INT);
        $stmt->bindParam(":linterna", $datos['linterna'], PDO::PARAM_INT);
        $stmt->bindParam(":conos_triangulos", $datos['conos_triangulos'], PDO::PARAM_INT);
        $stmt->bindParam(":tacos_bloques", $datos['tacos_bloques'], PDO::PARAM_INT);
        $stmt->bindParam(":gato", $datos['gato'], PDO::PARAM_INT);
        $stmt->bindParam(":cruceta_copa", $datos['cruceta_copa'], PDO::PARAM_INT);
        $stmt->bindParam(":alicate", $datos['alicate'], PDO::PARAM_INT);
        $stmt->bindParam(":destornilladores", $datos['destornilladores'], PDO::PARAM_INT);
        $stmt->bindParam(":llavesfijas", $datos['llavesfijas'], PDO::PARAM_INT);
        $stmt->bindParam(":botiquin", $datos['botiquin'], PDO::PARAM_INT);
        $stmt->bindParam(":llave_expansion", $datos['llave_expansion'], PDO::PARAM_INT);
        $stmt->bindParam(":extintor", $datos['extintor'], PDO::PARAM_INT);
        $stmt->bindParam(":kilometraje_total", $datos['kilometraje_total'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $stmt->bindParam(":sistema_hidraulico", $datos['sistema_hidraulico'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    /* ===================================================
       EDITAR ALISTAMIENTO
    ===================================================*/
    static public function mdlEditarAlistamiento($datos)
    {

        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE `o_alistamiento` SET 
            `idvehiculo`=:idvehiculo,
            `idconductor`=:idconductor,
            `fechaalista`=:fechaalista,
            `lucesbajas`=:lucesbajas,
            `lucesaltas`=:lucesaltas,
            `lucesreversa`=:lucesreversa,
            `direccionales_delanteras`=:direccionales_delanteras,
            `direccionales_traseras`=:direccionales_traseras,
            `iluminacioncabina`= :iluminacioncabina,
            `lucesinternas`= :lucesinternas,
            `lucesmedias`= :lucesmedias,
            `lucesdestop`= :lucesdestop,
            `lucesdeparqueo`= :lucesdeparqueo,
            `luzescala`= :luzescala,
            `baliza_licuadora`= :baliza_licuadora,
            `retrovisor_izquierdo`= :retrovisor_izquierdo,
            `retrovisor_derecho`= :retrovisor_derecho,
            `apoyacabeza_conductor`= :apoyacabeza_conductor,
            `apoyacabeza_pasajero`= :apoyacabeza_pasajero,
            `equipoaudio`= :equipoaudio,
            `claraboya`= :claraboya,
            `espejointerno`= :espejointerno,
            `parabrisas`= :parabrisas,
            `placas`= :placas,
            `limpiaparabrisas_derecho`= :limpiaparabrisas_derecho,
            `limpiaparabrisas_izquierdo`= :limpiaparabrisas_izquierdo,
            `piso`= :piso,
            `bomper_delantero`= :bomper_delantero,
            `bomper_trasero`= :bomper_trasero,
            `alarmareversa`= :alarmareversa,
            `sillas`= :sillas,
            `antideslizante_escaleras`= :antideslizante_escaleras,
            `puertas`= :puertas,
            `claxon`= :claxon,
            `cinturones_pasajero`= :cinturones_pasajero,
            `cinturones_conductor`= :cinturones_conductor,
            `pasamanos_interno`= :pasamanos_interno,
            `indicador_velocidad`= :indicador_velocidad,
            `ventaneria`= :ventaneria,
            `nivel_refrigerante`= :nivel_refrigerante,
            `nivel_combustible`= :nivel_combustible,
            `baterias`= :baterias,
            `freno_principal`= :freno_principal,
            `liquido_hidraulico`= :liquido_hidraulico,
            `estado_correas`= :estado_correas,
            `nivel_liquido_frenos`= :nivel_liquido_frenos,
            `caja_cambios`= :caja_cambios,
            `direccion`= :direccion,
            `nivel_aceite`= :nivel_aceite,
            `freno_emergencia`= :freno_emergencia,
            `velocimetro`= :velocimetro,
            `carga_bateria`= :carga_bateria,
            `presion_aceite`= :presion_aceite,
            `temperatura`= :temperatura,
            `combustible`= :combustible,
            `presion_aire`= :presion_aire,
            `llantas_delanteras`= :llantas_delanteras,
            `llantas_traseras`= :llantas_traseras,
            `cortes`= :cortes,
            `esparragos`= :esparragos,
            `profundidad_huella`= :profundidad_huella,
            `llanta_repuesto`= :llanta_repuesto,
            `presion_inflado`= :presion_inflado,
            `abultamientos`= :abultamientos,
            `reloj_braza`= :reloj_braza,
            `boca_llanta`= :boca_llanta,
            `rines`= :rines,
            `chalecoreflectivo`= :chalecoreflectivo,
            `linterna`= :linterna,
            `conos_triangulos`= :conos_triangulos,
            `tacos_bloques`= :tacos_bloques,
            `gato`= :gato,
            `cruceta_copa`= :cruceta_copa,
            `alicate`= :alicate,
            `destornilladores`= :destornilladores,
            `llavesfijas`= :llavesfijas,
            `botiquin`= :botiquin,
            `llave_expansion`= :llave_expansion,
            `extintor`= :extintor,
            `kilometraje_total`= :kilometraje_total,
            `observaciones`= :observaciones,
            `sistema_hidraulico`= :sistema_hidraulico
            WHERE id=:id");

        $stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);
        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor", $datos['idconductor'], PDO::PARAM_INT);
        $stmt->bindParam(":fechaalista", $datos['fechaAlistamiento'], PDO::PARAM_STR);
        $stmt->bindParam(":lucesbajas", $datos['lucesbajas'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesaltas", $datos['lucesaltas'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesreversa", $datos['lucesreversa'], PDO::PARAM_INT);
        $stmt->bindParam(":direccionales_delanteras", $datos['direccionales_delanteras'], PDO::PARAM_INT);
        $stmt->bindParam(":direccionales_traseras", $datos['direccionales_traseras'], PDO::PARAM_INT);
        $stmt->bindParam(":iluminacioncabina", $datos['iluminacioncabina'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesinternas", $datos['lucesinternas'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesmedias", $datos['lucesmedias'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesdestop", $datos['lucesdestop'], PDO::PARAM_INT);
        $stmt->bindParam(":lucesdeparqueo", $datos['lucesdeparqueo'], PDO::PARAM_INT);
        $stmt->bindParam(":luzescala", $datos['luzescala'], PDO::PARAM_INT);
        $stmt->bindParam(":baliza_licuadora", $datos['baliza_licuadora'], PDO::PARAM_INT);
        $stmt->bindParam(":retrovisor_izquierdo", $datos['retrovisor_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":retrovisor_derecho", $datos['retrovisor_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":apoyacabeza_conductor", $datos['apoyacabeza_conductor'], PDO::PARAM_INT);
        $stmt->bindParam(":apoyacabeza_pasajero", $datos['apoyacabeza_pasajero'], PDO::PARAM_INT);
        $stmt->bindParam(":equipoaudio", $datos['equipoaudio'], PDO::PARAM_INT);
        $stmt->bindParam(":claraboya", $datos['claraboya'], PDO::PARAM_INT);
        $stmt->bindParam(":espejointerno", $datos['espejointerno'], PDO::PARAM_INT);
        $stmt->bindParam(":parabrisas", $datos['parabrisas'], PDO::PARAM_INT);
        $stmt->bindParam(":placas", $datos['placas'], PDO::PARAM_INT);
        $stmt->bindParam(":limpiaparabrisas_derecho", $datos['limpiaparabrisas_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":limpiaparabrisas_izquierdo", $datos['limpiaparabrisas_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":piso", $datos['piso'], PDO::PARAM_INT);
        $stmt->bindParam(":bomper_delantero", $datos['bomper_delantero'], PDO::PARAM_INT);
        $stmt->bindParam(":bomper_trasero", $datos['bomper_trasero'], PDO::PARAM_INT);
        $stmt->bindParam(":alarmareversa", $datos['alarmareversa'], PDO::PARAM_INT);
        $stmt->bindParam(":sillas", $datos['sillas'], PDO::PARAM_INT);
        $stmt->bindParam(":antideslizante_escaleras", $datos['antideslizante_escaleras'], PDO::PARAM_INT);
        $stmt->bindParam(":puertas", $datos['puertas'], PDO::PARAM_INT);
        $stmt->bindParam(":claxon", $datos['claxon'], PDO::PARAM_INT);
        $stmt->bindParam(":cinturones_pasajero", $datos['cinturones_pasajero'], PDO::PARAM_INT);
        $stmt->bindParam(":cinturones_conductor", $datos['cinturones_conductor'], PDO::PARAM_INT);
        $stmt->bindParam(":pasamanos_interno", $datos['pasamanos_interno'], PDO::PARAM_INT);
        $stmt->bindParam(":indicador_velocidad", $datos['indicador_velocidad'], PDO::PARAM_INT);
        $stmt->bindParam(":ventaneria", $datos['ventaneria'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_refrigerante", $datos['nivel_refrigerante'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_combustible", $datos['nivel_combustible'], PDO::PARAM_INT);
        $stmt->bindParam(":baterias", $datos['baterias'], PDO::PARAM_INT);
        $stmt->bindParam(":freno_principal", $datos['freno_principal'], PDO::PARAM_INT);
        $stmt->bindParam(":liquido_hidraulico", $datos['liquido_hidraulico'], PDO::PARAM_INT);
        $stmt->bindParam(":estado_correas", $datos['estado_correas'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_liquido_frenos", $datos['nivel_liquido_frenos'], PDO::PARAM_INT);
        $stmt->bindParam(":caja_cambios", $datos['caja_cambios'], PDO::PARAM_INT);
        $stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_aceite", $datos['nivel_aceite'], PDO::PARAM_INT);
        $stmt->bindParam(":freno_emergencia", $datos['freno_emergencia'], PDO::PARAM_INT);
        $stmt->bindParam(":velocimetro", $datos['velocimetro'], PDO::PARAM_INT);
        $stmt->bindParam(":carga_bateria", $datos['carga_bateria'], PDO::PARAM_INT);
        $stmt->bindParam(":presion_aceite", $datos['presion_aceite'], PDO::PARAM_INT);
        $stmt->bindParam(":temperatura", $datos['temperatura'], PDO::PARAM_INT);
        $stmt->bindParam(":combustible", $datos['combustible'], PDO::PARAM_INT);
        $stmt->bindParam(":presion_aire", $datos['presion_aire'], PDO::PARAM_INT);
        $stmt->bindParam(":llantas_delanteras", $datos['llantas_delanteras'], PDO::PARAM_INT);
        $stmt->bindParam(":llantas_traseras", $datos['llantas_traseras'], PDO::PARAM_INT);
        $stmt->bindParam(":cortes", $datos['cortes'], PDO::PARAM_INT);
        $stmt->bindParam(":esparragos", $datos['esparragos'], PDO::PARAM_INT);
        $stmt->bindParam(":profundidad_huella", $datos['profundidad_huella'], PDO::PARAM_INT);
        $stmt->bindParam(":llanta_repuesto", $datos['llanta_repuesto'], PDO::PARAM_INT);
        $stmt->bindParam(":presion_inflado", $datos['presion_inflado'], PDO::PARAM_INT);
        $stmt->bindParam(":abultamientos", $datos['abultamientos'], PDO::PARAM_INT);
        $stmt->bindParam(":reloj_braza", $datos['reloj_braza'], PDO::PARAM_INT);
        $stmt->bindParam(":boca_llanta", $datos['boca_llanta'], PDO::PARAM_INT);
        $stmt->bindParam(":rines", $datos['rines'], PDO::PARAM_INT);
        $stmt->bindParam(":chalecoreflectivo", $datos['chalecoreflectivo'], PDO::PARAM_INT);
        $stmt->bindParam(":linterna", $datos['linterna'], PDO::PARAM_INT);
        $stmt->bindParam(":conos_triangulos", $datos['conos_triangulos'], PDO::PARAM_INT);
        $stmt->bindParam(":tacos_bloques", $datos['tacos_bloques'], PDO::PARAM_INT);
        $stmt->bindParam(":gato", $datos['gato'], PDO::PARAM_INT);
        $stmt->bindParam(":cruceta_copa", $datos['cruceta_copa'], PDO::PARAM_INT);
        $stmt->bindParam(":alicate", $datos['alicate'], PDO::PARAM_INT);
        $stmt->bindParam(":destornilladores", $datos['destornilladores'], PDO::PARAM_INT);
        $stmt->bindParam(":llavesfijas", $datos['llavesfijas'], PDO::PARAM_INT);
        $stmt->bindParam(":botiquin", $datos['botiquin'], PDO::PARAM_INT);
        $stmt->bindParam(":llave_expansion", $datos['llave_expansion'], PDO::PARAM_INT);
        $stmt->bindParam(":extintor", $datos['extintor'], PDO::PARAM_INT);
        $stmt->bindParam(":kilometraje_total", $datos['kilometraje_total'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $stmt->bindParam(":sistema_hidraulico", $datos['sistema_hidraulico'], PDO::PARAM_INT);


        if ($stmt->execute()) {
            $respuesta = $datos['id'];
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }

    /* ===================================================
       LISTA DE EVIDENCIAS
    ===================================================*/
    static public function mdlListaEvidencias($idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare("SELECT e.idevidencia, e.idvehiculo, e.fecha, e.ruta_foto, e.observaciones, e.estado, e.autor AS idautor, u.Nombre AS autor
                                                FROM o_re_alistamientoevidencias e
                                                INNER JOIN v_vehiculos v ON e.idvehiculo = v.idvehiculo
                                                LEFT JOIN l_usuarios u ON u.Cedula = e.autor
                                                WHERE v.idvehiculo = :idvehiculo
                                                ORDER BY e.estado ASC, e.fecha DESC, e.idevidencia DESC");

        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       GUARDAR EVIDENCIA
    ===================================================*/
    static public function mdlGuardarEvidencia($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO `o_re_alistamientoevidencias`(
                                    `idvehiculo`,
                                    `fecha`,
                                    `ruta_foto`,
                                    `observaciones`,
                                    `autor`) 
                                    VALUES (
                                    :idvehiculo,
                                    curdate(),
                                    :ruta_foto,
                                    :observaciones,
                                    :autor)
        ");

        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":ruta_foto", $datos['ruta_foto'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $stmt->bindParam(":autor", $datos['autor'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $respuesta = "ok";
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }

    /* ===================================================
       CAMBIAR ESTADO EVIDENCIA
    ===================================================*/
    static public function mdlActualizarEstado($datos)
    {

        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE `o_re_alistamientoevidencias` SET 
            `estado` = :estado,
            `observaciones` = :observaciones
            WHERE `idevidencia`=:idevidencia");

        $stmt->bindParam(":idevidencia", $datos['idevidencia'], PDO::PARAM_INT);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);


        if ($stmt->execute()) {
            $respuesta = "ok";
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }
}

class ModeloRodamiento
{
    static public function mdlAgregarRodamiento($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO o_rodamiento(idvehiculo,idconductor,idcliente,idruta,h_inicio,h_final,kmrecorridos,cantidad_pasajeros,tipo_servicio,fecha_servicio)
                                                VALUES(:idvehiculo,:idconductor,:idcliente,:idruta,:h_inicio,:h_final,:kmrecorridos,:cantidad_pasajeros,:tipo_servicio,:fecha_servicio)");

        $stmt->bindParam(":idvehiculo", $datos["vehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor", $datos["conductor"], PDO::PARAM_INT);
        $stmt->bindParam(":idcliente", $datos["cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":idruta", $datos["ruta"], PDO::PARAM_INT);
        $stmt->bindParam(":h_inicio", $datos["h_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":h_final", $datos["h_final"], PDO::PARAM_STR);
        $stmt->bindParam(":kmrecorridos", $datos["kmrecorrido"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad_pasajeros", $datos["cantidad_pasa"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_servicio", $datos["tipo_serv"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_servicio", $datos["fecha_serv"], PDO::PARAM_STR);


        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEditarRodamiento($datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE o_rodamiento set idvehiculo = :idvehiculo, idconductor = :idconductor, idcliente = :idcliente, idruta = :idruta, h_inicio = :h_inicio, h_final = :h_final, kmrecorridos = :kmrecorridos, cantidad_pasajeros = :cantidad_pasajeros, tipo_servicio = :tipo_servicio, fecha_servicio = :fecha_servicio
                                               WHERE id = :id");

        $stmt->bindParam(":id", $datos["id_rodamiento"], PDO::PARAM_INT);
        $stmt->bindParam(":idvehiculo", $datos["vehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor", $datos["conductor"], PDO::PARAM_INT);
        $stmt->bindParam(":idcliente", $datos["cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":idruta", $datos["ruta"], PDO::PARAM_INT);
        $stmt->bindParam(":h_inicio", $datos["h_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":h_final", $datos["h_final"], PDO::PARAM_STR);
        $stmt->bindParam(":kmrecorridos", $datos["kmrecorrido"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad_pasajeros", $datos["cantidad_pasa"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_servicio", $datos["tipo_serv"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_servicio", $datos["fecha_serv"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlListarRodamientos($value)
    {

        if ($value != null) {

            $stmt = Conexion::conectar()->prepare("SELECT r.*, 
                                                        v.placa, v.numinterno, v.modelo, v.capacidad, v.tipovinculacion,
                                                        m.marca AS marca,
                                                        p.Nombre AS conductor,
                                                        c.nombre AS cliente,
                                                        CONCAT(mu.municipio, '-', mu2.municipio) AS ruta,
                                                        mu.municipio AS origen,
                                                        mu2.municipio AS destino,
                                                        ru.nombreruta AS descripcion 
                                                    FROM o_rodamiento r
                                                    INNER JOIN v_vehiculos v ON v.idvehiculo = r.idvehiculo
                                                    LEFT JOIN v_marcas m ON m.idmarca = v.idmarca
                                                    INNER JOIN gh_personal p ON p.idPersonal = r.idconductor
                                                    INNER JOIN cont_clientes c ON c.idcliente = r.idcliente
                                                    INNER JOIN v_rutas ru ON ru.id = r.idruta
                                                    INNER JOIN gh_municipios mu ON mu.idmunicipio = ru.idorigen
                                                    INNER JOIN gh_municipios mu2 ON mu2.idmunicipio = ru.iddestino
                                                    WHERE r.id = :id");

            $stmt->bindParam(":id", $value, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT r.*, 
                                                        v.placa, v.numinterno, v.modelo, v.capacidad, v.tipovinculacion,
                                                        m.marca AS marca,
                                                        p.Nombre AS conductor,
                                                        c.nombre AS cliente, 
                                                        CONCAT(mu.municipio, '-', mu2.municipio) AS ruta,
                                                        mu.municipio AS origen,
                                                        mu2.municipio AS destino,
                                                        ru.nombreruta AS descripcion 
                                                    FROM o_rodamiento r
                                                    INNER JOIN v_vehiculos v ON v.idvehiculo = r.idvehiculo
                                                    LEFT JOIN v_marcas m ON m.idmarca = v.idmarca
                                                    INNER JOIN gh_personal p ON p.idPersonal = r.idconductor
                                                    INNER JOIN cont_clientes c ON c.idcliente = r.idcliente
                                                    INNER JOIN v_rutas ru ON ru.id = r.idruta
                                                    INNER JOIN gh_municipios mu ON mu.idmunicipio = ru.idorigen
                                                    INNER JOIN gh_municipios mu2 ON mu2.idmunicipio = ru.iddestino
                                                    WHERE r.estado = 1");
            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEliminarRodamiento($id)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE o_rodamiento set estado = 0
                                               WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }
}
