<?php

$main_template_content = '

	<div class="panel panel-default center" style="width: 100%;">

		<div class="panel-heading">

			<h3 class="panel-title">
				<img src="img/32x32/webmaster_tools.png" alt="admin panel" />
				Admin Dashboard
			</h3>
			
		</div>
                   '.$this->show_message().'
		<div class="panel-body">

			<div class="form-group">
			'
				.$this->get_content().
			'
			</div>

		</div>

		<div class="panel-footer" style="text-align: center;">

			<table align="center">
				<tr>
					<td class="MsgButtons">
						<form action="index.php?route=logout" method="post" role="form">
							<button type="submit" value="Wyloguj" name="logout" class="btn btn-danger">Logout</button>
						</form>
					</td>
					<td class="MsgButtons">
						<form action="index.php" method="post" role="form">
							<button type="submit" value="Zamknij" name="close" class="btn btn-warning">Cancel</button>
						</form>
					</td>
				</tr>
			</table>

		</div>

	</div>

	

';

?>

