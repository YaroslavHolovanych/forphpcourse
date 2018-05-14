<div class="product" action="#">
    <form method="post">
        <?php if (isset($this->invalid_password) and $this->invalid_password) :?>
        <p style="color: #CD214F; font-size: medium">Email or password is incorrect</p>
        <?php endif;?>
        <p>Email : <input type="text" name="email"></p>
        <p>Password : <input type="password" name="password"></p>
        <input type="submit" value="Login">
    </form>
</div>