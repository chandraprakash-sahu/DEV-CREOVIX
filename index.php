<?php
$pageTitle = "Home";
include 'includes/header.php';
?>
<head>
     <link rel="icon" type="image/png" href="">
</head>
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h6 class="hero-subtitle fade-in">Hello, I'm</h6>
                <h1 class="hero-title slide-up">Chandra Prakash Sahu</h1>
                <h2 class="hero-tagline fade-in">Founder of <span class="text-gradient">Dev Creovix</span></h2>
                <p class="hero-description fade-in">I craft stunning, high-performance websites and web applications that drive business growth. With expertise in modern web technologies, I transform your ideas into digital reality.</p>
                <div class="hero-buttons fade-in">
                    <a href="contact.php#order-form" class="btn btn-primary">Contact Me <i class="fas fa-arrow-right"></i></a>
                    <a href="portfolio.php" class="btn btn-secondary">View Projects</a>
                </div>
                <div class="hero-stats fade-in">
                    <div class="stat">
                        <!-- <span class="stat-number">50+</span>
                        <span class="stat-label">Projects Completed</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">40+</span>
                        <span class="stat-label">Happy Clients</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">5+</span>
                        <span class="stat-label">Years Experience</span> -->
                    </div>
                </div>
            </div>
            <div class="hero-image scale-in">
                <div class="image-container">
                    <div class="floating-shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                    </div>
                    <div class="developer-illustration">
                        <i class="fas fa-code code-icon"></i>
                        <i class="fas fa-palette design-icon"></i>
                        <i class="fas fa-server server-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Skills -->
<section class="skills-showcase">
    <div class="container">
        <h2 class="section-title text-center">Technologies I Work With</h2>
        <div class="skills-grid">
            <div class="skill-item">
                <i class="fab fa-html5"></i>
                <span>HTML5</span>
            </div>
            <div class="skill-item">
                <i class="fab fa-css3-alt"></i>
                <span>CSS3</span>
            </div>
            <div class="skill-item">
                <i class="fab fa-js"></i>
                <span>JavaScript</span>
            </div>
            <div class="skill-item">
                <i class="fab fa-php"></i>
                <span>PHP</span>
            </div>
            <div class="skill-item">
                <i class="fas fa-database"></i>
                <span>MySQL</span>
            </div>
            <div class="skill-item">
                <i class="fab fa-bootstrap"></i>
                <span>Bootstrap</span>
            </div>
            <div class="skill-item">
                <i class="fas fa-wind"></i>
                <span>Tailwind</span>
            </div>
            <div class="skill-item">
                <i class="fab fa-react"></i>
                <span>React</span>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Preview -->
<section class="featured-projects">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Featured Projects</h2>
            <a href="portfolio.php" class="btn-text">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        
        <div class="projects-preview">
            <div class="project-card">
                <div class="project-image">
                    <div class="image-placeholder">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
                <div class="project-info">
                    <h3>Agriculture Shop</h3>
                    <p>Full-featured online store with shopping cart, payment integration, and admin dashboard.</p>
                    <div class="project-tech">
                        <span>PHP</span>
                        <span>MySQL</span>
                        <span>JavaScript</span>
                        <span>Bootstrap</span>
                    </div>
                    <div class="project-links">
                        <a href="https://muskankrishikendra.42web.io" class="project-link" target="_blank">
                            <i class="fas fa-external-link-alt"></i> Live Demo
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="project-card">
                <div class="project-image">
                    <div class="image-placeholder">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
                <div class="project-info">
                    <h3>Corporate Website</h3>
                    <p>Modern business website with CMS, contact forms, and responsive design.</p>
                    <div class="project-tech">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>JavaScript</span>
                        <span>PHP</span>
                    </div>
                    <div class="project-links">
                        <a href="#" class="project-link" target="_blank">
                            <i class="fas fa-external-link-alt"></i> Live Demo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Ready to Start Your Project?</h2>
            <p class="cta-description">Let's discuss your ideas and create something amazing together.</p>
            <a href="contact.php" class="btn btn-primary btn-large">Get In Touch <i class="fas fa-paper-plane"></i></a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>