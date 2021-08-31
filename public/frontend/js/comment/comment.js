"use strict";
var COMMENT = (function(){
	function repComment(){
		const repComment = document.querySelectorAll(".rep-comment button");
		if(repComment.length > 0){
			repComment.forEach(function(element){
				element.onclick = function(){
					const form = element.parentElement;
					const formGroup = form.querySelector(".group-form");
					if(element.type == "submit"){
						const inputs = form.querySelectorAll('[name]');
						let isTrue = true;
						inputs.forEach(function(inputElement){
							if(inputElement.value.trim() == '' && inputElement.parentElement.className == "group-form"){
								isTrue = false;
								if(inputElement.nextElementSibling?.className !== "errorMessage"){
									const span = document.createElement('span');
									inputElement.parentElement.border = "1px solid var(--color-main)";
									span.innerHTML = element.dataset.placeholder;
									span.style.color = "var(--color-main)";
									span.className = "errorMessage";
									inputElement.parentElement.append(span);
								}
								inputElement.style.border = "1px solid var(--color-main)";
							}
						})

						if(isTrue){
							const data = {
								isForm:true,
                                form:form
							}
							XHR.send(data)
							.then((response) => {
								if(response.code == 100){
									notyf.error(response.message);
									if(response.redirect_url){
										window.location.href = response.redirect_url
									}
								}else{
									element.type = "button";
									formGroup.innerHTML = '';
									setRepComment();
								}
							});
						}
					}else{
						const textArea = document.createElement("textarea");
						textArea.name = "content";
						textArea.placeholder = element.dataset.placeholder;
						textArea.style.width="100%";
						textArea.animate([{opacity:0},{opacity:1}],{duration:400,fill:"forwards"})
						textArea.oninput = function(){
							textArea.style.border = "1px solid var(--color-star-evalue);";
							if(textArea.parentElement.querySelector('span')){
								textArea.parentElement.querySelector('span').remove();
							}
						}
						formGroup.append(textArea);
						textArea.focus();
						element.type = 'submit';
					}
				}
			});
		}
	}

	function setRepComment(){
		repComment();
	}

	function loadMoreChild(){
		const btnMore = document.querySelectorAll('.more-comment--child');
		btnMore.forEach(function(btn){
			btn.onclick = function(){
				const parentId = btn.parentElement.querySelector('.rep-comment').querySelector('[name="parent"]').value;
				var main = btn.previousElementSibling;
				var pagenumber = btn.getAttribute('page-current');
				pagenumber++;
				const options = {
					url: '/binh-luan-khac',
					method:"POST",
					datas:{	
						parent_id:parentId,
						page:pagenumber,
						_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
					}
				}
				XHR.send(options)
				.then(function(response){
					if(pagenumber == response.lastPage){
						btn.remove();
					}else{
						btn.setAttribute('page-current',pagenumber);
					}
					return response.html;
				}).then(function(response){
					main.insertAdjacentHTML('beforeend',response);
					return true;
				}).then(function(){
					loadMoreChild();
				});
			}
		})
	}
	
	function loadMore(){
		const btnMore = document.querySelector('.more-comment');
		if(btnMore){
			btnMore.onclick = function(){
				var main = btnMore.previousElementSibling;
				const map_table = btnMore.getAttribute('page-table');
				const map_id = btnMore.getAttribute('page-id');
				var pagenumber = btnMore.getAttribute('page-current');
				pagenumber++;
				const options = {
					url: '/xem-them-binh-luan',
					method:"POST",
					datas:{	
						map_table: map_table,
						map_id: map_id,
						page:pagenumber,
						_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
					}
				}
				XHR.send(options)
				.then(function(response){
					if(pagenumber == response.lastPage){
						btnMore.remove();
					}else{
						btnMore.setAttribute('page-current',pagenumber);
					}
					return response.html;
				}).then(function(response){
					main.insertAdjacentHTML('beforeend',response);
					return true;
				}).then(function(response){
					setRepComment();
					loadMore();
					loadMoreChild();
				});
			}
		}
	}
	
    function receivedComment(response){
        var main = document.querySelector('.comment-box__list');
        main.innerHTML = response.html
        setRepComment();
    }
	
	return {
		load:(function(){
			repComment();
			loadMore();
			loadMoreChild();
		})(),
		setRepComment:function(){
			setRepComment();
		},
        receivedComment:function(response){
            receivedComment(response)
        }
	}
})();