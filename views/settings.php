<h1>Memcache Server Configuration</h1>

<form method="post" action="" class="form-horizontal">

    <div class="control-group">
        <label class="control-label" for="inputHost"><?php echo I18n::get('settings.server.host') ?></label>
        <div class="controls">
            <input name="data[host]" type="text" id="inputHost" placeholder="Host" value="<?php echo $inputHost ?>" />
        </div>
    </div>                                                                      
    <div class="control-group">
        <label class="control-label" for="inputPort"><?php echo I18n::get('settings.server.port') ?></label>
        <div class="controls">
            <input name="data[port]" type="text" id="inputPort" placeholder="Port" value="<?php echo $inputPort ?>" />
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputTimeout"><?php echo I18n::get('settings.server.timeout') ?></label>
        <div class="controls">
            <input name="data[timeout]" type="text" id="inputTimeout" placeholder="Timeout" value="<?php echo $inputTimeout ?>" />
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn">Cancel</button>
    </div>

</form>

