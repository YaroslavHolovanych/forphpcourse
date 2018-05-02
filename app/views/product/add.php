<div class="product" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <form method="post">
        <p>SKU : <input type="text" name="sku" value="<?php echo 'sku'.date('Hms')?>"></p>
        <p>Назва товару : <input type="text" name="name" value="<?php echo 'name'.date('Hms')?>"></p>
        <p>Ціна : <input type="text" name="price" value="0.00"></p>
        <p>Кількість : <input type="text" name="qty" value="0"></p>
        <input type="submit" value="Добавити продукт">
    </form>
</div>