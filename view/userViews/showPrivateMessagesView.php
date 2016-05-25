<?php

	function showPrivateMessagesView($privateMessages) {

		if ($privateMessages == null) {
			?>

			<div id="privateMessageBlock" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div id="elementsMessageContainer" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="contentMessage content-message-error col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class='no-message'>Actualmente tu bandeja de entrada está vacía.
							<i class='fa fa-frown-o' aria-hidden='true'></i>
						</div>
						<p class='no-message'>¿Y si pruebas enviándole un mensaje a alguien?</p>
					</div>
				</div>
			</div>

			<?php

		} else {		
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
								<?php echo ($privateMessages[$x]['Date']); ?>
							</div>
						</div>
						<div class="contentMessage col-xs-9 col-sm-9 col-md-9 col-lg-9">
							<?php echo utf8_encode($privateMessages[$x]['Content']); ?>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <a href="sendPrivateMessageView.php?receiverName=<?php echo $privateMessages[$x]['Username'];?>" id="answerMessageButton" class="button-green pull-right btn form-button" role="button">
                                <i class="fa fa-reply" aria-hidden="true"></i>
                                Responder
                            </a>
                        </div>
					</div>
				</div>

				<?php
			}
		}
	}
?>