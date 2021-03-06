<li class=" dropdown dropdown-notice">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
       aria-expanded="false">
        <i class="pe-7s-bell" style="font-size:23px"></i>
        <span class="count"><?php echo $total_unread ?></span>
    </a>

    <?php if (isset($list) && $list): ?>
        <ul class="dropdown-menu">
            <div class="heading clearfix">
                <span class="title pull-left">Thông báo mới</span>
                <a class="check-count pull-right do_action" data-url="<?php echo site_url('user_notice/view_all') ?>"> <i class="fa fa-check"></i>&nbsp;Đã đọc tất cả</a>

                <?php /*if($total_unread==0): ?>
                <span class="check-count pull-right"> <i class="fa fa-check"></i>&nbsp;đã xem hết</span>
                <?php endif; */?>
            </div>
            <div class="slimscroll p2">
                <?php  foreach ($list as $row):  //  pr($row);?>
                    <li>
                        <a href="<?php echo $row->url?$row->url:'#0'; ?>">
                            <div class="title"> <?php echo $row->title ?> </div>
                            <div class="created"><i class="fa fa-clock-o"></i> Cách đây <?php echo  timespan($row->created,'',1);//$row->_created ?></div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </div>
            <div class="p10 text-center"><a href="<?php echo site_url('my-page').'?page=notice' ?>">Xem tất cả</a></div>
        </ul>

    <?php endif; ?>
</li>
