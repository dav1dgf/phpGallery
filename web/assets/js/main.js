function showDialog(message, title) {
    if ($('#dialog-message').length === 0) {
        
        $('body').append('<div id="dialog-message" style="display:none;"></div>');
    }

    
    $('#dialog-message').attr('title', title).html(message);

    
    $("#dialog-message").dialog({
        modal: true,             
        buttons: {
            Ok: function() {
                $(this).dialog("close");  
            }
        },
        width: 400,              
        height: 'auto',          
        closeOnEscape: true,     
        resizable: false,        
        dialogClass: 'custom-dialog' 
    });

    
    $(".ui-dialog-titlebar-close").hide(); 
}

document.addEventListener('DOMContentLoaded', function () {
    const flashMessageContainer = document.querySelector('.flash-message-container');
    const flashMessage = document.querySelector('.flash-message');

    if (flashMessage) {
        flashMessage.addEventListener('animationend', function () {
            
            flashMessage.style.zIndex = '1';  
            flashMessageContainer.style.zIndex = '1';  
        });
    }
});
