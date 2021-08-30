var XHR = (function () {
    var _send = function (options) {
        return new Promise(function (resolve, reject) {
            const xhr = new XMLHttpRequest();
            if(options.isForm){
                xhr.open(options.form.getAttribute('method'), options.form.getAttribute('action'), true);
                let button = options.form.querySelector('button[type="submit"]');
                Object.assign(button.style, {
                    width: `${button.offsetWidth}px`,
                    height: `${button.offsetHeight}px`,
                    position: `relative`,
                });
                button.setAttribute("content-old", button.innerHTML);
                button.disabled = true;
                button.innerHTML = `<div class="r-s-loader"></div><style>.r-s-loader{position:absolute;left:50%;top:50%;border:5px solid #f3f3f3;border-radius:50%;border-top:5px solid #fff;border-bottom:5px solid #fff;border-left:5px solid transparent;border-right:5px solid transparent;width:${button.offsetHeight - 16}px;height:${button.offsetHeight - 16}px;-webkit-animation:spin 2s linear infinite;animation:spin 2s linear infinite}@-webkit-keyframes spin{0%{-webkit-transform:translate(-50%,-50%) rotate(0)}100%{-webkit-transform:translate(-50%,-50%) rotate(360deg)}}@keyframes spin{0%{transform:translate(-50%,-50%) rotate(0)}100%{transform:translate(-50%,-50%) rotate(360deg)}}</style>`;
            }else{
                if(options.method == 'GET'){
                    if (options.datas && typeof options.datas === 'object') {
                        var params = Object.entries(options.datas).map(([key, value]) => `${key}=${value}`).join("&");
                        options.url = options.url + '?' + params;
                    }
                }
                xhr.open(options.method, options.url, true);
            }

            xhr.onreadystatechange = function () {
                // In local files, status is 0 upon success in Mozilla Firefox
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    var status = xhr.status;

                    if(options.isForm){
                        let button = options.form.querySelector('button[type="submit"]');
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
            if(options.isForm || options.method == 'POST'){
                const formData = new FormData();
                if(options.form){
                    var enableInputs = options.form.querySelectorAll(
                        "[name]:not([disabled])"
                    );
    
                    var dataValues = Array.from(enableInputs).reduce(function (values,input) {
                        switch (input.type) {
                            case "radio":
                                var radioChecked = formElement.querySelector(
                                    `input[name="${input.name}"]:checked`
                                );
                                if (radioChecked !== null) {
                                    values[input.name] = radioChecked.value;
                                } else {
                                    values[input.name] = "";
                                }
                                break;
                            case "checkbox":
                                if (input.matches(":checked")) {
                                    if (!Array.isArray(values[input.name])) {
                                        values[input.name] = [];
                                    }
                                    values[input.name].push(input.value);
                                } else if (values[input.name] == undefined) {
                                    values[input.name] = "";
                                }
                                break;
                            case "file":
                                values["image"] = input.files;
                                inputFile = input.name;
                                break;
                            default:
                                values[input.name] = input.value;
                        }
                        return values;
                    },
                    {});
                }else{
                    var dataValues = options.datas; 
                }
                for(const [key,value] of Object.entries(dataValues)){
                    if(key !== 'files'){
                        formData.append(key,value);
                    }
                };

                if(dataValues.files){
                    dataValues.files.forEach(function(file){
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
        send: function (data) {
            return _send(data);
        },
    };
})();