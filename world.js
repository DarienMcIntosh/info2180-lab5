document.addEventListener("DOMContentLoaded", function() {
    const lookupButton = document.getElementById("lookup");
    const resultContainer = document.getElementById("result");
    const countryInput = document.getElementById("country");

    lookupButton.addEventListener("click", function() {
        // Retrieve the value entered by the user
        const countryName = countryInput.value.trim();

        // Create an XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Adjust the query parameters based on user input
        const queryParams = countryName !== "" ? `country=${encodeURIComponent(countryName)}` : "";

        // Configure it to make a GET request to world.php with the adjusted parameters
        xhr.open("GET", `world.php?${queryParams}`, true);

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
