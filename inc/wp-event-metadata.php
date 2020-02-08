<table class="form-table" role="presentation">
    <tbody>
        <tr>
            <th><label for="start-date"><?php _e('Start Date', 'wp-events'); ?></label></th>
            <td><input type="text" id="start-date" name="wpe_start_date" value="<?php echo $start_date; ?>" /></td>
        </tr>
        <tr>
            <th><label for="end-date"><?php _e('End Date', 'wp-events'); ?></label></th>
            <td><input type="text" id="end-date" name="wpe_end_date" class="wpevent-date" value="<?php echo $end_date; ?>" /></td>
        </tr>
    </tbody>
</table>