<div class="tiitz">

<?php
	include 'templateLog.php';
	include 'templateCurrentError.php';
?>
<footer id="tiitz-toolbar" style="display:none;">
	<a class="close" data-dismiss="alert" href="#">&times;</a>
	<div class="navbar">
	  	<div class="navbar-inner">
	  		<ul class="nav">
				<li>	
					<a class="brand" href="#">
						<img src="<?php print WEB_PATH; ?>/tiitz/img/logo-tiitz-mini.png" id="tiitz-logo" /> <span id="tiitz-version">0.1</span>
					</a>
					<ul id="toolbar-tiitz-info" class="tiitz-toolbar-info">
						<li>
							<div id="toolbar-tiitz-version" class="tiitz-toolbar-info">
							   	<ul>
							   		<li>
							   			<div id="toolbar-photo">
							   				<a href="https://plus.google.com/communities/102794938632806435828">
							   					<img src="<?php print WEB_PATH; ?>/tiitz/img/toolbar-tiitz.png" alt="Tiitz Official Website" />
							   				</a>	
							   			</div>
							   			<div id="toolbar-content">
							   				<div id="toolbar-header">
							   					<h2><a href="https://plus.google.com/communities/102794938632806435828">Site Officiel</a></h2>
							   				</div>
							   				<div id="toolbar-text">
							   					<p>
							   						Documentation, Actualit&eacute;s, Get Started, Tutoriaux, Pluggins, Interviews etc.
							   					</p>
							   				</div>
							   			</div>
							   			<br class="toolbar-clear" />
							   		</li>
							   		<li>
							   			<div id="toolbar-photo">
							   				<a href="https://plus.google.com/communities/102794938632806435828">
							   					<img src="<?php print WEB_PATH; ?>/tiitz/img/toolbar-google-community.png" alt="google+" />
							   				</a>
							   			</div>
							   			<div id="toolbar-content">
							   				<div id="toolbar-header">
							   					<h2><a href="https://plus.google.com/communities/102794938632806435828">Google Communaut&eacute;</a></h2>
							   				</div>
							   				<div id="toolbar-text">
							   					<p>
							   						Toutes l'actualit&eacute;s de la communaut&eacute; de Tiitz (News, Bugs, Tutoriaux etc.)
							   					</p>
							   				</div>
							   			</div>
							   			<br class="toolbar-clear" />
							   		</li>
							   		<li>
							   			<div id="toolbar-photo">
							   				<a href="https://groups.google.com/forum/?fromgroups=#!forum/tiitz-framework">
							   					<img src="<?php print WEB_PATH; ?>/tiitz/img/toolbar-google-groups.jpeg" alt="google groups" />
							   				</a>
							   			</div>
							   			<div id="toolbar-content">
							   				<div id="toolbar-header">
							   					<h2><a href="https://groups.google.com/forum/?fromgroups=#!forum/tiitz-framework">Support Technique</a></h2>
							   				</div>
							   				<div id="toolbar-text">
							   					<p>
							   						Google Groupe. Vous avez une interrogation? un problème ? Venez nous en parler.
							   					</p>
							   				</div>
							   			</div>
							   			<br class="toolbar-clear" />
							   			
							   		</li>
							   		<li>
							   			<div id="toolbar-photo">
							   				<a href="https://github.com/epok75/tiitz">
							   					<img src="<?php print WEB_PATH; ?>/tiitz/img/toolbar-github.jpg" alt="Github" />
							   				</a>
							   			</div>
							   			<div id="toolbar-content">
							   				<div id="toolbar-header">
							   					<h2><a href="https://github.com/epok75/tiitz">Source / Report</a></h2>
							   				</div>
							   				<div id="toolbar-text">
							   					<p>
							   						Consultez, t&eacute;l&eacute;chargez les sources officielles du framework Tiitz.
							   					</p>
							   				</div>
							   			</div>
							   			<br class="toolbar-clear" />
							   		</li>
							   	</ul>
							</div>
						</li>	
					</ul>	
				</li>
				<li class="divider-vertical"></li>
			   	<li><a href="#"><strong>PHP : </strong><?php echo phpversion(); ?></a>
			   		<ul id="toolbar-php-version" class="tiitz-toolbar-info">
			   			<li>
			   				<div>
			   					<h2>Configuration php.ini</h2>
			   					<ul id="toolbar-php-version-detail">
			   						<li>
			   							<div>
			   								<h3>Sécurités</h3>
			   								<ul>
			   									<li><strong>allow_url_fopen : </strong> <?php $ini['allow_url_fopen'] == 1 ? print '<span style="color:red;">True</span>' : print 'False'; ?></li>
			   									<li>
			   										<strong>register_globals : </strong>
			   										<?php  ini_get('register_globals') ? print ini_get('register_globals') : print 'Supprimé<sup>*</sup>'; ?>
			   									</li>
			   									<li>
			   										<strong>magic_quotes_gpc : </strong>
			   										<?php ini_get('magic_quotes_gpc') ? print ini_get('magic_quotes_gpc') : print 'Supprimé<sup>*</sup>';  ?>
			   									</li>
			   									<li>
			   										<strong>open_basedir : </strong>
			   										<?php echo ini_get('open_basedir'); ?></li>
			   									<li>
			   										<strong>safe_mode : </strong>
			   										<?php ini_get('safe_mode') ? print ini_get('safe_mode') : print 'Supprimé<sup>*</sup>'; ?>
			   									</li>
			   								</ul>
			   							</div>
			   						</li>
			   						<li>
			   							<div>
			   								<h3>Upload</h3>
			   								<ul>
			   									<li><strong>file_uploads : </strong><?php echo $ini['file_uploads']; ?></li>
			   									<li><strong>max_file_uploads : </strong><?php echo $ini['max_file_uploads']; ?></li>
			   									<li><strong>upload_max_filesize : </strong><?php echo $ini['upload_max_filesize']; ?></li>
			   									<li><strong>upload_tmp_dir : </strong><?php echo $ini['upload_tmp_dir']; ?></li>
			   									<li><strong>post_max_size : </strong><?php echo $ini['post_max_size']; ?></li>
			   								</ul>
			   							</div>
			   						</li>
			   						<li>
			   							<div>
			   								<h3>Performances / Divers</h3>
			   								<ul>
			   									<li><strong>memory_limit : </strong><?php echo $ini['memory_limit']; ?></li>
			   									<li><strong>max_execution_time : </strong><?php echo $ini['max_execution_time']; ?></li>
			   									<li><strong>session.gc_maxlifetime : </strong>  <?php echo $ini['session.gc_maxlifetime']; ?></li>
			   									<li><strong>short_open_tag : </strong><?php $ini['short_open_tag'] == 1 ? print '<span style="color:red;">True</span>' : print 'False';; ?></li>
			   								</ul>
			   							</div>
			   						</li>	
			   						<br class="clear" />		   						
			   					</ul>
			   					<i>* Supprim&eacute; depuis la version 5.4 de php</i>
			   				</div>
			   			</li>
			   		</ul>
			   	</li>
			   	<li class="divider-vertical"></li>
			   	<li><a href="#">Configuration</a>
					<ul id="toolbar-config" class="tiitz-toolbar-info">
			   			<li>
			   				<div>
			   					<ul>
			   						<li><strong>Base de donn&eacute;es </strong>: <?php isset($conf['database']['dbname']) && !empty($conf['database']['dbname']) ? print $conf['database']['dbname'] : print 'none'; ?></li>
			   						<li><strong>Moteur de template </strong>: <?php isset($conf['template']) ? print $conf['template'] : print 'php'; ?></li>
			   						<li><strong>Environnement </strong>: <?php isset($conf['environnement']) ? print $conf['environnement']: print ''; ?></li>
			   						<li><strong>Langue </strong>: <?php isset($conf['language']) ? print $conf['language'] : print ''; ?></li>
			   						<li><strong>Route </strong>: <?php isset($conf['routingType']) ? print $conf['routingType'] : print ''; ?></li>
			   					</ul>
			   				</div>
			   			</li>
			   		</ul>
			   	</li>
			   	<li class="divider-vertical"></li>
			   	<li><a href="#"><?php isset($route['className']) ? print $route['className']:''; ?> : <?php isset($route['action']) ? print $route['action']:''; ?></a>
					<ul id="toolbar-file-controller" class="tiitz-toolbar-info">
			   			<li>
			   				<div>
			   					<ul>
			   						<li><strong>Controller </strong>: <?php isset($route['className']) ? print $route['className']:''; ?></li>
			   						<li><strong>Method </strong>: <?php isset($route['action']) ? print $route['action']:''; ?></li>
			   						<li><strong>Path </strong>: <?php isset($route['path']) ? print $route['path']:''; ?></li>
			   					</ul>
			   				</div>
			   			</li>
			   		</ul>
			   	</li>
			   	<?php if (count($errorArray) > 0 ) : ?>
			   	<li class="divider-vertical"></li>
			   	<li>
			   		<button id="opener-log" class="btn">Fichiers de logs (<?php print count($errorArray) ?>)</button>
			 	</li>
			 	<?php endif; ?>	
			   	<?php if(!empty($conf['database']['dbname'])) : ?>
			   	<li class="divider-vertical"></li>
			   	<li>
			   		<a href="<?php print WEB_PATH; ?>/configTiitz/entityGenerator">Cr&eacute;er vos entit&eacute;es</a>
				</li>
				<?php endif; ?>
				<li class="divider-vertical"></li>
			   	<li>
			   		<?php if (tzErrorCore::getNumberOfCurrentError() == 1) : ?>
			   			<button id="opener-error" class="btn btn-danger">1 nouvelle erreur</button>
			   			
			   		<?php elseif (tzErrorCore::getNumberOfCurrentError() > 1) : ?>
			   			<button id="opener-error" class="btn btn-danger"><?php print tzErrorCore::getNumberOfCurrentError(); ?> nouvelles erreurs</button>
			   			
			   		<?php endif; ?>
			   	</li>
				
			</ul>
		</div>
	</div>
