
<div class="product" action="product/list">
    <form method="post">
        <p>ID : <input type="text" name="id" value="<?php echo $this->registry['product']['id']?>"></p>
        <p>SKU : <input type="text" name="sku" value="<?php echo $this->registry['product']['sku']?>"></p>
        <p>Назва товару : <input type="text" name="name" value="<?php echo $this->registry['product']['name']?>"></p>
        <p>Ціна : <input type="text" name="price" value="<?php echo $this->registry['product']['price']?>"></p>
        <p>Кількість : <input type="text" name="qty" value="<?php echo $this->registry['product']['qty']?>"></p>
        <p>
            <?php if ($this->registry['saved'] == 0) :?>
                <input type="submit" value="Зберегти продукт">
            <?php else: ?>
                <h2><?php echo Helper::simpleLink('/product/list', 'Назад'); ?></h2>
            <?php endif; ?>

        </p>
    </form>
</div>