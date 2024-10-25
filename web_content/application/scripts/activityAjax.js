function updateActivitiesTable(activities){
    document.getElementById('activities').innerHTML = "";
    activities.forEach((activity) => {
        let onClickString1 = 'onclick="changeActivityEndingDate('+ "'" + activity.id + "','" + activity.endingDate + "','"+rootUrl+"activityController/modifyEndingDate/')" + '"';
        let onClickString2 = 'onclick="changeActivityHours('+ "'" + activity.id + "','" + activity.hours + "','"+rootUrl+"activityController/modifyHours/')" + '"';
        let onClickString3 = 'onclick="changeActivityDescription('+ "'" + activity.id + "','" + activity.description + "','"+rootUrl+"activityController/modifyDescription/')" + '"';
        let onClickString4 = 'onclick="changeActivityState('+ "'" + activity.id + "','" + activity.state + "','"+rootUrl+"activityController/modifyState/')" + '"';
        document.getElementById('activities').innerHTML +=
            "<tr><td>" + activity.id +
            "</td><td>" + activity.startingDate +
            "</td><td " + onClickString1 + ">" + activity.endingDate +
            "</td><td " + onClickString2 + ">" + activity.hours +
            "</td><td " + onClickString3 + ">" + activity.description +
            "</td><td " + onClickString4 + ">" + activity.state + "</td></tr>";
    });
}
function changeActivityEndingDate(activityId, currentEndingDate, url) {
    var newEndingDate = prompt("Change the date:", currentEndingDate);
    if (newEndingDate !== null && newEndingDate !== currentEndingDate) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        updateActivitiesTable(response.activities);
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("activityId=" + activityId + "&newEndingDate=" + encodeURIComponent(newEndingDate));
    }
}

function changeActivityHours(activityId, currentHours, url) {
    var newHours = prompt("Change the date:", currentHours);
    if (newHours !== null && newHours !== currentHours) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // Update the members list on the page if the request was successful
                    if (response.success) {
                        updateActivitiesTable(response.activities);
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("activityId=" + activityId + "&newHours=" + encodeURIComponent(newHours));
    }
}

function changeActivityDescription(activityId, currentDescription, url) {
    var newDescription = prompt("Change the date:", currentDescription);
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
                        updateActivitiesTable(response.activities);
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("activityId=" + activityId + "&newDescription=" + encodeURIComponent(newDescription));
    }
}

function changeActivityState(activityId, currentState, url) {
    var newState = prompt("Change the state(InProgress,Completed):", currentState);
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
                        updateActivitiesTable(response.activities);
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("activityId=" + activityId + "&newState=" + encodeURIComponent(newState));
    }
}

function getCurrentDateFormatted() {
    const today = new Date();

    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Mesi da 0 a 11, quindi aggiungere 1
    const day = String(today.getDate()).padStart(2, '0'); // Giorni da 1 a 31

    return `${year}-${month}-${day}`;
}

function newActivity(projectId,url) {
    var endingDate = prompt("Insert the ending date of the activity: ", getCurrentDateFormatted());
    if (endingDate !== null) {
        // Send AJAX request to the server to create the new projects
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);  // Assicurati che l'URL sia corretto
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        updateActivitiesTable(response.activities);
                    } else {
                        alert("Error: " + response.message);
                    }
                } catch (e) {
                    alert("Error parsing response: " + e);
                }
            }
        };
        xhr.send("projectId=" + projectId + "&endingDate=" + encodeURIComponent(endingDate));
    }
}