<script>
	// check if jquery is load and insert bootstrap.js
	function checkAndLoadjQueryUI() {
		
		var scriptUI = document.createElement('script');
	  	scriptUI.type = "text/javascript";
	   	scriptUI.src = "<?php print WEB_PATH;?>/tiitz/js/jquery-ui-1.10.0.custom.js";
	   	document.getElementsByTagName('head')[0].appendChild(scriptUI);
		
	}
	function loadCSS() {
			// bootstrap 
			var link = document.createElement('link');
		  	link.type = "text/css";
		  	link.rel = "stylesheet";
		   	link.href = "<?php print WEB_PATH;?>/tiitz/css/bootstrap.css";
		   	document.getElementsByTagName('head')[0].appendChild(link);
		   	// style toolbar - error
		   	var linkToolbar = document.createElement('link');
		  	linkToolbar.type = "text/css";
		  	linkToolbar.rel = "stylesheet";
		   	linkToolbar.href = "<?php print WEB_PATH;?>/tiitz/css/style-toolbar-error.css";
		   	document.getElementsByTagName('head')[0].appendChild(linkToolbar);
		   	// change footer visibilty
		   	$("#tiitz-toolbar").fadeIn(800);
	}
	
   	if(!window.jQuery)
	{
	   var script = document.createElement('script');
	   script.type = "text/javascript";
	   script.src = "<?php print WEB_PATH;?>/tiitz/js/jquery-1.9.0.min.js";
	   document.getElementsByTagName('head')[0].appendChild(script);
	   
	}	
	checkAndLoadjQueryUI(); 

	window.onload = function () {
	
		loadCSS();
		
		$(".close").click(function(){
			$("#tiitz-toolbar").hide();
		});

		$( "#dialog" ).dialog(
			{ 
				autoOpen: false, 
			  	width : 960,
			  	height: 500, 
			  	title: "Tittz Error"		
			}
		);
		$( "#opener-log" ).click(function() {
			$( "#myLogError" ).dialog( "open" );
		});

		$( "#myLogError" ).dialog(
			{ 
				autoOpen: false, 
			  	width : 960, 
			  	height: 500,
			  	title: "Log error"		
			}
		);

		$( "#opener-error" ).click(function() {
			$( "#dialog" ).dialog( "open" );
		});

		
	}
</script>
</footer>
</div>

