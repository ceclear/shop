function ajax(options) {
    if(options.need_hide==1){
        $('#loading').css('display', 'block');
    }

    // 默认参数;
    let _default = {
        type: "GET",
        url: "",
        data: null,
        dataType: "text",
        status: null,
        success: function (res) {
            if (options.need_alert && options.need_alert == 1) {
                cocoMessage.success(res.message)
            }
            // cocoMessage.success(res.message)
            if (options.callback) {
                if (options.callback == 'g') {
                    // setTimeout(function () {
                        self.location = document.referrer;
                    // }, 2000)
                }
                if (options.callback == 'f') {
                    options.func(res);
                }
            }

        },
        complete: function () {
            // setTimeout(function () {
                $('#loading').css('display', 'none');
            // }, 1500)

        },
        error: function (res) {

            cocoMessage.warning(res.message,)
            // $('#loading').css('display', 'none');


        }
    }

    options = assign(_default, options);
    options.type = options.type.toLowerCase();
    // 如果存在context;
    if (isObject(options.context)) {
        let callback_list = ["success", "complete", "error"];

        callback_list.forEach(function (item) {
            options[item] = options[item].bind(options.context);
        })
    }

    // 1. 创建shr ;
    let xhr = null;
    if (typeof XMLHttpRequest === "function") {
        xhr = new XMLHttpRequest();
    } else {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    // 1. 如果请求方式为get，那么我们把数据拼接到url上;
    if (options.type === "get") {
        options.url = toUrlData(options.data, options.url, options.type)
    }
    // 2. 如果请求方式为post，那么我们把数据拼接到data上;
    if (options.type === "post") {
        options.data = toUrlData(options.data, options.url, options.type)
    }
    // 2. 根据数据进行方法的调用;
    xhr.open(options.type, options.url, true);
    options.type === "post" ? xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded") : "";
    // 3. 调用send方法;
    xhr.send(options.type === "get" ? null : options.data);
    // 4. 调用回调函数;
    xhr.onreadystatechange = function () {
        // xhr程序运行结束;
        if (xhr.readyState === 4) {
            options.complete();
            if (/^2\d{2}$/.test(xhr.status)) {
                // 5.传递数据
                // 如果需要转换成json那么我们就返回json,如果不需要原样返回;
                // 如果JSON.parse报错了那么我们要调用错误函数;
                try {
                    let res = options.dataType === "json" ? JSON.parse(xhr.responseText) : xhr.responseText;
                    if (res.code == 0) {
                        options.success(res);
                    } else {
                        options.error(res);
                    }

                } catch (e) {
                    options.error(e, xhr.status);
                }
            } else {
                options.error("error", xhr.status);
            }
            // 策略模式调用 :
            if (isObject(options.status)) {
                typeof options.status[xhr.status] === "function" ? options.status[xhr.status]() : "";
            }
        }
    }
}

function assign() {
    let target = arguments[0];
    for (let i = 1; i < arguments.length; i++) {
        for (let attr in arguments[i]) {
            target[attr] = arguments[i][attr];
        }
    }
    return target;
}

function toUrlData(obj, url, method) {
    if (isObject(obj)) {
        let str = "";
        for (let attr in obj) {
            str += "&" + attr + "=" + obj[attr]
        }
        str = str.slice(1);
        method = method || "";
        if (method.toUpperCase() === "POST") {
            return str;
        }
        url += "?" + str;
        return url;
    }
    return url;
}

function isObject(data) {
    return (typeof data === "object" && data !== null && data.constructor && data.constructor === Object)
}

function formToJson(obj) {
    let data = $(obj).serializeArray(); //先进行序列化数组操作
    let postData = {};  //创建一个对象
    $.each(data, function (n, v) {
        postData[data[n].name] = data[n].value;  //循环数组，把数组的每一项都添加到对象中
    });
    return postData;
}

function validateRequire(obj) {
    let data = $(obj); //先进行序列化数组操作
    let success = true;
    $.each(data, function (n, v) {
        let re = $(v).attr('required');
        let val = $(v).val();
        let tip = $(v).data('tip');
        if (re === 'required' && val === '') {
            cocoMessage.error('请填写' + tip);
            $(v).focus();
            success = false;
            return false;
        }
    });
    return success;
}

function loadingShow(t) {
    Dialog.init('<img src="assets/dialog/dist/load3.gif" width="48px"/>', {
        mask: 0,
        addClass: 'dialog_load',
        time: t
    });
}


