function updateUserTable(users){
    document.getElementById('users').innerHTML = "";
    users.forEach((user) => {
        let onClickString = 'onclick="removeUser('+ "'" + user.username + "','" + rootUrl + "projectController/delete')" + '"';
        document.getElementById('users').innerHTML +=
            "<tr><td>" + user.username +
            "</td><td>" + user.name +
            "</td><td>" + user.surname +
            "</td><td>" + user.city +
            "</td><td><a " + onClickString +
            ">Remove</a></td></tr>";
    });
}

function changeUserUsername(currentUsername, url) {
    var newUsername = prompt("Change the username:", currentUsername);
    if (newUsername !== null && newUsername !== currentUsername) {

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        document.getElementById('username').innerHTML = newUsername;
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("username=" + currentUsername + "&newUsername=" + encodeURIComponent(newUsername));
    }
}
function changeUserName(username, currentName, url) {
    var newName = prompt("Change the name:", currentName);
    if (newName !== null && newName !== currentName) {

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        document.getElementById('name').innerHTML = newName;
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("username=" + username + "&newName=" + encodeURIComponent(newName));
    }
}

function changeUserSurname(username, currentSurname, url) {
    var newSurname = prompt("Change the surname:", currentSurname);
    if (newSurname !== null && newSurname !== currentSurname) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        document.getElementById('surname').innerHTML = newSurname;
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("username=" + username + "&newSurname=" + encodeURIComponent(newSurname));
    }
}

function changeUserCity(username, currentCity, url) {
    var newCity = prompt("Change the surname:", currentCity);
    if (newCity !== null && newCity !== currentCity) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        document.getElementById('city').innerHTML = newCity;
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("username=" + username + "&newCity=" + encodeURIComponent(newCity));
    }
}

function changeUserRole(username, currentRole, url) {
    var newRole = prompt("Change the surname:", currentRole);
    if (newRole !== null && newRole !== currentRole) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        document.getElementById('role').innerHTML = newRole;
                        if(username == response.username){
                            location.reload();
                        }
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("username=" + username + "&newRole=" + encodeURIComponent(newRole));
    }
}
function newUser(url) {
    var password = prompt("Insert the password of the user");
    if (password !== null) {
        // Send AJAX request to the server to add the user to the projects
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);  // Assicurati che l'URL sia corretto
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        updateUserTable(response.users);
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("password=" + encodeURIComponent(password));
    }
}

function deleteUser(username,url) {
    var confirmation = prompt("Are you sure? Type 'Sure");
    if (confirmation == "Sure") {
        // Send AJAX request to the server to add the user to the projects
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);  // Assicurati che l'URL sia corretto
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        updateUserTable(response.users);
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("username=" + encodeURIComponent(username));
    }
}