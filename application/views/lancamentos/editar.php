<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<div class="container mt-5">
    <h2><?= isset($lancamento) ? 'Editar Lançamento' : 'Cadastrar Lançamento' ?></h2>
    <form method="POST">
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" 
                   value="<?= isset($lancamento) ? $lancamento->descricao : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" class="form-control" id="valor" name="valor" step="0.01" 
                   value="<?= isset($lancamento) ? $lancamento->valor : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="data_vencimento">Data de Vencimento:</label>
            <input type="date" class="form-control" id="data_vencimento" name="data_vencimento" 
                   value="<?= isset($lancamento) ? $lancamento->data_vencimento : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="entrada" <?= isset($lancamento) && $lancamento->tipo == 'entrada' ? 'selected' : '' ?>>Entrada</option>
                <option value="saida" <?= isset($lancamento) && $lancamento->tipo == 'saida' ? 'selected' : '' ?>>Saída</option>
            </select>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoria:</label>
            <select class="form-control" id="categoria_id" name="categoria_id" required>
                <?php foreach($categorias as $categoria): ?>
                    <option value="<?= $categoria->id ?>" <?= isset($lancamento) && $lancamento->categoria_id == $categoria->id ? 'selected' : '' ?>>
                        <?= $categoria->nome ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($lancamento) ? 'Atualizar' : 'Cadastrar' ?></button>
        <a href="<?= site_url('lancamentos') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>