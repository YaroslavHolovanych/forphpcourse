<div class="product" action="/product/add">
    <form method="post">
        <!--<input type="hidden" name="id" value="new">-->
        <p>SKU : <input type="text" name="sku" value="<?php echo 'sku'.date('Hms')?>"></p>
        <p>Назва товару : <input type="text" name="name" value="<?php echo 'name'.date('Hms')?>"></p>
        <p>Ціна : <input type="number"  min="0.00" step="0.01" name="price" value="0.00"></p>
        <p>Кількість : <input type="number" min="0.000" step="0.001" name="qty" value="0.000"></p>
        <p>Опис : <input type="text" name="description" value="description"></p>
        <input type="submit" value="Добавити продукт">
    </form>
</div>