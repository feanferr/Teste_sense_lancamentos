<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<div class="container mt-5">
    <h2 class="text-center">Logs de Ações</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ação</th>
                <th>ID do Usuário</th>
                <th>Data e Hora</th>
                <th>Detalhes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= $log->id; ?></td>
                    <td><?= $log->action; ?></td>
                    <td><?= $log->user_id; ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($log->timestamp)); ?></td>
                    <td><?= $log->details; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
