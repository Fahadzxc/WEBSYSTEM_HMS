<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Dashboard - San Miguel HMS v2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container-fluid {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #243849;
            color: #ecf0f1;
            overflow-y: auto;
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
        
        .sidebar .nav {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
            display: block !important;
            flex-direction: column !important;
        }
        
        .sidebar .nav-item {
            margin-bottom: 5px !important;
        }

        .sidebar .nav-link {
            display: flex !important;
            align-items: center !important;
            padding: 12px 20px !important;
            color: #ecf0f1 !important;
            text-decoration: none !important;
            transition: all 0.3s ease !important;
            border-radius: 0 25px 25px 0 !important;
            margin-right: 10px !important;
        }
        
        .sidebar .nav-link:hover {
            background-color: #34495e !important;
            color: #fff !important;
        }
        
        .sidebar .nav-link.active {
            background-color: #3498db !important;
            color: #fff !important;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px !important;
            width: 20px !important;
            text-align: center !important;
        }
        
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #34495e;
        }
        

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background-color: #f8f9fa;
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
            font-size: 2rem !important;
            color: #2c3e50 !important;
            margin-bottom: 5px !important;
            font-weight: normal !important;
        }
        
        .header-content p {
            color: #6c757d;
            margin: 0;
        }
        
        .header-actions {
            display: flex;
            gap: 10px;
        }

        .header-info {
            text-align: right;
        }

        .header-info .date-time {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .header-info .user-info {
            color: #2c3e50;
            font-weight: 600;
            font-size: 16px;
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
        
        .summary-card.pending .number { color: #ffc107; }
        .summary-card.completed .number { color: #28a745; }
        .summary-card.equipment .number { color: #007bff; }
        .summary-card.reports .number { color: #6f42c1; }
        
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
            margin-top: 20px;
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
        
        .btn {
            padding: 8px 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0 2px;
        }
        
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        
        .btn-outline-secondary {
            background-color: transparent;
            color: #6c757d;
            border: 1px solid #6c757d;
        }
        
        .btn-outline-danger {
            background-color: transparent;
            color: #dc3545;
            border: 1px solid #dc3545;
        }
        
        .badge {
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        
        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        

        .section-header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .section-content {
            padding: 30px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }

        td {
            font-size: 14px;
            color: #555;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #1e7e34;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 11px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-control:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #2c3e50;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 10px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 30px;
            border-radius: 10px 10px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 18px;
        }

        .close {
            color: white;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            background: none;
            border: none;
        }

        .close:hover {
            opacity: 0.7;
        }

        .modal-body {
            padding: 30px;
        }

        .modal-footer {
            padding: 20px 30px;
            background-color: #f8f9fa;
            border-radius: 0 0 10px 10px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .summary-cards {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header-info {
                text-align: center;
            }
        }
		
		/* Bootstrap Replacement CSS */
		.text-center { text-align: center; }
		.text-white { color: #fff !important; }
		.text-muted { color: #6c757d !important; }
        .mb-4 { margin-bottom: 1.5rem !important; }
		.mb-2 { margin-bottom: 0.5rem !important; }
        .pt-3 { padding-top: 1rem !important; }
		.me-2 { margin-right: 0.5rem !important; }
        .mt-auto { margin-top: auto !important; }
        .nav { display: flex; flex-wrap: wrap; padding-left: 0; margin-bottom: 0; list-style: none; }
        .nav.flex-column { flex-direction: column !important; }
        .nav-item { margin-bottom: 0; }
        .d-flex { display: flex !important; }
        .justify-content-between { justify-content: space-between !important; }
        .align-items-center { align-items: center !important; }
        .btn { display: inline-block; font-weight: 400; line-height: 1.5; color: #212529; text-align: center; text-decoration: none; vertical-align: middle; cursor: pointer; user-select: none; background-color: transparent; border: 1px solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem; border-radius: 0.375rem; transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
        .btn-primary { color: #fff; background-color: #0d6efd; border-color: #0d6efd; }
        .btn-primary:hover { color: #fff; background-color: #0b5ed7; border-color: #0a58ca; }
        .btn-success { color: #fff; background-color: #198754; border-color: #198754; }
        .btn-success:hover { color: #fff; background-color: #157347; border-color: #146c43; }
        .btn-danger { color: #fff; background-color: #dc3545; border-color: #dc3545; }
        .btn-danger:hover { color: #fff; background-color: #bb2d3b; border-color: #b02a37; }
        .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.875rem; border-radius: 0.25rem; }
        .table { width: 100%; margin-bottom: 1rem; color: #212529; border-collapse: collapse; }
        .table th, .table td { padding: 0.75rem; vertical-align: top; border-top: 1px solid #dee2e6; }
        .table thead th { vertical-align: bottom; border-bottom: 2px solid #dee2e6; }
        .table-striped tbody tr:nth-of-type(odd) { background-color: rgba(0,0,0,0.05); }
        .table-hover tbody tr:hover { background-color: rgba(0,0,0,0.075); }
        .form-control { display: block; width: 100%; padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #212529; background-color: #fff; background-clip: padding-box; border: 1px solid #ced4da; border-radius: 0.375rem; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
        .form-control:focus { color: #212529; background-color: #fff; border-color: #86b7fe; outline: 0; box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.25); }
        .form-select { display: block; width: 100%; padding: 0.375rem 2.25rem 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #212529; background-color: #fff; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 16px 12px; border: 1px solid #ced4da; border-radius: 0.375rem; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
        .modal { position: fixed; top: 0; left: 0; z-index: 1055; width: 100%; height: 100%; overflow-x: hidden; overflow-y: auto; outline: 0; }
        .modal-dialog { position: relative; width: auto; margin: 0.5rem; pointer-events: none; }
        .modal-content { position: relative; display: flex; flex-direction: column; width: 100%; pointer-events: auto; background-color: #fff; background-clip: padding-box; border: 1px solid rgba(0,0,0,0.2); border-radius: 0.5rem; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15); outline: 0; }
        .modal-header { display: flex; flex-shrink: 0; align-items: center; justify-content: space-between; padding: 1rem 1rem; border-bottom: 1px solid #dee2e6; border-top-left-radius: calc(0.5rem - 1px); border-top-right-radius: calc(0.5rem - 1px); }
        .modal-body { position: relative; flex: 1 1 auto; padding: 1rem; }
        .modal-footer { display: flex; flex-wrap: wrap; flex-shrink: 0; align-items: center; justify-content: flex-end; padding: 0.75rem; border-top: 1px solid #dee2e6; border-bottom-right-radius: calc(0.5rem - 1px); border-bottom-left-radius: calc(0.5rem - 1px); }
        .modal-backdrop { position: fixed; top: 0; left: 0; z-index: 1050; width: 100vw; height: 100vh; background-color: #000; }
        .modal-backdrop.show { opacity: 0.5; }
        .modal.show .modal-dialog { transform: none; }
        .modal.fade .modal-dialog { transition: transform 0.3s ease-out; transform: translate(0, -50px); }
		.fa-2x { font-size: 2em; }
		.small { font-size: 0.875em; }
        .fw-bold { font-weight: 700 !important; }
        .text-success { color: #198754 !important; }
        .text-danger { color: #dc3545 !important; }
        .text-warning { color: #ffc107 !important; }
        .badge { display: inline-block; padding: 0.35em 0.65em; font-size: 0.75em; font-weight: 700; line-height: 1; color: #fff; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.375rem; }
        .badge.bg-success { background-color: #198754 !important; }
        .badge.bg-danger { background-color: #dc3545 !important; }
        .badge.bg-warning { background-color: #ffc107 !important; }
        .badge.bg-info { background-color: #0dcaf0 !important; }
        .badge.bg-primary { background-color: #0d6efd !important; }
        .badge.bg-secondary { background-color: #6c757d !important; }
        .badge.bg-light { background-color: #f8f9fa !important; color: #000 !important; }
        .badge.bg-dark { background-color: #212529 !important; }
        .spinner-border { display: inline-block; width: 2rem; height: 2rem; vertical-align: text-bottom; border: 0.25em solid currentcolor; border-right-color: transparent; border-radius: 50%; animation: spinner-border 0.75s linear infinite; }
        @keyframes spinner-border { to { transform: rotate(360deg); } }
        .spinner-border-sm { width: 1rem; height: 1rem; border-width: 0.125em; }
        .alert { position: relative; padding: 0.75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: 0.375rem; }
        .alert-success { color: #0f5132; background-color: #d1e7dd; border-color: #badbcc; }
        .alert-danger { color: #842029; background-color: #f8d7da; border-color: #f5c2c7; }
        .alert-warning { color: #664d03; background-color: #fff3cd; border-color: #ffecb5; }
        .alert-info { color: #055160; background-color: #d1ecf1; border-color: #b8daff; }
        .card { position: relative; display: flex; flex-direction: column; min-width: 0; word-wrap: break-word; background-color: #fff; background-clip: border-box; border: 1px solid rgba(0,0,0,0.125); border-radius: 0.375rem; }
        .card-body { flex: 1 1 auto; padding: 1rem 1rem; }
        .card-header { padding: 0.5rem 1rem; margin-bottom: 0; background-color: rgba(0,0,0,0.03); border-bottom: 1px solid rgba(0,0,0,0.125); }
        .card-footer { padding: 0.5rem 1rem; background-color: rgba(0,0,0,0.03); border-top: 1px solid rgba(0,0,0,0.125); }
        .row { display: flex; flex-wrap: wrap; margin-right: -0.75rem; margin-left: -0.75rem; }
        .col { flex: 1 0 0%; }
        .col-1 { flex: 0 0 auto; width: 8.33333333%; }
        .col-2 { flex: 0 0 auto; width: 16.66666667%; }
        .col-3 { flex: 0 0 auto; width: 25%; }
        .col-4 { flex: 0 0 auto; width: 33.33333333%; }
        .col-6 { flex: 0 0 auto; width: 50%; }
        .col-8 { flex: 0 0 auto; width: 66.66666667%; }
        .col-9 { flex: 0 0 auto; width: 75%; }
        .col-12 { flex: 0 0 auto; width: 100%; }
        .container { width: 100%; padding-right: 0.75rem; padding-left: 0.75rem; margin-right: auto; margin-left: auto; }
        .container-fluid { width: 100%; padding-right: 0.75rem; padding-left: 0.75rem; margin-right: auto; margin-left: auto; }
        .p-0 { padding: 0 !important; }
        .p-1 { padding: 0.25rem !important; }
        .p-2 { padding: 0.5rem !important; }
        .p-3 { padding: 1rem !important; }
        .p-4 { padding: 1.5rem !important; }
        .p-5 { padding: 3rem !important; }
        .m-0 { margin: 0 !important; }
        .m-1 { margin: 0.25rem !important; }
        .m-2 { margin: 0.5rem !important; }
        .m-3 { margin: 1rem !important; }
        .m-4 { margin: 1.5rem !important; }
        .m-5 { margin: 3rem !important; }
        .mt-0 { margin-top: 0 !important; }
        .mt-1 { margin-top: 0.25rem !important; }
        .mt-2 { margin-top: 0.5rem !important; }
        .mt-3 { margin-top: 1rem !important; }
        .mt-4 { margin-top: 1.5rem !important; }
        .mt-5 { margin-top: 3rem !important; }
        .mb-0 { margin-bottom: 0 !important; }
        .mb-1 { margin-bottom: 0.25rem !important; }
        .mb-2 { margin-bottom: 0.5rem !important; }
        .mb-3 { margin-bottom: 1rem !important; }
        .mb-4 { margin-bottom: 1.5rem !important; }
        .mb-5 { margin-bottom: 3rem !important; }
        .ms-0 { margin-left: 0 !important; }
        .ms-1 { margin-left: 0.25rem !important; }
        .ms-2 { margin-left: 0.5rem !important; }
        .ms-3 { margin-left: 1rem !important; }
        .ms-4 { margin-left: 1.5rem !important; }
        .ms-5 { margin-left: 3rem !important; }
        .me-0 { margin-right: 0 !important; }
        .me-1 { margin-right: 0.25rem !important; }
        .me-2 { margin-right: 0.5rem !important; }
        .me-3 { margin-right: 1rem !important; }
        .me-4 { margin-right: 1.5rem !important; }
        .me-5 { margin-right: 3rem !important; }
        .px-0 { padding-left: 0 !important; padding-right: 0 !important; }
        .px-1 { padding-left: 0.25rem !important; padding-right: 0.25rem !important; }
        .px-2 { padding-left: 0.5rem !important; padding-right: 0.5rem !important; }
        .px-3 { padding-left: 1rem !important; padding-right: 1rem !important; }
        .px-4 { padding-left: 1.5rem !important; padding-right: 1.5rem !important; }
        .px-5 { padding-left: 3rem !important; padding-right: 3rem !important; }
        .py-0 { padding-top: 0 !important; padding-bottom: 0 !important; }
        .py-1 { padding-top: 0.25rem !important; padding-bottom: 0.25rem !important; }
        .py-2 { padding-top: 0.5rem !important; padding-bottom: 0.5rem !important; }
        .py-3 { padding-top: 1rem !important; padding-bottom: 1rem !important; }
        .py-4 { padding-top: 1.5rem !important; padding-bottom: 1.5rem !important; }
        .py-5 { padding-top: 3rem !important; padding-bottom: 3rem !important; }
        .w-25 { width: 25% !important; }
        .w-50 { width: 50% !important; }
        .w-75 { width: 75% !important; }
        .w-100 { width: 100% !important; }
        .h-25 { height: 25% !important; }
        .h-50 { height: 50% !important; }
        .h-75 { height: 75% !important; }
        .h-100 { height: 100% !important; }
        .d-none { display: none !important; }
        .d-inline { display: inline !important; }
        .d-inline-block { display: inline-block !important; }
        .d-block { display: block !important; }
        .d-grid { display: grid !important; }
        .d-table { display: table !important; }
        .d-table-row { display: table-row !important; }
        .d-table-cell { display: table-cell !important; }
        .d-flex { display: flex !important; }
        .d-inline-flex { display: inline-flex !important; }
        .justify-content-start { justify-content: flex-start !important; }
        .justify-content-end { justify-content: flex-end !important; }
        .justify-content-center { justify-content: center !important; }
        .justify-content-between { justify-content: space-between !important; }
        .justify-content-around { justify-content: space-around !important; }
        .justify-content-evenly { justify-content: space-evenly !important; }
        .align-items-start { align-items: flex-start !important; }
        .align-items-end { align-items: flex-end !important; }
        .align-items-center { align-items: center !important; }
        .align-items-baseline { align-items: baseline !important; }
        .align-items-stretch { align-items: stretch !important; }
        .flex-row { flex-direction: row !important; }
        .flex-column { flex-direction: column !important; }
        .flex-wrap { flex-wrap: wrap !important; }
        .flex-nowrap { flex-wrap: nowrap !important; }
        .flex-fill { flex: 1 1 auto !important; }
        .flex-grow-0 { flex-grow: 0 !important; }
        .flex-grow-1 { flex-grow: 1 !important; }
        .flex-shrink-0 { flex-shrink: 0 !important; }
        .flex-shrink-1 { flex-shrink: 1 !important; }
        .text-start { text-align: left !important; }
        .text-end { text-align: right !important; }
        .text-center { text-align: center !important; }
        .text-justify { text-align: justify !important; }
        .text-nowrap { white-space: nowrap !important; }
        .text-wrap { white-space: normal !important; }
        .text-break { word-wrap: break-word !important; word-break: break-word !important; }
        .text-lowercase { text-transform: lowercase !important; }
        .text-uppercase { text-transform: uppercase !important; }
        .text-capitalize { text-transform: capitalize !important; }
        .text-decoration-none { text-decoration: none !important; }
        .text-decoration-underline { text-decoration: underline !important; }
        .text-decoration-line-through { text-decoration: line-through !important; }
        .text-primary { color: #0d6efd !important; }
        .text-secondary { color: #6c757d !important; }
        .text-success { color: #198754 !important; }
        .text-danger { color: #dc3545 !important; }
        .text-warning { color: #ffc107 !important; }
        .text-info { color: #0dcaf0 !important; }
        .text-light { color: #f8f9fa !important; }
        .text-dark { color: #212529 !important; }
        .text-muted { color: #6c757d !important; }
        .text-white { color: #fff !important; }
        .bg-primary { background-color: #0d6efd !important; }
        .bg-secondary { background-color: #6c757d !important; }
        .bg-success { background-color: #198754 !important; }
        .bg-danger { background-color: #dc3545 !important; }
        .bg-warning { background-color: #ffc107 !important; }
        .bg-info { background-color: #0dcaf0 !important; }
        .bg-light { background-color: #f8f9fa !important; }
        .bg-dark { background-color: #212529 !important; }
        .bg-white { background-color: #fff !important; }
        .bg-transparent { background-color: transparent !important; }
        .border { border: 1px solid #dee2e6 !important; }
        .border-0 { border: 0 !important; }
        .border-top { border-top: 1px solid #dee2e6 !important; }
        .border-end { border-right: 1px solid #dee2e6 !important; }
        .border-bottom { border-bottom: 1px solid #dee2e6 !important; }
        .border-start { border-left: 1px solid #dee2e6 !important; }
        .border-primary { border-color: #0d6efd !important; }
        .border-secondary { border-color: #6c757d !important; }
        .border-success { border-color: #198754 !important; }
        .border-danger { border-color: #dc3545 !important; }
        .border-warning { border-color: #ffc107 !important; }
        .border-info { border-color: #0dcaf0 !important; }
        .border-light { border-color: #f8f9fa !important; }
        .border-dark { border-color: #212529 !important; }
        .border-white { border-color: #fff !important; }
        .rounded { border-radius: 0.375rem !important; }
        .rounded-0 { border-radius: 0 !important; }
        .rounded-1 { border-radius: 0.2rem !important; }
        .rounded-2 { border-radius: 0.25rem !important; }
        .rounded-3 { border-radius: 0.3rem !important; }
        .rounded-circle { border-radius: 50% !important; }
        .rounded-pill { border-radius: 50rem !important; }
        .rounded-top { border-top-left-radius: 0.375rem !important; border-top-right-radius: 0.375rem !important; }
        .rounded-end { border-top-right-radius: 0.375rem !important; border-bottom-right-radius: 0.375rem !important; }
        .rounded-bottom { border-bottom-right-radius: 0.375rem !important; border-bottom-left-radius: 0.375rem !important; }
        .rounded-start { border-bottom-left-radius: 0.375rem !important; border-top-left-radius: 0.375rem !important; }
        .shadow { box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075) !important; }
        .shadow-sm { box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075) !important; }
        .shadow-lg { box-shadow: 0 1rem 3rem rgba(0,0,0,0.175) !important; }
        .shadow-none { box-shadow: none !important; }
        .position-static { position: static !important; }
        .position-relative { position: relative !important; }
        .position-absolute { position: absolute !important; }
        .position-fixed { position: fixed !important; }
        .position-sticky { position: sticky !important; }
        .top-0 { top: 0 !important; }
        .top-50 { top: 50% !important; }
        .top-100 { top: 100% !important; }
        .bottom-0 { bottom: 0 !important; }
        .bottom-50 { bottom: 50% !important; }
        .bottom-100 { bottom: 100% !important; }
        .start-0 { left: 0 !important; }
        .start-50 { left: 50% !important; }
        .start-100 { left: 100% !important; }
        .end-0 { right: 0 !important; }
        .end-50 { right: 50% !important; }
        .end-100 { right: 100% !important; }
        .translate-middle { transform: translate(-50%, -50%) !important; }
        .translate-middle-x { transform: translateX(-50%) !important; }
        .translate-middle-y { transform: translateY(-50%) !important; }
        .opacity-0 { opacity: 0 !important; }
        .opacity-25 { opacity: 0.25 !important; }
        .opacity-50 { opacity: 0.5 !important; }
        .opacity-75 { opacity: 0.75 !important; }
        .opacity-100 { opacity: 1 !important; }
        .overflow-auto { overflow: auto !important; }
        .overflow-hidden { overflow: hidden !important; }
        .overflow-visible { overflow: visible !important; }
        .overflow-scroll { overflow: scroll !important; }
        .overflow-x-auto { overflow-x: auto !important; }
        .overflow-x-hidden { overflow-x: hidden !important; }
        .overflow-x-visible { overflow-x: visible !important; }
        .overflow-x-scroll { overflow-x: scroll !important; }
        .overflow-y-auto { overflow-y: auto !important; }
        .overflow-y-hidden { overflow-y: hidden !important; }
        .overflow-y-visible { overflow-y: visible !important; }
        .overflow-y-scroll { overflow-y: scroll !important; }
        .d-print-none { display: none !important; }
        .d-print-inline { display: inline !important; }
        .d-print-inline-block { display: inline-block !important; }
        .d-print-block { display: block !important; }
        .d-print-grid { display: grid !important; }
        .d-print-table { display: table !important; }
        .d-print-table-row { display: table-row !important; }
        .d-print-table-cell { display: table-cell !important; }
        .d-print-flex { display: flex !important; }
        .d-print-inline-flex { display: inline-flex !important; }
        .visible { visibility: visible !important; }
        .invisible { visibility: hidden !important; }
        .user-select-all { user-select: all !important; }
        .user-select-auto { user-select: auto !important; }
        .user-select-none { user-select: none !important; }
        .pe-none { pointer-events: none !important; }
        .pe-auto { pointer-events: auto !important; }
        .rounded { border-radius: 0.375rem !important; }
        .rounded-0 { border-radius: 0 !important; }
        .rounded-1 { border-radius: 0.2rem !important; }
        .rounded-2 { border-radius: 0.25rem !important; }
        .rounded-3 { border-radius: 0.3rem !important; }
        .rounded-circle { border-radius: 50% !important; }
        .rounded-pill { border-radius: 50rem !important; }
        .rounded-top { border-top-left-radius: 0.375rem !important; border-top-right-radius: 0.375rem !important; }
        .rounded-end { border-top-right-radius: 0.375rem !important; border-bottom-right-radius: 0.375rem !important; }
        .rounded-bottom { border-bottom-right-radius: 0.375rem !important; border-bottom-left-radius: 0.375rem !important; }
        .rounded-start { border-bottom-left-radius: 0.375rem !important; border-top-left-radius: 0.375rem !important; }
	</style>
</head>
<body>
    <div class="container-fluid">
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
                    <a class="nav-link active" href="<?= site_url('laboratory') ?>">
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
                <a href="/auth/logout" class="nav-link logout-link">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
							</div>
						</div>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="header-content">
                    <h2>Laboratory Dashboard</h2>
                    <p class="text-muted">Monitor laboratory operations and test management</p>
                </div>
                <div class="header-actions">
                <div class="header-info">
                    <div class="date-time" id="currentDateTime"></div>
                    <div class="user-info">Welcome, <?= session('role') === 'laboratory' ? (session('user_name') ?? 'Lab Technician') : 'Lab Technician' ?></div>
                    </div>
					</div>
				</div>

            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="summary-card total">
                    <i class="fas fa-clipboard-list text-muted"></i>
                    <h6 class="text-muted">Tests Today</h6>
                    <div class="number">42</div>
					</div>
                <div class="summary-card new">
                    <i class="fas fa-clock text-warning"></i>
                    <h6 class="text-muted">Pending Results</h6>
                    <div class="number">18</div>
					</div>
                <div class="summary-card progress">
                    <i class="fas fa-check-circle text-success"></i>
                    <h6 class="text-muted">Completed Tests</h6>
                    <div class="number">156</div>
					</div>
                <div class="summary-card urgent">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    <h6 class="text-muted">Critical Results</h6>
                    <div class="number">3</div>
					</div>
				</div>

            <!-- Table -->
            <div class="table-container">
                <table class="table">
									<thead>
										<tr>
                            <th>Test ID</th>
                            <th>Patient</th>
                                    <th>Test Type</th>
                            <th>Priority</th>
                                    <th>Status</th>
                                    <th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<tr>
                            <td>LAB-001</td>
                            <td>Maria Santos<br><small class="text-muted">Requested by Dr. Rodriguez</small></td>
                            <td>Complete Blood Count<br><small class="text-muted">Blood</small></td>
                            <td><span class="badge badge-danger">HIGH</span></td>
                            <td><span class="badge badge-primary">IN PROGRESS</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Process</button>
                                <button class="btn btn-sm btn-outline-secondary">View</button>
                                    </td>
										</tr>
										<tr>
                            <td>LAB-002</td>
                            <td>Juan Dela Cruz<br><small class="text-muted">Requested by Dr. Garcia</small></td>
                            <td>Lipid Profile<br><small class="text-muted">Blood</small></td>
                            <td><span class="badge badge-warning">MEDIUM</span></td>
                            <td><span class="badge badge-success">SAMPLE RECEIVED</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Process</button>
                                <button class="btn btn-sm btn-outline-secondary">View</button>
                                    </td>
										</tr>
										<tr>
                            <td>LAB-003</td>
                            <td>Ana Reyes<br><small class="text-muted">Requested by Dr. Martinez</small></td>
                            <td>Urinalysis<br><small class="text-muted">Urine</small></td>
                            <td><span class="badge badge-success">LOW</span></td>
                            <td><span class="badge badge-secondary">PENDING</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Process</button>
                                <button class="btn btn-sm btn-outline-secondary">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>LAB-004</td>
                            <td>Carlos Mendoza<br><small class="text-muted">Requested by Dr. Lopez</small></td>
                            <td>Chest X-Ray<br><small class="text-muted">Imaging</small></td>
                            <td><span class="badge badge-danger">HIGH</span></td>
                            <td><span class="badge badge-primary">IN PROGRESS</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Process</button>
                                <button class="btn btn-sm btn-outline-secondary">View</button>
                                    </td>
										</tr>
									</tbody>
								</table>
			</div>
		</main>
	</div>

    <script>
    // Update date and time
    function updateDateTime() {
        const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
            day: 'numeric', 
                hour: '2-digit',
                minute: '2-digit', 
                second: '2-digit'
            };
            document.getElementById('currentDateTime').textContent = now.toLocaleDateString('en-US', options);
        }

        // Update every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
    </script>
</body>
</html>