function addMoreProductDetails(){
    var uuid = makeId(25);
    $("#product_details_form").append("<div id='"+uuid+"'><label for=\"size\">Size:</label>\n" +
        "    <input type=\"text\" name=\"size[]\">\n" +
        "\n" +
        "    <label for=\"color\">Color:</label>\n" +
        "    <input type=\"text\" name=\"color[]\">\n" +
        "\n" +
        "    <button type=\"button\" onclick=\"removeDiv('"+uuid+"')\">Remove</button>\n" +
        "    <hr></div>");
}

function removeDiv(id){
    $("#"+id).remove();
}

function makeId(len) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRS213213234asdkhaskdTUVWX-909213YZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < len; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}