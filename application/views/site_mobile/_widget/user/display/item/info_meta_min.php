<?php if (isset($row->_working_city) && $row->_working_city): ?>
    <span class="places"> <i
            class="pe-7s-map-marker"></i> <span
            class="value"><?php echo $row->_working_city_name . ', ' . $row->_working_country_name ?></span></span><br>
<?php endif; ?>

<span class="points"> <span
        class="value"><?php echo number_format($row->point_total) ?></span> <?php echo lang("count_point") ?></span>
