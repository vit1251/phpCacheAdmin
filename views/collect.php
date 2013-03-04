<table class="table table-hover table-condensed">
<thead>
	<th align="left"><?php echo I18n::get('server.nodes.name') ?></th>
	<th align="center"><?php echo I18n::get('server.nodes.slab') ?></th>
	<th align="right"><?php echo I18n::get('server.nodes.size') ?></th>
	<th align="right"><?php echo I18n::get('server.nodes.date_expire') ?></th>
	<th align="right"><?php echo I18n::get('server.nodes.timeout') ?></th>
	<th align="center"><?php echo I18n::get('server.nodes.actions') ?></th>
</thead>
<tbody>

<?php foreach((array)$collect as $key => $value) { ?>
<tr class="<?php echo $value['timeout'] > 0 ? 'success' : 'error' ?>">

	<td><a href="?controller=memcache&action=view&key=<?php echo $value['name'] ?>"><?php echo $value['name'] ?></a></td>
	<td align="center"><?php echo join(', ', $value['slab']) ?></td>
	<td align="right">~ <?php echo $value['size'] ?></td>
	<td align="right"><?php echo date('d.m.Y H:i:s', $value['expire']) ?></td>
	<td align="right"><?php echo $value['timeout'] ?></td>
	<td align="right">
		<span class="btn btn-warning btn-mini" data-key="<?php echo $value['name'] ?>"><?php echo I18n::get('action.delete') ?></span>
	</td>
</tr>
<?php } ?>

</tbody>
</table>

<script type="text/javascript">
$(document).ready( function() {
    $('span.delete').click( function() {
        var key = $(this).attr('data-key');
        var $row = $(this).parents('tr');

        $.ajax({
            url: '?controller=memcache&action=delete',
            data: { 
                'key': key
            },
            dataType: 'json',
            success: function( data ) {
                $row.fadeTo('slow', 0.5);
            }
        });

    });

});

</script>
