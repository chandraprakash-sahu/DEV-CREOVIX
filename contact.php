<?php
$pageTitle = "Contact";
include 'includes/header.php';

// Form submission handling
$success = false;
$error = '';
$formData = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $formData = [
        'name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
        'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
        'phone' => filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING),
        'project_type' => filter_input(INPUT_POST, 'project_type', FILTER_SANITIZE_STRING),
        'budget' => filter_input(INPUT_POST, 'budget', FILTER_SANITIZE_STRING),
        'message' => filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING)
    ];
    
    // Validate inputs
    if (empty($formData['name']) || empty($formData['email']) || empty($formData['message'])) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Connect to database
        include 'includes/config.php';
        $conn = getDBConnection();
        
        // Prepare and execute statement
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, project_type, budget, message) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", 
            $formData['name'],
            $formData['email'],
            $formData['phone'],
            $formData['project_type'],
            $formData['budget'],
            $formData['message']
        );
        
        if ($stmt->execute()) {
            $success = true;
            
            // Send email notification (optional)
            $to = "contact@devcreovix.com";
            $subject = "New Contact Form Submission from " . $formData['name'];
            $emailMessage = "Name: " . $formData['name'] . "\n";
            $emailMessage .= "Email: " . $formData['email'] . "\n";
            $emailMessage .= "Phone: " . $formData['phone'] . "\n";
            $emailMessage .= "Project Type: " . $formData['project_type'] . "\n";
            $emailMessage .= "Budget: " . $formData['budget'] . "\n";
            $emailMessage .= "Message: " . $formData['message'] . "\n";
            
            $headers = "From: " . $formData['email'] . "\r\n" .
                      "Reply-To: " . $formData['email'] . "\r\n";
            
            // Uncomment to send email
            // mail($to, $subject, $emailMessage, $headers);
            
            // Clear form data after successful submission
            $formData = [];
        } else {
            $error = 'Sorry, there was an error submitting your form. Please try again.';
        }
        
        $stmt->close();
        $conn->close();
    }
}

// Get service from URL if specified
$selectedService = isset($_GET['service']) ? urldecode($_GET['service']) : '';

// WhatsApp and Instagram Links (Replace with your actual links)
$whatsapp_number = "9329416874"; // Your WhatsApp number without + or 0
$whatsapp_link = "https://wa.me/{$whatsapp_number}?text=Hi%20Chandra%20Prakash%20Sahu%20from%20Dev%20Creovix!%20I%20visited%20your%20portfolio%20and%20would%20like%20to%20discuss%20a%20project.";
$instagram_link = "https://instagram.com/dev.creovix"; // Replace with your Instagram
$linkedin_link = "https://linkedin.com/in/yourusername"; // Replace with your LinkedIn
$github_link = "https://github.com/yourusername"; // Replace with your GitHub
?>

<section class="page-header">
    <div class="container">
        <h1 class="page-title">Contact</h1>
        <p class="page-subtitle">Let's discuss your project and bring your ideas to life</p>
    </div>
</section>

