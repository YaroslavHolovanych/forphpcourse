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
        <li><a href="<?php echo route::getBP();?>/customer/register/"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="<?php echo route::getBP();?>/customer/login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>