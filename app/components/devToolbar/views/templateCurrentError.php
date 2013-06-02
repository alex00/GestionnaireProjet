<div id="dialog" style="display:none;">
	<div class="modal-body">
		<?php $arrayError 	= tzErrorCore::getTemplateError(); ?>
		<?php $arrayCode 	= tzErrorCore::getTemplateCodePhp(); ?>
		<?php 
			for ($i=0; $i < count($arrayError); $i++) { 
				print $arrayError[$i];
				print $arrayCode[$i];
			}
		 ?>
	</div>
</div>