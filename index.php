<?php 

session_start();
require "config/config.php";

?>

<?php if(!isset($_SESSION["user"])): ?>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <div id="g_id_onload"
        data-client_id="<?php echo $goo->getClientId(); ?>"
        data-context="signin"
        data-callback="googleLoginEndpoint"
        data-close_on_tap_outside="false">
    </div>
    <script>
    // callback function that will be called when the user is successfully logged-in with Google
    function googleLoginEndpoint(googleUser) {
 
        // send an AJAX request to register the user in your website
        let ajax = new XMLHttpRequest();
 
        // path of server file
        ajax.open("POST", "google-sign-in.php", true);
        // callback when the status of AJAX is changed
        ajax.onreadystatechange = function () {
            // when the request is completed
            if (this.readyState == 4) {
                // when the response is okay
                if (this.status == 200) {
                    window.location.href = "welcome.php";
                }
                // if there is any server error
                if (this.status == 500) {
                    console.log(this.responseText);
                }
            }
        };
        // send google credentials in the AJAX request
        let formData = new FormData();
        formData.append("id_token", googleUser.credential);
        ajax.send(formData);
    }
</script>
<?php endif; ?>

