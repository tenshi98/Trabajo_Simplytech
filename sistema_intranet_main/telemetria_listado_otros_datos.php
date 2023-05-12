<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion original
$original = "telemetria_listado.php";
$location = $original;
$new_location = "telemetria_listado_otros_datos.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//se agregan ubicaciones
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// consulto los datos
$SIS_query = 'Nombre,id_Geo, id_Sensores,Capacidad, CrossCrane_tiempo_revision, CrossCrane_grupo_amperaje,
CrossCrane_grupo_elevacion, CrossCrane_grupo_giro, CrossCrane_grupo_carro,CrossCrane_grupo_voltaje,
CrossCrane_grupo_motor_subida, CrossCrane_grupo_motor_bajada, idGrupoDespliegue,idGrupoVmonofasico,
idGrupoVTrifasico, idGrupoPotencia, idGrupoConsumoMesHabil, idGrupoConsumoMesCurso,idGrupoEstanque,
idGenerador, idTelGenerador, FechaInsGen, idUbicacion';
$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado', '', 'idTelemetria ='.$_GET['id'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//Verifico el tipo de usuario que esta ingresando
$w = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND telemetria_listado.idEstado=1";
$w.= " AND telemetria_listado.idTab=9";//CrossEnergy
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Equipo', $rowdata['Nombre'], 'Editar Otros Datos'); ?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'telemetria_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<?php if($rowdata['id_Sensores']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_alarmas_perso.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bullhorn" aria-hidden="true"></i> Alarmas Personalizadas</a></li>
						<?php } ?>
						<?php if($rowdata['id_Geo']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_gps.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-marker" aria-hidden="true"></i> Datos GPS</a></li>
						<?php } elseif($rowdata['id_Geo']==2){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_direccion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-signs" aria-hidden="true"></i> Direccion</a></li>
						<?php } ?>
						<?php if($rowdata['id_Sensores']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_parametros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Sensores</a></li>
							<li class=""><a href="<?php echo 'telemetria_listado_sensor_operaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Definicion Operacional</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Imagen</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_trabajo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-clock-o" aria-hidden="true"></i> Jornada Trabajo</a></li>
						<li class="active"><a href="<?php echo 'telemetria_listado_otros_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-archive" aria-hidden="true"></i> Otros Datos</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_script.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-code" aria-hidden="true"></i> Scripts</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_archivos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivos</a></li>

					</ul>
                </li>
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter" style="padding-top:40px;margin-bottom: 400px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($Capacidad)){                      $x1  = $Capacidad;                        }else{$x1  = Cantidades_decimales_justos($rowdata['Capacidad']);}
					if(isset($CrossCrane_tiempo_revision)){     $x2  = $CrossCrane_tiempo_revision;       }else{$x2  = $rowdata['CrossCrane_tiempo_revision'];}
					if(isset($CrossCrane_grupo_amperaje)){      $x3  = $CrossCrane_grupo_amperaje;        }else{$x3  = $rowdata['CrossCrane_grupo_amperaje'];}
					if(isset($CrossCrane_grupo_elevacion)){     $x4  = $CrossCrane_grupo_elevacion;       }else{$x4  = $rowdata['CrossCrane_grupo_elevacion'];}
					if(isset($CrossCrane_grupo_giro)){          $x5  = $CrossCrane_grupo_giro;            }else{$x5  = $rowdata['CrossCrane_grupo_giro'];}
					if(isset($CrossCrane_grupo_carro)){         $x6  = $CrossCrane_grupo_carro;           }else{$x6  = $rowdata['CrossCrane_grupo_carro'];}
					if(isset($CrossCrane_grupo_voltaje)){       $x7  = $CrossCrane_grupo_voltaje;         }else{$x7  = $rowdata['CrossCrane_grupo_voltaje'];}
					if(isset($CrossCrane_grupo_motor_subida)){  $x8  = $CrossCrane_grupo_motor_subida;    }else{$x8  = $rowdata['CrossCrane_grupo_motor_subida'];}
					if(isset($CrossCrane_grupo_motor_bajada)){  $x9  = $CrossCrane_grupo_motor_bajada;    }else{$x9  = $rowdata['CrossCrane_grupo_motor_bajada'];}
					if(isset($idGrupoDespliegue)){              $x10 = $idGrupoDespliegue;                }else{$x10 = $rowdata['idGrupoDespliegue'];}
					if(isset($idGrupoVmonofasico)){             $x11 = $idGrupoVmonofasico;               }else{$x11 = $rowdata['idGrupoVmonofasico'];}
					if(isset($idGrupoVTrifasico)){              $x12 = $idGrupoVTrifasico;                }else{$x12 = $rowdata['idGrupoVTrifasico'];}
					if(isset($idGrupoPotencia)){                $x13 = $idGrupoPotencia;                  }else{$x13 = $rowdata['idGrupoPotencia'];}
					if(isset($idGrupoConsumoMesHabil)){         $x14 = $idGrupoConsumoMesHabil;           }else{$x14 = $rowdata['idGrupoConsumoMesHabil'];}
					if(isset($idGrupoConsumoMesCurso)){         $x15 = $idGrupoConsumoMesCurso;           }else{$x15 = $rowdata['idGrupoConsumoMesCurso'];}
					if(isset($idGrupoEstanque)){                $x16 = $idGrupoEstanque;                  }else{$x16 = $rowdata['idGrupoEstanque'];}
					if(isset($idTelGenerador)){                 $x17 = $idTelGenerador;                   }else{$x17 = $rowdata['idTelGenerador'];}
					if(isset($FechaInsGen)){                    $x18 = $FechaInsGen;                      }else{$x18 = $rowdata['FechaInsGen'];}
					if(isset($idUbicacion)){                    $x19 = $idUbicacion;                      }else{$x19 = $rowdata['idUbicacion'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_tittle(3, 'Crosschecking');
					$Form_Inputs->form_input_number('Capacidad Nebulizador','Capacidad', $x1, 1);

					$Form_Inputs->form_tittle(3, 'CrossCrane Gruas');
					$Form_Inputs->form_time('Hora Revision','CrossCrane_tiempo_revision', $x2, 1, 1);
					$Form_Inputs->form_select('Grupo Alimentacion','CrossCrane_grupo_amperaje', $x3, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select('Grupo Elevacion','CrossCrane_grupo_elevacion', $x4, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select('Grupo Giro','CrossCrane_grupo_giro', $x5, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select('Grupo Carro','CrossCrane_grupo_carro', $x6, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select('Grupo Voltaje','CrossCrane_grupo_voltaje', $x7, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);

					$Form_Inputs->form_tittle(3, 'CrossCrane Ascensores');
					$Form_Inputs->form_select('Grupo Amperaje Motor Subida','CrossCrane_grupo_motor_subida', $x8, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select('Grupo Amperaje Motor Bajada','CrossCrane_grupo_motor_bajada', $x9, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);

					$Form_Inputs->form_tittle(3, 'CrossEnergy');
					$Form_Inputs->form_post_data(2,1,1, '<strong>Grupos a Desplegar: </strong>Permite seleccionar los grupo de sensores a desplegar en el grafico de CrossEnergy.' );
					$Form_Inputs->form_select_filter('Grupo Despliegue','idGrupoDespliegue', $x10, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select_filter('Grupo V monofasico','idGrupoVmonofasico', $x11, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select_filter('Grupo V Trifasico','idGrupoVTrifasico', $x12, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select_filter('Grupo Potencia','idGrupoPotencia', $x13, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select_filter('Grupo Consumo Mes Habil','idGrupoConsumoMesHabil', $x14, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select_filter('Grupo Consumo Mes Curso','idGrupoConsumoMesCurso', $x15, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);
					$Form_Inputs->form_select_filter('Grupo Estanque Combustible','idGrupoEstanque', $x16, 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);

					//Si esta activo el uso del generador
					$Form_Inputs->form_tittle(3, 'CrossCrane Gruas');
					if(isset($rowdata['idGenerador'])&&$rowdata['idGenerador']==1){
						$Form_Inputs->form_post_data(2,1,1, '<strong>Uso Generador: </strong>Indica si la alimentacion electrica es directa o por generador, despliega una lista de equipos de telemetria configurados con el tab de <strong>CrossE</strong>, esto genera un boton en el widget principal.' );
						$Form_Inputs->form_select_filter('Generador','idTelGenerador', $x17, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);
						$Form_Inputs->form_date('Fecha Instalacion Generador','FechaInsGen', $x18, 1);
					}
					$Form_Inputs->form_post_data(2,1,1, '<strong>Ubicacion: </strong>Determina si el equipo esta en la planta de mantencion o en una obra.' );
					$Form_Inputs->form_select('Ubicacion Equipo','idUbicacion', $x19, 1, 'idUbicacion', 'Nombre', 'core_telemetria_ubicaciones', 0, '', $dbConn);

					$Form_Inputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					</div>
				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
