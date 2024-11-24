document.addEventListener("DOMContentLoaded", function () {
    const lookupButton = document.getElementById("lookup");
    const lookupCitiesButton = document.getElementById("lookupCities");
    const resultContainer = document.getElementById("result");

    lookupButton.addEventListener("click", function () {
        fetchData("countries");
    });

    lookupCitiesButton.addEventListener("click", function () {
        fetchData("cities");
    });

    function fetchData(lookupType) {
        const countryInput = document.getElementById("country");
        const countryName = countryInput.value.trim();
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `http://localhost/info2180-lab5/world.php?country=${encodeURIComponent(countryName)}&lookup=${lookupType}`, true);
        
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                resultContainer.innerHTML = xhr.responseText;
            } else {
                resultContainer.innerHTML = "<p>Error retrieving data.</p>";
            }
        };
        
        xhr.onerror = function () {
            resultContainer.innerHTML = "<p>Network error occurred.</p>";
        };
        
        xhr.send();
    }
});


