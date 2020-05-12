var uiConfig = {
    callbacks: {
        signInSuccessWithAuthResult: function(authResult, redirectUrl) {
            var user = authResult.user;
            var isNewUser = authResult.additionalUserInfo.isNewUser;
            var user_id = user.uid;
            var user_email = user.email;
            if(isNewUser) {
                // Add User Into Database
                var displayName = user.displayName;
                $.post('create_account.php', { uid: user_id, name: displayName, email: user_email}, {async: false});
            } else {
                // Set Session & Cookies | Do "Login State"
                $.post('check_login.php', { uid: user_id}, {async: false});
            }
            return true;
        },
        signInFailure: function(error) {
            // Handle Errors
            return handleUIError(error);
        },
        uiShown: function() {
            document.getElementById('loader').style.display = 'none';
        }
    },
    signInSuccessUrl: 'http://localhost/web/home.php',
    signInOptions: [
        firebase.auth.FacebookAuthProvider.PROVIDER_ID,
        firebase.auth.GoogleAuthProvider.PROVIDER_ID,
        firebase.auth.EmailAuthProvider.PROVIDER_ID
    ],
    tosUrl: 'https://',
    privacyPolicyUrl: function() {
       window.location.assign('https://');
    }
};
var ui = new firebaseui.auth.AuthUI(firebase.auth());

ui.start('#firebaseui-auth-container', uiConfig);