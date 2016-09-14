/**
 * Created by Eez on 07/09/2016.
 */

var searchbox;
var searchbutton;

window.onload = function(){
    document.getElementById("loginlink").onclick = function(){
        document.getElementById('loginframe').style.visibility = 'visible';
    };

    document.getElementById('loginframe').contentWindow.document.getElementById("cancelbtn").onclick = function(){
        document.getElementById('loginframe').style.visibility = 'hidden';
    };

    var d = new Date();
    document.getElementById("footer").innerHTML += d.getFullYear();

    // document.getElementById("logout").onclick = function(){
    //     location.href = "home.php"
    // };

    searchbox = document.getElementById("searchtype");
    searchbutton = document.getElementById("searchsubmit");
};

    function cancel() {
        window.history.back();
        window.frameElement.style.visibility = 'hidden';
        // this.parentNode.style.display = 'none';
        // document.getElementById('loginframe').style.visibility = 'hidden';
    }

    function cancelLogin(){
        window.frameElement.style.visibility = 'hidden';
    }

    function login() {
        searchbutton.disabled = false;
        searchbox.disabled = false;
    }

    
    // function submitForgot() {
    //     var valid = window.document.forms['loginform'].checkValidity();
    //     if(valid) {
    //         window.location = "thanksframe.html";
    //     }
    // }