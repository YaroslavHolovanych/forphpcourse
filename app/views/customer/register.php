<div class="product">
    <form method="post" action="#">

        <p>Ім'я : <input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])) {echo $_POST['first_name'];} ?>">
            <span style="color: #CD214F">
                <?php if(isset($this->registrationErrorsMessage['first_name'])){
                    echo $this->registrationErrorsMessage['first_name'];}?></span></p>

        <p>Фамілія : <input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])) {echo $_POST['last_name'];} ?>">
            <span style="color: #CD214F">
                <?php if(isset($this->registrationErrorsMessage['last_name'])){
                    echo $this->registrationErrorsMessage['last_name'];}?></span></p>

        <p>Телефон : <input type="text" name="telephone" value="<?php if(isset($_POST['telephone'])) {echo $_POST['telephone'];} ?>">
            <span style="color: #CD214F">
                <?php if(isset($this->registrationErrorsMessage['telephone'])){
                    echo $this->registrationErrorsMessage['telephone'];}?></span></p>

        <p>Email : <input type="text" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>">
            <span style="color: #CD214F">
                <?php if(isset($this->registrationErrorsMessage['email'])){
                       echo $this->registrationErrorsMessage['email'];}?></span></p>

        <p>Місто :<input type="text" name="city" value="<?php if(isset($_POST['city'])) {echo $_POST['city'];} ?>">
            <span style="color: #CD214F">
                <?php if(isset($this->registrationErrorsMessage['city'])){
                    echo $this->registrationErrorsMessage['city'];}?></span></p>

        <p>Пароль : <input type="password" name="password" value="<?php if(isset($_POST['password'])) {echo $_POST['password'];} ?>">
            <span style="color: #CD214F">
                <?php if(isset($this->registrationErrorsMessage['password'])){
                    echo $this->registrationErrorsMessage['password'];}?></span></p>

        <p>Підтвердження паролю : <input type="password" name="passwordCheck" value="<?php if(isset($_POST['passwordCheck'])) {echo $_POST['passwordCheck'];} ?>">
            <span style="color: #CD214F">
                <?php if(isset($this->registrationErrorsMessage['passwordCheck'])){
                    echo $this->registrationErrorsMessage['passwordCheck'];}?></span></p>

        <p><span style="color: #CD214F">
                <?php if(isset($this->registrationErrorsMessage['passwordsNoMatch'])){
                    echo $this->registrationErrorsMessage['passwordsNoMatch'];}?></span></p>
        <?php if(!empty($this->registrationErrorsMessage) OR empty($_POST)): ?>
            <input type="submit" value="Реєстрація">
        <?php else: ?>
            <span style="color: green; font-size: larger">Ви успішно зареєстровані, перейдіть на сторінку входу</span>
        <?php endif;?>
    </form>
</div>



