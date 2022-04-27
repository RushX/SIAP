function createNoty(message, type) {
    var html = '<div class="alert alert-' + type + ' alert-dismissable page-alert">';    
    html += '<button type="button" class="btn"><span aria-hidden="true"><i class="fa-regular fa-circle-xmark fa-xl"></i></span><span class="sr-only"></span></button>';
    html += message;
    html += '</div>';    
    $(html).hide().prependTo('#noty-holder').slideDown();
    $('.page-alert .btn').click(function(e) {
        
        e.preventDefault();
        $(this).closest('.page-alert').slideUp();
    });
    
};
