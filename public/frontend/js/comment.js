COMMENT = (function(){
	function repComment(){
		const repComment = document.querySelectorAll(".rep-comment button");
		if(repComment.length > 0){
			repComment.forEach(function(element){
				element.onclick = function(){
					const form = element.parentElement;
					formGroup = form.querySelector(".group-form");
					if(element.type == "submit"){
						inputs = form.querySelectorAll('[name]');
						isTrue = true;
						inputs.forEach(function(inputElement){
							if(inputElement.value.trim() == '' && inputElement.parentElement.className == "group-form"){
								isTrue = false;
								if(inputElement.nextElementSibling?.className !== "errorMessage"){
									const span = document.createElement('span');
									inputElement.parentElement.border = "1px solid red";
									span.innerHTML = element.dataset.placeholder;
									span.style.color = "red";
									span.className = "errorMessage";
									inputElement.parentElement.append(span);
								}
								inputElement.style.border = "1px solid red";
							}
						})

						if(isTrue){
							formData = Array.from(inputs).reduce(function(values,current){
							values[current.name] = current.value;
							return values;
							},{});
						
							const data = {
								method : form.getAttribute("method"),
								url: form.getAttribute("action"),
								data: formData
							}
							var main = document.querySelector(".comment-ratings__list");
							XHR._send(data)
							.then((response) => {
								if(response.code == 100){
									notyf.error(response.message);
									if(response.redirect_url){
										window.location.href = response.redirect_url
									}
								}else{
									main.innerHTML = response.html
								}
							})
							.then(function(response){
								element.type = "button";
								COMMENT.setRepComment();
							});
						}
					}else{
						const textArea = document.createElement("textarea");
						textArea.name = "content";
						textArea.placeholder = element.dataset.placeholder;
						textArea.style.width="100%";
						textArea.animate([{opacity:0},{opacity:1}],{duration:400,fill:"forwards"})
						textArea.oninput = function(){
							textArea.style.border = "1px solid #ebebeb";
							if(textArea.parentElement.querySelector('span')){
								textArea.parentElement.querySelector('span').remove();
							}
						}
						formGroup.append(textArea);
						element.type = 'submit';
					}
				}
			});
		}
	}
	function setRepComment(){
		repComment();
	}
	return {
		load:(function(){
			repComment();
		})(),
		setRepComment:function(){
			setRepComment();
		}
	}
})();

var XHR = (function () {
	var _send = function (options) {
		return new Promise(function (resolve, reject) {
			const xhr = new XMLHttpRequest();
			if(options.isForm){
				xhr.open(options.form.method, options.form.action, true);

				const button = options.form.querySelector('button[type="submit"]');
				Object.assign(button.style, {
					width: `${button.offsetWidth}px`,
					height: `${button.offsetHeight}px`,
					position: `relative`,
				});
				button.setAttribute("content-old", button.innerHTML);
				button.disabled = true;
				button.innerHTML = `<div class="r-s-loader"></div><style>.r-s-loader{position:absolute;left:50%;top:50%;border:5px solid #f3f3f3;border-radius:50%;border-top:5px solid #fff;border-bottom:5px solid #fff;border-left:5px solid transparent;border-right:5px solid transparent;width:${button.offsetHeight - 16}px;height:${button.offsetHeight - 16}px;-webkit-animation:spin 2s linear infinite;animation:spin 2s linear infinite}@-webkit-keyframes spin{0%{-webkit-transform:translate(-50%,-50%) rotate(0)}100%{-webkit-transform:translate(-50%,-50%) rotate(360deg)}}@keyframes spin{0%{transform:translate(-50%,-50%) rotate(0)}100%{transform:translate(-50%,-50%) rotate(360deg)}}</style>`;
			}else{
				xhr.open(options.method, options.url, true);
			}
			xhr.onreadystatechange = function () {
				// In local files, status is 0 upon success in Mozilla Firefox
				if (xhr.readyState === XMLHttpRequest.DONE) {
					var status = xhr.status;

					if(options.isForm){
						button = options.form.querySelector('button[type="submit"]');
						button.disabled = false;
						button.innerHTML = button.getAttribute("content-old");
					}

					if (status === 0 || (status >= 200 && status < 400)) {
						resolve(JSON.parse(xhr.responseText));
					} else {
						reject({
							status: this.status,
							statusText: xhr.statusText
						});
					}
				}
			};
			xhr.onerror = function () {
				if(options.isForm){
					button = options.form.querySelector('button[type="submit"]');
					button.disabled = false;
					button.innerHTML = button.getAttribute("content-old");
				}
				reject({
				  status: this.status,
				  statusText: xhr.statusText
				});
			};
			if(options.data){
				const formData = new FormData();
				for(const [key,value] of Object.entries(options.data)){
					if(key !== 'files'){
						formData.append(key,value);
					}
				};

				if(options.data.files){
					options.data.files.forEach(function(file){
						formData.append("files[]",file);
					})
				}

				xhr.send(formData);
			}else{
				xhr.send();
			}
		});
	};

	return {
		_send: function (data) {
			return _send(data);
		},
	};
})();