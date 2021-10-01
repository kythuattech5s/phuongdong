'use strict';
var MENU = (function(){
    const CONFIG_SMALL_MENU = 'CONFIG_SMALL_MENU';

    function clickshowMenu(){
        const divAnchors = document.querySelectorAll('.main-menu>li .menu-anchor');
        const btnIcons = document.querySelectorAll('.menu-show-icon');
        const submenus = document.querySelectorAll('.main-menu .sub');
        divAnchors.forEach(function(divAnchor,index){
            divAnchor.onclick = function(e){
                e.preventDefault();
                const li = divAnchor.parentElement;
                const submenu = li.querySelector('.sub');
                if(submenu.classList.contains('none')){
                    btnIcons.forEach(element => {
                        element.querySelector('i').animate([{transform:"rotate(0deg)"}],{
                            fill:"forwards",
                            duration:200
                        })
                    });

                    submenus.forEach(function(subMenuOther,indexMenuOther){
                        if(indexMenuOther !== index){
                            const animateSubmenu = subMenuOther.animate([{maxHeight:0}],{
                                duration:400,
                                fill:"forwards",
                            });
                            animateSubmenu.onfinish = function(){
                                subMenuOther.className = "sub none";
                                animateSubmenu.cancel();
                            }
                        }
                    })

                    li.querySelector('button i').animate([{transform:"rotate(-90deg)"}],{
                        duration:200,
                        fill:"forwards",
                    })
                    submenu.classList.remove('none');
                    submenu.animate([{maxHeight:"500px"}],{
                        duration:400,
                        fill:"forwards",
                    });
                }else{
                    const submenuAnimate = submenu.animate([{maxHeight:0}],{
                        duration:400,
                        fill:"forwards",
                    });
                    submenuAnimate.onfinish = function(){
                        submenu.className = "sub none";
                        submenuAnimate.cancel();
                    }
                    li.querySelector('button i').animate([{transform:"rotate(0deg)"}],{
                        fill:"forwards",
                        duration:200
                    })
                }
            }
        })
    }

    function sleep(ms = 0){
        return new Promise(function(resolve){
            setTimeout(resolve,ms);
        });
    }

    function checkMenu(){
        const store = storage();
        if(store.get()){
            document.querySelector('.small-menu').classList.add('fix-small');
            document.querySelector('.root-left').classList.add('fix-small');
            document.querySelector('.root-right').classList.add('fix-small');
            document.querySelector('.top_menu').classList.add('fix-small');
            hoverShowMenu();
        }
    }

    function hoverShowMenu(addEvent = true){
        const lis = document.querySelectorAll('.nav-item');
        lis.forEach(function(li){
            if(addEvent){
                li.addEventListener('mouseover',showSubMenu);
                li.addEventListener('mouseleave',hideSubMenu);
            }else{
                li.removeEventListener('mouseover',showSubMenu);
                li.removeEventListener('mouseleave',hideSubMenu);
            }
        })
    }
    
    function showSubMenu(e){
        const ulSub = e.target.closest('li').querySelector('ul');
        if(ulSub){
            ulSub.className = "sub fix-small";
        }
    }
    function hideSubMenu(e){
        const ulSub = e.target.closest('li').querySelector('ul');
        if(ulSub){
            ulSub.className = "sub none";
        }
    }
    function clickSmallMenu(){
        const store = storage();
        const btn = document.querySelector('.small-menu');
        const top = document.querySelector('.top_menu');
        btn.onclick = function(){
            const left = document.querySelector('.root-left');
            const right = document.querySelector('.root-right');
            if(btn.classList.contains('fix-small')){
                left.classList.remove('fix-small');
                btn.classList.remove('fix-small');
                top.classList.remove('fix-small');
                right.classList.remove('fix-small');
                clickshowMenu();
                hoverShowMenu(false);
                store.set(false);
            }else{
                store.set(true)
                left.classList.add('fix-small');
                top.classList.add('fix-small');
                btn.classList.add('fix-small');
                right.classList.add('fix-small');
                hoverShowMenu();
            }
        }
    }

    function storage() {
        const store = JSON.parse(localStorage.getItem(CONFIG_SMALL_MENU)) ?? {};
    
        const save = () => {
            localStorage.setItem(CONFIG_SMALL_MENU, JSON.stringify(store));
        };
    
        const storage = {
            get() {
                return store[CONFIG_SMALL_MENU];
            },
            set(value) {
                store[CONFIG_SMALL_MENU] = value;
                return save();
            },
            remove() {
                delete store[CONFIG_SMALL_MENU];
                save();
            },
        };
        
        return storage;
    }
    return {
        load:(function(){
            window.onload = function(){
                checkMenu();
                clickshowMenu();
                clickSmallMenu();
            }
        })(),
        checkMenu:function(){
            checkMenu();
        }
    }
})();