<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dev Creovix - Professional web development agency by Chandra Prakash Sahu. We create stunning websites and web applications.">
    <meta name="keywords" content="web development, e-commerce, portfolio website, PHP development, UI/UX design">
    <meta name="author" content="Chandra Prakash Sahu">
    <meta property="og:title" content="Dev Creovix - Professional Web Development">
    <meta property="og:description" content="Transform your digital presence with expert web development services.">
    <meta property="og:type" content="website">
    
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' : ''; ?>Dev Creovix</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="includes/logo.png">
</head>
<body>
    <!-- Dark Mode Toggle -->
    <button id="darkModeToggle" class="dark-mode-toggle" aria-label="Toggle dark mode">
        <i class="fas fa-moon"></i>
    </button>
    
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <a href="index.php" class="logo">
                    <span class="logo-text">Dev <span class="logo-highlight">Creovix</span></span>
                </a>
                
                <button class="menu-toggle" aria-label="Toggle menu">
                    <i class="fas fa-bars"></i>
                </button>
                
                <ul class="nav-menu">
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="about.php" class="nav-link">About</a></li>
                    <li><a href="services.php" class="nav-link">Services</a></li>
                    <li><a href="portfolio.php" class="nav-link">Portfolio</a></li>
                    <!-- <li><a href="contact.php" class="nav-link">Contact</a></li> -->
                    <li><a href="contact.php#order-form" class="btn btn-primary btn-small">Contact Me</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main>