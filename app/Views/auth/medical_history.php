<?php echo view('auth/partials/header', ['title' => 'Medical History']); ?>
<div class="container">
    <?php echo view('auth/partials/sidebar'); ?>
    <main class="main-content">
        <header class="header">
            <div>
                <h1>Medical History</h1>
                <div class="sub" style="color:#64748b">View comprehensive patient medical histories</div>
            </div>
            <a href="<?= site_url('patient-management') ?>" class="back-btn">
                <span>←</span> Back to Patients
            </a>
        </header>
        
        <div class="page-content">
            <div class="three-panel-layout">
                <!-- Left Panel - Patient List -->
                <div class="left-panel">
                    <div class="search-card">
                        <div class="search-input-wrapper">
                            <span class="search-icon">🔍</span>
                            <input type="text" class="search-input" id="patientSearch" placeholder="Search patients...">
                        </div>
                    </div>
                    
                    <div class="patient-list">
                        <?php foreach (($patients ?? []) as $p): ?>
                            <div class="patient-item" data-patient-id="<?= $p['id'] ?>" onclick="selectPatient(<?= $p['id'] ?>, <?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>)">
                                <div class="patient-avatar">👤</div>
                                <div class="patient-info">
                                    <div class="patient-name"><?= esc(($p['first_name'] ?? '').' '.($p['last_name'] ?? '')) ?></div>
                                    <div class="patient-meta">
                                        P<?= esc(str_pad((string)$p['id'],3,'0',STR_PAD_LEFT)) ?> • 
                                        <?php 
                                            if (!empty($p['dob'])) {
                                                $dob = new DateTime($p['dob']);
                                                $now = new DateTime();
                                                echo $dob->diff($now)->y . 'y';
                                            } else {
                                                echo 'N/A';
                                            }
                                        ?> • 
                                        <?= esc($p['gender'] ?? 'N/A') ?>
                                    </div>
                                    <div class="patient-visits" id="visits-<?= $p['id'] ?>">Loading consultations...</div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Middle Panel - Medical History Timeline -->
                <div class="middle-panel">
                    <div class="timeline-header">
                        <h2>Medical History Timeline</h2>
                        <div class="selected-patient-info" id="selectedPatientInfo">
                            <div class="select-patient-message">
                                <div class="message-icon">👥</div>
                                <div class="message-title">Select a Patient</div>
                                <div class="message-subtitle">Choose a patient from the list to view their medical history</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-content" id="timelineContent">
                        <!-- Timeline will be populated here -->
                    </div>
                </div>
                
                <!-- Right Panel - Medical Record Details -->
                <div class="right-panel">
                    <div class="record-details" id="recordDetails">
                        <div class="select-record-message">
                            <div class="record-icon">📋</div>
                            <div class="record-title">Select a Medical Record</div>
                            <div class="record-subtitle">Choose a visit from the timeline to view detailed medical records</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
/* Header */
.header {
    background: white;
    padding: 24px 32px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    border-radius: 12px;
}

.header h1 {
    font-size: 28px;
    color: #1e293b;
    font-weight: 700;
    margin: 0;
}

.header .sub {
    color: #64748b;
    font-size: 15px;
    margin-top: 6px;
    font-weight: 400;
}

.back-btn {
    background: #374151;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
}

/* Page Content */
.page-content {
    padding: 0 32px 32px;
}

/* Three Panel Layout */
.three-panel-layout {
    display: grid;
    grid-template-columns: 320px 1fr 320px;
    gap: 24px;
    height: calc(100vh - 220px);
}

/* Left Panel - Patient List */
.left-panel {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    border: 1px solid #f1f5f9;
}

.search-card {
    padding: 20px;
    border-bottom: 1px solid #f1f5f9;
    background: #fafafa;
}

.search-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.search-icon {
    position: absolute;
    left: 14px;
    color: #94a3b8;
    font-size: 16px;
    z-index: 2;
}

.search-input {
    width: 100%;
    padding: 14px 14px 14px 42px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-size: 14px;
    outline: none;
    background: white;
    color: #374151;
}

.search-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-input::placeholder {
    color: #9ca3af;
}

.patient-list {
    overflow-y: auto;
    max-height: calc(100vh - 340px);
}

.patient-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 20px;
    cursor: pointer;
    border-left: 4px solid transparent;
    border-bottom: 1px solid #f8fafc;
}

.patient-item.selected {
    background-color: #eff6ff;
    border-left-color: #3b82f6;
}

