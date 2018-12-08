
var submenu_slug_array = ["baseball", "flag-football", "team", "settings"]

//when user mouses over menu item, sub menu appears beneath
function submenuMouseOver(slug){
    $("#" + slug).mouseover(function(){
        $("#" + slug + "-submenu").removeClass("menu-invisible");
    });
    $("#" + slug + "-submenu").mouseover(function(){
        $("#" + slug + "-submenu").removeClass("menu-invisible");
    });
}

// //when user mouses out of menu item, sub menu disappears
function submenuMouseOut(slug){
    $("#" + slug).mouseout(function(){
        $("#" + slug + "-submenu").addClass("menu-invisible");
    });
    $("#" + slug + "-submenu").mouseout(function(){
        $("#" + slug + "-submenu").addClass("menu-invisible");
    });
}

// //creates mouseout/mouseover events for all submenus included in slug_array
$.each(submenu_slug_array, function( index, slug){
    submenuMouseOver(slug);
    submenuMouseOut(slug);
});


function loadUrgentMessage(){
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText); //if returning a json object
           
            document.getElementById("urgentMessage").innerHTML = myObj;
            
        }
    };
    ajax.open("GET", "urgent.php", true);
    ajax.send();
}
loadUrgentMessage();