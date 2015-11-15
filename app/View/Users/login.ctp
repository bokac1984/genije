<?php
$this->assign('title', 'Prijava');

echo $this->Html->script('/assets/plugins/jquery-validation/dist/jquery.validate.min', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/validacija', array('block' => 'scriptBottom'));
echo $this->Html->script('/js/login', array('block' => 'scriptBottom'));
?>
<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
    <div class="logo">
        <?php echo $this->Html->image('logo_login.png'); ?>
    </div>
    <!-- start: LOGIN BOX -->
    <div class="box-login">
        <h3>Prijava na Urban Genie</h3>
        <p>
            Molimo unesite svoje korisničko ime i lozinku za prijavu.
        </p>
        <?php echo $this->Form->create('User', array(
            'plugin' => null,
            'controller' => 'users',
            'action' => 'login', 
            'class' => 'form-login',
            'method' => 'post'
            ));
            echo $this->Session->flash('auth');
            echo $this->Session->flash();
        ?>
            <div class="errorHandler alert alert-danger no-display">
                <i class="fa fa-remove-sign"></i> Upsss, greška. Molimo ispravite greške i pokušajte ponovo.
            </div>
            <fieldset>
                <div class="form-group">
                    <span class="input-icon">
                        <input type="text" class="form-control" name="data[User][username]" placeholder="Korisničko ime">
                        <i class="fa fa-user"></i> </span>
                    <!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
                    <!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
                </div>
                <div class="form-group form-actions">
                    <span class="input-icon">
                        <input type="password" class="form-control password" name="data[User][password]" placeholder="Šifra">
                        <i class="fa fa-lock"></i>
                        <a class="forgot" href="?box=forgot">
                            Zaboravio sam šifru
                        </a> </span>
                </div>
                <div class="form-actions">
                    <label for="remember" class="checkbox-inline">
                        <input type="checkbox" class="grey remember" id="remember" name="data[User][rememberme]">
                        Zapamti me
                    </label>
                    <button type="submit" class="btn btn-bricky pull-right">
                        Prijava <i class="fa fa-arrow-circle-right"></i>
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
    <!-- end: LOGIN BOX -->
    <!-- start: FORGOT BOX -->
    <div class="box-forgot">
        <h3>Zaboravili ste lozinku?</h3>
        <p>
            Unesite svoju e-mail adresu za restart lozinke.
        </p>
        <form class="form-forgot">
            <div class="errorHandler alert alert-danger no-display">
                <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
            </div>
            <fieldset>
                <div class="form-group">
                    <span class="input-icon">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <i class="fa fa-envelope"></i> </span>
                </div>
                <div class="form-actions">
                    <a href="?box=login" class="btn btn-light-grey go-back">
                        <i class="fa fa-circle-arrow-left"></i> Nazad
                    </a>
                    <button type="submit" class="btn btn-bricky pull-right">
                        Pošalji <i class="fa fa-arrow-circle-right"></i>
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
    <!-- end: FORGOT BOX -->
    <!-- start: COPYRIGHT -->
    <div class="copyright">
        <?php echo date('Y') ?> &copy; Urban Genie Theme.
    </div>
    <!-- end: COPYRIGHT -->
</div>