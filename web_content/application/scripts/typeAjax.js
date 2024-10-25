function updateTypeTable(types){
    document.getElementById('types').innerHTML = "";
    types.forEach((type) => {
        let onClickString1 = 'onclick="changeTypeName('+ "'" + type.name + "','"+rootUrl+"typeController/modifyName/')" + '"';
        let onClickString2 = 'onclick="changeTypeDescription('+ "'" + type.name + "','" + type.description + "','"+rootUrl+"typeController/modifyDescription/')" + '"';
        document.getElementById('types').innerHTML +=
            "<tr><td " + onClickString1 + ">" + type.name +
            "</td><td " + onClickString2+ ">" + type.description + "</td></tr>";
    });

}
function newType(url) {
    var typeName  = prompt("Insert the name of the type");
    if (typeName !== null) {
        // Send AJAX request to the server to create the new projects
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);  // Assicurati che l'URL sia corretto
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        let type =  response.type;
                        let onClickString1 = 'onclick="changeTypeName('+ "'" + type.name + "','"+rootUrl+"typeController/modifyName/')" + '"';
                        let onClickString2 = 'onclick="changeTypeDescription('+ "'" + type.name + "','" + type.description + "','"+rootUrl+"typeController/modifyDescription/')" + '"';
                        document.getElementById('types').innerHTML +=
                            "<tr><td " + onClickString1 + ">" + type.name +
                            "</td " + onClickString2 + "><td>" + type.description +
                            "</td></tr>";
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("typeName=" + encodeURIComponent(typeName));
    }
}
function changeTypeName(name,url) {
    var newName = prompt("Change the name:", name);
    if (newName !== null && newName !== name) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        updateTypeTable(response.types);
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("name=" + name + "&newName=" + encodeURIComponent(newName));
    }
}

function changeTypeDescription(name, currentDescription,url) {
    var newDescription = prompt("Change the description:", currentDescription);
    if (newDescription !== null && newDescription !== currentDescription) {

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        updateTypeTable(response.types);
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("name=" + name + "&newDescription=" + encodeURIComponent(newDescription));
    }
}