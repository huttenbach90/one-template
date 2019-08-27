jQuery(document).ready(function($) {
  $('#choose_default_image_other').click(function(e) {
      e.preventDefault();

      var custom_uploader = wp.media({
          title: 'Custom Image',
          button: {
              text: 'Upload Image'
          },
          multiple: false  // Set this to true to allow multiple files to be selected
      })
      .on('select', function() {
          var attachment = custom_uploader.state().get('selection').first().toJSON();
          $('.preview_image').attr('src', attachment.url);
          $('#default_image_other').val(attachment.url);
      })
      .open();
  });
  $('#choose_header_images_domacnosti').click(function(e) {
    e.preventDefault();

    var custom_uploader = wp.media({
        title: 'Custom Image',
        button: {
            text: 'Upload Image'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
    })
    .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        $('#preview_header_images_domacnosti').attr('src', attachment.url);
        $('#header_images_domacnosti').val(attachment.url);
    })
    .open();
  });
  $('#choose_desktop_images_domacnosti').click(function(e) {
    e.preventDefault();

    var custom_uploader = wp.media({
        title: 'Custom Image',
        button: {
            text: 'Upload Image'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
    })
    .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        $('#preview_desktop_images_domacnosti').attr('src', attachment.url);
        $('#desktop_images_domacnosti').val(attachment.url);
    })
    .open();
  });
  $('#choose_mobile_images_domacnosti').click(function(e) {
    e.preventDefault();

    var custom_uploader = wp.media({
        title: 'Custom Image',
        button: {
            text: 'Upload Image'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
    })
    .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        $('#preview_mobile_images_domacnosti').attr('src', attachment.url);
        $('#mobile_images_domacnosti').val(attachment.url);
    })
    .open();
  });
});  