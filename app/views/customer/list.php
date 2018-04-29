<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<select name='sortfirst'>
    <option <?php echo filter_input(INPUT_POST, 'sortfirst') === 'first_name_ASC' ? 'selected' : '';?> value="first_name_ASC">Імена за зростанням</option>
    <option <?php echo filter_input(INPUT_POST, 'sortfirst') === 'first_name_DESC' ? 'selected' : '';?> value="first_name_DESC">Імена за спаданням</option>
</select>
<input type="submit" value="Submit">
</form>

<?php  ?>

<table style="width:100%;">
    <tr>
        <td class="th">Ім'я</td>
        <td class="th">По-батькові</td>
        <td class="th">Місто</td>
        <td class="th">Ел. адреса</td>
        <td class="th">Телефон</td>
    </tr>
<?php $customers =  $this->registry['customer'];
foreach($customers as $customer): ?>
    <tr>
        <td><?php echo $customer['first_name']?></td>
        <td><?php echo $customer['last_name']?></td>
        <td><?php echo $customer['city']?></td>
        <td><?php echo $customer['email']?></td>
        <td><?php echo $customer['telephone']?></td>
    </tr>
<?php endforeach; ?>
</table>


