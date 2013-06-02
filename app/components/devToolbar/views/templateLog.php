<div id="myLogError" style="display:none;font-size: 13px!important;">
	<div class="modal-body">
		<?php for ($i=0; $i < count($errorArray); $i++) : ?> 
  		<div <?php ($i%2 == 0) ? print "class='odd'" : print "class='even'" ?>>
  			<p><strong>Date </strong>: <?php print $errorArray[$i]['date']; ?> | <strong>Num&eacute;ro erreur </strong>: <?php print $errorArray[$i]['type']; ?></p>
  			<p><strong>Message </strong>: <?php print $errorArray[$i]['message']; ?></p>
  			<p><strong>File </strong>: <?php print $errorArray[$i]['file']; ?> | <strong>Ligne </strong>: <?php print $errorArray[$i]['line']; ?></p>
  		</div>		
  	<?php endfor ?>
	</div>
</div>