<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dev_creovix');

// Create connection
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

// Site configuration
define('SITE_NAME', 'Dev Creovix');
define('OWNER_NAME', 'Chandra Prakash Sahu');
define('SITE_URL', 'http://localhost/dev-creovix');

// Function to track views
function trackView() {
    $conn = getDBConnection();
    
    // Check if today's record exists
    $today = date('Y-m-d');
    $check_sql = "SELECT id, views FROM website_views WHERE view_date = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $today);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update existing record
        $row = $result->fetch_assoc();
        $new_views = $row['views'] + 1;
        $update_sql = "UPDATE website_views SET views = ? WHERE view_date = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("is", $new_views, $today);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // Insert new record for today
        $insert_sql = "INSERT INTO website_views (view_date, views) VALUES (?, 1)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("s", $today);
        $insert_stmt->execute();
        $insert_stmt->close();
    }
    
    $check_stmt->close();
    $conn->close();
}

// Function to get view statistics
function getViewStats() {
    $conn = getDBConnection();
    $stats = [];
    
    // Get today's views
    $today = date('Y-m-d');
    $today_sql = "SELECT views FROM website_views WHERE view_date = ?";
    $today_stmt = $conn->prepare($today_sql);
    $today_stmt->bind_param("s", $today);
    $today_stmt->execute();
    $today_result = $today_stmt->get_result();
    
    if ($today_result->num_rows > 0) {
        $row = $today_result->fetch_assoc();
        $stats['today'] = $row['views'];
    } else {
        $stats['today'] = 0;
    }
    $today_stmt->close();
    
    // Get yesterday's views
    $yesterday = date('Y-m-d', strtotime('-1 day'));
    $yesterday_sql = "SELECT views FROM website_views WHERE view_date = ?";
    $yesterday_stmt = $conn->prepare($yesterday_sql);
    $yesterday_stmt->bind_param("s", $yesterday);
    $yesterday_stmt->execute();
    $yesterday_result = $yesterday_stmt->get_result();
    
    if ($yesterday_result->num_rows > 0) {
        $row = $yesterday_result->fetch_assoc();
        $stats['yesterday'] = $row['views'];
    } else {
        $stats['yesterday'] = 0;
    }
    $yesterday_stmt->close();
    
    // Get total lifetime views
    $total_sql = "SELECT SUM(views) as total FROM website_views";
    $total_result = $conn->query($total_sql);
    $row = $total_result->fetch_assoc();
    $stats['total'] = $row['total'] ?? 0;
    
    // Get this month's views
    $month_start = date('Y-m-01');
    $month_sql = "SELECT SUM(views) as month_total FROM website_views WHERE view_date >= ?";
    $month_stmt = $conn->prepare($month_sql);
    $month_stmt->bind_param("s", $month_start);
    $month_stmt->execute();
    $month_result = $month_stmt->get_result();
    $row = $month_result->fetch_assoc();
    $stats['month'] = $row['month_total'] ?? 0;
    $month_stmt->close();
    
    // Get all-time views chart data (last 30 days)
    $chart_sql = "SELECT view_date, views FROM website_views 
                  WHERE view_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) 
                  ORDER BY view_date DESC";
    $chart_result = $conn->query($chart_sql);
    $stats['chart_data'] = [];
    while ($row = $chart_result->fetch_assoc()) {
        $stats['chart_data'][] = $row;
    }
    
    $conn->close();
    return $stats;
}
?>