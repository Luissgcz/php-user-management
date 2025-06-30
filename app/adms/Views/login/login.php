<?php

use App\adms\Helpers\CSFRHelper;

if (isset($this->data['error'])) {
    foreach ($this->data['error'] as $value) {
        echo "<div class='alert alert-danger'>{$value}</div>";
    }
}

// Mensagens de sessão
if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}

?>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo $_ENV['APP_DOMAIN'] ?>/public/adms/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In</h3>
                                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
                            </div>
                            <form action="#" method="POST">
                                <input type="hidden" name="csfr_tokens" value="<?php echo CSFRHelper::generateCSFRToken('form_login'); ?>">
                                <div class="form-group first">
                                    <label for="email"></label>
                                    <input type="email"
                                        id="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Email de acesso"
                                        required
                                        value="<?php echo $this->data['form']['email'] ?? ''; ?>">
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password"></label>
                                    <input type="password"
                                        id="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Senha de acesso"
                                        required
                                        value="<?php echo $this->data['form']['password'] ?? ''; ?>">

                                </div>

                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0">
                                        <span class="caption">Remember me</span>
                                        <input type="checkbox" checked="checked" />
                                        <div class="control__indicator"></div>
                                    </label>

                                    <div class="ml-auto d-flex">
                                        <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/recovery-password" class="forgot-pass me-3">Esqueceu a Senha</a>
                                        <a href="<?php echo $_ENV['APP_DOMAIN']; ?>/new-login" class="register-link">Cadastrar</a>
                                    </div>
                                </div>

                                <input type="submit" value="Log In" class="btn btn-block btn-primary">

                                <span class="d-block text-left my-4 text-muted">&mdash; Entrar Com &mdash;</span>

                                <div class="social-login">
                                    <a href="#" class="facebook">
                                        <span class="icon-facebook mr-3"></span>
                                    </a>
                                    <a href="#" class="twitter">
                                        <span class="icon-twitter mr-3"></span>
                                    </a>
                                    <a href="#" class="google">
                                        <span class="icon-google mr-3"></span>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


</body>