<?php
$pageTitle = "Services";
include 'includes/header.php';

$services = [
    [
        'id' => 'web-dev',
        'icon' => 'fas fa-code',
        'title' => 'Web Development',
        'description' => 'Custom website development from scratch using latest technologies and best practices.'
    ],
    [
        'id' => 'ecommerce',
        'icon' => 'fas fa-shopping-cart',
        'title' => 'E-commerce Website',
        'description' => 'Complete online store solutions with shopping cart, payment gateways, and inventory management.'
    ],
    [
        'id' => 'portfolio',
        'icon' => 'fas fa-briefcase',
        'title' => 'Portfolio Website',
        'description' => 'Showcase your work with elegant portfolio websites that highlight your skills and projects.'
    ],
    [
        'id' => 'business',
        'icon' => 'fas fa-building',
        'title' => 'Business Website',
        'description' => 'Professional business websites to establish your online presence and attract customers.'
    ],
    [
        'id' => 'custom',
        'icon' => 'fas fa-cogs',
        'title' => 'Custom PHP Applications',
        'description' => 'Tailor-made PHP applications for your specific business needs and workflows.'
    ],
    [
        'id' => 'ui-ux',
        'icon' => 'fas fa-palette',
        'title' => 'UI/UX Design',
        'description' => 'User-centered design that enhances user experience and drives engagement.'
    ],
    [
        'id' => 'api',
        'icon' => 'fas fa-exchange-alt',
        'title' => 'API Integration',
        'description' => 'Seamless integration of third-party APIs and services into your applications.'
    ],
    [
        'id' => 'redesign',
        'icon' => 'fas fa-redo',
        'title' => 'Website Redesign',
        'description' => 'Modernize your outdated website with fresh design and improved functionality.'
    ],
    [
        'id' => 'maintenance',
        'icon' => 'fas fa-tools',
        'title' => 'Website Maintenance',
        'description' => 'Ongoing support, updates, and maintenance to keep your website running smoothly.'
    ]
];
?>

<section class="page-header">
    <div class="container">
        <h1 class="page-title">Services</h1>
        <p class="page-subtitle">Comprehensive web development solutions tailored to your needs</p>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <div class="services-intro">
            <h2 class="section-title">What I Offer</h2>
            <p class="section-description">From simple websites to complex web applications, I provide end-to-end solutions that drive results. Each service is delivered with attention to detail and commitment to quality.</p>
        </div>
        
        <div class="services-grid">
            <?php foreach ($services as $service): ?>
            <div class="service-card" id="<?php echo $service['id']; ?>">
                <div class="service-icon">
                    <i class="<?php echo $service['icon']; ?>"></i>
                </div>
                <h3 class="service-title"><?php echo $service['title']; ?></h3>
                <p class="service-description"><?php echo $service['description']; ?></p>
                <a href="contact.php?service=<?php echo urlencode($service['title']); ?>" class="service-link">
                    Get This Service <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="services-process">
            <h2 class="section-title text-center">My Process</h2>
            
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">01</div>
                    <h3>Discovery</h3>
                    <p>Understanding your requirements, goals, and target audience.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">02</div>
                    <h3>Planning</h3>
                    <p>Creating project roadmap, wireframes, and technical specifications.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">03</div>
                    <h3>Development</h3>
                    <p>Coding, testing, and implementing all features with best practices.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">04</div>
                    <h3>Delivery</h3>
                    <p>Final testing, deployment, and providing documentation.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">05</div>
                    <h3>Support</h3>
                    <p>Ongoing maintenance and support after project completion.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pricing-cta">
    <div class="container">
        <div class="pricing-content">
            <h2>Flexible Pricing Models</h2>
            <p>I offer different pricing options to suit your budget and project requirements:</p>
            
            <div class="pricing-options">
                <div class="pricing-option">
                    <h3>Fixed Price</h3>
                    <p>Perfect for projects with clearly defined requirements and scope.</p>
                </div>
                <div class="pricing-option">
                    <h3>Hourly Rate</h3>
                    <p>Ideal for ongoing work, maintenance, or projects with evolving requirements.</p>
                </div>
                <div class="pricing-option">
                    <h3>Monthly Retainer</h3>
                    <p>Best for long-term partnerships and regular website updates.</p>
                </div>
            </div>
            
            <a href="contact.php" class="btn btn-primary btn-large">Get Custom Quote</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>