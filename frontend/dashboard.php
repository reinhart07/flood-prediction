<?php 
session_start();
// Check if logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$title = "Dashboard - FloodGuard Jakarta";
$user_name = $_SESSION['full_name'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .dashboard-container {
            min-height: 100vh;
            background: var(--lighter-bg);
            padding-top: 70px;
        }
        
        .dashboard-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: #f1f5f9;
            padding: 2rem 0;
        }
        
        .dashboard-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .user-info h2 {
            margin: 0 0 0.5rem 0;
        }
        
        .user-info p {
            margin: 0;
            color: #cbd5e1;
        }
        
        .dashboard-nav {
            display: flex;
            gap: 1rem;
        }
        
        .dashboard-nav a {
            padding: 0.75rem 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            color: #f1f5f9;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .dashboard-nav a:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .dashboard-content {
            padding: 2rem 0;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card-dash {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .stat-icon-dash {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #f1f5f9;
        }
        
        .stat-info h3 {
            margin: 0;
            font-size: 2rem;
            color: #1e3a8a;
        }
        
        .stat-info p {
            margin: 0.25rem 0 0 0;
            color: #64748b;
        }
        
        .history-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }
        
        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .history-header h3 {
            margin: 0;
            color: #1e3a8a;
        }
        
        .filter-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .filter-btn {
            padding: 0.5rem 1rem;
            border: 2px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            color: #64748b;
            transition: all 0.3s ease;
        }
        
        .filter-btn.active {
            background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%);
            color: #f1f5f9;
            border-color: #3b82f6;
        }
        
        .history-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .history-table thead {
            background: #1e3a8a;
            color: #f1f5f9;
        }
        
        .history-table th,
        .history-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .history-table tbody tr:hover {
            background: #f1f5f9;
        }
        
        .risk-badge-table {
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .badge-low {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-medium {
            background: #fef3c7;
            color: #92400e;
        }
        
        .badge-high {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-view,
        .btn-delete {
            padding: 0.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-view {
            background: #3b82f6;
            color: #f1f5f9;
        }
        
        .btn-view:hover {
            background: #1e3a8a;
        }
        
        .btn-delete {
            background: #ef4444;
            color: #f1f5f9;
        }
        
        .btn-delete:hover {
            background: #991b1b;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #64748b;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #cbd5e1;
        }
        
        .loading {
            text-align: center;
            padding: 2rem;
            color: #64748b;
        }
        
        .loading i {
            font-size: 2rem;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }
        
        .pagination button {
            padding: 0.5rem 1rem;
            border: 2px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            color: #64748b;
            transition: all 0.3s ease;
        }
        
        .pagination button:hover:not(:disabled) {
            background: #3b82f6;
            color: #f1f5f9;
            border-color: #3b82f6;
        }
        
        .pagination button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.9);
        }
        
        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem;
            border-radius: 12px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .modal-header h3 {
            margin: 0;
            color: #1e3a8a;
        }
        
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #64748b;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .detail-item {
            background: #f1f5f9;
            padding: 1rem;
            border-radius: 8px;
        }
        
        .detail-item strong {
            display: block;
            color: #1e3a8a;
            margin-bottom: 0.25rem;
        }
        
        .detail-item span {
            color: #334155;
            font-size: 1.1rem;
        }
        
        @media (max-width: 768px) {
            .dashboard-header .container {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .dashboard-nav {
                flex-direction: column;
                width: 100%;
            }
            
            .dashboard-nav a {
                text-align: center;
            }
            
            .history-table {
                display: block;
                overflow-x: auto;
            }
            
            .filter-buttons {
                flex-direction: column;
            }
            
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
        .btn-download {
        padding: 0.5rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #10b981;
        color: #f1f5f9;
    }

    .btn-download:hover {
        background: #059669;
    }

    /* Download Modal */
    .download-modal-content {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 2rem;
        border-radius: 12px;
        max-width: 400px;
        width: 90%;
    }

    .download-options {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .download-option-btn {
        padding: 1rem;
        border: 2px solid #e2e8f0;
        background: #f8fafc;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .download-option-btn:hover {
        background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%);
        color: #f1f5f9;
        border-color: #3b82f6;
        transform: translateY(-2px);
    }

    .download-option-btn i {
        font-size: 1.5rem;
    }

    .download-option-info {
        text-align: left;
    }

    .download-option-info strong {
        display: block;
        font-size: 1rem;
    }

    .download-option-info small {
        color: #64748b;
        font-size: 0.85rem;
    }

    .download-option-btn:hover .download-option-info small {
        color: #cbd5e1;
    }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <i class="fas fa-shield-alt"></i>
                <span>FloodGuard</span>
            </div>
            <ul class="nav-menu">
                <li><a href="../index.php">Home</a></li>
                <li><a href="prediksi.php">Flood Prediction</a></li>
                <li><a href="peta.php">Map</a></li>
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
                <li><a href="#" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
            <div class="nav-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="container">
                <div class="user-info">
                    <h2><i class="fas fa-user-circle"></i> Welcome, <?= htmlspecialchars($user_name) ?>!</h2>
                    <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($email) ?> | <i class="fas fa-at"></i> <?= htmlspecialchars($username) ?></p>
                </div>
                <div class="dashboard-nav">
                    <a href="prediksi.php"><i class="fas fa-cloud-rain"></i> New Prediction</a>
                    <a href="peta.php"><i class="fas fa-map"></i> View Map</a>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="container">
                <!-- Statistics -->
                <div class="stats-grid">
                    <div class="stat-card-dash">
                        <div class="stat-icon-dash">
                            <i class="fas fa-history"></i>
                        </div>
                        <div class="stat-info">
                            <h3 id="totalPredictions">0</h3>
                            <p>Total Predictions</p>
                        </div>
                    </div>
                    
                    <div class="stat-card-dash">
                        <div class="stat-icon-dash">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3 id="highRiskCount">0</h3>
                            <p>High Risk</p>
                        </div>
                    </div>
                    
                    <div class="stat-card-dash">
                        <div class="stat-icon-dash">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3 id="lowRiskCount">0</h3>
                            <p>Low Risk</p>
                        </div>
                    </div>
                    
                    <div class="stat-card-dash">
                        <div class="stat-icon-dash">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="stat-info">
                            <h3 id="lastPrediction">-</h3>
                            <p>Last Prediction</p>
                        </div>
                    </div>
                </div>

                <!-- History Section -->
                <div class="history-section">
                    <div class="history-header">
                        <h3><i class="fas fa-history"></i> Prediction History</h3>
                        <div class="filter-buttons">
                            <button class="filter-btn active" data-filter="all">All</button>
                            <button class="filter-btn" data-filter="Low">Low</button>
                            <button class="filter-btn" data-filter="Medium">Medium</button>
                            <button class="filter-btn" data-filter="High">High</button>
                        </div>
                    </div>

                    <div id="historyContent">
                        <div class="loading">
                            <i class="fas fa-spinner"></i>
                            <p>Loading data...</p>
                        </div>
                    </div>

                    <div class="pagination" id="pagination" style="display: none;">
                        <button id="prevBtn" disabled><i class="fas fa-chevron-left"></i> Previous</button>
                        <button id="nextBtn"><i class="fas fa-chevron-right"></i> Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Download Options Modal -->
    <div id="downloadModal" class="modal">
        <div class="download-modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-download"></i> Choose Download Format</h3>
                <button class="modal-close" onclick="closeDownloadModal()">&times;</button>
            </div>
            <div class="download-options">
                <button class="download-option-btn" onclick="downloadAsJSON()">
                    <i class="fas fa-file-code"></i>
                    <div class="download-option-info">
                        <strong>Download JSON</strong>
                        <small>Data format for developers</small>
                    </div>
                </button>
                <button class="download-option-btn" onclick="downloadAsPDF()">
                    <i class="fas fa-file-pdf"></i>
                    <div class="download-option-info">
                        <strong>Download PDF</strong>
                        <small>Print-ready document format</small>
                    </div>
                </button>
            </div>
        </div>
    </div>
    <!-- Detail Modal -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-info-circle"></i> Prediction Details</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div id="modalBody"></div>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script>
        let currentPage = 0;
        let currentFilter = 'all';
        const limit = 10;

        // Load history on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadHistory();
            loadStats();
        });

        // Filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.getAttribute('data-filter');
                currentPage = 0;
                loadHistory();
            });
        });

        // Load statistics
        async function loadStats() {
            try {
                const response = await fetch('../backend/api/predictions_history.php?limit=1000');
                const result = await response.json();

                if (result.success) {
                    const predictions = result.predictions;
                    
                    document.getElementById('totalPredictions').textContent = predictions.length;
                    
                    const highRisk = predictions.filter(p => p.risk_level === 'High').length;
                    const lowRisk = predictions.filter(p => p.risk_level === 'Low').length;
                    
                    document.getElementById('highRiskCount').textContent = highRisk;
                    document.getElementById('lowRiskCount').textContent = lowRisk;
                    
                    if (predictions.length > 0) {
                        const lastDate = new Date(predictions[0].created_at);
                        const options = { day: 'numeric', month: 'short' };
                        document.getElementById('lastPrediction').textContent = lastDate.toLocaleDateString('en-US', options);
                    }
                }
            } catch (error) {
                console.error('Error loading stats:', error);
            }
        }

        // Load history
        async function loadHistory() {
            const historyContent = document.getElementById('historyContent');
            historyContent.innerHTML = '<div class="loading"><i class="fas fa-spinner"></i><p>Loading data...</p></div>';

            try {
                const offset = currentPage * limit;
                const response = await fetch(`../backend/api/predictions_history.php?limit=${limit}&offset=${offset}`);
                const result = await response.json();

                if (result.success) {
                    let predictions = result.predictions;

                    // Filter by risk level
                    if (currentFilter !== 'all') {
                        predictions = predictions.filter(p => p.risk_level === currentFilter);
                    }

                    if (predictions.length === 0) {
                        historyContent.innerHTML = `
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h3>No History Yet</h3>
                                <p>Start your first prediction now!</p>
                                <a href="prediksi.php" class="btn btn-primary" style="display: inline-block; margin-top: 1rem;">
                                    <i class="fas fa-cloud-rain"></i> Predict Now
                                </a>
                            </div>
                        `;
                        document.getElementById('pagination').style.display = 'none';
                    } else {
                        let tableHTML = `
                            <table class="history-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Risk</th>
                                        <th>Probability</th>
                                        <th>Rainfall</th>
                                        <th>Humidity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        predictions.forEach(pred => {
                            const date = new Date(pred.created_at).toLocaleString('en-US');
                            const badgeClass = pred.risk_level === 'High' ? 'badge-high' : pred.risk_level === 'Medium' ? 'badge-medium' : 'badge-low';
                            
                            tableHTML += `
                            <tr>
                                <td>${date}</td>
                                <td><span class="risk-badge-table ${badgeClass}">${pred.risk_level}</span></td>
                                <td>${(pred.probability * 100).toFixed(1)}%</td>
                                <td>${pred.rainfall} mm</td>
                                <td>${pred.humidity}%</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-view" onclick="viewDetail(${pred.id})" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn-download" onclick="downloadOptions(${pred.id})" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="btn-delete" onclick="deletePredict(${pred.id})" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        });

                        tableHTML += '</tbody></table>';
                        historyContent.innerHTML = tableHTML;

                        // Show pagination
                        document.getElementById('pagination').style.display = 'flex';
                        document.getElementById('prevBtn').disabled = currentPage === 0;
                        document.getElementById('nextBtn').disabled = predictions.length < limit;
                    }
                }
            } catch (error) {
                console.error('Error loading history:', error);
                historyContent.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h3>Failed to Load Data</h3>
                        <p>An error occurred. Please refresh the page.</p>
                    </div>
                `;
            }
        }

        // Pagination
        document.getElementById('prevBtn').addEventListener('click', function() {
            if (currentPage > 0) {
                currentPage--;
                loadHistory();
            }
        });

        document.getElementById('nextBtn').addEventListener('click', function() {
            currentPage++;
            loadHistory();
        });

        // View detail
        window.viewDetail = async function(id) {
            try {
                const response = await fetch('../backend/api/predictions_history.php');
                const result = await response.json();

                if (result.success) {
                    const prediction = result.predictions.find(p => p.id === id);
                    
                    if (prediction) {
                        const date = new Date(prediction.created_at).toLocaleString('en-US');
                        const badgeClass = prediction.risk_level === 'High' ? 'badge-high' : prediction.risk_level === 'Medium' ? 'badge-medium' : 'badge-low';
                        
                        document.getElementById('modalBody').innerHTML = `
                            <div style="text-align: center; margin-bottom: 1.5rem;">
                                <h2 style="color: #1e3a8a; margin: 0;">${(prediction.probability * 100).toFixed(1)}%</h2>
                                <span class="risk-badge-table ${badgeClass}">${prediction.risk_level} Risk</span>
                                <p style="color: #64748b; margin-top: 0.5rem;">${date}</p>
                            </div>
                            
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <strong><i class="fas fa-cloud-rain"></i> Rainfall</strong>
                                    <span>${prediction.rainfall} mm</span>
                                </div>
                                <div class="detail-item">
                                    <strong><i class="fas fa-tint"></i> Humidity</strong>
                                    <span>${prediction.humidity}%</span>
                                </div>
                                <div class="detail-item">
                                    <strong><i class="fas fa-thermometer-half"></i> Avg Temperature</strong>
                                    <span>${prediction.temp_avg}°C</span>
                                </div>
                                <div class="detail-item">
                                    <strong><i class="fas fa-temperature-low"></i> Min Temp</strong>
                                    <span>${prediction.temp_min}°C</span>
                                </div>
                                <div class="detail-item">
                                    <strong><i class="fas fa-temperature-high"></i> Max Temp</strong>
                                    <span>${prediction.temp_max}°C</span>
                                </div>
                                <div class="detail-item">
                                    <strong><i class="fas fa-sun"></i> Sunshine</strong>
                                    <span>${prediction.sunshine} hours</span>
                                </div>
                                <div class="detail-item">
                                    <strong><i class="fas fa-wind"></i> Max Wind</strong>
                                    <span>${prediction.wind_max} m/s</span>
                                </div>
                                <div class="detail-item">
                                    <strong><i class="fas fa-wind"></i> Avg Wind</strong>
                                    <span>${prediction.wind_avg} m/s</span>
                                </div>
                            </div>
                        `;
                        
                        document.getElementById('detailModal').classList.add('active');
                    }
                }
            } catch (error) {
                console.error('Error viewing detail:', error);
            }
        }

        // Delete prediction
        window.deletePredict = async function(id) {
            if (!confirm('Are you sure you want to delete this prediction?')) return;

            try {
                const response = await fetch('../backend/api/predictions_history.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id })
                });

                const result = await response.json();

                if (result.success) {
                    loadHistory();
                    loadStats();
                    alert('Prediction successfully deleted');
                } else {
                    alert('Failed to delete prediction');
                }
            } catch (error) {
                console.error('Error deleting:', error);
                alert('An error occurred');
            }
        }

        // Close modal
        window.closeModal = function() {
            document.getElementById('detailModal').classList.remove('active');
        }

        // Logout
        document.getElementById('logoutBtn').addEventListener('click', async function(e) {
            e.preventDefault();
            
            if (!confirm('Are you sure you want to logout?')) return;

            try {
                const response = await fetch('../backend/api/auth.php?action=logout', {
                    method: 'POST'
                });

                const result = await response.json();

                if (result.success) {
                    window.location.href = '../index.php';
                }
            } catch (error) {
                console.error('Logout error:', error);
                window.location.href = '../index.php';
            }
        });
        // Store selected prediction ID for download
let selectedDownloadId = null;

// Download options modal
window.downloadOptions = function(id) {
    selectedDownloadId = id;
    document.getElementById('downloadModal').classList.add('active');
}

window.closeDownloadModal = function() {
    document.getElementById('downloadModal').classList.remove('active');
    selectedDownloadId = null;
}

// Download as JSON
window.downloadAsJSON = async function() {
    if (!selectedDownloadId) return;
    
    try {
        const response = await fetch('../backend/api/predictions_history.php');
        const result = await response.json();
        
        if (result.success) {
            const prediction = result.predictions.find(p => p.id === selectedDownloadId);
            
            if (prediction) {
                // Format data
                const exportData = {
                    prediction_info: {
                        id: prediction.id,
                        date: prediction.created_at,
                        risk_level: prediction.risk_level,
                        probability: prediction.probability
                    },
                    weather_data: {
                        rainfall: prediction.rainfall,
                        humidity: prediction.humidity,
                        temperature: {
                            average: prediction.temp_avg,
                            minimum: prediction.temp_min,
                            maximum: prediction.temp_max
                        },
                        sunshine: prediction.sunshine,
                        wind: {
                            max: prediction.wind_max,
                            average: prediction.wind_avg
                        }
                    },
                    result: {
                        prediction: prediction.prediction_result,
                        risk_level: prediction.risk_level,
                        probability_percentage: (prediction.probability * 100).toFixed(2) + '%'
                    },
                    metadata: {
                        model: 'Random Forest',
                        accuracy: '88.49%',
                        exported_at: new Date().toISOString(),
                        source: 'FloodGuard Jakarta'
                    }
                };
                
                // Create and download
                const dataStr = JSON.stringify(exportData, null, 2);
                const dataBlob = new Blob([dataStr], { type: 'application/json' });
                const url = URL.createObjectURL(dataBlob);
                const link = document.createElement('a');
                link.href = url;
                link.download = `floodguard-prediction-${selectedDownloadId}-${Date.now()}.json`;
                link.click();
                URL.revokeObjectURL(url);
                
                closeDownloadModal();
                alert('✓ JSON file downloaded successfully!');
            }
        }
    } catch (error) {
        console.error('Download JSON error:', error);
        alert('Failed to download JSON');
    }
}

// Download as PDF
window.downloadAsPDF = async function() {
    if (!selectedDownloadId) return;
    
    try {
        const response = await fetch('../backend/api/predictions_history.php');
        const result = await response.json();
        
        if (result.success) {
            const prediction = result.predictions.find(p => p.id === selectedDownloadId);
            
            if (prediction) {
                // Create PDF content
                const date = new Date(prediction.created_at).toLocaleString('en-US');
                const riskColor = prediction.risk_level === 'High' ? '#ef4444' : 
                                 prediction.risk_level === 'Medium' ? '#f59e0b' : '#10b981';
                
                // Create HTML for PDF
                const pdfContent = `
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>FloodGuard - Flood Prediction Report</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            padding: 40px;
                            max-width: 800px;
                            margin: 0 auto;
                        }
                        .header {
                            text-align: center;
                            margin-bottom: 30px;
                            border-bottom: 3px solid #3b82f6;
                            padding-bottom: 20px;
                        }
                        .header h1 {
                            color: #1e3a8a;
                            margin: 0;
                        }
                        .header p {
                            color: #64748b;
                            margin: 5px 0;
                        }
                        .risk-box {
                            background: ${riskColor};
                            color: white;
                            padding: 20px;
                            border-radius: 10px;
                            text-align: center;
                            margin: 20px 0;
                        }
                        .risk-box h2 {
                            margin: 0;
                            font-size: 2rem;
                        }
                        .risk-box p {
                            margin: 10px 0 0 0;
                            font-size: 1.2rem;
                        }
                        .data-section {
                            margin: 30px 0;
                        }
                        .data-section h3 {
                            color: #1e3a8a;
                            border-bottom: 2px solid #e2e8f0;
                            padding-bottom: 10px;
                        }
                        .data-grid {
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 15px;
                            margin-top: 15px;
                        }
                        .data-item {
                            background: #f8fafc;
                            padding: 15px;
                            border-radius: 8px;
                            border-left: 4px solid #3b82f6;
                        }
                        .data-item strong {
                            display: block;
                            color: #1e3a8a;
                            margin-bottom: 5px;
                        }
                        .data-item span {
                            color: #334155;
                            font-size: 1.1rem;
                        }
                        .footer {
                            margin-top: 40px;
                            text-align: center;
                            color: #64748b;
                            font-size: 0.9rem;
                            border-top: 2px solid #e2e8f0;
                            padding-top: 20px;
                        }
                        @media print {
                            body { padding: 20px; }
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>🌊 FloodGuard Jakarta</h1>
                        <p>Flood Risk Prediction Report</p>
                        <p>Prediction ID: #${prediction.id} | ${date}</p>
                    </div>
                    
                    <div class="risk-box">
                        <h2>${(prediction.probability * 100).toFixed(1)}%</h2>
                        <p>Risk: ${prediction.risk_level}</p>
                    </div>
                    
                    <div class="data-section">
                        <h3>📊 Weather Data</h3>
                        <div class="data-grid">
                            <div class="data-item">
                                <strong>☔ Rainfall</strong>
                                <span>${prediction.rainfall} mm</span>
                            </div>
                            <div class="data-item">
                                <strong>💧 Humidity</strong>
                                <span>${prediction.humidity}%</span>
                            </div>
                            <div class="data-item">
                                <strong>🌡️ Average Temperature</strong>
                                <span>${prediction.temp_avg}°C</span>
                            </div>
                            <div class="data-item">
                                <strong>🌡️ Minimum Temperature</strong>
                                <span>${prediction.temp_min}°C</span>
                            </div>
                            <div class="data-item">
                                <strong>🌡️ Maximum Temperature</strong>
                                <span>${prediction.temp_max}°C</span>
                            </div>
                            <div class="data-item">
                                <strong>☀️ Sunshine</strong>
                                <span>${prediction.sunshine} hours</span>
                            </div>
                            <div class="data-item">
                                <strong>💨 Maximum Wind</strong>
                                <span>${prediction.wind_max} m/s</span>
                            </div>
                            <div class="data-item">
                                <strong>💨 Average Wind</strong>
                                <span>${prediction.wind_avg} m/s</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="data-section">
                        <h3>🤖 Model Information</h3>
                        <div class="data-item">
                            <strong>Machine Learning Model</strong>
                            <span>Random Forest Classifier</span>
                        </div>
                        <div class="data-item" style="margin-top: 10px;">
                            <strong>Model Accuracy</strong>
                            <span>88.49%</span>
                        </div>
                        <div class="data-item" style="margin-top: 10px;">
                            <strong>Training Dataset</strong>
                            <span>6,308 BMKG data points (2016-2020)</span>
                        </div>
                    </div>
                    
                    <div class="footer">
                        <p><strong>FloodGuard Jakarta</strong> - AI-Based Flood Prediction System</p>
                        <p>Developed for PROX x CORIS 2026</p>
                        <p>Document generated automatically on ${new Date().toLocaleString('en-US')}</p>
                    </div>
                </body>
                </html>
                `;
                
                // Open in new window and print to PDF
                const printWindow = window.open('', '_blank');
                printWindow.document.write(pdfContent);
                printWindow.document.close();
                
                // Wait for content to load then print
                setTimeout(() => {
                    printWindow.print();
                }, 500);
                
                closeDownloadModal();
                alert('✓ PDF print window opened! Select "Save as PDF" in printer options.');
            }
        }
    } catch (error) {
        console.error('Download PDF error:', error);
        alert('Failed to download PDF');
    }
}

// Close download modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('detailModal');
    const downloadModal = document.getElementById('downloadModal');
    
    if (event.target == modal) {
        closeModal();
    }
    if (event.target == downloadModal) {
        closeDownloadModal();
    }
}
    </script>
</body>
</html>