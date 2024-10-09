<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="text-center">Registrar</h2>
            
            <!-- Exibe mensagens de sucesso ou erro -->
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('auth/do_register') ?>" method="POST">
                <div class="form-group">
                    <label for="username">Nome de Usuário</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Digite seu nome de usuário" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu email" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Digite sua senha" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            </form>
        </div>
    </div>
</div>
