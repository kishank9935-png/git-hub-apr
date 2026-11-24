/**
 * APR GROUP OF COMPANY - Contact Form & WhatsApp Routing
 */

document.addEventListener('DOMContentLoaded', () => {
  const contactForm = document.getElementById('apr-contact-form');
  const formSuccess = document.getElementById('contact-form-success');

  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const nameInput = document.getElementById('contact-name');
      const phoneInput = document.getElementById('contact-phone');
      const projectInput = document.getElementById('contact-project');
      const sizeInput = document.getElementById('contact-size');
      const budgetInput = document.getElementById('contact-budget');
      const messageInput = document.getElementById('contact-message');

      const name = nameInput ? nameInput.value.trim() : '';
      const phone = phoneInput ? phoneInput.value.trim() : '';
      const project = projectInput ? projectInput.value : '';
      const size = sizeInput ? sizeInput.value.trim() : '';
      const budget = budgetInput ? budgetInput.value.trim() : '';
      const message = messageInput ? messageInput.value.trim() : '';

      if (!name || !phone) {
        alert('Please enter your full name and phone number.');
        return;
      }

      // Format WhatsApp lead message
      let leadText = `*APR GROUP - Website Enquiry*\n`;
      leadText += `Name: ${name}\n`;
      leadText += `Phone: ${phone}\n`;
      if (project) leadText += `Interested Project: ${project}\n`;
      if (size) leadText += `Preferred Plot Size: ${size} Sq. Ft.\n`;
      if (budget) leadText += `Budget: ${budget}\n`;
      if (message) leadText += `Message: ${message}\n`;
      leadText += `\nSent via aprgroupbhadohi.com`;

      const waUrl = `https://wa.me/916392199296?text=${encodeURIComponent(leadText)}`;

      // Show friendly confirmation and open WhatsApp
      if (formSuccess) {
        formSuccess.style.display = 'block';
        formSuccess.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }

      window.open(waUrl, '_blank');
      contactForm.reset();
    });
  }
});
