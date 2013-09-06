/* * * * * * * * * * * * * * * * * * * * * * * * *
 * Login Module
 *
 * Author: Zachary Fisher - zfisher@zfidesign.com
 * * * * * * * * * * * * * * * * * * * * * * * * */
Login = function(id) {
    var module = this;
    var config = {
        theme : 'default',
        ajaxURL : '/api/user/login/'
    };
    module.setTheme = function(theme) {
        config.theme = theme;
        $(id).attr('data-theme', config.theme);
    };
    module.displayMsg = function(type, msg) {
        $(module.message).find('p').removeClass('success error').addClass(type).text(msg).show();
    };
    var submitForm = function(e) {
        e.preventDefault();
        var POST = {
            username : $(module.username).val(),
            password : $(module.password).val()
        };
        var usernameExists = POST.username.length > 0
        var passwordExists = POST.password.length > 0
        if (!usernameExists && !passwordExists) {
            module.displayMsg('error', 'You must provide credentials to login.');
            return false;
        }
        if (POST.username.length == 0) {
            module.displayMsg('error', 'You must provide a username to login.');
            return false;
        }
        if (POST.password.length == 0) {
            module.displayMsg('error', 'You must provide a password to login.');
            return false;
        }
        $(module.submitBtn).attr('disabled', '');
        $.post(config.ajaxURL, POST, function(data) {
            $(module.submitBtn).prop('disabled', false);
            if (data.success) {
                module.displayMsg('success', data.success);
                console.log(data.success);
            }
            if (data.error) {
                module.displayMsg('error', data.error);
                console.log(data.error);
            }
        })
        .error(function() {
            module.displayMsg('error', 'Unable to reach server.');
            $(module.submitBtn).prop('disabled', false);
        });
    };
    module.init = function(opts) {
        if (typeof opts !== 'undefined') $.extend(config, opts);
        module.message   = $(id).find('div.message');
        module.form      = id + ' form';
        module.username  = module.form + ' input[name=username]';
        module.password  = module.form + ' input[name=password]';
        module.submitBtn = module.form + ' input[name=submit]';
        module.setTheme(config.theme);
        $(document).on('submit', module.form, submitForm);
        $(id).data('login', module);
    };
};

$(function() {
    Login.prototype.existingIDs = [];
    var getRandomInt = function(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    };
    $('div[data-module=login]').each(function(i, module) {
        var id = 'login-' + getRandomInt(0, 12345);
        while ($.inArray(id, Login.prototype.existingIDs) != -1) {
            id = 'login-' + getRandomInt(0, 12345);
        }
        Login.prototype.existingIDs.push(id);
        $(module).attr('id', id);
        var login = new Login('#' + id);
        login.init();
    });
});