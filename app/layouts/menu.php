<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    <?php 
        $menu = Helper::getMenu();
        foreach($menu as $item)  :
    ?>
        <li>
            <?php echo Helper::simpleLink($item['path'], $item['name']); ?>
        </li>
    <?php endforeach; ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php if ($this->customer !== null):?>
            <li><a href="<?php echo route::getBP();?>/customer/account/"><span class="glyphicon glyphicon-user"></span>
                    <?php echo "{$this->customer['first_name']} {$this->customer['last_name']}"; if (Helper::isAdmin()) {echo ", Administrator";};?>
                </a></li>
            <li><a href="<?php echo route::getBP();?>/customer/logout/"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        <?php else:?>
            <li><a href="<?php echo route::getBP();?>/customer/register/"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="<?php echo route::getBP();?>/customer/login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php endif;?>
    </ul>
  </div>
</nav>