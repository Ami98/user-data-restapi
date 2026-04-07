document.addEventListener("DOMContentLoaded", function () {

    fetch(udvRest.rest_url)
        .then(res => res.json())
        .then(data => {

            let output = "<ul>";

            data.forEach(user => {
                output += `<li>${user.name} - ${user.email}</li>`;
            });

            output += "</ul>";

            document.getElementById("rest-users").innerHTML = output;
        });

});