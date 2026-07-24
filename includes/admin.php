<?php
session_start();
require_once 'config.php';

// Admin authentication
$admin_username = 'admin';
$admin_password = 'chandan@216724'; // Change this to your secure password

// Check if logged in
if (!isset($_SESSION['admin_logged_in'])) {
    if (isset($_POST['login'])) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if ($username === $admin_username && $password === $admin_password) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
        } else {
            $error = "Invalid username or password!";
        }
    }
    
    // Show login form if not logged in
    if (!isset($_SESSION['admin_logged_in'])) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin Login - Dev Creovix</title>
            <link rel="stylesheet" href="../style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <style>
                :root {
                    --admin-gradient: linear-gradient(135deg, #4361ee 0%, #7209b7 100%);
                }
                
                .admin-login {
                    min-height: 100vh;
                    background: var(--admin-gradient);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 2rem;
                }
                
                .login-container {
                    background: rgba(255, 255, 255, 0.95);
                    backdrop-filter: blur(10px);
                    padding: 3rem;
                    border-radius: 1.5rem;
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                    width: 100%;
                    max-width: 450px;
                    text-align: center;
                    border: 1px solid rgba(255, 255, 255, 0.2);
                }
                
                .login-logo {
                    margin-bottom: 2rem;
                }
                
                .login-logo h1 {
                    font-size: 2.5rem;
                    background: var(--admin-gradient);
                    -webkit-background-clip: text;
                    background-clip: text;
                    color: transparent;
                    margin-bottom: 0.5rem;
                }
                
                .login-logo p {
                    color: #666;
                    font-size: 1rem;
                }
                
                .form-group {
                    margin-bottom: 1.5rem;
                    text-align: left;
                }
                
                .form-group label {
                    display: block;
                    margin-bottom: 0.5rem;
                    color: #333;
                    font-weight: 600;
                    font-size: 0.9rem;
                }
                
                .input-with-icon {
                    position: relative;
                }
                
                .input-with-icon i {
                    position: absolute;
                    left: 1rem;
                    top: 50%;
                    transform: translateY(-50%);
                    color: #666;
                }
                
                .input-with-icon input {
                    width: 100%;
                    padding: 1rem 1rem 1rem 3rem;
                    border: 2px solid #e1e5e9;
                    border-radius: 0.75rem;
                    font-size: 1rem;
                    transition: all 0.3s ease;
                    background: white;
                }
                
                .input-with-icon input:focus {
                    outline: none;
                    border-color: #4361ee;
                    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
                }
                
                .login-btn {
                    width: 100%;
                    padding: 1rem;
                    background: var(--admin-gradient);
                    color: white;
                    border: none;
                    border-radius: 0.75rem;
                    font-size: 1rem;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0.5rem;
                }
                
                .login-btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
                }
                
                .error-message {
                    background: #fee;
                    color: #f72585;
                    padding: 1rem;
                    border-radius: 0.75rem;
                    margin-bottom: 1.5rem;
                    border-left: 4px solid #f72585;
                    text-align: left;
                }
                
                .security-note {
                    margin-top: 1.5rem;
                    padding-top: 1rem;
                    border-top: 1px solid #eee;
                    color: #666;
                    font-size: 0.875rem;
                }
                
                @media (max-width: 480px) {
                    .login-container {
                        padding: 2rem 1.5rem;
                    }
                    
                    .login-logo h1 {
                        font-size: 2rem;
                    }
                }
            </style>
        </head>
        <body class="dark-mode">
            <div class="admin-login">
                <div class="login-container">
                    <div class="login-logo">
                        <h1>Dev Creovix</h1>
                        <p>Admin Dashboard</p>
                    </div>
                    
                    <?php if (isset($error)): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-with-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="username" name="username" required placeholder="Enter admin username">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-with-icon">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="password" name="password" required placeholder="Enter password">
                            </div>
                        </div>
                        
                        <button type="submit" name="login" class="login-btn">
                            <i class="fas fa-sign-in-alt"></i> Login to Dashboard
                        </button>
                    </form>
                    
                    <div class="security-note">
                        <i class="fas fa-shield-alt"></i> Secure admin area. Access is restricted.
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Handle message actions
if (isset($_GET['action'])) {
    $conn = getDBConnection();
    
    if ($_GET['action'] === 'mark_read' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("UPDATE contacts SET status = 'read' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } elseif ($_GET['action'] === 'mark_replied' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("UPDATE contacts SET status = 'replied' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } elseif ($_GET['action'] === 'archive' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("UPDATE contacts SET status = 'archived' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    
    $conn->close();
    header('Location: admin.php');
    exit;
}

// Get statistics
$stats = getViewStats();
$conn = getDBConnection();

// Get messages
$messages_query = "SELECT * FROM contacts ORDER BY created_at DESC";
$messages_result = $conn->query($messages_query);

// Get message statistics
$msg_stats_query = "SELECT 
    COUNT(*) as total,
    SUM(CASE WHEN status = 'unread' THEN 1 ELSE 0 END) as unread,
    SUM(CASE WHEN status = 'read' THEN 1 ELSE 0 END) as read_count,
    SUM(CASE WHEN status = 'replied' THEN 1 ELSE 0 END) as replied,
    SUM(CASE WHEN status = 'archived' THEN 1 ELSE 0 END) as archived
    FROM contacts";
$msg_stats_result = $conn->query($msg_stats_query);
$msg_stats = $msg_stats_result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Dev Creovix</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --admin-sidebar-width: 280px;
            --admin-primary: #4361ee;
            --admin-secondary: #3a0ca3;
            --admin-success: #4cc9f0;
            --admin-warning: #f8961e;
            --admin-danger: #f72585;
            --admin-info: #4895ef;
        }
        
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            background: var(--bg-secondary);
        }
        
        /* Sidebar */
        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background: var(--bg-primary);
            border-right: 1px solid var(--border-color);
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
        }
        
        .admin-logo {
            padding: 0 2rem 2rem;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }
        
        .admin-logo h1 {
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }
        
        .admin-logo p {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0 2rem;
            margin-bottom: 2rem;
        }
        
        .user-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }
        
        .user-info h3 {
            margin-bottom: 0.25rem;
            font-size: 1rem;
        }
        
        .user-info p {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }
        
        .admin-nav {
            padding: 0 1rem;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.75rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .nav-item:hover,
        .nav-item.active {
            background: var(--bg-secondary);
            color: var(--admin-primary);
        }
        
        .nav-item i {
            width: 20px;
            text-align: center;
        }
        
        .nav-badge {
            margin-left: auto;
            background: var(--admin-danger);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* Main Content */
        .admin-main {
            flex: 1;
            margin-left: var(--admin-sidebar-width);
            padding: 2rem;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .header-title h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .header-title p {
            color: var(--text-secondary);
        }
        
        .header-actions {
            display: flex;
            gap: 1rem;
        }
        
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--admin-danger);
            color: white;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: #d11a6d;
            transform: translateY(-2px);
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: var(--bg-primary);
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--admin-primary);
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .views .stat-icon { background: rgba(67, 97, 238, 0.1); color: var(--admin-primary); }
        .messages .stat-icon { background: rgba(247, 37, 133, 0.1); color: var(--admin-danger); }
        .growth .stat-icon { background: rgba(76, 201, 240, 0.1); color: var(--admin-success); }
        .monthly .stat-icon { background: rgba(72, 149, 239, 0.1); color: var(--admin-info); }
        
        .stat-trend {
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
        }
        
        .trend-up { background: rgba(76, 201, 240, 0.1); color: var(--admin-success); }
        .trend-down { background: rgba(247, 37, 133, 0.1); color: var(--admin-danger); }
        
        .stat-content h3 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }
        
        .stat-content p {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }
        
        /* Charts */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .chart-card {
            background: var(--bg-primary);
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid var(--border-color);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .chart-header h3 {
            font-size: 1.25rem;
        }
        
        .chart-container {
            height: 250px;
            position: relative;
        }
        
        /* Messages Table */
        .messages-table {
            background: var(--bg-primary);
            border-radius: 1rem;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }
        
        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .filter-btn {
            padding: 0.5rem 1rem;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-btn.active {
            background: var(--admin-primary);
            color: white;
            border-color: var(--admin-primary);
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: var(--bg-secondary);
        }
        
        th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
        }
        
        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-secondary);
        }
        
        .message-row:hover {
            background: var(--bg-secondary);
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-unread { background: rgba(247, 37, 133, 0.1); color: var(--admin-danger); }
        .status-read { background: rgba(67, 97, 238, 0.1); color: var(--admin-primary); }
        .status-replied { background: rgba(76, 201, 240, 0.1); color: var(--admin-success); }
        .status-archived { background: rgba(108, 117, 125, 0.1); color: var(--text-tertiary); }
        
        .message-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }
        
        .action-read { background: rgba(67, 97, 238, 0.1); color: var(--admin-primary); }
        .action-reply { background: rgba(76, 201, 240, 0.1); color: var(--admin-success); }
        .action-archive { background: rgba(108, 117, 125, 0.1); color: var(--text-tertiary); }
        .action-delete { background: rgba(247, 37, 133, 0.1); color: var(--admin-danger); }
        
        .action-btn:hover {
            transform: translateY(-2px);
        }
        
        .message-preview {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-secondary);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--border-color);
        }
        
        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .modal {
            background: var(--bg-primary);
            border-radius: 1rem;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlide 0.3s ease;
        }
        
        @keyframes modalSlide {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-secondary);
            cursor: pointer;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .message-detail {
            margin-bottom: 1.5rem;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 1rem;
        }
        
        .detail-label {
            width: 120px;
            color: var(--text-secondary);
            font-weight: 600;
        }
        
        .detail-value {
            flex: 1;
            color: var(--text-primary);
        }
        
        .message-content {
            background: var(--bg-secondary);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
            white-space: pre-wrap;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 70px;
                padding: 1rem 0;
            }
            
            .admin-logo,
            .admin-user,
            .nav-item span {
                display: none;
            }
            
            .nav-item {
                justify-content: center;
                padding: 1rem;
            }
            
            .admin-main {
                margin-left: 70px;
                padding: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .admin-sidebar {
                display: none;
            }
            
            .admin-main {
                margin-left: 0;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .table-actions {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body class="dark-mode">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <h1>Dev Creovix</h1>
                <p>Admin Dashboard</p>
            </div>
            
            <div class="admin-user">
                <div class="user-avatar">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="user-info">
                    <h3>Administrator</h3>
                    <p>Admin Panel</p>
                </div>
            </div>
            
            <nav class="admin-nav">
                <a href="#dashboard" class="nav-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#messages" class="nav-item">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                    <?php if ($msg_stats['unread'] > 0): ?>
                    <span class="nav-badge"><?php echo $msg_stats['unread']; ?></span>
                    <?php endif; ?>
                </a>
                <a href="#analytics" class="nav-item">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
                <a href="#settings" class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="admin-main">
            <!-- Header -->
            <header class="admin-header">
                <div class="header-title">
                    <h1>Dashboard Overview</h1>
                    <p>Welcome back, Administrator. Here's what's happening.</p>
                </div>
                <div class="header-actions">
                    <a href="?export=csv" class="logout-btn" style="background: var(--admin-success);">
                        <i class="fas fa-download"></i> Export CSV
                    </a>
                    <a href="?logout=1" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </header>
            
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card views">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i> 12%
                        </div>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo number_format($stats['total']); ?></h3>
                        <p>Total Website Views</p>
                    </div>
                </div>
                
                <div class="stat-card messages">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i> <?php echo $msg_stats['unread']; ?> new
                        </div>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo number_format($msg_stats['total']); ?></h3>
                        <p>Total Messages</p>
                    </div>
                </div>
                
                <div class="stat-card growth">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i> 24%
                        </div>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo number_format($stats['today']); ?></h3>
                        <p>Today's Views</p>
                    </div>
                </div>
                
                <div class="stat-card monthly">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i> 18%
                        </div>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo number_format($stats['month']); ?></h3>
                        <p>This Month Views</p>
                    </div>
                </div>
            </div>
            
            <!-- Charts -->
            <div class="charts-grid">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Views Trend (30 Days)</h3>
                        <select class="filter-btn" style="padding: 0.5rem;">
                            <option>Last 30 days</option>
                            <option>Last 7 days</option>
                            <option>Last 90 days</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="viewsChart"></canvas>
                    </div>
                </div>
                
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Messages Overview</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="messagesChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Messages Table -->
            <div class="messages-table">
                <div class="table-header">
                    <h3>Contact Messages</h3>
                    <div class="table-actions">
                        <button class="filter-btn active">All</button>
                        <button class="filter-btn">Unread</button>
                        <button class="filter-btn">Replied</button>
                        <button class="filter-btn">Archived</button>
                    </div>
                </div>
                
                <div class="table-container">
                    <?php if ($messages_result->num_rows > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Project Type</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($message = $messages_result->fetch_assoc()): ?>
                            <tr class="message-row" data-id="<?php echo $message['id']; ?>">
                                <td>#<?php echo $message['id']; ?></td>
                                <td><?php echo htmlspecialchars($message['name']); ?></td>
                                <td><?php echo htmlspecialchars($message['email']); ?></td>
                                <td><?php echo htmlspecialchars($message['project_type']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($message['created_at'])); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo $message['status']; ?>">
                                        <?php echo ucfirst($message['status']); ?>
                                    </span>
                                </td>
                                <td class="message-preview">
                                    <?php echo substr(htmlspecialchars($message['message']), 0, 50); ?>...
                                </td>
                                <td>
                                    <div class="message-actions">
                                        <button class="action-btn action-read" onclick="markRead(<?php echo $message['id']; ?>)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn action-reply" onclick="markReplied(<?php echo $message['id']; ?>)">
                                            <i class="fas fa-reply"></i>
                                        </button>
                                        <button class="action-btn action-archive" onclick="archiveMessage(<?php echo $message['id']; ?>)">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                        <button class="action-btn action-delete" onclick="deleteMessage(<?php echo $message['id']; ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No messages yet</h3>
                        <p>Contact messages will appear here.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Message Detail Modal -->
    <div class="modal-overlay" id="messageModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Message Details</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="messageDetails">
                <!-- Message details will be loaded here -->
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize Charts
        const viewsCtx = document.getElementById('viewsChart').getContext('2d');
        const messagesCtx = document.getElementById('messagesChart').getContext('2d');
        
        // Views Chart
        const viewsChart = new Chart(viewsCtx, {
            type: 'line',
            data: {
                labels: <?php 
                    $labels = [];
                    $data = [];
                    foreach ($stats['chart_data'] as $day) {
                        $labels[] = date('d M', strtotime($day['view_date']));
                        $data[] = $day['views'];
                    }
                    echo json_encode(array_reverse($labels));
                ?>,
                datasets: [{
                    label: 'Daily Views',
                    data: <?php echo json_encode(array_reverse($data)); ?>,
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // Messages Chart
        const messagesChart = new Chart(messagesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Unread', 'Read', 'Replied', 'Archived'],
                datasets: [{
                    data: [
                        <?php echo $msg_stats['unread']; ?>,
                        <?php echo $msg_stats['read_count']; ?>,
                        <?php echo $msg_stats['replied']; ?>,
                        <?php echo $msg_stats['archived']; ?>
                    ],
                    backgroundColor: [
                        'rgba(247, 37, 133, 0.8)',
                        'rgba(67, 97, 238, 0.8)',
                        'rgba(76, 201, 240, 0.8)',
                        'rgba(108, 117, 125, 0.8)'
                    ],
                    borderWidth: 2,
                    borderColor: 'var(--bg-primary)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        
        // Message Actions
        function markRead(id) {
            if (confirm('Mark this message as read?')) {
                window.location.href = '?action=mark_read&id=' + id;
            }
        }
        
        function markReplied(id) {
            if (confirm('Mark this message as replied?')) {
                window.location.href = '?action=mark_replied&id=' + id;
            }
        }
        
        function archiveMessage(id) {
            if (confirm('Archive this message?')) {
                window.location.href = '?action=archive&id=' + id;
            }
        }
        
        function deleteMessage(id) {
            if (confirm('Are you sure you want to delete this message? This action cannot be undone.')) {
                window.location.href = '?action=delete&id=' + id;
            }
        }
        
        // Modal Functions
        function openMessage(id) {
            fetch('get_message.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    const modal = document.getElementById('messageModal');
                    const details = document.getElementById('messageDetails');
                    
                    details.innerHTML = `
                        <div class="message-detail">
                            <div class="detail-row">
                                <div class="detail-label">Name:</div>
                                <div class="detail-value">${data.name}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Email:</div>
                                <div class="detail-value"><a href="mailto:${data.email}">${data.email}</a></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Phone:</div>
                                <div class="detail-value">${data.phone || 'Not provided'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Project:</div>
                                <div class="detail-value">${data.project_type}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Budget:</div>
                                <div class="detail-value">${data.budget || 'Not specified'}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Date:</div>
                                <div class="detail-value">${new Date(data.created_at).toLocaleString()}</div>
                            </div>
                        </div>
                        <div class="message-content">${data.message}</div>
                        <div class="message-actions" style="margin-top: 1.5rem;">
                            <button class="action-btn action-read" onclick="markRead(${id})">
                                <i class="fas fa-eye"></i> Mark Read
                            </button>
                            <button class="action-btn action-reply" onclick="markReplied(${id})">
                                <i class="fas fa-reply"></i> Mark Replied
                            </button>
                            <button class="action-btn action-archive" onclick="archiveMessage(${id})">
                                <i class="fas fa-archive"></i> Archive
                            </button>
                        </div>
                    `;
                    
                    modal.style.display = 'flex';
                });
        }
        
        function closeModal() {
            document.getElementById('messageModal').style.display = 'none';
        }
        
        // Open modal when clicking on message row
        document.querySelectorAll('.message-row').forEach(row => {
            row.addEventListener('click', (e) => {
                if (!e.target.closest('.message-actions')) {
                    const id = row.getAttribute('data-id');
                    openMessage(id);
                }
            });
        });
        
        // Close modal when clicking outside
        document.getElementById('messageModal').addEventListener('click', (e) => {
            if (e.target.id === 'messageModal') {
                closeModal();
            }
        });
        
        // Filter messages
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Filter logic would go here
            });
        });
        
        // Auto refresh every 60 seconds
        setInterval(() => {
            if (!document.hidden) {
                // Refresh page to update stats
                window.location.reload();
            }
        }, 60000);
    </script>
</body>
</html>
<?php
$conn->close();
?>