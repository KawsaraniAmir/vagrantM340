
function updateProjectMemberTable(projectId, users){
    document.getElementById('users').innerHTML = "";
    users.forEach((user) => {
        let onClickString = 'onclick="removeUserFromProject('+ "'" + projectId + "','" + user.username + "','" + rootUrl + "projectController/removeUser')" + '"';
        document.getElementById('users').innerHTML +=
            "<tr><td>" + user.username +
            "</td><td>" + user.name +
            "</td><td>" + user.surname +
            "</td><td>" + user.city +
            "</td><td><a " + onClickString +
            ">Remove</a></td></tr>";
    });
}
function changeProjectDescription(projectId, currentDescription, url) {
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
                        document.getElementById('description').innerHTML = newDescription;
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("projectId=" + projectId + "&newDescription=" + encodeURIComponent(newDescription));
    }
}

function changeProjectState(projectId, currentState, url) {
    var newState = prompt("Change the state (Inactive, Active, Finished, Stopped):", currentState);
    if (newState !== null && newState !== currentState) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        document.getElementById('state').innerHTML = newState;
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("projectId=" + projectId + "&newState=" + encodeURIComponent(newState));
    }
}
function addUserToProject(projectId,url) {
    var username = prompt("Insert the name of the user");
    if (username !== null) {
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
                        updateProjectMemberTable(projectId,response.users);
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("projectId=" + projectId + "&username=" + encodeURIComponent(username));
    }

}

function removeUserFromProject(projectId,username,url) {
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
                    updateProjectMemberTable(projectId,response.users);
                } else {
                    alert("Error: " + response.message);
                }
            } catch (e) {
                alert("Error parsing response: " + e);
            }
        }
    };
    xhr.send("projectId=" + projectId + "&username=" + encodeURIComponent(username));
}

function newProject(url) {
    var projectName = prompt("Insert the name of the project");
    if (projectName !== null) {
        // Send AJAX request to the server to create the new projects
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);  // Assicurati che l'URL sia corretto
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        let onClickString = 'onclick="window.location=' + "'" + rootUrl + "home/project/" + response.project.id + "'"+'"';
                        document.getElementById('projects').innerHTML +=
                            "<tr " + onClickString + "><td>" + response.project.id +
                            "</td><td>" + response.project.name +
                            "</td><td>" + response.project.startingDate +
                            "</td><td>" + response.project.author +
                            "</td><td>" + response.project.description +
                            "</td><td>" + response.project.state +
                            "</td><td>" + response.project.type +
                            "</td></tr>";
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("projectName=" + encodeURIComponent(projectName));
    }
}