<section class="contact-section">
    <div class="container">
        <div class="contact-content">
            <div class="contact-info">
                <h2>Get In Touch</h2>
                <p>Have a project in mind? Let's discuss how we can work together to create something amazing. You can reach me through any of these channels:</p>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="method-info">
                            <h3>Email</h3>
                            <!-- <p>contact@devcreovix.com</p> -->
                            <p>chandraprakashsahu2124@gmail.com</p>
                            <a href="mailto:chandraprakashsahu2124@gmail.com" class="method-action-btn">
                                <i class="fas fa-paper-plane"></i> Send Email
                            </a>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="method-info">
                            <h3>WhatsApp</h3>
                            <p>+91 9329416874</p>
                            <p>Quick responses • File sharing</p>
                            <a href="<?php echo $whatsapp_link; ?>" target="_blank" class="method-action-btn whatsapp-btn">
                                <i class="fab fa-whatsapp"></i> Message on WhatsApp
                            </a>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="method-info">
                            <h3>Phone Call</h3>
                            <p>+91 9329416874</p>
                            <p>Mon - Fri, 9:00 AM - 6:00 PM</p>
                            <a href="tel:+919329416874" class="method-action-btn">
                                <i class="fas fa-phone-alt"></i> Call Now
                            </a>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="method-info">
                            <h3>Location</h3>
                            <p>Raipur, Chhattisgarh</p>
                            <p>India (Available Worldwide)</p>
                            <a href="https://maps.google.com/?q=Raipur,Chhattisgarh,India" target="_blank" class="method-action-btn">
                                <i class="fas fa-map-marked-alt"></i> View on Map
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media Quick Connect -->
                <div class="social-connect">
                    <h3><i class="fas fa-share-alt"></i> Connect on Social Media</h3>
                    <p>Follow for updates, projects, and web development tips</p>
                    
                    <div class="social-buttons">
                        <a href="<?php echo $whatsapp_link; ?>" target="_blank" class="social-btn whatsapp">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="<?php echo $instagram_link; ?>" target="_blank" class="social-btn instagram">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                        <!-- <a href="<?php echo $linkedin_link; ?>" target="_blank" class="social-btn linkedin">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                        <a href="<?php echo $github_link; ?>" target="_blank" class="social-btn github">
                            <i class="fab fa-github"></i> GitHub
                        </a> -->
                    </div>
                </div>
                
                <div class="contact-note">
                    <h3><i class="fas fa-lightbulb"></i> What to Expect</h3>
                    <ul>
                        <li><strong>Response within 24 hours</strong> (Usually much faster)</li>
                        <li><strong>Free 30-minute consultation</strong> to discuss your project</li>
                        <li><strong>Detailed project proposal</strong> with timeline & pricing</li>
                        <li><strong>Regular updates</strong> throughout development</li>
                        <li><strong>Post-launch support</strong> included</li>
                    </ul>
                </div>
            </div>
            
            <div class="contact-form-container" id="order-form">
                <h2>Project Inquiry Form</h2>
                <p class="form-subtitle">Fill this form for detailed project discussions and quotations</p>
                
                <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <h3>Thank You!</h3>
                        <p>Your message has been sent successfully. I'll get back to you within 24 hours.</p>
                        <p class="alert-note">For immediate response, you can also message me on <a href="<?php echo $whatsapp_link; ?>" target="_blank">WhatsApp</a>.</p>
                    </div>
                </div>
                <?php elseif ($error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <h3>Error</h3>
                        <p><?php echo $error; ?></p>
                    </div>
                </div>
                <?php endif; ?>
                
                <form method="POST" class="contact-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required 
                                   value="<?php echo htmlspecialchars($formData['name'] ?? ''); ?>"
                                   placeholder="Enter your full name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required 
                                   value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>"
                                   placeholder="Enter your email">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" 
                                   value="<?php echo htmlspecialchars($formData['phone'] ?? ''); ?>"
                                   placeholder="Enter your phone number (for WhatsApp)">
                            <small class="field-hint">For faster communication via WhatsApp</small>
                        </div>
                        <div class="form-group">
                            <label for="project_type">Project Type *</label>
                            <select id="project_type" name="project_type" required>
                                <option value="">Select a project type</option>
                                <option value="web-development" <?php echo ($formData['project_type'] ?? '') == 'web-development' ? 'selected' : ''; ?>>Web Development</option>
                                <option value="ecommerce" <?php echo ($formData['project_type'] ?? '') == 'ecommerce' ? 'selected' : ''; ?>>E-commerce Website</option>
                                <option value="portfolio" <?php echo ($formData['project_type'] ?? '') == 'portfolio' ? 'selected' : ''; ?>>Portfolio Website</option>
                                <option value="business" <?php echo ($formData['project_type'] ?? '') == 'business' ? 'selected' : ''; ?>>Business Website</option>
                                <option value="custom-app" <?php echo ($formData['project_type'] ?? '') == 'custom-app' ? 'selected' : ''; ?>>Custom PHP Application</option>
                                <option value="redesign" <?php echo ($formData['project_type'] ?? '') == 'redesign' ? 'selected' : ''; ?>>Website Redesign</option>
                                <option value="maintenance" <?php echo ($formData['project_type'] ?? '') == 'maintenance' ? 'selected' : ''; ?>>Website Maintenance</option>
                                <option value="consultation" <?php echo ($formData['project_type'] ?? '') == 'consultation' ? 'selected' : ''; ?>>Consultation</option>
                                <option value="other" <?php echo ($formData['project_type'] ?? '') == 'other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="budget">Project Budget</label>
                            <select id="budget" name="budget">
                                <option value="">Select budget range</option>
                                <option value="under-500" <?php echo ($formData['budget'] ?? '') == 'under-500' ? 'selected' : ''; ?>>Under ₹500</option>
                                <option value="500-1000" <?php echo ($formData['budget'] ?? '') == '500-1000' ? 'selected' : ''; ?>>₹500 - ₹1,000</option>
                                <option value="1000-5000" <?php echo ($formData['budget'] ?? '') == '1000-5000' ? 'selected' : ''; ?>>₹1,000 - ₹5,000</option>
                                <option value="5000-10000" <?php echo ($formData['budget'] ?? '') == '5000-10000' ? 'selected' : ''; ?>>₹5,000 - ₹10,000</option>
                                <option value="10000-25000" <?php echo ($formData['budget'] ?? '') == '10000-25000' ? 'selected' : ''; ?>>₹10,000 - ₹25,000</option>
                                <option value="25000-plus" <?php echo ($formData['budget'] ?? '') == '25000-plus' ? 'selected' : ''; ?>>₹25,000+</option>
                                <option value="not-sure" <?php echo ($formData['budget'] ?? '') == 'not-sure' ? 'selected' : ''; ?>>Not Sure</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="timeline">Preferred Timeline</label>
                            <select id="timeline" name="timeline">
                                <option value="">Select timeline</option>
                                <option value="asap">ASAP (As soon as possible)</option>
                                <option value="1-2-weeks">1-2 Weeks</option>
                                <option value="1-month">1 Month</option>
                                <option value="2-3-months">2-3 Months</option>
                                <option value="flexible">Flexible/No Rush</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Project Details *</label>
                        <textarea id="message" name="message" rows="6" required 
                                  placeholder="Describe your project requirements, goals, target audience, features needed, timeline, and any other details..."><?php echo htmlspecialchars($formData['message'] ?? ''); ?></textarea>
                        <small class="field-hint">The more details you provide, the better I can understand your requirements</small>
                    </div>
                    
                    <div class="form-options">
                        <div class="form-note">
                            <p><i class="fas fa-info-circle"></i> All fields marked with * are required.</p>
                        </div>
                        
                        <div class="quick-connect">
                            <p><i class="fas fa-bolt"></i> For urgent inquiries, message directly on:</p>
                            <div class="quick-buttons">
                                <a href="<?php echo $whatsapp_link; ?>" target="_blank" class="quick-btn whatsapp">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                                <a href="<?php echo $instagram_link; ?>" target="_blank" class="quick-btn instagram">
                                    <i class="fab fa-instagram"></i> Instagram DM
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="faq-section">
    <div class="container">
        <h2 class="section-title text-center">Frequently Asked Questions</h2>
        
        <div class="faq-grid">
            <div class="faq-item">
                <h3>What is your typical response time?</h3>
                <p>I respond to all inquiries within 24 hours, usually much sooner during business hours (9 AM - 6 PM IST). For urgent matters, WhatsApp is the fastest way to reach me.</p>
            </div>
            
            <div class="faq-item">
                <h3>Do you offer free consultations?</h3>
                <p>Yes, I offer a free 30-minute consultation to discuss your project requirements, provide initial guidance, and answer any questions you might have about the process.</p>
            </div>
            
            <div class="faq-item">
                <h3>What information should I provide?</h3>
                <p>Please provide as much detail as possible about your project goals, target audience, timeline, budget, examples of websites you like, and any specific features needed.</p>
            </div>
            
            <div class="faq-item">
                <h3>Do you work with international clients?</h3>
                <p>Yes, I work with clients worldwide. I'm comfortable with remote collaboration across different time zones. I've worked with clients from the US, UK, Australia, and Europe.</p>
            </div>
            
            <div class="faq-item">
                <h3>What's the best way to contact you?</h3>
                <p>For detailed project discussions, use the form. For quick questions or urgent matters, WhatsApp is best. For general updates and seeing my work, follow me on Instagram.</p>
            </div>
            
            <div class="faq-item">
                <h3>Do you provide post-launch support?</h3>
                <p>Yes, all projects include 30 days of free support after launch. I also offer maintenance plans for ongoing support, updates, and security monitoring.</p>
            </div>
        </div>
        
        <div class="final-cta">
            <h3>Still have questions?</h3>
            <p>Don't hesitate to reach out! I'm here to help you bring your ideas to life.</p>
            <div class="cta-buttons">
                <a href="<?php echo $whatsapp_link; ?>" target="_blank" class="btn btn-primary">
                    <i class="fab fa-whatsapp"></i> Message on WhatsApp
                </a>
                <a href="mailto:chandraprakashsahu2124@gmail.com" class="btn btn-secondary">
                    <i class="fas fa-envelope"></i> Send Email
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>