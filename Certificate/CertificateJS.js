$(document).ready(function() {
  $('#buttonCertificateSAVE').on('click', function() {
    var formData = new FormData();

    formData.append('em_id', $('#em_id').val());
    formData.append('cert_title', $('#cert_title').val());
    formData.append('cert_description', $('#cert_description').val());
    formData.append('cert_date', $('#cert_date').val());

    // Check if cert media field exists and is not empty
    var certMediaInput = $('#cert_media')[0];
    if (certMediaInput && certMediaInput.files && certMediaInput.files[0]) {
      formData.append('cert_media', certMediaInput.files[0]);
      submitForm(formData);
    } else {
      // Default image path based on the hostname
      var defaultImagePath;
      if (window.location.hostname === "localhost") {
        defaultImagePath = '../PINEHR/bgimages/certificate.png';
      } else {
        defaultImagePath = '../pinesolutions.com/bgimages/certificate.png';
      }

      // Create a File object from the default image path
      fetch(defaultImagePath)
        .then(response => response.blob())
        .then(blob => {
          const file = new File([blob], 'certificate.png', { type: 'image/png' });
          formData.append('cert_media', file);
          submitForm(formData);
        })
        .catch(error => {
          console.error('Error fetching default image:', error);
        });
    }
  });

  function submitForm(formData) {
    if (formData.get('em_id') === '' || formData.get('cert_title') === '' || formData.get('cert_description') === '' || formData.get('cert_date') === '') {
      $('#message').html('Please fill in the required fields');
      console.log(formData.get('cert_media'));
    } else {
      $.ajax({
        url: 'Certificate/insertCertificate.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          if (data.toLowerCase().includes('success')) {
            $('#exampleModalCenter').modal('show');
          } else {
            $('#message').html(data);
          }
          $('form').trigger('reset');
        }
      });
    }
  }
});