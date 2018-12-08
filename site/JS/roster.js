$(".editButton").click(function () {
    var $row = $(this).closest("tr"),       // Finds the closest row <tr> 
        $tds = $row.find("td:first");
    console.log($tds[0].innerText);
});

$(".deleteButton").click(function () {
    var $row = $(this).closest("tr"),       // Finds the closest row <tr> 
        $tds = $row.find("td:first");
    console.log($tds[0].innerText);
});