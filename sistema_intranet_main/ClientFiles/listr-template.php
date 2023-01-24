<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../A1XRXS_sys/xrxs_configuracion/config.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<?php echo $header?>
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/theme_color_<?php if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])&&$_SESSION['usuario']['basic_data']['Config_idTheme']!=''){echo $_SESSION['usuario']['basic_data']['Config_idTheme'];}else{echo '1';} ?>.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIB_assets/css/my_colors.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/my_corrections.css">
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>body {background-color: #FFF!important;}</style>
	</head>
	<body <?php echo $body_style.$direction?>>
	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">
			<?php echo $breadcrumbs?>
			<?php echo $search ?>
		</div>
		<div class="clearfix"></div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="box">
					<header>
						<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Archivos</h5>
					</header>
					<div class="table-responsive">
						<table id="bs-table" class="table <?php echo $options['bootstrap']['table_style']?>">
							<thead>
								<tr>
									<?php echo $table_header?>
								</tr>
							</thead>
							<?php if($options['bootstrap']['sticky_footer'] !== true) { ?>
								<tfoot>
									<tr>
										<td colspan="<?php echo $table_count+1?>">
											<small class="pull-<?php echo $left?> text-muted" dir="ltr"><?php echo $summary?></small>
										</td>
									</tr>
								</tfoot>
							<?php } ?>
							<tbody>
								<?php echo $table_body?>
							</tbody>                          
						</table>
					</div>
				</div>
			</div>
		
		
			
			<?php if ($options['general']['enable_viewer']) { ?>
				<div class="modal fade" id="viewer-modal" tabindex="-1" role="dialog" aria-labelledby="file-name" aria-hidden="true">
					<div class="modal-dialog <?php echo $modal_size ?>">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close pull-<?php echo $right?>" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title text-<?php echo $left?>" id="file-name">&nbsp;</h4>
								<small class="text-muted" id="file-meta"></small>
							</div>
							<div class="modal-body"></div>
							<div class="modal-footer">
								<?php if (($options['general']['enable_highlight'])){ ?>
								<div class="pull-<?php echo $left?>">
									<button type="button" class="btn <?php echo $btn_highlight ?> highlight hidden"><?php echo _('Apply syntax highlighting')?></button>
								</div>
								<?php } ?>
								<div class="pull-<?php echo $right?>">
									<button type="button" class="btn <?php echo $btn_default ?>" data-dismiss="modal"><?php echo _('Cerrar')?></button>
									<?php if ($options['general']['share_button']) { ?>
										<div class="btn-group">
											<a href="#" class="btn <?php echo $btn_primary ?> fullview" download><?php echo _('Download')?></a>
											<button type="button" class="btn <?php echo $btn_primary ?> dropdown-toggle" data-toggle="dropdown">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<?php if ($options['keys']['dropbox'] !== null ) { ?>
													<li role="presentation"><a role="menuitem" class="save-dropbox"><?php echo $icons_dropbox._('Guardar en Dropbox')?></a></li>
													<li role="presentation" class="divider"></li>
												<?php } ?>
												<li role="presentation"><a role="menuitem" class="email-link"><?php echo $icons_email ?>Email</a></li>
												<li role="presentation"><a role="menuitem" class="facebook-link"><?php echo $icons_facebook ?>Facebook</a></li>
												<li role="presentation"><a role="menuitem" class="google-link"><?php echo $icons_gplus ?>Google+</a></li>
												<li role="presentation"><a role="menuitem" class="twitter-link"><?php echo $icons_twitter ?>Twitter</a></li>
											</ul>
										</div>
									<?php } else { ?>
										<a href="#" class="btn <?php echo $btn_primary ?> fullview" download><?php echo _('Descargar')?></a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		
		
		
		<?php echo $footer?>
		<?php if($options['bootstrap']['sticky_footer'] === true) { ?>
			<footer class="footer">
				<div class="container">
					<small class="pull-<?php echo $left?> text-muted" dir="ltr"><?php echo $summary ?></small>
					<?php echo $kudos?>
				</div>
			</footer>
		<?php } ?>
	</body>
</html>
