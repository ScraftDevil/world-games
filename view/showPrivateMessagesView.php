<?php

	function showPrivateMessagesView($privateMessages) {
		
		for ($x = 0; $x < count($privateMessages); $x++) {

			?> 

			<div id="privateMessageBlock" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div id="elementsMessageContainer" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div id="infoMessage" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<span class="glyphicon glyphicon-user"></span>
							Enviado por: 
							<span id="senderName"><?php echo $privateMessages[$x]['Username']; ?></span>
						</div>

						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<span class="glyphicon glyphicon-time"></span>
							<?php echo date('d-m-Y H:m:s', strtotime($privateMessages[$x]['Date'])); ?>
						</div>
					</div>
					<div class="contentMessage">
						<?php echo utf8_encode($privateMessages[$x]['Content']); ?>
					</div>
				</div>
			</div>

			<?php
		}
	}
?>