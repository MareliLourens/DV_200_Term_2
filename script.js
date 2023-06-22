var buttons = document.querySelectorAll('.btn');
  buttons.forEach(function(button) {
    button.addEventListener('mouseover', function() {
      // Add hover effect when mouse is over the button
      this.style.backgroundColor = '#ccc';
    });

    button.addEventListener('mouseout', function() {
      // Remove hover effect when mouse leaves the button
      this.style.backgroundColor = '#e6e6e6';
    });
  });