.patient-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #e0e7ff;
    display: grid;
    place-items: center;
    color: #6366f1;
    font-weight: 600;
    font-size: 18px;
    flex-shrink: 0;
}

.patient-info {
    flex: 1;
    min-width: 0;
}

.patient-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 15px;
    margin-bottom: 3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.patient-meta {
    color: #64748b;
    font-size: 13px;
    font-weight: 400;
    margin-bottom: 3px;
}

.patient-visits {
    color: #059669;
    font-size: 12px;
    font-weight: 500;
}

/* Middle Panel - Timeline */
.middle-panel {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    border: 1px solid #f1f5f9;
}

.timeline-header {
    padding: 24px;
    border-bottom: 1px solid #f1f5f9;
}

.timeline-header h2 {
    font-size: 20px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 16px 0;
}

.timeline-content {
    padding: 24px;
    height: calc(100vh - 340px);
    overflow-y: auto;
}

/* Timeline Items */
.timeline-item {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
    padding: 20px;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    cursor: pointer;
    transition: all 0.2s;
}

.timeline-item:hover {
    background: #f1f5f9;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.timeline-item.selected {
    background: #eff6ff;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.timeline-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 6px;
}

.timeline-content-info {
    flex: 1;
}

.timeline-title {
    font-weight: 600;
    color: #1e293b;
    font-size: 16px;
    margin-bottom: 6px;
}

.timeline-description {
    color: #374151;
    font-size: 14px;
    margin-bottom: 8px;
    line-height: 1.5;
}

.timeline-doctor {
    color: #059669;
    font-size: 13px;
    font-weight: 500;
}

.timeline-room {
    color: #7c3aed;
    font-size: 13px;
    font-weight: 500;
    margin-left: 12px;
}

.timeline-status-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    color: white;
    margin-top: 8px;
}

/* Right Panel - Record Details */
.right-panel {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    border: 1px solid #f1f5f9;
}

.record-details {
    padding: 28px;
    height: 100%;
    overflow-y: auto;
}

.select-record-message {
    display: grid;
    place-items: center;
    min-height: 400px;
    text-align: center;
    color: #94a3b8;
}

.record-icon {
    font-size: 72px;
    line-height: 1;
    margin-bottom: 20px;
    opacity: 0.6;
}

.record-title {
    font-weight: 600;
    color: #1e293b;
    font-size: 22px;
    margin-bottom: 10px;
}

.record-subtitle {
    color: #64748b;
    font-size: 15px;
    max-width: 300px;
    line-height: 1.5;
}

/* Record Details */
.record-header {
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.record-header-main {
    flex: 1;
}

.record-header h3 {
    font-size: 20px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 8px 0;
}

.record-header-meta {
    color: #64748b;
    font-size: 14px;
    display: flex;
    gap: 16px;
}

.record-date {
    font-weight: 500;
}

.record-doctor {
    font-weight: 500;
}

.record-room {
    font-weight: 500;
    color: #8b5cf6;
}

.record-actions {
    display: flex;
    gap: 10px;
}

.btn {
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    transition: background-color 0.2s;
}

.btn-primary {
    background: #3b82f6;
    color: white;
}

.btn-primary:hover {
    background: #2563eb;
}

.btn-success {
    background: #10b981;
    color: white;
}

.btn-success:hover {
    background: #059669;
}

.record-content {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.record-section {
    background: #f8fafc;
    padding: 16px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.record-label {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.record-value {
    font-size: 14px;
    color: #1e293b;
    font-weight: 500;
    line-height: 1.5;
}

/* Vital Signs Grid */
.vital-signs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 12px;
    margin-top: 8px;
}

.vital-sign-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    background: #f0f9ff;
    border-radius: 8px;
    border: 1px solid #bae6fd;
}

.vital-label {
    font-size: 12px;
    color: #374151;
    font-weight: 500;
}

.vital-value {
    font-size: 14px;
    color: #1e293b;
    font-weight: 600;
}

/* Patient Info Enhancements */
.selected-patient-header {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.selected-patient-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #e0e7ff;
    display: grid;
    place-items: center;
    color: #6366f1;
    font-weight: 600;
    font-size: 20px;
    flex-shrink: 0;
}

.selected-patient-details {
    flex: 1;
}

.selected-patient-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 18px;
    margin-bottom: 4px;
}

.selected-patient-meta {
    color: #64748b;
    font-size: 14px;
    margin-bottom: 4px;
}

.selected-patient-visits {
    color: #059669;
    font-size: 13px;
    font-weight: 500;
}

/* Message States */
.select-patient-message, .select-record-message {
    display: grid;
    place-items: center;
    min-height: 400px;
    text-align: center;
    color: #94a3b8;
}

.message-icon, .record-icon {
    font-size: 72px;
    line-height: 1;
    margin-bottom: 20px;
    opacity: 0.6;
}

.message-title, .record-title {
    font-weight: 600;
    color: #1e293b;
    font-size: 22px;
    margin-bottom: 10px;
}

.message-subtitle, .record-subtitle {
    color: #64748b;
    font-size: 15px;
    max-width: 300px;
    line-height: 1.5;
}

/* Responsive Design */
@media (max-width: 1400px) {
    .three-panel-layout {
        grid-template-columns: 280px 1fr 280px;
        gap: 20px;
    }
}

@media (max-width: 1200px) {
    .three-panel-layout {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .left-panel { order: 2; }
    .middle-panel { order: 1; }
    .right-panel { order: 3; }
}

@media (max-width: 768px) {
    .header {
        padding: 20px;
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
    }
    
    .page-content {
        padding: 0 20px 20px;
    }
}
</style>

<script>
// Search functionality
document.getElementById('patientSearch').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const patientItems = document.querySelectorAll('.patient-item');
    
    patientItems.forEach(item => {
        const patientName = item.querySelector('.patient-name').textContent.toLowerCase();
        const patientMeta = item.querySelector('.patient-meta').textContent.toLowerCase();
        
        const shouldShow = patientName.includes(searchTerm) || patientMeta.includes(searchTerm);
        item.style.display = shouldShow ? 'flex' : 'none';
    });
});

