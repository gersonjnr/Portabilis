<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<style type="text/css">
	hr { border: 2px solid #E7E7E7; }
</style>

<body>

<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td>&nbsp;</td>
	<td><!--<img src="<?=$webroot .'img/topo_email.jpg'?>" alt="<?=Configure::read( 'site_title' )?>" width="600" height="132" /></td>
	<td>&nbsp;--></td>
</tr>

<?php if( isset( $emailTitulo ) ) : ?>
<tr>
	<td>&nbsp;</td>
	<td width="600"><font face="Arial, Helvetica, Verdana, sans-serif" size="4"><b><?=$emailTitulo?></b></font></td>
	<td>&nbsp;</td>
</tr>
<?php endif; ?>

<tr>
	<td>&nbsp;</td>
	<td align="left" width="600">

		<br /><br />
		<font face="Arial, Helvetica, Verdana, sans-serif" size="2" color="#666666">

		<?php echo $content_for_layout; ?>

		<br />
		<br />

		</font>

	</td>
	<td>&nbsp;</td>
</tr>

</table>
</body>
</html>