<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="text-center">Login</h2>
            
            <!-- Exibe mensagens de erro -->
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Formulário de login -->
            <form action="<?= site_url('auth/do_login') ?>" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Digite sua senha" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </form>

            <!-- Botão para registrar -->
            <div class="text-center mt-3">
                <p>Não tem uma conta? <a href="<?= site_url('auth/register') ?>" class="btn btn-secondary">Registrar</a></p>
            </div>
        </div>
    </div>
</div>
