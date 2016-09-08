/**
 * Created by Eez on 07/09/2016.
 */

window.onload = function(){
    document.getElementById("loginlink").onclick = function(){
        document.getElementById('loginframe').style.visibility = 'visible';
    };

    document.getElementById('loginframe').contentWindow.document.getElementById("cancelbtn").onclick = function(){
        document.getElementById('loginframe').style.visibility = 'hidden';
    };
};
