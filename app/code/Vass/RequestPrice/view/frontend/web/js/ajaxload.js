define(
    [
        'jquery',
        'Magento_Ui/js/modal/modal',
        'mage/validation',
    ],
    function ($, modal) {
        jQuery(document).ready(function () {
            var options = {
                type: 'popup',
                responsive: true,
                innerScroll: true,
                title: 'Request Price',
                buttons: [{
                    text: $.mage.__('Close'),
                    class: '',
                    click: function () {
                        this.closeModal();
                    }
                }]
            };
            var openModal = modal(options, $('#popup-modal'));

            $('body').on('click', '.open-contact-form', function () {

                $('.contact-form-popup').show();
                $('.static-block-message').hide();
                $('#popup-modal').modal('openModal');

                var isLoggedIn = jQuery('.authorization-link > a').attr('href').indexOf('/login') < 0;
                if (isLoggedIn) {
                    // alert("LOGGED");
                } else {
                    // alert("NOTLOGGED");
                }
                // var nameInput = document.getElementById('name');
                // nameInput.value = "v";
                // var emailInput = document.getElementById('email');
                // emailInput.value = "v@com";
                // var phoneInput = document.getElementById('telephone');
                // phoneInput.value = "+3812412";
            });

            jQuery('body').on('click', '#contact-form .submit', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var dataForm = $('#contact-form');
                dataForm.mage('validation', {});

                var status = dataForm.validation('isValid');
                if(status) {
                    console.log('form is validated');
                    jQuery.ajax({
                        type: 'POST',
                        data: jQuery('#contact-form').serialize(),
                        cache: false,
                        url: '/price/index/index',
                        showLoader: 'true',
                        success: function (response) {
                            $('#contact-form').valid();
                            // alert('success');
                            jQuery('.contact-form-popup').hide();
                            jQuery('#popup-modal').modal('closeModal');
                        }
                    });
                } else {
                    console.log('form is not validated');
                }
                return false;
            });
        });
        
    }
);