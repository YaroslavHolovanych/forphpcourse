<div class="product" action="product/delete">
    <form method="get">
        <?php if ($this->registry['delete'] == 0) :?>
        <p class="sku">Код: <?php echo $this->registry['product']['sku']?></p>
        <h4>Назва : <?php echo $this->registry['product']['name']?></h4>
            <p> Ціна: <span class="price"><?php echo $this->registry['product']['price']?></span> грн</p>
            <p> Кількість: <?php echo $this->registry['product']['qty']?></p>
            <p><?php if(!$this->registry['product']['qty'] > 0) { echo 'Нема в наявності'; } ?></p>
            <p>
        <h2><?php echo Helper::simpleLink('/product/delete', 'Видалити',array('id' => $this->registry['product']['id'],'delete' => 'true')); ?></h2>
        <?php else: ?>
            <h4 style="color: #CD214F">Продукт видалено</h4>
        <?php endif; ?>
        <h2><?php echo Helper::simpleLink('/product/list', 'Назад'); ?></h2>
        </p>
    </form>
</div>