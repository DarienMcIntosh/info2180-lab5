document.addEventListener("DOMContentLoaded", function() {
    const lookupButton = document.getElementById("lookup");
    const resultContainer = document.getElementById("result");

    lookupButton.addEventListener("click", function() {
        // Retrieve the value entered by the user
        const countryInput = document.getElementById("country");
        const countryName = countryInput.value.trim();

        // Create an XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Configure it to make a GET request to world.php with the country parameter
        xhr.open("GET", `world.php?country=${encodeURIComponent(countryName)}`, true);

        // Set up a callback function to handle the response
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Success! Print the response into the result container
                resultContainer.innerHTML = xhr.responseText;
            } else {
                // Error handling
                resultContainer.innerHTML = "<p>Error retrieving data.</p>";
            }
        };

        // Handle network errors
        xhr.onerror = function() {
            resultContainer.innerHTML = "<p>Network error occurred.</p>";
        };

        // Send the request
        xhr.send();
    });
});