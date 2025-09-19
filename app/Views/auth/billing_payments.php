<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing & Payments - San Miguel HMS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/appointments.css') ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background-color: #f5f7fa;
            overflow-x: hidden;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: #fff;
            color: #0f172a;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-icon {
            width: 32px;
            height: 32px;
            background: #2563eb;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            color: #fff;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
        }

        .sidebar-subtitle {
            font-size: 12px;
            color: #64748b;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            display: block;
            padding: 12px 20px;
            color: #334155;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .menu-item:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            border-left-color: #2563eb;
        }

        .menu-item.active {
            background-color: #eef2ff;
            color: #1d4ed8;
            border-left-color: #2563eb;
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 0;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
            color: #0f172a;
            font-weight: 600;
        }

        .header-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-top: 4px;
        }

        .generate-bill-btn {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s ease;
        }

        .generate-bill-btn:hover {
            background: #1d4ed8;
        }

        /* Page Content */
        .page-content {
            padding: 30px;
        }

        /* Summary Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #2563eb;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stat-title {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
        }

        .stat-icon.revenue { background: #22c55e; }
        .stat-icon.pending { background: #f59e0b; }
        .stat-icon.overdue { background: #ef4444; }
        .stat-icon.collection { background: #2563eb; }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .stat-detail {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        /* Main Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 70% 30%;
            gap: 30px;
        }

        .panel {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .panel-header {
            padding: 24px;
            border-bottom: 1px solid #ecf0f1;
            background: #f8fafc;
        }

        .panel-title {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 16px;
        }

        .search-filter {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .search-container {
            position: relative;
            flex: 1;
        }

        .search-bar {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            padding-right: 40px;
            transition: border-color 0.2s;
        }

        .search-bar:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 16px;
        }

        .filter-dropdown {
            padding: 10px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            min-width: 120px;
            background: white;
            cursor: pointer;
        }

        .filter-dropdown:focus {
            border-color: #2563eb;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
        }

        .bills-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bills-table th {
            background: #f8fafc;
            padding: 16px 12px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            font-size: 13px;
            border-bottom: 1px solid #e5e7eb;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bills-table td {
            padding: 16px 12px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            vertical-align: middle;
        }

        .bill-id {
            font-weight: 600;
            color: #1f2937;
            font-family: 'Courier New', monospace;
        }

        .patient-info {
            display: flex;
            flex-direction: column;
        }

        .patient-name {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .service-type {
            font-size: 12px;
            color: #6b7280;
            font-style: italic;
        }

        .amount {
            font-weight: 600;
            color: #1f2937;
            font-family: 'Courier New', monospace;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-paid { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-overdue { background: #fee2e2; color: #991b1b; }
        .status-partial { background: #fef3c7; color: #92400e; }

        .due-date {
            color: #6b7280;
            font-size: 13px;
            font-family: 'Courier New', monospace;
        }

        .actions {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-action {
            padding: 6px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-view { background: #3b82f6; color: white; }
        .btn-download { background: #10b981; color: white; }
        .btn-edit { background: #8b5cf6; color: white; }
        .btn-delete { background: #ef4444; color: white; }

        .btn-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* Recent Payments */
        .payments-list {
            padding: 0 24px 24px;
        }

        .payment-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px 0;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.2s;
        }

        .payment-item:hover {
            background-color: #f8fafc;
            margin: 0 -24px;
            padding-left: 24px;
            padding-right: 24px;
        }

        .payment-item:last-child {
            border-bottom: none;
        }

        .payment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #eef2ff;
            display: grid;
            place-items: center;
            color: #2563eb;
            font-weight: 800;
            font-size: 16px;
            flex-shrink: 0;
        }

        .payment-info {
            flex: 1;
            min-width: 0;
        }

        .payment-patient {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 6px;
            font-size: 15px;
        }

        .payment-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .payment-amount {
            font-weight: 600;
            color: #1f2937;
            font-family: 'Courier New', monospace;
            font-size: 15px;
        }

        .payment-time {
            font-size: 12px;
            color: #6b7280;
            font-family: 'Courier New', monospace;
        }

        .payment-status {
            display: flex;
            flex-direction: column;
            gap: 6px;
            align-items: flex-end;
            flex-shrink: 0;
        }

        .payment-method {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .method-cash { background: #dcfce7; color: #166534; }
        .method-card { background: #dbeafe; color: #1d4ed8; }
        .method-insurance { background: #fef3c7; color: #92400e; }
        .method-transfer { background: #dcfce7; color: #166534; }

        .view-all-link {
            padding: 20px 24px;
            text-align: center;
            border-top: 1px solid #ecf0f1;
            background: #f8fafc;
        }

        .view-all-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: color 0.2s;
        }

        .view-all-link a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        /* Alert Messages */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border-color: #bbf7d0;
        }

        .alert-error {
            background: #fecaca;
            color: #dc2626;
            border-color: #fca5a5;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .content-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .search-filter {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <?php echo view('auth/partials/sidebar'); ?>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div>
                    <h1>Billing & Payments</h1>
                    <div class="header-subtitle">Manage billing, invoices and payment tracking</div>
                </div>
                <a href="<?= site_url('billing/generate') ?>" class="generate-bill-btn">
                    <span>➕</span> Generate Bill
                </a>
            </header>

            <!-- Page Content -->
            <div class="page-content">
                <!-- Success/Error Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        ✅ <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-error">
                        ❌ <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- Summary Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Total Revenue</span>
                            <div class="stat-icon revenue">💰</div>
                        </div>
                        <div class="stat-value">₱<?= number_format($stats['total_revenue'] ?? 0, 2) ?></div>
                        <div class="stat-detail">+12% from last month</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Pending Bills</span>
                            <div class="stat-icon pending">📄</div>
                        </div>
                        <div class="stat-value">₱<?= number_format($stats['pending_amount'] ?? 0, 2) ?></div>
                        <div class="stat-detail"><?= $stats['pending_bills'] ?? 0 ?> invoices</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Overdue</span>
                            <div class="stat-icon overdue">⚠️</div>
                        </div>
                        <div class="stat-value">₱<?= number_format($stats['overdue_bills'] ?? 0, 2) ?></div>
                        <div class="stat-detail"><?= $stats['overdue_bills'] ?? 0 ?> overdue bills</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Today's Collection</span>
                            <div class="stat-icon collection">👁️</div>
                        </div>
                        <div class="stat-value">₱<?= number_format($stats['todays_collection'] ?? 0, 2) ?></div>
                        <div class="stat-detail"><?= $stats['todays_collection'] > 0 ? 'Recent payments' : 'No payments today' ?></div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="content-grid">
                    <!-- Recent Bills Panel -->
                    <div class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">Recent Bills</h2>
                            <div class="search-filter">
                                <div class="search-container">
                                    <input type="text" class="search-bar" placeholder="Search bills...">
                                    <span class="search-icon">🔍</span>
                                </div>
                                <select class="filter-dropdown">
                                    <option>All Status</option>
                                    <option>Paid</option>
                                    <option>Pending</option>
                                    <option>Overdue</option>
                                    <option>Partial</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="bills-table">
                                <thead>
                                    <tr>
                                        <th>BILL ID</th>
                                        <th>PATIENT</th>
                                        <th>AMOUNT</th>
                                        <th>STATUS</th>
                                        <th>DUE DATE</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recentBills)): ?>
                                        <?php foreach ($recentBills as $bill): ?>
                                            <tr>
                                                <td class="bill-id"><?= esc($bill['bill_id']) ?></td>
                                                <td>
                                                    <div class="patient-info">
                                                        <div class="patient-name"><?= esc($bill['patient_name']) ?></div>
                                                        <div class="service-type"><?= esc($bill['services']) ?></div>
                                                    </div>
                                                </td>
                                                <td class="amount">₱<?= number_format($bill['total_amount'], 2) ?></td>
                                                <td>
                                                    <span class="status-badge status-<?= strtolower($bill['status']) ?>">
                                                        <?= esc($bill['status']) ?>
                                                    </span>
                                                </td>
                                                <td class="due-date"><?= date('Y-m-d', strtotime($bill['due_date'])) ?></td>
                                                <td class="actions">
                                                    <a href="<?= site_url('billing/view/' . $bill['bill_id']) ?>" class="btn-action btn-view" title="View">👁️</a>
                                                    <a href="<?= site_url('billing/download/' . $bill['bill_id']) ?>" class="btn-action btn-download" title="Download">📥</a>
                                                    <a href="<?= site_url('billing/edit/' . $bill['bill_id']) ?>" class="btn-action btn-edit" title="Edit">✏️</a>
                                                    <button class="btn-action btn-delete" title="Delete" onclick="deleteBill('<?= $bill['bill_id'] ?>')">🗑️</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">
                                                <div style="font-size: 16px; margin-bottom: 8px;">📋</div>
                                                <div>No bills found</div>
                                                <div style="font-size: 12px; margin-top: 4px;">Generate your first bill to get started</div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Payments Panel -->
                    <div class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">Recent Payments</h2>
                        </div>
                        
                        <div class="payments-list">
                            <?php if (!empty($recentPayments)): ?>
                                <?php foreach ($recentPayments as $payment): ?>
                                    <div class="payment-item">
                                        <div class="payment-avatar"><?= strtoupper(substr($payment['patient_name'], 0, 1)) ?></div>
                                        <div class="payment-info">
                                            <div class="payment-patient"><?= esc($payment['patient_name']) ?></div>
                                            <div class="payment-details">
                                                <span class="payment-amount">₱<?= number_format($payment['total_amount'], 2) ?></span>
                                                <span class="payment-time">
                                                    <?php if ($payment['status'] === 'Paid'): ?>
                                                        <?= date('Y-m-d H:i', strtotime($payment['payment_date'] ?? $payment['created_at'])) ?>
                                                    <?php else: ?>
                                                        <?= date('Y-m-d H:i', strtotime($payment['created_at'])) ?> (Pending)
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="payment-status">
                                            <span class="status-badge status-<?= strtolower($payment['status']) ?>">
                                                <?= esc($payment['status']) ?>
                                            </span>
                                            <?php if (!empty($payment['payment_method'])): ?>
                                                <span class="payment-method method-<?= strtolower(str_replace(' ', '-', $payment['payment_method'])) ?>">
                                                    <?= esc($payment['payment_method']) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div style="text-align: center; padding: 40px; color: #64748b;">
                                    <div style="font-size: 16px; margin-bottom: 8px;">💰</div>
                                    <div>No recent payments</div>
                                    <div style="font-size: 12px; margin-top: 4px;">Payments will appear here once bills are paid</div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="view-all-link">
                            <a href="<?= site_url('billing/payments') ?>">View All Payments</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Highlight active menu item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                const href = item.getAttribute('href') || '';
                if (href && currentPath.includes(href)) {
                    item.classList.add('active');
                }
            });
        });

        // Search functionality
        document.querySelector('.search-bar').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.bills-table tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Filter functionality
        document.querySelector('.filter-dropdown').addEventListener('change', function(e) {
            const filterValue = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.bills-table tbody tr');
            
            rows.forEach(row => {
                const status = row.querySelector('.status-badge').textContent.toLowerCase();
                if (filterValue === 'all status' || status === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Bill action functions
        function deleteBill(billId) {
            if (confirm(`Are you sure you want to delete bill ${billId}? This action cannot be undone.`)) {
                window.location.href = `<?= site_url('billing/delete/') ?>${billId}`;
            }
        }
    </script>
</body>
</html>
