<!-- Main content wrapper -->
<?php
$_macro = $this->data;

/* Tabs links */
/*$_macro['toolbar_sub'] = array(
    array('url' => admin_url('aboutus'), 'title' => lang('mod_aboutus'),'attr'=>array('class'=>'active')),
    array('url' => admin_url('aboutus_cat'), 'title' => lang('mod_aboutus_cat'), )
);*/


/* Khởi tạo bảng và nút xóa */
$_macro['table'] = array_only($this->data, array('total', 'actions', 'pages_config'));
$_macro['table']['sort'] = true;
$_macro['table']['sort_url_update'] = $sort_url_update;
/* Những trường có trong bộ lọc */
$_macro['table']['filters'] = array(

    array(
        'name' => lang('name'),
        'param' => 'name',
        'value' => $filter['name']
    ),

    array(
        'name' => lang('cat'),
         'param' => 'cat_id',
        'type' => 'select',
        'value' => isset($filter['cat_id']) && $filter['cat_id'] != '' ? $filter['cat_id'] : '-1',
        'values_row' => array($categories, 'id', 'name')
    ),
     /*array(
        'type' => 'select',
        'param' => 'price_option',
        'value' => isset($filter['price_option']) ? $filter['price_option'] : '-1',
        // 'values'        => $this->_price_option
        'values' => $price_options,
    ),
    array(
        'type' => 'number',
        'param' => 'price_gt',
        'refer' => 'price_option',
        'refer_value' => 1,
        'name' => lang('price_greater'),
        'value' => isset($filter['price_gt']) ? $filter['price_gt'] : ''
    ),
    array(
        'type' => 'number',
        'param' => 'price_lt',
        'refer' => 'price_option',
        'refer_value' => 1,
        'name' => lang('price_lesser'),
        'value' => isset($filter['price_lt']) ? $filter['price_lt'] : ''
    ),   */
    array(
        'name' => lang('feature'),
        'type' => 'select',
        'param' => 'is_feature',
        'value' => isset($filter['is_feature']) && $filter['is_feature'] != '' ? $filter['is_feature'] : '-1',
        'values' => array(
            '1' => lang('yes'),
            '0' => lang('no')
        ),
    ),

    array(
        'name' => lang('new'),
        'type' => 'select',
        'param' => 'is_new',
        'value' => isset($filter['is_new']) && $filter['is_new'] != '' ? $filter['is_new'] : '-1',
        'values' => array(
            '1' => lang('yes'),
            '0' => lang('no')
        ),
    ),
    /*array(
        'name' => lang('soon'),
        'type' => 'select',
        'param' => 'is_soon',
        'value' => isset($filter['is_soon']) && $filter['is_soon'] != '' ? $filter['is_soon'] : '-1',
        'values' => array(
            '1' => lang('yes'),
            '0' => lang('no')
        ),
    ),*/

    array(
        'name' => lang('status'),
        'type' => 'select',
        'param' => 'status',
        'value' => isset($filter['status']) && $filter['status'] != '' ? $filter['status'] : '-1',
        'values' => array(
            '1' => lang('status'),
            '0' => lang('hide')
        ),
    ),

  /*  array('name' => lang('from_date'), 'param' => 'created', 'type' => 'date',
        'value' => $filter['created'],
    ),
    array('name' => lang('to_date'), 'param' => 'created_to', 'type' => 'date',
        'value' => $filter['created_to'],
    ),*/
);


/* Các cột trong list */

$_macro['table']['columns'] = array(
    'id' => lang('id'),
    'name' => lang('name'),
    //'price' => lang('price'),
    'cat_id' => lang('cat'),
    'is_feature' => lang('feature'),
    'status' => lang('status'),
    'action' => lang('action'),
);


/* Biến đổi giá trị hiển thị List */


$_data_name = function ($row) {
    ob_start(); ?>

    <a href="<?php echo $row->_url_view; ?>" target="_blank" style="float:left; margin-right: 5px;">
        <img src="<?php echo $row->image->url_thumb; ?>" height="40px" width="50px"/>
    </a>
    <a href="<?php echo $row->_url_view; ?>" target="_blank">
        <?php echo $row->name; ?>
    </a>
    <br>
    <i class="fa fa-eye" title="Số lượt xem"></i> <?php echo $row->count_view ?>
    <?php if (isset($row->is_new) && $row->is_new): ?>
        &nbsp;|&nbsp; <i class="fa fa-retweet" title="Mới"></i>
    <?php endif; ?>
    <?php return ob_get_clean();
};
/*
$_data_price = function ($row) use ($price_options, $currency) {
    ob_start();
    $price = $price_options[$row->price_option];
    if ($row->price_option == 1)
        $price .= ": " . dinhdangtien($row->price) . ' ' . $currency->symbol_right;
    echo $price;
    ?>
    <?php return ob_get_clean();
};
  */
$_data_cat = function ($row) {
    ob_start(); ?>
    <?php if (isset($row->_cat_name) && $row->_cat_name) echo $row->_cat_name . '<br>'; ?>
    <?php return ob_get_clean();
};
$_row_feature = function ($row) {
    ob_start();
    ?>
    <a class="toggle_action iIcon iStar <?php if ($row->_can_feature_del) echo 'on'; ?>"
       _url_on="<?php echo $row->_url_feature; ?>" _url_off="<?php echo $row->_url_feature_del; ?>"
       _title_on="<?php echo lang('feature_set'); ?>" _title_off="<?php echo lang('feature_del'); ?>"
        ></a>
    <?php return ob_get_clean();
};


$_rows = array();
foreach ($list as $row) {
    $r = (array)$row;
    //$r['name']  = t('html')->a( 'javascript:;', $row->name, array('target'=>'_blank') );
    $r['name'] = $_data_name($row);
    $r['cat_id'] = $_data_cat($row);
    //$r['price'] = $_data_price($row);
    $r['is_feature'] = $_row_feature($row);
    $r['status'] = macro()->status_color($row->_status);
    $_rows[] = $r;
}

$_macro['table']['rows'] = $_rows;
echo macro('mr::advForm')->page($_macro);



