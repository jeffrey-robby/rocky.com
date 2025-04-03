/*******************
    signn_in.php
    login script
    *******************/
    $("#SingIn").on("submit", async function (e) {
        e.preventDefault();
        try {
            let formData = new FormData(this);
            let response = await fetch("Async.php", {
                method: "POST",
                body: formData
            });

            if (response.ok) {
                let result = await response.text();
                if (result == "false") {
                    getToastrOptions(0);
                }else{
                    let days = 7;
                    let date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    let expires = "; expires=" + date.toUTCString();
                    document.cookie = "user_cookie" + "=" + result + expires + "; path=/";
                    window.location.href= "../index.php";
                }
            } else {
                getToastrOptions(2);
            }
        } catch (error) {
            console.error('Error during login:', error);
            getToastrOptions(2);
        }
    });