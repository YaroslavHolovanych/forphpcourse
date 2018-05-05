<div class="product" action="product/delete">
    <form method="get">
        <?php if ($this->registry['delete'] == 0) :?>
            <p class="sku">Код: <?php echo $this->registry['product']['sku']?></p>
            <h4>Назва : <?php echo $this->registry['product']['name']?></h4>
            <p> Ціна: <span class="price"><?php echo $this->registry['product']['price']?></span> грн</p>
            <p> Кількість: <?php echo $this->registry['product']['qty']?></p>
            <p>Опис : <?php echo $this->registry['product']['description']?></p>
            <h2><?php echo Helper::simpleLink('/product/delete', 'Видалити',array('id' => $this->registry['product']['id'],'delete' => 'true')); ?></h2>
            <h2><?php echo Helper::simpleLink('/product/list', 'Назад'); ?></h2>
        <?php else: ?>
            <?php Helper::redirect('/product/list'); ?>
        <?php endif; ?>
    </form>
</div>