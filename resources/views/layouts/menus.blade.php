<?php if($menus):?>
    <?php foreach ($menus as $key => $val) :?>
        <?php if(!count($val['child'])):?>
        <li <?php if ($page_path == $val['url']) {echo 'class="active"';}?> >
            <a href="<?php echo $val['url'];?>">
                <i class="<?php echo $val['class']?>"></i>
                <span class="nav-label"><?php echo $val['name'];?></span>
            </a>
        </li>
        <?php else:?>
        <li <?php if (in_array($page_path, array_column($val['child'], 'url'))) {echo 'class="active"';}?> >
            <a href="">
                <i class="<?php echo $val['class']?>"></i>
                <span class="nav-label"><?php echo $val['name'];?></span>
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
                <?php foreach ($val['child'] as $item):?>
                <li <?php if($page_path == $item['url']){ echo 'class="active"';}?> >
                    <a href="<?php echo $item['url']?>"><?php echo $item['name']?></a>
                </li>
                <?php endforeach;?>
            </ul>
        </li>
        <?php endif;?>
    <?php endforeach;?>
<?php endif;?>
