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
    var submitForm = function(e) {
        e.preventDefault();
        var POST = {
            username : $(module.username).val(),
            password : $(module.password).val()
        };
        var usernameExists = POST.username.length > 0
        var passwordExists = POST.password.length > 0
        if (!usernameExists && !passwordExists) {
            alert('You must provide a username and password to login.');
            console.log('You must provide a username and password to login.');
            //module.displayMsg('error', 'You must provide a username and password to login.');
            return false;
        }
        if (POST.username.length == 0) {
            alert('You must provide a username to login.');
            console.log('You must provide a username to login.');
            //module.displayMsg('error', 'You must provide a username to login.');
            return false;
        }
        if (POST.password.length == 0) {
            alert('You must provide a password to login.');
            console.log('You must provide a password to login.');
            //module.displayMsg('error', 'You must provide a password to login.');
            return false;
        }
        $.post(config.ajaxURL, POST, function(data) {
            if (data.success) {
                //module.displayMsg('success', data.success);
                console.log(data.success);
            }
            if (data.error) {
                //module.displayMsg('error', data.error);
                console.log(data.error);
            }
        })
        .error(function() {
            module.displayMsg('error', 'Unable to reach server.');
        });
    };
    module.setTheme = function(theme) {
        config.theme = theme;
        $(id).attr('data-theme', config.theme);
    };
    module.displayMsg = function(type, msg) {
        $(module.message).find('p').removeClass('success error').addClass(type).text(msg).show();
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
        if ($('body').attr('data-browser') == 'msie' && $('body').attr('data-version') == '9.0') {
            $(module.username).val('Apple ID');
            $(module.password).val('Password');
        }
    };
};

$(function() {
    Login.prototype.id = 0;
    var initAll = function() {
        $('div[data-module=login]').each(function(i, module) {
            if (!$(module).is('[id]')) {
                Login.prototype.id++;
                var id = 'login-' + Login.prototype.id;
                $(module).attr('id', id);
                var login = new Login('#' + id);
                login.init();
            }
        });
    };
    initAll();
    $(document).on('click', '#navigation a.add-instance', function() {
        Handlebars.renderTemplate('login-module', {}, 'body', 'append');
        initAll();
    });
});