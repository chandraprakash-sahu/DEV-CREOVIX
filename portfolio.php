<?php
$pageTitle = "Portfolio";
include 'includes/header.php';

$projects = [
    [
        'title' => 'E-commerce Platform',
        'description' => 'Full-featured online store with admin dashboard and payment integration.',
        'tech' => ['PHP', 'MySQL', 'JavaScript', 'Bootstrap'],
        'image' => 'ecommerce',
        'live' => '#',
        'github' => '#'
    ],
    [
        'title' => 'Corporate Website',
        'description' => 'Modern business website with CMS and responsive design.',
        'tech' => ['HTML', 'CSS', 'JavaScript', 'PHP'],
        'image' => 'corporate',
        'live' => '#',
        'github' => '#'
    ],
    [
        'title' => 'Portfolio Website',
        'description' => 'Creative portfolio for a photographer with gallery and contact forms.',
        'tech' => ['HTML', 'CSS', 'JavaScript'],
        'image' => 'portfolio',
        'live' => '#',
        'github' => '#'
    ],
    [
        'title' => 'Task Management App',
        'description' => 'Web application for managing tasks with drag-and-drop functionality.',
        'tech' => ['React', 'Node.js', 'MongoDB'],
        'image' => 'taskapp',
        'live' => '#',
        'github' => '#'
    ],
    [
        'title' => 'Real Estate Website',
        'description' => 'Property listing website with search filters and contact forms.',
        'tech' => ['PHP', 'MySQL', 'JavaScript'],
        'image' => 'realestate',
        'live' => '#',
        'github' => '#'
    ],
    [
        'title' => 'Blog Platform',
        'description' => 'Custom blog platform with user authentication and commenting system.',
        'tech' => ['PHP', 'MySQL', 'Bootstrap'],
        'image' => 'blog',
        'live' => '#',
        'github' => '#'
    ]
];
?>

<section class="page-header">
    <div class="container">
        <h1 class="page-title">Portfolio</h1>
        <p class="page-subtitle">Showcasing my recent projects and web development work</p>
    </div>
</section>

<section class="portfolio-section">
    <div class="container">
        <div class="portfolio-filters">
            <button class="filter-btn active" data-filter="all">All Projects</button>
            <button class="filter-btn" data-filter="web">Web Development</button>
            <button class="filter-btn" data-filter="ecommerce">E-commerce</button>
            <button class="filter-btn" data-filter="php">PHP Applications</button>
            <button class="filter-btn" data-filter="design">UI/UX Design</button>
        </div>
        
        <div class="portfolio-grid">
            <?php foreach ($projects as $index => $project): ?>
            <div class="portfolio-card" data-category="web">
                <div class="portfolio-image">
                    <div class="image-placeholder type-<?php echo ($index % 3) + 1; ?>">
                        <i class="fas fa-<?php echo $project['image']; ?>"></i>
                    </div>
                    <div class="portfolio-overlay">
                        <a href="<?php echo $project['live']; ?>" class="portfolio-link" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="<?php echo $project['github']; ?>" class="portfolio-link" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
                <div class="portfolio-info">
                    <h3><?php echo $project['title']; ?></h3>
                    <p><?php echo $project['description']; ?></p>
                    <div class="portfolio-tech">
                        <?php foreach ($project['tech'] as $tech): ?>
                        <span><?php echo $tech; ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="portfolio-cta">
            <h2>Have a Project in Mind?</h2>
            <p>Let's discuss your ideas and create something amazing together.</p>
            <a href="contact.php" class="btn btn-primary btn-large">Start Your Project</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>