// Load visit count for each patient
function loadVisitCounts() {
    const patientItems = document.querySelectorAll('.patient-item');
    patientItems.forEach(item => {
        const patientId = item.getAttribute('data-patient-id');
        loadPatientVisits(patientId);
    });
}

// Load patient visits count
function loadPatientVisits(patientId) {
    fetch(`<?= site_url('doctor/consultations/getPatientConsultations/') ?>${patientId}`)
        .then(response => response.json())
        .then(data => {
            const visitsElement = document.getElementById(`visits-${patientId}`);
            if (visitsElement) {
                if (data.success && data.consultations) {
                    const visitCount = data.consultations.length;
                    visitsElement.textContent = `${visitCount} consultation${visitCount !== 1 ? 's' : ''}`;
                } else {
                    visitsElement.textContent = '0 consultations';
                }
            }
        })
        .catch(error => {
            console.error('Error loading consultations:', error);
            const visitsElement = document.getElementById(`visits-${patientId}`);
            if (visitsElement) {
                visitsElement.textContent = '0 consultations';
            }
        });
}

// Patient selection
function selectPatient(patientId, patientData) {
    // Remove selected class from all items
    document.querySelectorAll('.patient-item').forEach(item => {
        item.classList.remove('selected');
    });
    
    // Add selected class to clicked item
    event.currentTarget.classList.add('selected');
    
    // Display patient info in timeline header
    displayPatientInfo(patientData);
    
    // Load and display real consultation data
    loadPatientConsultations(patientId);
    
    // Reset record details
    resetRecordDetails();
}

// Display patient info in timeline header
function displayPatientInfo(patient) {
    const patientInfoContainer = document.getElementById('selectedPatientInfo');
    const visitsElement = document.getElementById(`visits-${patient.id}`);
    const visitCount = visitsElement ? visitsElement.textContent : '0 visits';
    
    patientInfoContainer.innerHTML = `
        <div class="selected-patient-header">
            <div class="selected-patient-avatar">👤</div>
            <div class="selected-patient-details">
                <div class="selected-patient-name">${patient.first_name} ${patient.last_name}</div>
                <div class="selected-patient-meta">P${String(patient.id).padStart(3, '0')} • ${patient.gender}</div>
                <div class="selected-patient-visits">${visitCount}</div>
            </div>
        </div>
    `;
}

// Update patient info with consultation data
function updatePatientInfoWithConsultations(patient, consultations) {
    const patientInfoContainer = document.getElementById('selectedPatientInfo');
    const visitCount = consultations ? consultations.length : 0;
    const lastVisit = consultations && consultations.length > 0 ? consultations[0].date_time : 'No consultations yet';
    
    patientInfoContainer.innerHTML = `
        <div class="selected-patient-header">
            <div class="selected-patient-avatar">👤</div>
            <div class="selected-patient-details">
                <div class="selected-patient-name">${patient.first_name} ${patient.last_name}</div>
                <div class="selected-patient-meta">P${String(patient.id).padStart(3, '0')} • ${patient.gender}</div>
                <div class="selected-patient-visits">${visitCount} total consultations • Last: ${lastVisit}</div>
            </div>
        </div>
    `;
}

