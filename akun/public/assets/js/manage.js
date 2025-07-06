document.addEventListener('DOMContentLoaded', function() {
    // Tab System
    const tabBtns = document.querySelectorAll('.tab-btn');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(btn.dataset.tab).classList.add('active');
        });
    });

    // Update Role
    document.querySelectorAll('.role-select').forEach(select => {
        select.addEventListener('change', function() {
            const userId = this.dataset.userId;
            const newRole = this.value;
            
            fetch(`/akun/api/update-role`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    user_id: userId,
                    role: newRole,
                    csrf_token: document.querySelector('meta[name="csrf-token"]').content
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Role updated!');
                }
            });
        });
    });

    // Approve/Reject User
    document.querySelectorAll('.btn-approve, .btn-reject').forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const action = this.classList.contains('btn-approve') ? 'approve' : 'reject';
            
            fetch(`/akun/api/${action}-user`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    user_id: userId,
                    csrf_token: document.querySelector('meta[name="csrf-token"]').content
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        });
    });

    // Delete User
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm('Yakin hapus user ini?')) return;
            
            const userId = this.dataset.userId;
            
            fetch(`/akun/api/delete-user`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    user_id: userId,
                    csrf_token: document.querySelector('meta[name="csrf-token"]').content
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        });
    });
});