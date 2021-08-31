'use strict';
const pathname = window.location.pathname;

let timeTab = sessionStorage.getItem('session_tab');
if(!timeTab){
    timeTab = sessionStorage.setItem('session_tab',+ new Date());
}

var MAIN = (function(){
    var checkEdit = function(){
        const button = document.querySelector('._vh_save');
        if(pathname.indexOf('/esystem/edit/news') == 0){
            button.style.pointerEvents = 'none';
            var id = pathname.split('/')[pathname.split('/').length - 1];
            
            $.ajax({
                url:'esystem/news/check-editing/'+id,
                method:"POST",
                data:{
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    tab_time: timeTab
                }
            })
            .done(function(response){
                if(response.code == 100){
                    window.location.href = response.redirect_url;
                }else{
                    button.removeAttribute('style');
                    runWarning();
                }
            });
        }else if(document.querySelector('.has_warning')?.value == 1){
            runWarning();
        }

        

        function runWarning(){
            beforeUnload();
            checkClick();
            clickSave();
        }

        function beforeUnload(){
            window.onbeforeunload =  function (e) {
                var confirmationMessage = "Không thể thay đổi ở trình duyệt mới";
                (e || window.event).returnValue = confirmationMessage;
                return confirmationMessage;
            };
        }

        function clickSave(){
            button.onclick = function(e){
                if(pathname.indexOf('/esystem/edit/news') == 0){
                    console.log('ok');
                    if(!$('#frmUpdate').find('input[name="is_draft"]')){
                        $('#frmUpdate').find('input[name="is_draft"]').val(0);
                    }else{
                        $('#frmUpdate').append(`<input name="is_draft" value="0">`);
                    }
                }
                window.onbeforeunload = false;
            };
        }

        function checkClick(){
            window.onclick = function(e){
                var parent = getParent(e.target,'._vh_save');
                if(!parent){
                    beforeUnload();
                }
            }
            window.addEventListener('unload',updateEditing,{passive: true});
        }
        
        function getParent(element, selector) {
            while (element.parentElement) {
                if (element.parentElement.matches(selector)) {
                    return element.parentElement;
                }
                element = element.parentElement;
            }
        };

        function updateEditing(){
            var pathname = window.location.pathname;
            var id = pathname.split('/')[pathname.split('/').length - 1];
            $.get({url:'esystem/news/editing-done/'+id})
        }
    }

    var checkHasEdit = function(){
        if(pathname.indexOf('/esystem/view/news') == 0){
            $('.action a').unbind('click');
            $('.action a').click(function(e){
                const _this = $(this);
                if(_this.attr('href').indexOf('esystem/edit/news') == 0){
                    e.preventDefault();
                    const id = $(this).closest('tr').find('.squaredTwo input').attr('dt-id');
                    $.ajax({
                        url:'/esystem/news/check-has-edit/'+id,
                        method:"POST",
                        data:{
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        }
                    }).done(function(response){
                        if(response.code == 200){
                            window.location.href = _this.attr('href');
                        }else{
                            $.simplyToast(response.message, 'danger');
                        }
                    })
                }
            })
        }
    }

    var getLink = function(){
        if($('button.get-link').length == 0) return;
        $('button.get-link').unbind('click');
        $('button.get-link').click(function(){
            copyLink($(this).prev());
        });

        function copyLink(element){
            var textarea = document.createElement("textarea");
            textarea.textContent = window.location.origin + '/' +$(element).val();
            textarea.style.height = 0;
            textarea.style.width = 0;
            document.body.appendChild(textarea);
            textarea.select();
            textarea.setSelectionRange(0, 99999)
            document.execCommand("copy");
            document.body.removeChild(textarea);
            $.simplyToast('Đã sao chép', 'success')
        }
    }

    // var autoSave = function(){
    //     $.form(function(){

    //     })
    // }
    return {
        load:(function(){
            document.addEventListener("readystatechange",function(){
                checkEdit();
                checkHasEdit();
                getLink();
            },{passive: true});
        })()
    }
})();

var USERONLINE = (function(){
	// Pusher.logToConsole = true;
    var pusher = new Pusher('5ef77b79133276e49bce', {
        cluster: 'ap1'
    });
    var channel = pusher.subscribe('HUserOnline');

    channel.bind('App\\Events\\HUserOnline', loadUser);
    
    function loadUser(data){
        const main = document.querySelector('.h-user-online');
        const users = data.users;
        const html = users.map(function(user){
            return `<li>${user.h_user.name} - ${user.doing}</li>`;
        })
        if(main !== null && typeof main ){
            main.querySelector('ul.h-user__list').innerHTML = html.slice(0,5).join('');
            main.querySelector('.count').innerHTML = users.length > 5 ? "5+" : users.length ;
            main.querySelector('ul.h-user__list-all').innerHTML = html.join('');
        }
    }
    
    window.onunload = function(){
        ajaxAction('REMOVE');
    }

    document.onreadystatechange = function () {
        if (document.readyState === 'complete') {
            ajaxAction('ADD');
        }
    }

    function ajaxAction(action){
        const content = buildContent();
        $.ajax({
            url:'/esystem/user-online',
            method:"POST",
            data:{
                action:action,
                tab_session:timeTab,
                doing: content,
                _token: $('meta[name="csrf-token"]').attr('content'),
            }
        });
    }

    function buildContent(){
        const doing = document.querySelector('.list-link');
        var from = JSON.stringify('đang ở trang ' + (doing ? doing.innerText : 'không xác định'));
        
        if(pathname.indexOf('/esystem/edit/configs/0') == 0 && pathname.lastIndexOf('/esystem/edit/configs/0') == 0){
            var content = JSON.stringify('đang sửa ' + (doing ? doing.innerText : 'không xác định'));
        }else if(pathname.indexOf('/esystem/media/manager') == 0 && pathname.lastIndexOf('/esystem/media/manager') == 0){
            var content = JSON.stringify('đang ở trang trang Media');
        }else if(pathname.indexOf('/esystem/editSitemap') == 0 && pathname.lastIndexOf('/esystem/editSitemap') == 0){
            var content = JSON.stringify('đang ở trang trang Sitemap');
        }else if(pathname.indexOf('/esystem/editRobot') == 0 && pathname.lastIndexOf('/esystem/editRobot') == 0){
            var content = JSON.stringify('đang ở trang Robots.txt');
        }else if (pathname.indexOf('/esystem/edit') == 0){
            const inputName = document.querySelector('input[name="name"]');
            var content = JSON.stringify('đang sửa ' + (inputName ? inputName.value : 'không xác định'));
        }else if(pathname.indexOf('/esystem/insert') == 0){
            var content = JSON.stringify('đang thêm mới ' + (doing ? doing.innerText : 'không xác định'));
        }else if(pathname.indexOf('/esystem/copy') == 0){
            const inputName = document.querySelector('input[name="name"]');
            var content = JSON.stringify('đang copy ' + (inputName ? inputName.value : 'không xác định'));
        }else if(pathname.indexOf('/esystem') == 0 && pathname.lastIndexOf('/esystem') == 0){
            var content = JSON.stringify('đang ở trang chủ');
        }
        if(!content){
            return from;
        }else{
            return content;
        }
    }
})();