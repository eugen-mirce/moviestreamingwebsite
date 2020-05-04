var uiConfig = {
    callbacks: {
        signInSuccessWithAuthResult: function(authResult, redirectUrl) {
            var user = authResult.user;
            var isNewUser = authResult.additionalUserInfo.isNewUser;
            var user_id = user.uid;
            var user_email = user.email;
            //alert(JSON.stringify(user));
            if(isNewUser) {
                // Add User Into Database
                var displayName = user.displayName;
                $.post('create_account.php', { uid: user_id, name: displayName, email: user_email}, {async: false});
            } else {
                // Set Session & Cookies | Do "Login State"
                $.post('set_session_id.php', { uid: user_id}, {async: false});
            }
            return true;
        },
        signInFailure: function(error) {
            // Some unrecoverable error occurred during sign-in.
            // Return a promise when error handling is completed and FirebaseUI
            // will reset, clearing any UI. This commonly occurs for error code
            // 'firebaseui/anonymous-upgrade-merge-conflict' when merge conflict
            // occurs. Check below for more details on this.
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
// Initialize the FirebaseUI Widget using Firebase.
var ui = new firebaseui.auth.AuthUI(firebase.auth());

// The start method will wait until the DOM is loaded.
ui.start('#firebaseui-auth-container', uiConfig);