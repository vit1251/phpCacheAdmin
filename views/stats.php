<table>
<thead>
    <tr>
        <th align="left"><?php echo I18n::get('server.status.name') ?></th>
        <th align="right"><?php echo I18n::get('server.status.value') ?></th>
    </tr>
</thead>
<tbody>
<?php foreach($info as $key => $value): ?>
<tr>
    <td><?php echo I18n::get('memcache.stats.' . $key) ?> (<?php echo $key ?>):
    <td align="right"><?php echo ctype_digit( $value ) ? number_format ( $value, 0 , '.' , ' ' ) : $value ?>
</tr>
<?php endforeach ?>
</tbody>
</table>
