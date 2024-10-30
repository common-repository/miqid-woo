(($) => {
  $(() => {
    var conditional_shipping = window.conditional_shipping || { admin_ajax: null };
    $('body').on('click', '.miqid_woo_club_signup button', (e) => {
      let _email = $('.miqid_woo_club_signup input[name="miqid_woo_club_signup"]').val();
      $.ajax({
        method: 'POST',
        url: conditional_shipping.admin_ajax,
        data: {
          action: 'miqid_woo_club_signup',
          miqid_woo_club_signup: _email,
        },
      }).done(success => {
        console.log(success);
        if(success == "Login") {
          location.href = "/wp-login.php/?redirect_to='"+encodeURI(window.location.href)+"'";
        } else if (success) {
          location.href = location.href;
        }
      });
    });
  });
})(jQuery);