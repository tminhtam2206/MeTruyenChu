function Alert(message){
    $.confirm({
        title: '<i class="fas fa-rocket"></i> Thông Báo!',
        content: message,
        type: 'purple',
        buttons:{
            cancelAction:{
                text: 'Đóng',
                btnClass: 'btn-blue'
            }
        }
    });
}