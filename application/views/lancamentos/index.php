<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<div class="container mt-5">    
    <a href="<?= site_url('auth/logout') ?>" class="btn btn-danger mt-6">Logout</a>
    <br />
    <br />
    
    <h2 class="mb-4">Lançamentos</h2>

    <!-- Totalizadores -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total de Entradas</h5>
                    <p class="card-text">R$ <?= number_format($total_entradas, 2, ',', '.'); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Total de Saídas</h5>
                    <p class="card-text">R$ <?= number_format($total_saidas, 2, ',', '.'); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total de Entradas Futuras</h5>
                    <p class="card-text">R$ <?= number_format($total_entradas_futuras, 2, ',', '.'); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total de Saídas Futuras</h5>
                    <p class="card-text">R$ <?= number_format($total_saidas_futuras, 2, ',', '.'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtro -->
    <form method="GET" action="<?= site_url('lancamentos') ?>" class="form-inline mb-4">
        <div class="form-group mr-3">
            <label for="tipo" class="mr-2">Tipo</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="">Todos</option>
                <option value="entrada" <?= $this->input->get('tipo') == 'entrada' ? 'selected' : '' ?>>Entrada</option>
                <option value="saida" <?= $this->input->get('tipo') == 'saida' ? 'selected' : '' ?>>Saída</option>
            </select>
        </div>

        <div class="form-group mr-3">
            <label for="data_inicio" class="mr-2">Data Início</label>
            <input type="date" name="data_inicio" id="data_inicio" class="form-control" 
                   value="<?= $this->input->get('data_inicio') ?>">
        </div>

        <div class="form-group mr-3">
            <label for="data_fim" class="mr-2">Data Fim</label>
            <input type="date" name="data_fim" id="data_fim" class="form-control" 
                   value="<?= $this->input->get('data_fim') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="<?= site_url('lancamentos') ?>" class="btn btn-secondary ml-2">Limpar</a>
    </form>

    <!-- Tabela -->
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data de Vencimento</th>
                <th>Tipo</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lancamentos)): ?>
                <?php foreach ($lancamentos as $lancamento): ?>
                    <tr>
                        <td><?= $lancamento->descricao ?></td>
                        <td>R$ <?= number_format($lancamento->valor, 2, ',', '.') ?></td>
                        <td><?= date('d/m/Y', strtotime($lancamento->data_vencimento)) ?></td>
                        <td><?= ucfirst($lancamento->tipo) ?></td>
                        <td><?= $lancamento->categoria_nome ?></td>
                        <td>
                            <a href="<?= site_url('lancamentos/edit/'.$lancamento->id) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="<?= site_url('lancamentos/delete/'.$lancamento->id) ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Nenhum lançamento encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Botão para cadastrar -->
    <a href="<?= site_url('lancamentos/create') ?>" class="btn btn-success mt-3">Novo Lançamento</a>

    <!-- Botão para logs -->
    <a href="<?= site_url('logs') ?>" class="btn btn-info mt-3 pull-right">Logs</a>
</div>
