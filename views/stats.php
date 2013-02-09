<table>
<?php foreach($info as $key => $value): ?>
<tr>
    <td><?php echo I18n::get('memcache.stats.' . $key) ?> (<?php echo $key ?>):
    <td align="right"><?php echo ctype_digit( $value ) ? number_format ( $value, 0 , '.' , ' ' ) : $value ?>
</tr>
<?php endforeach ?>
</table>
