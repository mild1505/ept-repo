<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h1>Manajemen Akun</h1>
    
    <!-- Tab Navigasi -->
    <div class="tabs">
        <button class="tab-btn active" data-tab="users">Daftar User</button>
        <button class="tab-btn" data-tab="pending">Menunggu Approval</button>
    </div>

    <!-- Tabel Daftar User -->
    <div id="users" class="tab-content active">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activeUsers as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td>
                        <select class="role-select" data-user-id="<?= $user['id'] ?>">
                            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn-delete" data-user-id="<?= $user['id'] ?>">Hapus</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Tabel Pending Approval -->
    <div id="pending" class="tab-content">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingUsers as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                    <td>
                        <button class="btn-approve" data-user-id="<?= $user['id'] ?>">Setujui</button>
                        <button class="btn-reject" data-user-id="<?= $user['id'] ?>">Tolak</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="/akun/public/assets/js/manage.js"></script>

<?php require __DIR__ . '/../partials/footer.php'; ?>