// Load real patient consultations from database
function loadPatientConsultations(patientId) {
    console.log('Loading consultations for patient ID:', patientId);
    fetch(`<?= site_url('doctor/consultations/getPatientConsultations/') ?>${patientId}`)
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                const consultations = data.consultations || [];
                console.log('Consultations found:', consultations);
                displayConsultationTimeline(consultations);
                // Update visit count
                updateVisitCount(patientId, consultations.length);
                // Update patient info with consultation data
                const patientItem = document.querySelector(`[data-patient-id="${patientId}"]`);
                if (patientItem) {
                    const patientData = JSON.parse(patientItem.getAttribute('onclick').match(/selectPatient\((\d+), (.+)\)/)[2]);
                    updatePatientInfoWithConsultations(patientData, consultations);
                }
            } else {
                console.error('Error loading consultations:', data.message);
                displayConsultationTimeline([]);
                updateVisitCount(patientId, 0);
            }
        })
        .catch(error => {
            console.error('Error loading consultations:', error);
            displayConsultationTimeline([]);
            updateVisitCount(patientId, 0);
        });
}

// Update visit count for a patient
function updateVisitCount(patientId, count) {
    const visitsElement = document.getElementById(`visits-${patientId}`);
    if (visitsElement) {
        visitsElement.textContent = `${count} visit${count !== 1 ? 's' : ''}`;
    }
}

