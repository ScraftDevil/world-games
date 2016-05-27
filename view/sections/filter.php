<div class="col-md-12 col-xs-12">
	<div class="dropdown pull-right">
		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Genero
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<?php
				include("../../controller/gameControllers/getGenresGamesController.php");
				foreach($genres as $genre) {
					echo '<li><a href="#" class="genreFilter" id="'.$genre->getName().'">'.$genre->getName().'</a></li>';
				}
			?>
		</ul>
	</div>
	<div class="dropdown pull-left">
		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="hidden-xs">Plataforma</span><span class="visible-xs col-xs-12" style="padding-left:0px">Pla.</span>
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<?php
				include("../../controller/gameControllers/getPlatformsGamesController.php");
				foreach($platforms as $platform) {
					echo ' <li><a href="#" class="platformFilter" id="'.$platform->getName().'">'.$platform->getName().'</a></li>';
				}
			?>
		</ul>
	 </div>
 </div>