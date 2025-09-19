<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Reports - HMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }


        .sidebar {
            background-color: #243849;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-header {
            text-align: center;
            padding: 20px 15px;
            border-bottom: 1px solid #34495e;
        }
        
        .sidebar-header i {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 10px;
        }
        
        .sidebar-header h4 {
            color: #fff;
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        
        .sidebar-header small {
            color: #bdc3c7;
            font-size: 0.9rem;
        }
        
        .sidebar-nav {
            flex: 1;
            padding: 20px 0;
        }
        
        .nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .nav-item {
            margin-bottom: 5px;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0 25px 25px 0;
            margin-right: 10px;
        }
        
        .nav-link:hover {
            background-color: #34495e;
            color: #fff;
        }
        
        .nav-link.active {
            background-color: #3498db;
            color: #fff;
        }
        
        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #34495e;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content h1 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 5px;
        }

        .header-content p {
            color: #7f8c8d;
            font-size: 1rem;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .summary-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .summary-card-content h3 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .summary-card-content p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .total { background-color: #3498db; }
        .month { background-color: #27ae60; }
        .scheduled { background-color: #9b59b6; }
        .templates { background-color: #e67e22; }

        /* Table */
        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .table-header {
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            color: #2c3e50;
            font-size: 1.3rem;
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .search-box {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            width: 250px;
        }

        .btn-outline-secondary {
            background: transparent;
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-urgent {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-normal {
            background-color: #28a745;
            color: white;
        }

        .badge-high {
            background-color: #dc3545;
            color: white;
        }

        .badge-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-progress {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-pending {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .action-links {
            display: flex;
            gap: 8px;
        }

        .action-links a {
            padding: 4px 8px;
            border-radius: 3px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .action-process {
            background-color: #28a745;
            color: white;
        }

        .action-view {
            background-color: #007bff;
            color: white;
        }

        .action-edit {
            background-color: #6c757d;
            color: white;
        }

        .action-links a:hover {
            opacity: 0.8;
        }

        /* Mobile Responsive */
        .hamburger {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #2c3e50;
            cursor: pointer;
            padding: 10px;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .summary-cards {
                grid-template-columns: 1fr;
            }

            .table-container {
                overflow-x: auto;
            }

            .table {
                min-width: 800px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Hamburger Menu -->
    <button class="hamburger" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-hospital"></i>
            <h4>Laboratory</h4>
            <small>San Miguel Hospital</small>
        </div>
        
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('laboratory') ?>">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('laboratory/test/request') ?>">
                        <i class="fas fa-clipboard-list"></i> Test Requests
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('laboratory/test/results') ?>">
                        <i class="fas fa-file-medical-alt"></i> Test Results
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('laboratory/equipment/status') ?>">
                        <i class="fas fa-tools"></i> Equipment
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= site_url('laboratory/reports') ?>">
                        <i class="fas fa-chart-bar"></i> Lab Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('laboratory/inventory') ?>">
                        <i class="fas fa-flask"></i> Lab Inventory
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('laboratory/settings') ?>">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <a href="<?= site_url('auth/logout') ?>" class="nav-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="header-content">
                    <h1>Laboratory Reports</h1>
                    <p>Generate and manage laboratory reports and analytics</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-secondary">
                        <i class="fas fa-file-alt"></i>
                        Templates
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fas fa-calendar"></i>
                        Schedule Report
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Generate Report
                    </button>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="summary-card">
                    <div class="summary-card-icon total">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="summary-card-content">
                        <h3>156</h3>
                        <p>Total Reports</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-card-icon month">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="summary-card-content">
                        <h3>42</h3>
                        <p>This Month</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-card-icon scheduled">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="summary-card-content">
                        <h3>8</h3>
                        <p>Scheduled</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-card-icon templates">
                        <i class="fas fa-file-export"></i>
                    </div>
                    <div class="summary-card-content">
                        <h3>12</h3>
                        <p>Templates</p>
                    </div>
                </div>
            </div>

            <!-- Reports Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3>Recent Reports</h3>
                    <div class="table-actions">
                        <input type="text" class="search-box" placeholder="Search reports...">
                        <button class="btn btn-outline-secondary">
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Report Name</th>
                            <th>Type</th>
                            <th>Generated By</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>RPT-001</strong></td>
                            <td>Daily Laboratory Summary</td>
                            <td>Daily Report</td>
                            <td>John Martinez</td>
                            <td><span class="badge badge-urgent">URGENT</span></td>
                            <td><span class="badge badge-completed">Completed</span></td>
                            <td>2024-01-16</td>
                            <td>
                                <div class="action-links">
                                    <a href="#" class="action-process">Process</a>
                                    <a href="#" class="action-view">View</a>
                                    <a href="#" class="action-edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>RPT-002</strong></td>
                            <td>Monthly Quality Control Report</td>
                            <td>QC Report</td>
                            <td>Sarah Garcia</td>
                            <td><span class="badge badge-normal">NORMAL</span></td>
                            <td><span class="badge badge-completed">Completed</span></td>
                            <td>2024-01-01</td>
                            <td>
                                <div class="action-links">
                                    <a href="#" class="action-process">Process</a>
                                    <a href="#" class="action-view">View</a>
                                    <a href="#" class="action-edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>RPT-003</strong></td>
                            <td>Equipment Maintenance Report</td>
                            <td>Maintenance Report</td>
                            <td>Mike Rodriguez</td>
                            <td><span class="badge badge-high">HIGH</span></td>
                            <td><span class="badge badge-progress">In Progress</span></td>
                            <td>2024-01-10</td>
                            <td>
                                <div class="action-links">
                                    <a href="#" class="action-process">Process</a>
                                    <a href="#" class="action-view">View</a>
                                    <a href="#" class="action-edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>RPT-004</strong></td>
                            <td>Weekly Inventory Report</td>
                            <td>Inventory Report</td>
                            <td>Lisa Chen</td>
                            <td><span class="badge badge-normal">NORMAL</span></td>
                            <td><span class="badge badge-pending">Pending</span></td>
                            <td>2024-01-15</td>
                            <td>
                                <div class="action-links">
                                    <a href="#" class="action-process">Process</a>
                                    <a href="#" class="action-view">View</a>
                                    <a href="#" class="action-edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>RPT-005</strong></td>
                            <td>Patient Test Results Summary</td>
                            <td>Test Results Report</td>
                            <td>David Park</td>
                            <td><span class="badge badge-urgent">URGENT</span></td>
                            <td><span class="badge badge-completed">Completed</span></td>
                            <td>2024-01-16</td>
                            <td>
                                <div class="action-links">
                                    <a href="#" class="action-process">Process</a>
                                    <a href="#" class="action-view">View</a>
                                    <a href="#" class="action-edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('open');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.querySelector('.sidebar');
            const hamburger = document.querySelector('.hamburger');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(e.target) && 
                !hamburger.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.querySelector('.sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('open');
            }
        });
    </script>
</body>
</html>
