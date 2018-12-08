
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



