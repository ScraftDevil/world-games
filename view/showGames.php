<?php
 function showGames($list) {
            ?>
            <table class="showAll">
				<tr>
					<th>Title</th>
					<th>Price</th>
					<th>Stock</th>
				</tr>
            <?php
            for ($i = 0; $i < count($list); $i++) {
				?>
				<tr>
					<td><?php echo $list[$i][0]?></td>
					<td>2</td>
					<td>3</td>
				</tr>
				<?php
            }
            if (count($list)==0)
            {
            	?>
            	<td colspan='9'><font color='blue'>Sorry, any game for show.</font></td>
            	<?php
            }
            ?>
            </table>
            <?php
        }
?>