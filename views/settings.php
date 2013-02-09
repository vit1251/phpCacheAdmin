<form method="post" action="">

    <table>
    <thead>
        <tr>
            <th></th>
            <th align="left"><?php echo I18n::get('settings.server.name') ?></th>
            <th align="left"><?php echo I18n::get('settings.server.host') ?></th>
            <th align="left"><?php echo I18n::get('settings.server.port') ?></th>
            <th align="left"><?php echo I18n::get('settings.server.timeout') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $id => $item): ?>
        <tr style="background-color: <?php echo $server_id == $id ? '#C0C0C0' : '#FFFFFF' ?>">
            <td><input type="radio" name="server_id" value="<?php echo $id ?>" <?php echo $server_id == $id ? 'checked' : '' ?> /></td>
            <td><?php echo $item['name'] ?></td>
            <td><?php echo $item['host'] ?></td>
            <td><?php echo $item['port'] ?></td>
            <td><?php echo $item['timeout'] ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
    </table>

    <input type="submit" value="Применить" />

</form>

