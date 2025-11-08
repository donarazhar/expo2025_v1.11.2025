import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Smooth scroll untuk navigation
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll untuk semua anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg', 'bg-white');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.remove('shadow-lg', 'bg-white');
                navbar.classList.add('bg-transparent');
            }
        });
    }

    // Scroll reveal animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-slide-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach(el => {
        observer.observe(el);
    });
});

// Form Registration Handler
window.registrationForm = function() {
    return {
        formData: {
            nama_lengkap: '',
            email: '',
            no_hp: '',
            asal_instansi: ''
        },
        errors: {},
        loading: false,
        success: false,
        registrationId: '',
        
        validateForm() {
            this.errors = {};
            
            // Validate nama
            if (!this.formData.nama_lengkap || this.formData.nama_lengkap.trim().length < 3) {
                this.errors.nama_lengkap = 'Nama lengkap minimal 3 karakter';
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!this.formData.email || !emailRegex.test(this.formData.email)) {
                this.errors.email = 'Email tidak valid';
            }
            
            // Validate phone
            const phoneRegex = /^(\+62|62|0)[0-9]{9,12}$/;
            if (!this.formData.no_hp || !phoneRegex.test(this.formData.no_hp.replace(/[\s-]/g, ''))) {
                this.errors.no_hp = 'Nomor HP tidak valid (contoh: 081234567890)';
            }
            
            // Validate instansi
            if (!this.formData.asal_instansi || this.formData.asal_instansi.trim().length < 3) {
                this.errors.asal_instansi = 'Asal instansi minimal 3 karakter';
            }
            
            return Object.keys(this.errors).length === 0;
        },
        
        async submitForm() {
            if (!this.validateForm()) {
                return;
            }
            
            this.loading = true;
            
            try {
                const response = await fetch('/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(this.formData)
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    this.success = true;
                    this.registrationId = data.id_peserta;
                    this.resetForm();
                    
                    // Scroll to success message
                    setTimeout(() => {
                        document.getElementById('success-message').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 100);
                    
                    // Auto hide success message after 10 seconds
                    setTimeout(() => {
                        this.success = false;
                    }, 10000);
                } else {
                    if (data.errors) {
                        this.errors = data.errors;
                    } else {
                        alert('Terjadi kesalahan: ' + (data.message || 'Silakan coba lagi'));
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
            } finally {
                this.loading = false;
            }
        },
        
        resetForm() {
            this.formData = {
                nama_lengkap: '',
                email: '',
                no_hp: '',
                asal_instansi: ''
            };
            this.errors = {};
        }
    }
}

// Counter Animation
window.animateCounter = function(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(start);
        }
    }, 16);
}

// Initialize counters when visible
document.addEventListener('DOMContentLoaded', function() {
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.counted) {
                const target = parseInt(entry.target.dataset.target);
                animateCounter(entry.target, target);
                entry.target.dataset.counted = 'true';
            }
        });
    }, { threshold: 0.5 });
    
    document.querySelectorAll('.counter').forEach(counter => {
        counterObserver.observe(counter);
    });
});

// Mobile menu toggle
window.toggleMobileMenu = function() {
    return {
        open: false,
        toggle() {
            this.open = !this.open;
            document.body.style.overflow = this.open ? 'hidden' : '';
        },
        close() {
            this.open = false;
            document.body.style.overflow = '';
        }
    }
}