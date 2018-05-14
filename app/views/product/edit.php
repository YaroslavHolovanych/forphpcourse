<?php
    if (isset($_GET['is']) == 'new') {
        echo '<p style="color: green; font-size: 25px">Продукт збережений</p>';
    }
?>

<div class="product" action="product/edit">
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $this->registry['product']['id']?>">
        <p>ID : <?php echo $this->registry['product']['id']?></p>
        <p>SKU : <input type="text" name="sku" value="<?php echo $this->registry['product']['sku']?>"></p>
        <p>Назва товару : <input type="text" name="name" value="<?php echo $this->registry['product']['name']?>"></p>
        <p>Ціна : <input type="number" name="price" min="0.00" step="0.01" value="<?php echo $this->registry['product']['price']?>"></p>
        <p>Кількість : <input type="number" name="qty" min="0.000" step="0.001" value="<?php echo $this->registry['product']['qty']?>"></p>
        <p>Опис : <input type="text" name="description" value="<?php echo $this->registry['product']['description']?>"></p>
        <input type="submit" value="Зберегти продукт">
        <input type="reset" value="Початкові значення">
    </form>
</div>