// Display consultation timeline
function displayConsultationTimeline(consultations) {
    const timelineContent = document.getElementById('timelineContent');
    
    if (consultations.length === 0) {
        timelineContent.innerHTML = `
            <div class="no-consultations">
                <div style="text-align: center; color: #94a3b8; padding: 40px;">
                    <div style="font-size: 48px; margin-bottom: 16px;">🩺</div>
                    <div style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">No Consultations</div>
                    <div style="color: #64748b;">This patient has no medical consultations yet. Follow-ups will appear here once a doctor creates a consultation.</div>
                </div>
            </div>
        `;
        return;
    }
    
    // Sort consultations by date (newest first)
    consultations.sort((a, b) => new Date(b.date_time) - new Date(a.date_time));
    
    timelineContent.innerHTML = consultations.map(consultation => {
        const status = consultation.status || 'active';
        const statusText = status.charAt(0).toUpperCase() + status.slice(1);
        
        // Get status color based on consultation status
        let statusColor = '#3b82f6'; // default blue
        if (status.toLowerCase() === 'completed') statusColor = '#10b981'; // green
        if (status.toLowerCase() === 'active') statusColor = '#f59e0b'; // orange
        if (status.toLowerCase() === 'cancelled') statusColor = '#ef4444'; // red
        
        // Format date for display
        const consultationDate = new Date(consultation.date_time);
        const formattedDate = consultationDate.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: '2-digit', 
            day: '2-digit' 
        });
        
        // Generate medical description based on consultation type
        let medicalDescription = consultation.chief_complaint || 'Medical consultation';
        if (consultation.consultation_type && consultation.consultation_type.toLowerCase() === 'follow-up') {
            medicalDescription = 'Follow-up consultation - Monitoring progress';
        } else if (consultation.consultation_type && consultation.consultation_type.toLowerCase() === 'emergency') {
            medicalDescription = 'Emergency consultation - Immediate care provided';
        }
        
        return `
            <div class="timeline-item" onclick="selectConsultation(${JSON.stringify(consultation).replace(/"/g, '&quot;')})">
                <div class="timeline-dot" style="background-color: ${statusColor}"></div>
                <div class="timeline-content-info">
                    <div class="timeline-title">
                        <strong>${consultation.consultation_type || 'General Consultation'}</strong> (${formattedDate})
                    </div>
                    <div class="timeline-description">
                        ${medicalDescription}
                    </div>
                    <div class="timeline-doctor">
                        Dr. ${consultation.doctor_name || 'Unknown'}
                        <span class="timeline-room">• Room ${consultation.room || 'N/A'}</span>
                    </div>
                    <div class="timeline-status-badge" style="background-color: ${statusColor}; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                        ${statusText}
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

// Select consultation
function selectConsultation(consultation) {
    // Remove selected class from all timeline items
    document.querySelectorAll('.timeline-item').forEach(item => {
        item.classList.remove('selected');
    });
    
    // Add selected class to clicked item
    event.currentTarget.classList.add('selected');
    
    // Display consultation details
    displayConsultationDetails(consultation);
}

// Display consultation details
function displayConsultationDetails(consultation) {
    const recordDetails = document.getElementById('recordDetails');
    const status = consultation.status || 'active';
    const statusText = status.charAt(0).toUpperCase() + status.slice(1);
    
    // Format date for display
    const consultationDate = new Date(consultation.date_time);
    const formattedDate = consultationDate.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: '2-digit', 
        day: '2-digit' 
    });
    const formattedTime = consultationDate.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
    
    recordDetails.innerHTML = `
        <div class="record-header">
            <div class="record-header-main">
                <h3>${consultation.consultation_type || 'General Consultation'}</h3>
                <div class="record-header-meta">
                    <span class="record-date">${formattedDate} ${formattedTime}</span>
                    <span class="record-doctor">Dr. ${consultation.doctor_name || 'Unknown'}</span>
                    ${consultation.room ? `<span class="record-room">📍 ${consultation.room}</span>` : ''}
                </div>
            </div>
            <div class="record-actions">
                <button class="btn btn-primary">Print</button>
                <button class="btn btn-success">Share</button>
            </div>
        </div>
        <div class="record-content">
            <div class="record-section">
                <div class="record-label">Vital Signs</div>
                <div class="vital-signs-grid">
                    <div class="vital-sign-item">
                        <span class="vital-label">Blood Pressure:</span>
                        <span class="vital-value">${consultation.blood_pressure || 'N/A'}</span>
                    </div>
                    <div class="vital-sign-item">
                        <span class="vital-label">Heart Rate:</span>
                        <span class="vital-value">${consultation.heart_rate || 'N/A'}</span>
                    </div>
                    <div class="vital-sign-item">
                        <span class="vital-label">Temperature:</span>
                        <span class="vital-value">${consultation.temperature || 'N/A'}</span>
                    </div>
                    <div class="vital-sign-item">
                        <span class="vital-label">Weight:</span>
                        <span class="vital-value">${consultation.weight || 'N/A'}</span>
                    </div>
                </div>
            </div>
            <div class="record-section">
                <div class="record-label">Chief Complaint</div>
                <div class="record-value">${consultation.chief_complaint || 'No complaint recorded'}</div>
            </div>
            <div class="record-section">
                <div class="record-label">History of Present Illness</div>
                <div class="record-value">${consultation.history_illness || 'No history recorded'}</div>
            </div>
            <div class="record-section">
                <div class="record-label">Physical Examination</div>
                <div class="record-value">${consultation.physical_exam || 'No examination recorded'}</div>
            </div>
            <div class="record-section">
                <div class="record-label">Assessment & Diagnosis</div>
                <div class="record-value">${consultation.assessment || 'No diagnosis recorded'}</div>
            </div>
            <div class="record-section">
                <div class="record-label">Treatment Plan</div>
                <div class="record-value">${consultation.treatment_plan || 'No treatment plan recorded'}</div>
            </div>
            <div class="record-section">
                <div class="record-label">Additional Notes</div>
                <div class="record-value">${consultation.notes || 'No additional notes available'}</div>
            </div>
        </div>
    `;
}



// Reset record details
function resetRecordDetails() {
    const recordDetails = document.getElementById('recordDetails');
    recordDetails.innerHTML = `
        <div class="select-record-message">
            <div class="record-icon">📋</div>
            <div class="record-title">Select a Medical Record</div>
            <div class="record-subtitle">Choose a visit from the timeline to view detailed medical records</div>
        </div>
    `;
}

// Auto-select first patient if available
document.addEventListener('DOMContentLoaded', function() {
    // Load visit counts for all patients
    loadVisitCounts();
    
    const firstPatient = document.querySelector('.patient-item');
    if (firstPatient) {
        const patientId = firstPatient.getAttribute('data-patient-id');
        const patientData = JSON.parse(firstPatient.getAttribute('onclick').match(/selectPatient\((\d+), (.+)\)/)[2]);
        selectPatient(patientId, patientData);
    }
});
</script>

<?php echo view('auth/partials/footer'); ?>

<?php echo view('auth/partials/footer'); ?>
