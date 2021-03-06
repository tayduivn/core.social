<?php // pr($widget); ?>
<div class="clearfix"></div>
<div class="fxw db-xs pos-r c_discovery-units__header infinite-scroll ">
    <h2 class="c_discovery-units__title"><?php echo $widget->name; ?></h2>
    <?php if (isset($url_more) && $url_more): ?>
        <a href="<?php echo $url_more ?>" class="collapse-btn btn view-all">
            <span><span><?php echo lang("view_more") ?></span></span> </a>
    <?php endif; ?>
    <div class="nav-container">
        <div class="user-nav-btn user-nav-btn1 prev btn btn-default">

        </div>
        <div class="user-nav-btn user-nav-btn1 next btn btn-default">

        </div>
    </div>
</div>
<div class="discover-users-list-mask">
    <?php //pr($list);
    if (isset($list) && $list): ?>
        <ul class=" channel-users-list one-line caroulsel-bxslider">

            <?php foreach ($list as $row): //pr($row);

                ?>
                <li class="user-box small promotion ">
                    <a href="<?php echo $row->_url_view; ?>" class="mask">
										<span class="user-thumb pos-r dib">

											<?php view('tpl::_widget/user/display/item/info_stats', array('info' => $row)); ?>
                                            <?php view('tpl::_widget/user/display/item/info_label', array('info' => $row)); ?>
                                            <img src="<?php echo thumb_img($row->image)//$row->image->url_thumb; ?>"/>
                                            <?php view('tpl::_widget/user/display/item/info_author', array('info' => $row)); ?>


										</span>

										<span class="box-second-row">
											<span class="title"> <?php echo $row->name; ?></span>
											<span
                                                class="dib title ins-title"> <?php echo character_limiter($row->target, 50); ?></span>

                                            <?php view('tpl::_widget/user/display/item/info_rate',array('info'=>$row)); ?>


											<span class="price-wrap fxac pl10">
												<span>
													<span class="price"><?php echo $row->_price ?></span>
												</span>
                                                <?php if(isset($row->_price_old)): ?>

											<span class="price--old">
												<?php echo $row->_price_old ?>
											</span>
 											<?php  endif;?>
											</span>
										</span>
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>
        <div style="height: 40px"></div>
    <?php else: ?>
        <span class="red"><?php echo lang("have_no_list") ?></span>
    <?php endif; ?>
</div>
