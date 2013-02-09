<table border="0" width="100%">
<thead>
	<th align="left"><?php echo I18n::get('table.name') ?></th>
	<th align="center"><?php echo I18n::get('table.slab') ?></th>
	<th align="right"><?php echo I18n::get('table.size') ?></th>
	<th align="right"><?php echo I18n::get('table.date_expire') ?></th>
	<th align="right"><?php echo I18n::get('table.timeout') ?></th>
	<th align="center"><?php echo I18n::get('table.actions') ?></th>
</thead>
<tbody>

<?php foreach((array)$collect as $key => $value): ?>
<tr class="<?php echo $value['timeout'] > 0 ? 'green' : 'red' ?>">

	<td><a href="/view/?name=<?php echo $value['name'] ?>"><?php echo $value['name'] ?></a></td>
	<td align="center"><?php echo join(', ', $value['slab']) ?></td>
	<td align="right">~ <?php echo $value['size'] ?></td>
	<td align="right"><?php echo date('d.m.Y H:i:s', $value['expire']) ?></td>
	<td align="right"><?php echo $value['timeout'] ?></td>
	<td align="right">
<!--		<span class="button view" data-id="<?php echo $value['name'] ?>"><?php echo I18n::get('action.view') ?></span> -->
		<span class="button delete" data-id="<?php echo $value['name'] ?>"><?php echo I18n::get('action.delete') ?></span>
	</td>
</tr>
<?php endforeach ?>

</tbody>
</table>

<script type="text/javascript">

$(document).ready( function() {

    $('span.view').click( function() {

        var id = $(this).attr('data-id');

        $.ajax({
            url: '/view/',
            data: {
                name: id
            },
            success: function( data ) {
                $.blockUI({
                    css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff',
                        top:  ($(window).height() * 0.1) /2 + 'px',
                        left: ($(window).width() * 0.1) /2 + 'px', 
                        width: '90%',
                        'text-align': 'left'
                    },
                    message: data.substr(0, 2048) + ' ....'
                });
                $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
            }
        });
    });

    $('span.delete').click( function() {
        var id = $(this).attr('data-id');
        var $row = $(this).parents('tr');

        $.ajax({
            url: '/delete/',
            data: { 
                name: id
            },
            dataType: 'json',
            success: function( data ) {
                $row.fadeTo('slow', 0.5);
            }
        });

    });

});

</script>
