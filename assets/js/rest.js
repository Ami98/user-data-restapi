document.addEventListener("DOMContentLoaded", function () {

    const container = document.getElementById("rest-users");
    if (!container) {
       // console.error("Container element not found");
        return;
    }

    fetch(udvRest.rest_url)
        .then(res => res.json())
        .then(data => {

            let output = "<ul>";

            data.forEach(user => {
                output += `<li>${user.name} - ${user.email} - ${user.address.city} - ${user.address.geo.lng}</li>`;
            });

            output += "</ul>";

           container.innerHTML = output;
        })
            .catch(() => {
                container.innerHTML = "Error loading users";
            });
});