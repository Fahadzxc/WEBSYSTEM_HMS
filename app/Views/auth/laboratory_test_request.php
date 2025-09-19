<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Requests - San Miguel HMS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .header {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header-content h2 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .header-content p {
            color: #6c757d;
            margin: 0;
        }
        
        .header-actions {
            display: flex;
            gap: 10px;
        }
        
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .summary-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .summary-card:hover {
            transform: translateY(-5px);
        }

        .summary-card.progress-card {
            padding: 32px;
            min-height: 140px;
        }

        .summary-card.progress-card .number {
            font-size: 3.5rem;
            font-weight: 900;
        }

        .summary-card.progress-card h6 {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .summary-card.progress-card i {
            font-size: 3rem !important;
        }


        
        .summary-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .summary-card h6 {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .summary-card .number {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .summary-card.total .number { color: #6c757d; }
        .summary-card.new .number { color: #007bff; }
        .summary-card.progress .number { color: #ffc107; }
        .summary-card.urgent .number { color: #dc3545; }
        
        /* Text color utilities */
        .text-muted { color: #6c757d !important; }
        .text-primary { color: #007bff !important; }
        .text-warning { color: #ffc107 !important; }
        .text-danger { color: #dc3545 !important; }
        .text-success { color: #28a745 !important; }
        
        .table-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        
        .table th {
            background-color: #f8f9fa;
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table td {
            padding: 15px 12px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }
        
        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,123,255,0.3);
        }
        
        .btn-outline-secondary {
            background: transparent;
            color: #6c757d;
            border: 1px solid #6c757d;
        }
        
        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
        }
        
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 2000;
        }
        
        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 85%;
            max-width: 480px;
            height: auto;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #6c757d;
        }
        
        .form-group {
            margin-bottom: 12px;
        }
        
        .form-group label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }
        
        .btn-cancel {
            background: #6c757d;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            color: white;
            margin-right: 10px;
        }
        
        .btn-create {
            background: #28a745;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            color: white;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #dee2e6;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-urgent { background-color: #fff3e0; color: #f57c00; }
        .badge-normal { background-color: #e3f2fd; color: #1976d2; }
        .badge-routine { background-color: #e8f5e8; color: #2e7d32; }
        .badge-new-request { background-color: #e8f5e8; color: #2e7d32; }
        .badge-in-progress { background-color: #e3f2fd; color: #1976d2; }
        .badge-completed { background-color: #e8f5e8; color: #2e7d32; }

        .action-links {
            display: flex;
            gap: 15px;
        }
        
        .action-link {
            color: #007bff;
            text-decoration: underline;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
        }
        
        .action-link:hover {
            color: #0056b3;
        }
        
        .process-link { color: #10b981; }
        .view-link { color: #3b82f6; }
        .edit-link { color: #374151; }

        .request-info-box {
            background: #e3f2fd;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            border-left: 4px solid #2196f3;
        }

        .info-item {
            margin-bottom: 6px;
            font-size: 13px;
        }

        .info-item strong {
            color: #1976d2;
        }

        .details-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .details-column {
            flex: 1;
        }

        .detail-item {
            margin-bottom: 12px;
            font-size: 14px;
        }

        .detail-item strong {
            color: #374151;
            font-weight: 600;
        }

        .notes-text {
            background: #f8f9fa;
            padding: 8px;
            border-radius: 4px;
            margin-top: 4px;
            font-style: italic;
            color: #6b7280;
        }

        .modal-actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-process {
            background: #10b981;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
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
            
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .summary-cards {
                grid-template-columns: 1fr;
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            .table {
                min-width: 600px;
            }
        }
        
        /* Hamburger Menu */
        .hamburger {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: #243849;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Hamburger Menu (Mobile) -->
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
                    <a class="nav-link active" href="<?= site_url('laboratory/test/request') ?>">
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
                    <a class="nav-link" href="<?= site_url('laboratory/reports') ?>">
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
                <h2>Test Requests</h2>
                <p class="text-muted">Manage laboratory test requests from doctors and nurses</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline-secondary">
                    <i class="fas fa-filter"></i> Filters
                </button>
                <button class="btn btn-primary" onclick="openModal()">
                    <i class="fas fa-plus"></i> New Request
                </button>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="summary-card total">
                <i class="fas fa-clipboard-list text-muted"></i>
                <h6 class="text-muted">Total Requests</h6>
                <div class="number">0</div>
            </div>
            <div class="summary-card new">
                <i class="fas fa-plus-circle text-primary"></i>
                <h6 class="text-muted">New Requests</h6>
                <div class="number">0</div>
            </div>
            <div class="summary-card progress">
                <i class="fas fa-play-circle text-warning"></i>
                <h6 class="text-muted">In Progress</h6>
                <div class="number">0</div>
            </div>
            <div class="summary-card urgent">
                <i class="fas fa-exclamation-triangle text-danger"></i>
                <h6 class="text-muted">Urgent/High Priority</h6>
                <div class="number">0</div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Patient</th>
                        <th>Test</th>
                        <th>Requested By</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($requests)): ?>
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list"></i>
                                    <h5>No test requests available</h5>
                                    <p>Click "New Request" to create your first test request</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($requests as $request): ?>
                            <tr>
                                <td><?= esc($request['lab_id']) ?></td>
                                <td><?= esc($request['patient_name']) ?></td>
                                <td><?= esc($request['tests']) ?></td>
                                <td><?= esc($request['doctor_name']) ?></td>
                                <td>
                                    <span class="badge badge-<?= strtolower($request['priority']) ?>">
                                        <?= esc($request['priority']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-<?= strtolower(str_replace(' ', '-', $request['status'])) ?>">
                                        <?= esc($request['status']) ?>
                                    </span>
                                </td>
                                <td><?= esc($request['expected_date']) ?></td>
                                <td>
                                    <div class="action-links">
                                        <a href="#" class="action-link process-link" onclick="openProcessModal('<?= $request['lab_id'] ?>', '<?= esc($request['patient_name']) ?>', '<?= esc($request['tests']) ?>', '<?= esc($request['priority']) ?>')">Process</a>
                                        <a href="#" class="action-link view-link" onclick="openViewModal('<?= $request['lab_id'] ?>', '<?= esc($request['patient_name']) ?>', '<?= esc($request['tests']) ?>', '<?= esc($request['priority']) ?>', '<?= esc($request['doctor_name']) ?>', '<?= esc($request['expected_date']) ?>')">View</a>
                                        <a href="#" class="action-link edit-link" onclick="openEditModal('<?= $request['lab_id'] ?>', '<?= esc($request['patient_name']) ?>', '<?= esc($request['tests']) ?>', '<?= esc($request['priority']) ?>', '<?= esc($request['expected_date']) ?>')">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="requestModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>New Test Request</h4>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            
            <form id="requestForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="patientId">Patient ID</label>
                            <input type="text" class="form-control" id="patientId" placeholder="Enter patient ID" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="testType">Test Type</label>
                            <select class="form-control" id="testType" required>
                                <option value="">Select test type</option>
                                <option value="blood">Blood Test</option>
                                <option value="urine">Urine Test</option>
                                <option value="imaging">Imaging</option>
                                <option value="serum">Serum Test</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <select class="form-control" id="priority" required>
                                <option value="">Select priority</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="requester">Requesting Doctor/Nurse</label>
                            <select class="form-control" id="requester" required>
                                <option value="">Select requester</option>
                                <option value="dr-rodriguez">Dr. Rodriguez</option>
                                <option value="dr-martinez">Dr. Martinez</option>
                                <option value="nurse-garcia">Nurse Garcia</option>
                                <option value="nurse-patricia">Nurse Patricia</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select class="form-control" id="department" required>
                                <option value="">Select department</option>
                                <option value="internal-medicine">Internal Medicine</option>
                                <option value="cardiology">Cardiology</option>
                                <option value="nephrology">Nephrology</option>
                                <option value="emergency">Emergency</option>
                                <option value="gastroenterology">Gastroenterology</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="roomNumber">Room Number</label>
                            <input type="text" class="form-control" id="roomNumber" placeholder="e.g., Room 204, ER Bay 3">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="clinicalNotes">Clinical Notes</label>
                    <textarea class="form-control" id="clinicalNotes" rows="4" placeholder="Enter clinical notes and symptoms"></textarea>
                </div>
                
                <div class="text-end">
                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-create">Create Request</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Process Test Request Modal -->
    <div class="modal-overlay" id="processModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Process Test Request</h4>
                <button class="close-btn" onclick="closeProcessModal()">&times;</button>
            </div>
            
            <div class="request-info-box">
                <div class="info-item">
                    <strong>ID:</strong> <span id="processRequestId">LAB-001</span>
                </div>
                <div class="info-item">
                    <strong>Patient:</strong> <span id="processPatientName">Maria Santos (P-12345)</span>
                </div>
                <div class="info-item">
                    <strong>Test:</strong> <span id="processTestType">Complete Blood Count</span>
                </div>
                <div class="info-item">
                    <strong>Priority:</strong> <span id="processPriority">high</span>
                </div>
            </div>
            
            <form id="processForm">
                <div class="form-group">
                    <label for="updateStatus">Update Status</label>
                    <select class="form-control" id="updateStatus" required>
                        <option value="">Select status</option>
                        <option value="Sample Collection Scheduled">Sample Collection Scheduled</option>
                        <option value="Sample Collected">Sample Collected</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Analysis Complete">Analysis Complete</option>
                        <option value="Results Ready">Results Ready</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="assignedTechnician">Assigned Technician</label>
                    <select class="form-control" id="assignedTechnician" required>
                        <option value="">Select technician</option>
                        <option value="tech1">John Smith</option>
                        <option value="tech2">Sarah Johnson</option>
                        <option value="tech3">Mike Davis</option>
                        <option value="tech4">Lisa Wilson</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="collectionNotes">Sample Collection Notes</label>
                    <textarea class="form-control" id="collectionNotes" rows="2" placeholder="Enter collection instructions or notes"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="completionTime">Expected Completion Time</label>
                    <input type="datetime-local" class="form-control" id="completionTime">
                </div>
                
                <div class="text-end">
                    <button type="button" class="btn btn-cancel" onclick="closeProcessModal()">Cancel</button>
                    <button type="submit" class="btn btn-create">Process Request</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Test Request Details Modal -->
    <div class="modal-overlay" id="viewModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Test Request Details</h4>
                <button class="close-btn" onclick="closeViewModal()">&times;</button>
            </div>
            
            <div class="details-container">
                <div class="details-column">
                    <div class="detail-item">
                        <strong>Request ID:</strong> <span id="viewRequestId">LAB-001</span>
                    </div>
                    <div class="detail-item">
                        <strong>Patient Information:</strong> <span id="viewPatientName">Maria Santos</span>
                    </div>
                    <div class="detail-item">
                        <strong>Patient ID:</strong> <span id="viewPatientId">P-12345</span>
                    </div>
                    <div class="detail-item">
                        <strong>Test Type:</strong> <span id="viewTestType">Complete Blood Count</span>
                    </div>
                    <div class="detail-item">
                        <strong>Sample Type:</strong> <span id="viewSampleType">Blood</span>
                    </div>
                    <div class="detail-item">
                        <strong>Room Number:</strong> <span id="viewRoomNumber">Room 204</span>
                    </div>
                    <div class="detail-item">
                        <strong>Requested Date:</strong> <span id="viewRequestedDate">2024-01-15</span>
                    </div>
                    <div class="detail-item">
                        <strong>Clinical Notes:</strong>
                        <div class="notes-text" id="viewClinicalNotes">Patient experiencing fatigue and weakness. Suspected anemia.</div>
                    </div>
                </div>
                
                <div class="details-column">
                    <div class="detail-item">
                        <strong>Requested By:</strong> <span id="viewRequestedBy">Dr. Rodriguez</span>
                    </div>
                    <div class="detail-item">
                        <strong>Role:</strong> <span id="viewRole">Doctor</span>
                    </div>
                    <div class="detail-item">
                        <strong>Department:</strong> <span id="viewDepartment">Internal Medicine</span>
                    </div>
                    <div class="detail-item">
                        <strong>Contact Number:</strong> <span id="viewContactNumber">+63 917 123 1567</span>
                    </div>
                    <div class="detail-item">
                        <strong>Priority:</strong> <span class="badge badge-urgent" id="viewPriority">high</span>
                    </div>
                    <div class="detail-item">
                        <strong>Status:</strong> <span class="badge badge-new-request" id="viewStatus">New Request</span>
                    </div>
                    <div class="detail-item">
                        <strong>Due Date:</strong> <span id="viewDueDate">2024-01-16</span>
                    </div>
                </div>
            </div>
            
            <div class="modal-actions">
                <button class="btn btn-cancel" onclick="closeViewModal()">Close</button>
                <button class="btn btn-process" onclick="processFromView()">Process Test</button>
                <button class="btn btn-edit" onclick="editFromView()">Edit Request</button>
            </div>
        </div>
    </div>

    <!-- Edit Test Request Modal -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Edit Test Request</h4>
                <button class="close-btn" onclick="closeEditModal()">&times;</button>
            </div>
            
            <form id="editForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editRequestId">Request ID</label>
                            <input type="text" class="form-control" id="editRequestId" value="LAB-001" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editPatientId">Patient ID</label>
                            <input type="text" class="form-control" id="editPatientId" value="P-12345" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editTestType">Test Type</label>
                            <select class="form-control" id="editTestType" required>
                                <option value="">Select test type</option>
                                <option value="Complete Blood Count" selected>Complete Blood Count</option>
                                <option value="Blood Test">Blood Test</option>
                                <option value="Urine Test">Urine Test</option>
                                <option value="Imaging">Imaging</option>
                                <option value="Serum Test">Serum Test</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editPriority">Priority</label>
                            <select class="form-control" id="editPriority" required>
                                <option value="">Select priority</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High" selected>High</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editDueDate">Due Date</label>
                            <input type="date" class="form-control" id="editDueDate" value="2024-01-16" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editRoomNumber">Room Number</label>
                            <input type="text" class="form-control" id="editRoomNumber" value="Room 204" placeholder="e.g., Room 204, ER Bay 3">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="editClinicalNotes">Clinical Notes</label>
                    <textarea class="form-control" id="editClinicalNotes" rows="3" placeholder="Enter clinical notes and symptoms">Patient experiencing fatigue and weakness. Suspected anemia.</textarea>
                </div>
                
                <div class="text-end">
                    <button type="button" class="btn btn-cancel" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="btn btn-create">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar toggle for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.querySelector('.hamburger');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(e.target) && 
                !hamburger.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });

        function openModal() {
            document.getElementById('requestModal').style.display = 'block';
        }
        
        function closeModal() {
            document.getElementById('requestModal').style.display = 'none';
            document.getElementById('requestForm').reset();
        }

        function openProcessModal(requestId, patientName, testType, priority) {
            document.getElementById('processRequestId').textContent = requestId;
            document.getElementById('processPatientName').textContent = patientName;
            document.getElementById('processTestType').textContent = testType;
            document.getElementById('processPriority').textContent = priority;
            document.getElementById('processModal').style.display = 'block';
        }

        function closeProcessModal() {
            document.getElementById('processModal').style.display = 'none';
            document.getElementById('processForm').reset();
        }

        function openViewModal(requestId, patientName, testType, priority, doctorName, dueDate) {
            document.getElementById('viewRequestId').textContent = requestId;
            document.getElementById('viewPatientName').textContent = patientName;
            document.getElementById('viewPatientId').textContent = 'P-12345';
            document.getElementById('viewTestType').textContent = testType;
            document.getElementById('viewSampleType').textContent = 'Blood';
            document.getElementById('viewRoomNumber').textContent = 'Room 204';
            document.getElementById('viewRequestedDate').textContent = '2024-01-15';
            document.getElementById('viewClinicalNotes').textContent = 'Patient experiencing fatigue and weakness. Suspected anemia.';
            document.getElementById('viewRequestedBy').textContent = doctorName;
            document.getElementById('viewRole').textContent = 'Doctor';
            document.getElementById('viewDepartment').textContent = 'Internal Medicine';
            document.getElementById('viewContactNumber').textContent = '+63 917 123 1567';
            document.getElementById('viewPriority').textContent = priority;
            document.getElementById('viewStatus').textContent = 'New Request';
            document.getElementById('viewDueDate').textContent = dueDate;
            document.getElementById('viewModal').style.display = 'block';
        }

        function closeViewModal() {
            document.getElementById('viewModal').style.display = 'none';
        }

        function processFromView() {
            closeViewModal();
            // Open process modal with same data
            const requestId = document.getElementById('viewRequestId').textContent;
            const patientName = document.getElementById('viewPatientName').textContent;
            const testType = document.getElementById('viewTestType').textContent;
            const priority = document.getElementById('viewPriority').textContent;
            openProcessModal(requestId, patientName, testType, priority);
        }

        function editFromView() {
            closeViewModal();
            // Open edit modal with same data
            const requestId = document.getElementById('viewRequestId').textContent;
            const patientName = document.getElementById('viewPatientName').textContent;
            const testType = document.getElementById('viewTestType').textContent;
            const priority = document.getElementById('viewPriority').textContent;
            const dueDate = document.getElementById('viewDueDate').textContent;
            openEditModal(requestId, patientName, testType, priority, dueDate);
        }

        function openEditModal(requestId, patientName, testType, priority, dueDate) {
            document.getElementById('editRequestId').value = requestId;
            document.getElementById('editPatientId').value = 'P-12345';
            document.getElementById('editTestType').value = testType;
            document.getElementById('editPriority').value = priority;
            document.getElementById('editDueDate').value = dueDate;
            document.getElementById('editRoomNumber').value = 'Room 204';
            document.getElementById('editClinicalNotes').value = 'Patient experiencing fatigue and weakness. Suspected anemia.';
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.getElementById('editForm').reset();
        }
        
        document.getElementById('requestForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                patientId: document.getElementById('patientId').value,
                testType: document.getElementById('testType').value,
                priority: document.getElementById('priority').value,
                requester: document.getElementById('requester').value,
                department: document.getElementById('department').value,
                roomNumber: document.getElementById('roomNumber').value,
                clinicalNotes: document.getElementById('clinicalNotes').value
            };
            
            console.log('New Test Request:', formData);
            alert('Test request created successfully! (Check console for details)');
            closeModal();
        });

        document.getElementById('processForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                requestId: document.getElementById('processRequestId').textContent,
                status: document.getElementById('updateStatus').value,
                technician: document.getElementById('assignedTechnician').value,
                notes: document.getElementById('collectionNotes').value,
                completionTime: document.getElementById('completionTime').value
            };
            
            console.log('Process Test Request:', formData);
            alert('Test request processed successfully! (Check console for details)');
            closeProcessModal();
        });

        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                requestId: document.getElementById('editRequestId').value,
                patientId: document.getElementById('editPatientId').value,
                testType: document.getElementById('editTestType').value,
                priority: document.getElementById('editPriority').value,
                dueDate: document.getElementById('editDueDate').value,
                roomNumber: document.getElementById('editRoomNumber').value,
                clinicalNotes: document.getElementById('editClinicalNotes').value
            };
            
            console.log('Edit Test Request:', formData);
            alert('Test request updated successfully! (Check console for details)');
            closeEditModal();
        });
        
        // Close modal when clicking outside
        document.getElementById('requestModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.getElementById('processModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeProcessModal();
            }
        });

        document.getElementById('viewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeViewModal();
            }
        });

        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</body>
</html>